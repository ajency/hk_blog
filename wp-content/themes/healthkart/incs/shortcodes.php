<?php
add_shortcode( 'banner', function(){?>
	<div class="banner-image">
		
	</div>
<?php });

add_shortcode( 'year', function(){
	return date('Y');
});
add_shortcode( 'read-these-next', function(){?>
	<div class="read-these-next mt-4">
		<div class="section-title pb-3"> Read these next</div>
		<?php
			$args = array(
				'posts_per_page' => 4,
				'post_type' => 'post',
				'post__not_in'   => array( get_the_ID() ),
				'no_found_rows'  => true, 
				'date_query'    => array(
			        'column'  => 'post_date',
			        'before'   => get_the_date('Y-m-d')
			    ),
			);
// 			foreach($args as $val){
//   if(!is_array($val)){
//         echo $val, '<br>';
//     }
// }
			// Query posts
			$count = 0;
			$wpex_query = new wp_query( $args );?>
			<?php  // Loop through posts
			if( $wpex_query->have_posts() ) :
			while( $wpex_query->have_posts() ) :
			$wpex_query->the_post(); 
			$post_ids[] = get_the_id();
			$count ++;
			?>
				<div class="col-12 recent-post p-0">
					<div class="row py-4">
						<div class="col-md-4 col-12">
							<div class="recent-post-featured-img">
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
									<?php 
									$thumbnail = get_post_meta(get_the_id(), 'hk_thumbnail_image', true);
									if ( $thumbnail ) { ?>
										<img src="<?php echo $thumbnail; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
									<?php } else if ( has_post_thumbnail() ) {
									the_post_thumbnail('medium', ['title' => get_the_title()]); ?>
									<?php
									} else { ?>
									<img src="<?php echo get_site_url(); ?>/wp-content/uploads/2020/09/default.jpg" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
									<?php } ?>
								</a>
							</div>
						</div>
						<div class="col-md-8 col-12 next-articles">
							<span>
								<span class="category">
									<?php the_category(' , '); ?>
								</span>
								<span class="dot"><i class="fa fa-circle" aria-hidden="true"></i></span>
								<span class="last-read"><?php echo get_mins_read(); ?> MIN READ</span>
								<span class="dot"><i class="fa fa-circle" aria-hidden="true"></i></span>
								<?php $post_date = get_the_date( 'M j, Y' ); ?>
								<span class="last-read"><?php echo $post_date; ?></span>
							</span>
							<div class="recent-post-header">
								<h2 class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
							</div>
							<div class="recent-post-excerpt content-desktop"><?php echo hk_get_excerpt(140); ?>
							</div>
							<div class="content-description content-mobile"><?php echo hk_get_excerpt(220); ?></div>
							<div class="recent-post-icons">
								<span class="mr-3 f-14 heart"><i class="fa fa-heart" aria-hidden="true"></i> 15 </span>
								<span class="mr-3 f-14 comment"><i class="fa fa-comments" aria-hidden="true"></i> 3</span>
							</div>
						</div>
					</div>
				</div>
			<?php 
			if($count == 5){
				break;
			}
			endwhile; ?>
		<?php endif; ?>
	</div>
<?php });


