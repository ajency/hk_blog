var $ = jQuery.noConflict();

$( document ).ready(function() {
	$(function(){
		$(".close-icon").hide();
		$('ul.menu > li:has(.sub-menu)').addClass('hassub');
		$('.menu li:has(.sub-menu) li ul').addClass('hassub-child');
		$(".menu").on("mouseenter", "li:not(li li)", function(e) {
			$(this).find(".sub-menu > li").first().addClass("active");
		});
		$("#u_0_0").css("width", "100%");
	});

	$(".sub-menu > li").on("mouseover", function() {
		$("li").removeClass("active");
	    $(this).addClass("active");
	});
    $(".toggler").click(function(e) {
		e.preventDefault();
        $(".menu-content-list>div").addClass("visible");
        $(".close-icon").show();
        $("body").addClass("no-scrolling");
		$('.menu li li ul').parent().addClass('hasSubChild');
		$(".list-view ul li:not(li li):nth-child(2)").addClass('selected');
    });
    $(".close-icon").click(function(e) {
        $(".menu-content-list>div").removeClass("visible");
    	$(".close-icon").hide();
    	$("body").removeClass("no-scrolling");
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
	    	$("#site-header").addClass("headerScroll");
	        $("#site-navigation").addClass("headerScroll");
	    } else {
	        $("#site-header").removeClass("headerScroll");
	        $("#site-navigation").removeClass("headerScroll");
	    }
	});

	$('.slider').slick({
		autoplay: true,
		draggable: true,
		arrows: false,
		fade: true,
		speed: 900,
		infinite: true,
		cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)',
		touchThreshold: 100
/*		autoplay: true,
		fade: true,
		speed: 800,
		//lazyLoad: 'progressive',
		arrows: false,
		dots: false,*/
	});
	$(".category-buttons-single:not(.category-buttons-single-active)").click(function(){
		var button = $(this);
		$.ajax({ 
			url : ajax_params.url, 
			data: {
				'action' : 'fetch_category_articles',
				'category_id' : $(this).attr('data-val')
			},
			type : 'POST',
			beforeSend : function ( xhr ) {
				$(".category_articles_container").html('');
				$(".category-loader").addClass("d-flex").removeClass("d-none");
			},
			success : function( data ){
				$(".category-loader").addClass("d-none").removeClass("d-flex");
				if( data ) { 
					$(".category_articles_container").html(data);
					$(".category-buttons-single").removeClass("category-buttons-single-active");
					button.addClass("category-buttons-single-active");
				} else {
					//button.remove(); // if no data, remove the button as well
				}
			}
		});
	})
	var canBeLoaded = true;
 	var category_page = 3;
	$(window).scroll(function(){
		if($(".category-list-view").length){
			var data = {
				'action': 'fetch_category_page_articles',
				'page' : category_page,
				'category' : $(".category-list-view").data('category'),
			};
			if( ($(window).scrollTop() + $(window).height() + 70 > $(document).height()) && canBeLoaded == true ){
				$.ajax({
					url : ajax_params.url,
					data:data,
					type:'POST',
					beforeSend: function( xhr ){
						$('.category-list-view .category-loader').addClass("d-flex").removeClass("d-none");
						canBeLoaded = false; 
					},
					success:function(data){
						if( data ) {
							$('.category-list-view .category-loader').remove();
							$('.category-list-view .category-post-row:last').after( data ); 
							canBeLoaded = true; 
							category_page++;
						}
					}
				});
			}
		}
	});
}); 
