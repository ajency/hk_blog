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
			//e.preventDefault();
	 		$("ul.menu > li").removeClass('selected');
	     	$(this).toggleClass('selected');
	    });
	 	// $("ul.sub-menu li").click(function(e) {
	 	// 	is_selected = $(this).hasClass('selected');
	 	// 	e.preventDefault();
	 	// 	e.stopImmediatePropagation();
	 	// 	$("ul.sub-menu li").removeClass('selected');
	 	// 	$(e.target).parents("li").each(function(){
	 	// 		$(this).addClass('selected');
	 	// 	});
	 	// 	if(is_selected){
	 	// 		$(e.target).closest("li").removeClass('selected');
	 	// 	}
	  //   });
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
		lazyLoad: 'ondemand',
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
	$(".category-buttons-single").click(function(){
		var button = $(this);
		if(!button.hasClass('category-buttons-single-active')){
			$.ajax({ 
				url : ajax_params.url, 
				data: {
					'action' : 'fetch_category_articles',
					'category_id' : $(this).data('val'),
					'type' : $(this).data('type'),
				},
				type : 'POST',
				beforeSend : function ( xhr ) {
					$(".explore-articles").css('visibility', 'hidden');
					$(".explore-articles-loader").addClass("d-block").removeClass("d-none");
				},
				success : function( data ){
					$(".category_articles_container").html('');
					$(".explore-articles-loader").addClass("d-none").removeClass("d-block");
					if( data ) { 
						$(".category_articles_container").html(data);
						$(".explore-articles-slider").slick({
							infinite: true,
							prevArrow: '<button class="slide-arrow next-arrow"><i class="fa fa-arrow-left"></i></button>',
							nextArrow: '<button class="slide-arrow prev-arrow"><i class="fa fa-arrow-right"></i></button>',
							dots: false,
							speed: 900,
							slidesToShow: 2,
							slidesToScroll: 2,
							mobileFirst: true,
							responsive: [
								{
									breakpoint: 769,
									settings: 'unslick'
								}
							]
						});
						$(".category-buttons-single").removeClass("category-buttons-single-active");
						button.addClass("category-buttons-single-active");
					}
				}
			});
		}
	})
	$(".nested-section-chips .single-chip").click(function(){
		var button = $(this);
		$.ajax({ 
			url : ajax_params.url, 
			data: {
				'action' : 'fetch_category_alphaposts',
				'posts_letter' : $(this).data('value'),
				'cat' : $(".nested-section-posts").data('cat'),
			},
			type : 'POST',
			beforeSend : function ( xhr ) {
				 $(".nested-section-posts-wrapper").fadeTo(200, 0, function(){
			        $(this).css("visibility", "hidden");
			        $(".nested-section-posts-loader").addClass("d-block").removeClass("d-none");
			    });
				
			},
			success : function( data ){
				$(".nested-section-posts-wrapper").html('');
				if( data ) { 
					$(".nested-section-posts-loader").addClass("d-none").removeClass("d-block");
					$(".nested-section-posts-wrapper").fadeTo(200, 1, function(){
						$(".nested-section-posts-loader").addClass("d-none").removeClass("d-block");
				        $(this).css("visibility", "visible");
				    });
					$(".nested-section-posts-wrapper").html(data);
					$(".nested-section-chips .single-chip").removeClass("active");
					button.addClass("active");
				}
			}
		});
	})
	$(window).scroll(function(){
		if($(".nested-section-chips").length && $(window).width() < 1024){
			if(isScrolledIntoView(".nested-section-posts")){
				$(".nested-section-chips").css("display", "flex");
			}
			else{
				$(".nested-section-chips").css("display", "none");
			}
		}

		if ($('.category-list-view .category-post-row').find('.component-articles-single').length) {
			if($(".category-list-view").length && $(window).width() < 767 && ($(window).scrollTop() > $(".category-list-view .category-post-row .component-articles-single:last").position().top) && canBeLoaded == true){
				canBeLoaded = false;			
				var url = new URL(window.location.href);
				var page = url.searchParams.get("page");
				page = parseInt(page) + 1;
				get_category_posts(page, false);
			}
		}
		if ($('.category-list-view .category-post-row').find('.transformation-section-single').length) {
			if($(".category-list-view").length && $(window).width() < 767 && ($(window).scrollTop() > $(".category-list-view .category-post-row .transformation-section-single:last").position().top) && canBeLoaded == true){
				canBeLoaded = false;			
				var url = new URL(window.location.href);
				var page = url.searchParams.get("page");
				page = parseInt(page) + 1;
				get_category_posts(page, false);
			}
		}
		if ($('.category-list-view .category-post-row').find('.videos-single.video-each').length) {
			if($(".category-list-view").length && $(window).width() < 767 && ($(window).scrollTop() > $(".category-list-view .category-post-row .videos-single.video-each:last").position().top) && canBeLoaded == true){
				canBeLoaded = false;			
				var url = new URL(window.location.href);
				var page = url.searchParams.get("page");
				page = parseInt(page) + 1;
				get_category_posts(page, false);
			}
		}
	});
	if($(".category-list-view").length && $(window).width() < 767){
		var url = new URL(window.location.href);
		var page = url.searchParams.get("page");
		if(page){
			get_category_posts(page);
		}
		else{
			get_category_posts(1);
		}
	}
	$(".widget_media_image a").click(function(e){
		e.preventDefault();
		window.open($(this).attr('href'), '_blank');
	});
	$(".nested-section-subcategory-content").slick({
		draggable: true,
		arrows: true,
		dots: false,
		speed: 900,
		infinite: false,
 		slidesToShow: 4,
  		slidesToScroll: 4,
  		responsive: [
	        {
	            breakpoint: 1024,
	            settings: {
	                slidesToShow: 3,
	                slidesToScroll: 3,
	            }
	        },
	        {
	            breakpoint: 767,
	            settings: {
	                slidesToShow: 2,
	                slidesToScroll: 2
	            }
	        },
	        {
	            breakpoint: 600,
	            settings: {
	                slidesToShow: 1,
	                slidesToScroll: 1,
              		centerMode: true,
  					centerPadding: '30px'
	            }
	        }
        ]
	});
	$('.nested-section-subcategory-content').on('afterChange', function (event, slick, currentSlide) {
		var total = $(this).find(".recent-post").length;
        if(total - currentSlide <= 4) {
            $(this).find('.slick-next').hide();
        }
        else {
            $(this).find('.slick-next').show();
        }
        if(currentSlide < 4) {
            $(this).find('.slick-prev').hide();
        }
        else {
            $(this).find('.slick-prev').show();
        }  
    });
    $('.nested-section-subcategory-content .slick-prev').hide();
    $("#searchBtn").click(function(){
    	$("#searchform").submit();
    });
    $("#searchform").on('submit', function(e) {
	    e.preventDefault();
	    window.location = $("#searchform").attr('action') +'/'+ $("#searchform #search").val().replace(/ /g,'+');
	});
	$(".read-these-next-content").slick({
		draggable: true,
		arrows: true,
		dots: false,
		speed: 900,
		infinite: false,
 		slidesToShow: 3,
  		slidesToScroll: 3,
  		responsive: [
	        {
	            breakpoint: 1024,
	            settings: {
	                slidesToShow: 3,
	                slidesToScroll: 3,
	            }
	        },
	        {
	            breakpoint: 767,
	            settings: {
	                slidesToShow: 2,
	                slidesToScroll: 2
	            }
	        },
	        {
	            breakpoint: 600,
	            settings: {
	                slidesToShow: 1,
	                slidesToScroll: 1,
              		centerMode: true,
  					centerPadding: '30px'
	            }
	        }
        ]
	});
	$('.read-these-next-content').on('afterChange', function (event, slick, currentSlide) {
/* 		var total = $(this).find(".recent-post").length;
        if(total - currentSlide <= 3) {
            $(this).find('.slick-next').hide();
        }
        else {
            $(this).find('.slick-next').show();
        }
        if(currentSlide < 3) {
            $(this).find('.slick-prev').hide();
        }
        else {
            $(this).find('.slick-prev').show();
        }   */
		$('.read-these-next-content .slick-arrow').show();
		$('.read-these-next-content .slick-arrow.slick-disabled').hide();
    });
    $('.read-these-next-content .slick-prev').hide();
	$(window).scroll(function () {
		if ($(this).scrollTop() > 50) {
			$('#back-to-top').fadeIn();
		} else {
			$('#back-to-top').fadeOut();
		}
	});
	$('#back-to-top').click(function () {
		$('body,html').animate({
			scrollTop: 0
		}, 400);
		return false;
	});
}); 
let canBeLoaded = true;
function get_category_posts(category_page, remove_posts = false){
	var url = new URL(window.location.href);
	var data = {
		'action': 'fetch_category_page_articles',
		'page' : category_page,
		'category' : $(".category-list-view").data('category'),
		'type' : $(".category-list-view").data('type'),
		'taxonomy' : $(".category-list-view").data('taxonomy'),
		'taxtype' : $(".category-list-view").data('taxtype'),
		'search' : $("#search").val(),
	};
	$.ajax({
		url : ajax_params.url,
		data:data,
		type:'POST',
		beforeSend: function( xhr ){
			$('.category-list-view .category-loader').addClass("d-flex").removeClass("d-none");
			setParam('page', category_page);
		},
		success:function(data){
			if(remove_posts){
				$(".recent-post:first")
				$(".category-list-view").html('');
				$(".category-loader").addClass("d-none").removeClass("d-block");
			}else{
				$(".category-filler").parent().remove();
				$(".category-loader").remove();
			}
			
			if( data ) {
				$('.category-list-view').append( data ); 
				canBeLoaded = true; 
				category_page++;
				if(remove_posts){
					$([document.documentElement, document.body]).animate({
				        scrollTop: $(".category-list-view").offset().top
				    }, 1000);
				}
			}
		}
	});
}
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