add_shortcode( 'related-articles', function($atts){
global $post, $wpdb;
?>
<div class="related-articles mt-4">
	<?php if(is_author()){?>
		<?php $number_of_posts = $atts['count'];
		$author = get_user_by( 'slug', get_query_var( 'author_name' ) );
		$args = array(
			'posts_per_page' => $number_of_posts,
			'author'     => $author->ID,
		);
		
		$author_query = new wp_query( $args);
		if( $author_query->have_posts() ) {?>
			<div class="section-title pb-3">Related Articles</div>
			<?php while( $author_query->have_posts() ){
				$author_query->the_post();
				$author_post_ids[] = get_the_id();?>
						<div class="recent-post">
						<div class="row py-4">
							<div class="col-4">
								<div class="recent-post-featured-img">
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
										<?php 
										$thumbnail = get_post_meta(get_the_id(), 'hk_thumbnail_image', true);
										if ( $thumbnail ) { ?>
											<img src="<?php echo $thumbnail; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
										<?php } else if ( has_post_thumbnail() ) {
										the_post_thumbnail('medium', ['title' => get_the_title()]); ?>
										<?php
										} else { ?>
										<img src="<?php echo get_site_url(); ?>/wp-content/uploads/2020/09/default.jpg" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
										<?php } ?>
									</a>
								</div>
							</div>
							<div class="col-8 pl-0">
								<span>
									<span class="category">
									<?php the_category(' , '); ?>
									</span>
									<span class="dot"><i class="fa fa-circle" aria-hidden="true"></i></span>
									<span class="last-read"><?php echo get_mins_read(); ?> MIN READ</span>
									<span class="dot"><i class="fa fa-circle" aria-hidden="true"></i></span>
									<?php $post_date = get_the_date( 'M j, Y' ); ?>
									<span class="last-read"><?php echo $post_date; ?></span>
								</span>
								<div class="recent-post-header">
									<h2 class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
								</div>
							</div>
						</div>
					</div>
			<?php }
		}
		?>
	<?php } else { ?>
	<div class="section-title pb-3">Related Articles</div>
		<?php 
			$number_of_posts = $atts['count'];
			$tags = wp_get_post_tags($post->ID);
			$post_ids = [];
			/* if($tags){
				$tag_ids = array();
				foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
				$args=array(
				'fields'         => 'ids',
				'tag__in' => $tag_ids,
				'post__not_in' => array($post->ID),
				'posts_per_page'=>$number_of_posts, // Number of related posts that will be shown.
				'post_status'    => 'publish',
				);
				$post_ids = get_posts( $args );
			} */
			$page_post_ids = get_query_var('post_ids');
			if(count($post_ids) < $number_of_posts){
				$args = array(
					'fields'         => 'ids',
					'posts_per_page' => $number_of_posts - count($post_ids),
					'post__not_in'   => array_merge(array($post->ID),$post_ids,(array)$page_post_ids),
					'post_status'    => 'publish',
				);
				// Check for current post category and add tax_query to the query arguments
				$cats = wp_get_post_terms( $post->ID, 'category' ); 
				$cats_ids = array();  
				foreach( $cats as $wpex_related_cat ) {
					$cats_ids[] = $wpex_related_cat->term_id; 
				}
				if ( ! empty( $cats_ids ) ) {
					$args['category__in'] = $cats_ids;
				}
				// Query posts
				$cat_post_ids = get_posts( $args );		
				$required_posts = array_merge($post_ids, $cat_post_ids);
			}
			$myposts = $wpdb->get_results("SELECT * FROM ".$wpdb->posts." WHERE ID in ('".implode("','", $required_posts)."')");
			foreach( $myposts as $post ) :  setup_postdata($post); ?>
					<div class="recent-post">
						<div class="row py-4">
							<div class="col-4">
								<div class="recent-post-featured-img">
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
										<?php 
										$thumbnail = get_post_meta(get_the_id(), 'hk_thumbnail_image', true);
										if ( $thumbnail ) { ?>
											<img src="<?php echo $thumbnail; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
										<?php } else if ( has_post_thumbnail() ) {
										the_post_thumbnail('medium', ['title' => get_the_title()]); ?>
										<?php
										} else { ?>
										<img src="<?php echo get_site_url(); ?>/wp-content/uploads/2020/09/default.jpg" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
										<?php } ?>
									</a>
								</div>
							</div>
							<div class="col-8 pl-0">
								<span>
									<span class="category">
									<?php the_category(' , '); ?>
									</span>
									<span class="dot"><i class="fa fa-circle" aria-hidden="true"></i></span>
									<span class="last-read"><?php echo get_mins_read(); ?> MIN READ</span>
									<span class="dot"><i class="fa fa-circle" aria-hidden="true"></i></span>
									<?php $post_date = get_the_date( 'M j, Y' ); ?>
									<span class="last-read"><?php echo $post_date; ?></span>
								</span>
								<div class="recent-post-header">
									<h2 class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
	</div>
<?php } });



