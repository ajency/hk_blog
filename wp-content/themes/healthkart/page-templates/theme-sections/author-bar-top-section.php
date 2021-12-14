<?php

$user_info = get_userdata($post->post_author); 
$authorId = $user_info->ID;
?>
<div class="author-bar-top">
    <div class="author">
        <div class="author__profile">
            <?php $avatar_url = get_avatar_url( $user_info->ID); ?>
            <a href="<?php echo get_author_posts_url($user_info->ID); ?>">
                <img src="<?php echo esc_url($avatar_url); ?>" alt="">
            </a>
        </div>
        <div class="author__content">
            <h4 class="author-name">
                <a href="<?php echo get_author_posts_url($user_info->ID); ?>">
                    <?php echo $user_info->display_name; ?>
                </a>
            </h4>
            <p class="article-date-time">
            <span class="last-read"><?php the_date('M j, Y'); ?></span>
			<span class="dot"><i class="fa fa-circle" aria-hidden="true"></i></span>
            <span class="last-read"><?php echo get_mins_read(); ?> min read</span>
            </p>
            <?php 
				$reviewedby = get_field('medically_reviewed_by');
					if(!empty($reviewedby)){
						$username = sanitize_user($reviewedby->user_login);
							if ( username_exists( $username) ) {
								$user_data = get_user_by('login', $username);
									if(!empty($user_data->user_lastname || $user_data->user_firstname)){
			?>
            <p class="reviewer-name">Medically Reviewed By <a href="<?php echo get_author_posts_url($user_data->ID); ?>" class="author-link"> <?php echo $user_data->display_name; ?></a></p>
            <?php } } } ?>
        </div>
        <div class="author__social">
            <?php 
                $postUrl = 'http' . ( isset( $_SERVER['HTTPS'] ) ? 's' : '' ) . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"; 
                $title = urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8'));
            ?>
            <!-- twitter -->
			<a href="https://twitter.com/intent/tweet?text=<?php echo $title; ?>&amp;url=<?php echo $postUrl; ?>&amp;via=Healthkart" class="author__social__icons" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            <!-- linkedin -->
			<a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $postUrl; ?>&amp;title=<?php echo $title; ?>&amp;source=healthkart.com/connect/" class="author__social__icons" target="_blank"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
            <!-- facebook -->
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $postUrl; ?>" class="author__social__icons" target="_blank"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
        </div>
    </div>
</div>