// Returns an array of maxLength (or less) page numbers
// where a 0 in the returned array denotes a gap in the series.
// Parameters:
//   totalPages:     total number of pages
//   page:           current page
//   maxLength:      maximum size of returned array
function getPageList(totalPages, page, maxLength) {
	page = parseInt(page);
	if (maxLength < 5) throw "maxLength must be at least 5";

	function range(start, end) {
		return Array.from(Array(end - start + 1), (_, i) => i + start);
	}

	var sideWidth = maxLength < 9 ? 1 : 2;
	var leftWidth = (maxLength - sideWidth * 2 - 3) >> 1;
	var rightWidth = (maxLength - sideWidth * 2 - 2) >> 1;
	if (totalPages <= maxLength) {
		// no breaks in list
		return range(1, totalPages);
	}
	if (page <= maxLength - sideWidth - 1 - rightWidth) {
		// no break on left of page
		return range(1, maxLength - sideWidth - 1)
		.concat([0])
		.concat(range(totalPages - sideWidth + 1, totalPages));
	}
	if (page >= totalPages - sideWidth - 1 - rightWidth) {
		// no break on right of page
		return range(1, sideWidth)
		.concat([0])
		.concat(
		range(totalPages - sideWidth - 1 - rightWidth - leftWidth, totalPages)
		);
	}
	// Breaks on both sides
	return range(1, sideWidth)
	.concat([0])
	.concat(range(page - leftWidth, page + rightWidth))
	.concat([0])
	.concat(range(totalPages - sideWidth + 1, totalPages));
}
function isScrolledIntoView(elem)
{
    var scrollTop = $(window).scrollTop();
    var scrollBottom = $(window).scrollTop() + $(window).height();
    var elemTop = $(elem).offset().top;
    var elemBottom = elemTop + $(elem).height();
    return ((elemTop - $(window).height() + 100 < scrollTop) && (elemBottom + $(window).height() > scrollBottom));
}
$(function() {
	// Number of items and limits the number of items per page
	var numberOfItems = $(".category-list-view").data('count');
	var limitPerPage = 24;
	// Total pages rounded upwards
	var totalPages = Math.ceil(numberOfItems / limitPerPage);
	// Number of buttons at the top, not counting prev/next,
	// but including the dotted buttons.
	// Must be at least 5:
	var paginationSize = 7;
	var currentPage;

	function showPage(whichPage) {
		$(".category-loader").addClass("d-block").removeClass("d-none");
		if (whichPage < 1 || whichPage > totalPages) return false;
		currentPage = whichPage;
		$(".category-list-view .category-post-row").css('visibility', 'hidden');
		// Replace the navigation items (not prev/next):
		$(".pagination li").slice(1, -1).remove();
		if(whichPage == 1){
			$("#previous-page").addClass("disabled");
		}
		else{
			$("#previous-page").removeClass("disabled");
		}
		if(whichPage == totalPages){
			$("#next-page").addClass("disabled");
		}
		else{
			$("#next-page").removeClass("disabled");
		}
		getPageList(totalPages, currentPage, paginationSize).forEach(item => {
			$("<li>").addClass(
				"page-item " +
				(item ? "current-page " : "") +
				(item === currentPage ? "active " : "")
			).attr('data-page', item).append(
				$("<a>").addClass("page-link").attr({
					href: "javascript:void(0)"
				})
				.text(item || "...")
			).insertBefore("#next-page");
		});
		get_category_posts(whichPage, true);
		return true;
	}
	if($(".category-list-view").length && $(window).width() > 767){

		var url = new URL(window.location.href);
		var page = url.searchParams.get("page");
		currentPage = page;
		if(!$(".pagination li[data-page='"+page+"']").hasClass('active')){
			$(".pagination li[data-page='"+page+"']").addClass('active');
		}
  	}
	// Use event delegation, as these items are recreated later
	$(document).on("click", ".pagination li.current-page:not(.active)", function(e) {
		e.preventDefault();
		return showPage(+$(this).text());
	});
	$(document).on("click", ".pagination #next-page:not(.disabled)", function(e) {
		e.preventDefault();
		return showPage(currentPage + 1);
	});
	$(document).on("click", ".pagination #previous-page:not(.disabled)", function(e) {
		e.preventDefault();
		return showPage(currentPage - 1);
	});
});
$(document).ready(function(){
	$(".blog_featured_img img").click(function(){
	  $(".popupOverlay").css("display", "flex");
	});
	$(".popupOverlay").click(function(){
	  $(this).css("display", "none");
	});
}); 
$(document).ready(function(){
    $(window).on('resize', function() {
        $('.explore-articles-slider').slick('resize');
    });
});

