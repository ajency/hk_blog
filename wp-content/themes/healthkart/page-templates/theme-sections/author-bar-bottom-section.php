<?php

$user_info = get_userdata($post->post_author); 
$authorId = $user_info->ID;
?>
<div class="author-bar-bottom">
    <div class="author">
        <div class="author__profile">
            <?php $avatar_url = get_avatar_url( $user_info->ID); ?>
            <div class="profile-container">
                <a href="<?php echo get_author_posts_url($user_info->ID); ?>">
                    <img src="<?php echo esc_url($avatar_url); ?>" alt="">
                </a>
            </div>
        </div>
        <div class="author__content">
            <?php $author_bio_desc = get_the_author_meta('description'); 
            if(!$author_bio_desc){ ?>
                <div class="author-name"><?php echo $user_info->display_name ?></div>
            <?php 
            } else{ ?>
                <p class="author-bio"><?php echo $author_bio_desc ?></p>
            <?php } ?>
        </div>
    </div>
</div>