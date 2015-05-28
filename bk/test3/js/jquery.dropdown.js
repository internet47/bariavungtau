/*$(function(){
	
	$("ul#global-navi li ul").fadeOut(0);
	
    $("ul#global-navi li:not(:animated)").hover(function(){
        $('ul',this).fadeIn("fast");
    }, function(){
        $('ul',this).fadeOut("fast");
    });


});*/

$(function(){
	
	$("ul.global-navi li ul").css("display","none");
	
    $("ul.global-navi li").hover(function(){
        $('ul',this).css("display","block");
    }, function(){
        $('ul',this).css("display","none");
    });


});