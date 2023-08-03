<?php
    class Main {
        protected $db;

        public function __construct() {
            $this->db = $this->db_connect();
        }

        private function db_connect() {
            $mysqli = new mysqli(HOST, USER, PASS, DATA);
 
            if ($mysqli -> connect_error) {
                printf("Соединение не удалось: %s\n", $mysqli -> connect_error);
                exit();
            }
            return $mysqli;
        }

        public function query($q = false) {
            if ($q == false) {
                printf("Аргумент отсутствует или недоступен.");
                exit();
            }

            if($this->db->multi_query($q)) {
                $index = 0; 
                do {
                    if ($result = $this->db->store_result()) {
                        while ($row = $result->fetch_assoc()) {
                            $data[$index][] = $row;
                        }
                        if(!$this->db->affected_rows) 
                            $data["affected_rows"][$index] = true;
                        $result->free(); 
                        $index++;
                    } 
                } while ($this->db->next_result());

            } 

            return $data;
        }

        public function auth($post = array()) {
            if (empty($post["login"]) or empty($post["password"])) {
                printf("Заполните оба поля!");
                exit();
            }
            $sql   = "SELECT * from `users` WHERE `login` = '{$post["login"]}';";
            $query = $this->query($sql);
            $data  = $query[0][0];
            $password = md5(md5($post["password"]));

            if ($password == $data["password"]) {
                $result = array(
                    "success" => 1,
                    "message" => "Вы успешно авторизованы!"
                );
                $_SESSION["user_id"] = $data["id"];
            }
            else {
                $result = array(
                    "success" => 0,
                    "message" => "Неверный логин или пароль!"
                );
            }
            return $result;
        }

        public function get_user_data($id) {
            $sql   = "SELECT * FROM `users` WHERE `id` = '{$id}';";
            $query = $this->query($sql);
            $data  = $query[0][0];
            return $data;
        }

        public function logout() {
            unset($_SESSION["user_id"]);
            return "<meta http-equiv='refresh' content='0; URL=/'>";
        }

        public function add_post($post) {
            if (empty($post["title"]) or empty($post["text"])) {
                return array(
                    "success" => 0,
                    "message" => "Заполните все поля!"
                );
            }
            $title = addslashes($post["title"]);
            $text = addslashes($post["text"]);
            $sql = "INSERT INTO `posts` (`author_id`, `text`, `title`, `pub_date`) VALUES ('{$_SESSION["user_id"]}', '{$text}', '{$title}', now());";
            $query = $this->query($sql);
            return array(
                "success" => 1,
                "message" => "<meta http-equiv='refresh' content='0; URL=/'>"
            );
        }

        public function get_posts($config) {
            $start = ($config["start"] ? (int)$config["start"] : "0");
            $sql = "SELECT * FROM `posts`";
            if ($config["id"]) {
                $sql .= " WHERE `id`= {$config["id"]}";
            }
            else {
                $sql .= " ORDER BY `id` DESC LIMIT {$start}, {$config["limit"]};";
            }
            $query = $this->query($sql);
            return $query[0];
        }
        
        public function edit_post($post) {
            if (empty($post["title"]) or empty($post["text"])) {
                return array(
                    "success" => 0,
                    "message" => "Заполните все поля!"
                );
            }
            $title = addslashes($post["title"]);
            $text = addslashes($post["text"]);
            $sql = "UPDATE `posts` SET `text` = '{$text}', `title` = '{$title}' WHERE `id` = '{$_GET['id']}';";
            $query = $this->query($sql);
            return array(
                "success" => 1,
                "message" => "<meta http-equiv='refresh' content='0; URL=/?route=post&id={$_GET['id']}'>"
            );
        }

        public function delete_post() {
            $sql = "DELETE FROM `posts` WHERE `id`='{$_GET['id']}';";
            $query = $this->query($sql);
            return "<meta http-equiv='refresh' content='0; URL=/'>";
        }
    }
?>