add_shortcode( 'Question_form', function(){?>
	<div class="form-wrapper qna">
		<div class="wrap">
			<h2 class="form-title">Ask A Question</h2>
			<div class="form-group">
				<label for="category">Select Topic</label>
				<select class="form-control" id="category">
					<option>BodyBuilding</option>
					<option>HealthyLiving</option>
					<option>Weightloss</option>
					<option>Celebrity</option>
				</select>
			</div>
			<div class="form-group">
				<label for="comment">What's your question</label>
	  			<textarea class="form-control" rows="5" id="comment" placeholder="Please specify in detail"></textarea>
			</div>
			<button type="submit" class="hk-btn">Submit Question</button>
		</div>
	</div>
<?php });


add_shortcode( 'Subscribe-form', function(){?>
	<div class="form-wrapper subscribe">
		<div class="wrap">
			<h2 class="form-title">Subscribe to Healthkart Blog</h2>
			<p>Get your daily updates on fitness, bodybuilding, weight management, nutrition & much more.</p>
			<div class="form-group">
		      	<?php echo do_shortcode( '[formidable id=1]' ) ?>
			</div>
		</div>
	</div>
<?php });


add_shortcode( 'read-these-next-transformations', function(){?>
	<div class="read-these-next">
		<div class="section-title pb-3">Read these next</div>
		<?php
			$args = array(
				'posts_per_page' => 5,
				'post__not_in'   => array( get_the_ID() ),
				'no_found_rows'  => true, 
				'post_type' => array('transformation'),
			);
			// Query posts
			$wpex_query = new wp_query( $args );?>
			<?php  // Loop through posts
			if( $wpex_query->have_posts() ) :
			while( $wpex_query->have_posts() ) :
			$wpex_query->the_post(); ?>
				<div class="col-12 recent-post p-0">
					<div class="row py-4">
						<div class="col-md-4 col-12">
							<div class="transformation-section-single-image mb-2">
								<a class="row" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<?php
									$before_image_id = get_post_meta(get_the_id(), 'hk_image_before_diet_id', true);
									$before_image_url = wp_get_attachment_image_src($before_image_id, 'medium')[0];
									$after_image_id = get_post_meta(get_the_id(), 'hk_image_after_diet_id', true);
									$after_image_url = wp_get_attachment_image_src($after_image_id, 'medium')[0];
								?>
								<div class="position-relative col-md-6 pl-3 pr-1 transform">
									<img src="<?php echo $before_image_url; ?>"/>
									<div class="img-tag px-3 py-1">Before</div>
								</div>
								<div class="position-relative col-md-6 pl-1 pr-3 transform">
									<img src="<?php echo $after_image_url; ?>"/>
									<div class="img-tag px-3 py-1">After</div>
								</div>
								</a>
							</div>
						</div>
						<div class="col-md-8 col-12 next-articles">
							<span>
								<a target="_blank" title="Transformation" href="<?php echo get_post_type_archive_link(get_post_type()); ?>" rel="category tag">Transformation</a>
								<span class="dot"><i class="fa fa-circle" aria-hidden="true"></i></span>
								<span class="last-read"><?php echo get_mins_read(); ?> MIN READ</span>
								<span class="dot"><i class="fa fa-circle" aria-hidden="true"></i></span>
								<?php $post_date = get_the_date( 'M j, Y' ); ?>
								<span class="last-read"><?php echo $post_date; ?></span>
							</span>
							<div class="recent-post-header">
								<h2 class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
							</div>
							<div class="recent-post-excerpt"><?php echo wp_trim_words(get_the_content(), 18, '...'); ?>
							</div>
							<div class="recent-post-icons">
								<span class="mr-3 f-14 heart"><i class="fa fa-heart" aria-hidden="true"></i> 15 </span>
								<span class="mr-3 f-14 comment"><i class="fa fa-comments" aria-hidden="true"></i> 3</span>
							</div>
						</div>
					</div>
				</div>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
<?php });

