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
	$(".category-buttons-single:not(.category-buttons-single-active)").click(function(){
		var button = $(this);
		$.ajax({ 
			url : ajax_params.url, 
			data: {
				'action' : 'fetch_category_articles',
				'category_id' : $(this).data('val')
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
					$(".category-buttons-single").removeClass("category-buttons-single-active");
					button.addClass("category-buttons-single-active");
				}
			}
		});
	})
	
	$(window).scroll(function(){
		if($(".category-list-view").length && $(window).width() < 767 && ($(window).scrollTop() > $(".category-list-view .category-post-row .recent-post:last").position().top) && canBeLoaded == true){
			canBeLoaded = false;
			$('html, body').animate({
		        scrollTop: $(".category-name").offset().top
		    }, 500);
			
			var url = new URL(window.location.href);
			var page = url.searchParams.get("page");
			page = parseInt(page) + 1;
			get_category_posts(page, false);
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
  		slidesToScroll: 4
	});
	$('.nested-section-subcategory-content').on('afterChange', function (event, slick, currentSlide) {
		var total = $(this).find(".recent-post").length;
        if(total - currentSlide < 4) {
            $('.slick-next').hide();
        }
        else {
            $('.slick-next').show();
        }
        if(currentSlide < 4) {
            $('.slick-prev').hide();
        }
        else {
            $('.slick-prev').show();
        }  
    });
    $('.slick-prev').hide();
}); 
let canBeLoaded = true;
function get_category_posts(category_page, remove_posts = false){
	var url = new URL(window.location.href);
	var data = {
		'action': 'fetch_category_page_articles',
		'page' : category_page,
		'category' : $(".category-list-view").data('category'),
		'type' : $(".category-list-view").data('type'),
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

$(function() {
	// Number of items and limits the number of items per page
	var numberOfItems = $(".category-list-view").data('count');
	var limitPerPage = 6;
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
		if(!page){
			page = 1;
		}
		currentPage = parseInt(page);
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