/* homepeage banner */
$(document).ready(function(){
	$(".banner-animated .slide-box:first-child").addClass("show");
	$(".banner-animated .slide-box").hover(function(){
		$(".banner-animated .slide-box").removeClass("show");
		$(this).addClass("show");
	});
}); 

/* transformation slider */
$(function() {
	$(".transformation-section-articles").slick({
		arrows:false,
		dots: true,
		speed: 300,
		infinite: true,
		cssEase: 'linear',
		slidesToShow: 3,
		slidesToScroll: 2,

		responsive: [
            {
                breakpoint: 768,
                settings: {
					slidesToShow: 2,
					slidesToScroll: 2,
				}
            }
        ]
	});
	/* more articles slider */
	$(".more-articles-slider").slick({
		arrows:true,
		dots: true,
		speed: 300,
		infinite: false,
		cssEase: 'linear',
		slidesToShow: 1,
		slidesToScroll: 1,
		adaptiveHeight: true,
		appendArrows: $('.more-articles-section .slider-nav .arrows'),
    	appendDots: $('.more-articles-section .slider-nav .dots'),
		prevArrow: "<button class='arrows__prev'><svg xmlns='http://www.w3.org/2000/svg' width='31.117' height='31.117' viewBox='0 0 31.117 31.117'><g id='Icon_ionic-ios-arrow-dropright' data-name='Icon ionic-ios-arrow-dropright' transform='translate(-3.375 -3.375)' style='mix-blend-mode: normal;isolation: isolate'><path id='Path_15' data-name='Path 15' d='M14.84,10.4a1.449,1.449,0,0,1,2.042,0l7.136,7.158a1.442,1.442,0,0,1,.045,1.99l-7.031,7.054a1.441,1.441,0,1,1-2.042-2.035L20.967,18.5,14.84,12.438A1.427,1.427,0,0,1,14.84,10.4Z' transform='translate(0.705 0.422)'/><path id='Path_16' data-name='Path 16' d='M3.375,18.934A15.559,15.559,0,1,0,18.934,3.375,15.556,15.556,0,0,0,3.375,18.934Zm2.394,0a13.16,13.16,0,0,1,22.47-9.305,13.16,13.16,0,1,1-18.61,18.61A13.052,13.052,0,0,1,5.769,18.934Z'/></g></svg></button>",
    	nextArrow: "<button class='arrows__next'><svg xmlns='http://www.w3.org/2000/svg' width='31.117' height='31.117' viewBox='0 0 31.117 31.117'><g id='Icon_ionic-ios-arrow-dropright' data-name='Icon ionic-ios-arrow-dropright' transform='translate(-3.375 -3.375)' style='mix-blend-mode: normal;isolation: isolate'><path id='Path_15' data-name='Path 15' d='M14.84,10.4a1.449,1.449,0,0,1,2.042,0l7.136,7.158a1.442,1.442,0,0,1,.045,1.99l-7.031,7.054a1.441,1.441,0,1,1-2.042-2.035L20.967,18.5,14.84,12.438A1.427,1.427,0,0,1,14.84,10.4Z' transform='translate(0.705 0.422)'/><path id='Path_16' data-name='Path 16' d='M3.375,18.934A15.559,15.559,0,1,0,18.934,3.375,15.556,15.556,0,0,0,3.375,18.934Zm2.394,0a13.16,13.16,0,0,1,22.47-9.305,13.16,13.16,0,1,1-18.61,18.61A13.052,13.052,0,0,1,5.769,18.934Z'/></g></svg></button>",

		responsive: [
            {
                breakpoint: 769,
                settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
					arrows:false,
				}
            }
        ]
	});
});

