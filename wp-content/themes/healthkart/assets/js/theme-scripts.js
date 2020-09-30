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
		arrows: true,
		dots: true,
		fade: true,
		speed: 900,
		infinite: true,
		cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)',
		touchThreshold: 100
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
				$(".explore-articles").css('visibility', 'hidden');
				$(".explore-articles-loader").addClass("d-block").removeClass("d-none");
			},
			success : function( data ){
				$(".category_articles_container").html('');
				$(".explore-articles").css('visibility', 'hidden');
				$(".explore-articles-loader").addClass("d-none").removeClass("d-block");
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
 	var category_page = 2;
	$(window).scroll(function(){
		if($(".category-list-view").length){
			var url = new URL(window.location.href);
			var page = url.searchParams.get("page");
			if(page){
				category_page = parseInt(page) + 1;
			}
			var data = {
				'action': 'fetch_category_page_articles',
				'page' : category_page,
				'category' : $(".category-list-view").data('category'),
			};
			if( ($(window).scrollTop() > $(".category-list-view .category-post-row:last").position().top + 150) && canBeLoaded == true ){
				$.ajax({
					url : ajax_params.url,
					data:data,
					type:'POST',
					beforeSend: function( xhr ){
						$('.category-list-view .category-loader').addClass("d-flex").removeClass("d-none");
						canBeLoaded = false; 
					},
					success:function(data){
						$('.category-list-view .category-loader').remove();
						if( data ) {
							setParam('page', category_page);
							$('.category-list-view .category-post-row:last').after( data ); 
							canBeLoaded = true; 
							category_page++;
							$("html, body").animate({ scrollTop: $('.category-list-view .category-post-row:last').position().top });
						}
					}
				});
			}
		}
	});
	$(".widget_media_image a").click(function(e){
		e.preventDefault();
		window.open($(this).attr('href'), '_blank');
	})
}); 

function setParam(param, mode = ''){
	var url = new URL(location.href);
	if(mode){
		url.searchParams.set(param, mode);
	}
	else{
		url.searchParams.delete(param);
	}
	url.search = url.searchParams.toString();
	var new_url = url.toString(); 
	window.history.pushState('page2', 'Title', new_url);
}
/*function setPage(param, mode = ''){
	const url = new URL(location.href);
	var pathnameArray = url.pathname.split('/');
	pathnameArray = pathnameArray.filter(function (el) {
		return el != '';
	});
	var index = pathnameArray.indexOf('page') + 1;
	if(!index){
		pathnameArray.push('page');
		pathnameArray.push(2);
	}
	else{
		pathnameArray[index] = parseInt(pathnameArray[index])+1;
	}
	var new_url = pathnameArray.join('/');
	console.log(new_url);
	url.pathname = new_url;
}*/