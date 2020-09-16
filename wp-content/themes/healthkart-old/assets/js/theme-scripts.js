var $ = jQuery.noConflict();

$( document ).ready(function() {
	$(function(){
		$(".close-icon").hide();
		$('ul.menu > li:has(.sub-menu)').addClass('hassub');
		$('.menu li:has(.sub-menu) li ul').addClass('hassub-child');
		$(".menu").on("mouseenter", "li:not(li li)", function(e) {
			$(this).find(".sub-menu > li").first().addClass("active");
		});
	});

	$(".sub-menu > li").on("mouseover", function() {
		$("li").removeClass("active");
	    $(this).addClass("active");
	});
    $(".toggler").click(function(e) {
		e.preventDefault();
        $(".menu-content-list>div").addClass("visible");
        $(".close-icon").show();
		$('.menu li li ul').parent().addClass('hasSubChild');
		$("#menu-main-menu-1 li:first").addClass('selected');
    });
    $(".close-icon").click(function(e) {
        $(".menu-content-list>div").removeClass("visible");
    	$(".close-icon").hide();
    });
    if( $(window).width() < 992 ){
	 	$("ul.menu li:not(li li)").click(function(e) {
	 		$("ul.menu > li").removeClass('selected');
	     	$(this).toggleClass('selected');
	    });
	 	$("ul.sub-menu li").click(function(e) {
	 		is_selected = $(this).hasClass('selected');
	 		e.preventDefault();
	 		e.stopImmediatePropagation();
	 		$("ul.sub-menu li").removeClass('selected');
	 		$(e.target).parents("li").each(function(){
	 			$(this).addClass('selected');
	 		});
	 		if(is_selected){
	 			$(e.target).closest("li").removeClass('selected');
	 		}
	    });
	}
	$(window).on("scroll", function() {
	    if($(window).scrollTop() > 50) {
	        $("#site-navigation").addClass("headerScroll");
	    } else {
	        $("#site-navigation").removeClass("headerScroll");
	    }
	});
}); 