/* scaleup animations */
// banner
$(".transformation-section-single-image .title a").hover(function(){
	$(this).parent().parent().find("a .image-container").toggleClass("scaleup");
});
//expore articles
$(".explore-articles-single-content .content-title a").hover(function(){
	$(this).parent().parent().parent().parent().find(".explore-articles-single-image a img").toggleClass("scaleup");
});
$(".explore-articles-single-image a").hover(function(){
	$(this).find("img").toggleClass("scaleup");
	$(this).parent().parent().find(".explore-articles-single-content .content-title a").toggleClass("hovered-link");
});
// infographics
$(".infographics-articles-single-content .content-title a").hover(function(){
	$(this).parent().parent().parent().parent().find(".infographics-articles-single-image a img").toggleClass("scaleup");
});
$(".infographics-articles-single-image a").hover(function(){
	$(this).find("img").toggleClass("scaleup");
	$(this).parent().parent().find(".infographics-articles-single-content .content-title a").toggleClass("hovered-link");
});

/* accordion menu */
$("footer .footer-widgets .footer-wrapper .footer-sidebar:first-child .widget_nav_menu .widget-wrap").addClass("accordion-menu");
$(".accordion-menu .widget-title").addClass("accordion-menu__header");
$(".accordion-menu nav").addClass("accordion-menu__content");