add_shortcode( 'amp-section', function(){
	ob_start(); 
	?> <div class="container">
		<div class="banner row mt-4">
			<div class="banner-category col-12 col-md-4">
				<div class="banner-category-title">Top Topics</div>
				<?php $categories = get_terms(['taxonomy' => 'category' ]); 
				foreach ($categories as $category):
					$is_featured = get_term_meta( $category->term_id, 'hk_featured_category', true );
					if($is_featured == 'on'): ?>
						<div class="banner-category-single"><a href="<?php echo get_category_link($category->term_id); ?>" >
							<div class="banner-category-single-image">
								<?php
								$image_id = get_term_meta( $category->term_id, 'hk_featured_image_id', true );
								$image_url = wp_get_attachment_image_src($image_id, 'large')[0];
								?>
								<img title="<?php echo $category->name; ?>" src="<?php echo $image_url; ?>" alt="<?php echo $category->name; ?>"/>
								<div class="overlay"></div>
							</div>
							<div class="banner-category-single-title"><?php echo $category->name; ?></div>
						</a></div>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		</div>
		<?php 
			get_template_part( 'page-templates/theme-sections/latest-articles', 'section' );
		 	get_template_part( 'page-templates/theme-sections/trending-articles', 'section' );
		 	get_template_part( 'page-templates/theme-sections/transformations', 'section' ); 
		 ?>
	</div> 
	<?php $content = ob_get_clean();
	return $content;
});

