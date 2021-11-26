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
        </div>
        <div class="author__social">
            <!-- twitter -->
			<a href="https://twitter.com/intent/tweet?text=<?php echo $title; ?>&amp;url=<?php echo $postUrl; ?>&amp;via=Healthkart" class="author__social__icons" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            <!-- linkedin -->
			<a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $postUrl; ?>&amp;title=<?php echo $title; ?>&amp;source=healthkart.com/connect/" class="author__social__icons" target="_blank"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
            <!-- facebook -->
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $postUrl; ?>" class="author__social__icons" target="_blank"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
        </div>
    </div>
</div>