$(document).on("touchstart", ".accordion-menu__header", function() {
	$(this).parent().toggleClass("show");
});

/* latest articles */
$(window).on('load resize', function () {
    $item = $(".latest-articles-section .latest-articles-single");
$FullWidth = $item.width();
$contWidth = $(".latest-articles-section .container").width();
$calcMarg = ($FullWidth - $contWidth)/2;

//add calculated margin
$(".latest-articles-section .latest-articles-single:nth-child(odd) .wraper").css("margin-left", $calcMarg);
$(".latest-articles-section .latest-articles-single:nth-child(even) .wraper").css("margin-right", $calcMarg);
$(".more-articles-slider .more-articles-single .wraper").css("margin-left", $calcMarg);
$(".more-articles .slider-nav").css("padding-left", $calcMarg);
});

/* hero-banner */
$item1 = $(".banner-animated .slide-box");
$slideWidth = $item1.outerWidth()-48;

// add calculated width
$(".banner .slide-box__content2").css("width", $slideWidth);

/* video blog page */
$(".article-tags a").addClass("article-tags__tag");


/* read these next section */
$(".read-these-next .article-link").hover(function(){
	$(this).parents().eq(0).toggleClass("hovered");
});
$(".read-these-next .title a").hover(function(){
	$(this).parents().eq(3).toggleClass("hovered");
});