add_shortcode( 'product-listing', function(){?>
	<div class="product-listing">
		<?php

			$categoryMapping = [
				"Bodybuilding" => ["Workout Essentials", "Proteins", "Pre/Post Workout", "Plant Proteins"],
				"Weight Management" => ["Weight Management"],
				"Diet Nutrition" => ["Nutrition"],
				"Women's Wellness" => [ "Women", "Women Care"],
				"Hair Skin Nails" => ["Hair Care", "Hair Styling Tools", "Hair Loss", "Hair Spa & Beauty", "Skin Care", "Bath & Skin Care", "Nails", "Nail Art", "Biotin","Glutathione","Collagen", "Shampoo"],
				"Pre & Post Workout Nutrition" => ["Pre/Post Workout"],
				"Workout Routine" => ["Workout Essentials"],
				"Weight Loss Diet" => ["Weight Loss"],
				"Weight Gain Diet" => ["Weight Gain"],
				"Lifestyle Changes" => ["Lifestyle Concerns"],
				"Home Workout Plans" => ["Workout Programs"],
				"Vitamins and Minerals" => ["Vitamins", "Vitamin B" , "Vitamins & Supplements" , "Minerals" ],
				"Nutrition for Women" => ["Nutrition" , "Sports Nutrition", "Proteins"],
				"Fitness Tips for Women" =>["Fitness","Fitness Clothing","Fitness & Weight Management", "Fitness Accessories"],
				"Vitamins for Hair" => ["Hair Care", "Biotin", "Collagen", "Glutathione"],
				"Essential Nutrients for Skin" => ["Skin Care", "Antioxidants", "Biotin", "Collagen", "Glutathione"],
				"Nutrition for Nails" => ["Nails", "Biotin", "Collagen", "Glutathione"],
				"Nutrition and Stress" => ["Nutrition"],
				"Yoga Exercises" => ["Gym Accessories"],
				"Zen Mode" => ["Ashwagandha"],
				"Bulking" => ["Mass Gainers", "ZMA"],
				"Bodybuilding Diet" => ["Proteins"],
				"Healthy Eating" => ["Fruit Vinegars"],
				"Balanced Diet" => ["Fruit Vinegars"],
				"Healthy Diet Plans" => ["Weight Loss", "Weight Gain", "PCOS", "Hair Fall"],
				"Healthy Diet Plan for Women" => ["Weight Loss", "PCOS", "Hair Fall", "PMS"],
				"Common Women Health Issues" => ["PCOS", "Hair Fall", "PMS"]
			];

			$categories = hk_get_category($GLOBALS['global_article_id']);


			$article_cat_name = '';

			foreach($categories as $index => $category): 

				$article_cat_name = $category->name;

				if($category->parent != 0){
					$article_cat_name = get_cat_name($category->parent);
				}

			endforeach; 


			$replace_character = str_replace("&","",$article_cat_name);

			if($replace_character == 'Hair, Skin amp; Nails'){
				$article_cat_name = 'Hair Skin Nails';
			}
			if($replace_character == 'Diet amp; Nutrition'){
				$article_cat_name = 'Diet Nutrition';
			}

			$categoryMappingValue = $article_cat_name;


			if(isset($categoryMapping[$article_cat_name])){
				if(!isset($_SESSION["CATEGORY_MAP"])){
				$_SESSION["CATEGORY_MAP"] = $categoryMapping;
				}
				$categoryMappingList = $_SESSION["CATEGORY_MAP"][$article_cat_name];
				shuffle($categoryMappingList);

				if(isset($categoryMappingList[0])){
				$categoryMappingValue = $categoryMappingList[0];
				}
				else{
				$_SESSION["CATEGORY_MAP"][$article_cat_name] = $categoryMapping[$article_cat_name];
				}

				if (($key = array_search($categoryMappingValue, $_SESSION["CATEGORY_MAP"][$article_cat_name])) !== false) {
				   unset($_SESSION["CATEGORY_MAP"][$article_cat_name][$key]);
				}

			}

			$api_url = 'https://api.healthkart.com/api/category/all/1';

			$json_data = file_get_contents($api_url);

			$response_data = json_decode($json_data);
 							
			$user_data = $response_data->results;

			$product_data = $user_data->allCat;

			$product_api_url = '';

			foreach ($product_data as $product) {

				$value = $product->nm ;
			 	
		 		if( $value == $categoryMappingValue ){

		 			$product_api_url = 'http://api.healthkart.com/api/catalog/results?catPrefix='. $product->catPre.'&pageNo=1&perPage=2&excludeOOS=true&plt=1&st=1';

		 			break;
		 		}

	 		}
	 		?>
	 		<p style="display: none"> CatPre Value: <?php echo  $product->catPre ?></p>
			<p style="display: none">Category Name: <?php echo  $article_cat_name ?></p>
			<p style="display: none">Category Mapping Value:<?php echo  $categoryMappingValue ; ?></p>

			<?php
			
			if ($product_api_url != ''){

				$pr_json_data = file_get_contents($product_api_url);


				$pr_response_data = json_decode($pr_json_data);

				$product_info = $pr_response_data->results;

				$product_detail_info = $product_info->variants;

				//print_r($product_detail_info);

			
			if (!empty($product_detail_info)){?>
				<div class="section-title pb-3"> Recommended Products </div>
				
			<?php } ?>
			<div class="grid-view row">
				<?php $i = 0 ;?>				
				<?php foreach ($product_detail_info as $pr) { 
					if (++$i > 3) break; ?>

					<div class="recommend-products col-md-12 col-6">
						<div class="product-stack row">
							<div class="product-stack-image col-md-6 col-sm-12">
								<a href="https://www.healthkart.com/sv<?php echo $pr->urlFragment ?>?navKey=<?php echo $pr->navKey ?>" target="_blank" title="<?php echo $pr->m_img->alt ?>">
									<img src="<?php echo $pr->m_img->m_link ?>" class="img-responsive product-image" title="<?php echo $pr->m_img->alt ?>" alt="<?php echo $pr->m_img->alt ?>">
								</a>
							</div>
							<div class="col-md-6"> 
								<a href="https://www.healthkart.com/sv<?php echo $pr->urlFragment ?>?navKey=<?php echo $pr->navKey ?>" target="_blank" title="<?php echo $pr->m_img->alt ?>"> 
									<span class="product-des product-desc"> <?php echo $pr->nm ?> </span> 
								</a>
								<div class="buy-now-btn"> 
									<a class="article-btn" href="https://www.healthkart.com/sv<?php echo $pr->urlFragment ?>?navKey=<?php echo $pr->navKey ?>" target="_blank" title="<?php echo $pr->m_img->alt ?>"> Buy now </a>
								</div>
							</div>
						</div>
					</div> 
				<?php }  ?>
			</div>
			<?php }  ?>
		</div>
<?php });

