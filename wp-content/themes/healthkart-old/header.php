<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="utf-8"/>
		<meta http-equiv="x-ua-compatible" content="ie=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0 height=device-height">
		<title><?php wp_title(); ?></title>
		<link rel="icon" href="<?php echo site_url('/wp-content/uploads/2020/09/favicon.png'); ?>" type="image/png" />
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
			
	<header id="site-header" class="site-header">
		<div class="container">
			<div class="tob-bar-menu">
				<?php wp_nav_menu( array( 'theme_location' => 'top-menu' ) ); ?>
			</div>
			<div id="site-navigation" class="site-navigation">
				<div class="main-header d-flex justify-content-between pt-3 pb-4">
					<div class="logo-text">
						<div class="site-logo d-flex align-items-center">
							<!--Toggle Start -->
							<div id="togglerBtn" class="toggler">
					        	<div class="top-line"></div>
					            <div class="mid-line"></div>
					            <div class="bot-line"></div>
			        		</div> <!-- Toggler End-->
							<?php 
							   	$custom_logo_id = get_theme_mod( 'custom_logo' );
							   	$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
					      	?>
							<img src="<?php echo $image[0]; ?>" alt="" class="pr-2">
							<span class="pr-4 f-24 font-weight-500">Blog</span>
						</div>
						<div class="input-group">
							<input type="text" class="form-control search-bar" placeholder="Search Healthkart Blog">
							<div class="input-group-append button-icon">
								<button class="btn" type="button">
									<img src="<?php echo get_template_directory_uri(); ?>/assets/images/search-icon.png" alt="search" class="search-icon-white">
									<img src="<?php echo get_template_directory_uri(); ?>/assets/images/search-icon-grey.png" alt="search" class="search-icon-grey">
								</button>
							</div>
						</div>
					</div>
					<div class="action-block">
						<a href=""> Shop at Healthkart <i class="fa fa-arrow-right pl-2" aria-hidden="true"></i></a>
					</div>
				</div>
				<div class="navbar navbar-expand-md navbar-light header-menu p-0">
					  <?php wp_nav_menu(); ?>
				</div>
			</div>
		</div>
		<!-- Mobile Menu -->
		<div class="menu-list-container">
			<div class="mweb-innnermenu">
				<div class="menu-section">
					<div class="menu-content-list expandable">
						<div class="">
							<div class="user-bar">
								<div class="greet-container">
									<span class="close-icon"></span>
									<span class="user-name">To get personalised Offers</span>
								</div>
								<div class="user-mweb-button">
									<ul>
										<li class="login-link-mweb">
											<a href="https://www.healthkart.com/account/" target="_blank">Log In</a>
										</li>
										<li class="registeruser">
											<a href="https://www.healthkart.com/account/" target="_blank">Sign Up</a>
										</li>
									</ul>
								</div>
							</div>
							<div class="list-view">
								<?php wp_nav_menu(); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	<div id="content">