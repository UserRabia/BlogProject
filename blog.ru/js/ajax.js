var postPage = 1;
var lastGetDataTime = new Date($.now());

$(document).scroll(function(e) {
    var scroll = $(window).scrollTop();
    var windowHeight = $("body").height();
    var diff = parseInt(windowHeight) - (window.screen.width / 2) - parseInt(scroll);
    var now  = new Date($.now());
    var seconds = (now.getTime() - lastGetDataTime.getTime()) / 1000;


    if( diff < 200 && seconds >= 2 ) {
        $.ajax({ 
            url: '/ajax.php?route=addPosts&page=' + postPage,
            method: "GET",  
            dataType: 'html',
            success: function(data) {
                $('.posts').append(data);
                postPage++;
            }
        });
        lastGetDataTime = new Date($.now());
        e.preventDefault();
    }

});