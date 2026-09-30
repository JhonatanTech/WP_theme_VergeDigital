<?php
function social_share_links($post_id) {
    $post_url = urlencode(get_permalink($post_id)); // URL do post
    $post_title = urlencode(get_the_title($post_id)); // Título do post

    // Links de compartilhamento
    $facebook_link = "https://www.facebook.com/sharer/sharer.php?u=$post_url";
    $twitter_link  = "https://twitter.com/intent/tweet?text=$post_title&url=$post_url";
    $linkedin_link = "https://www.linkedin.com/sharing/share-offsite/?url=$post_url";
    $whatsapp_link = "https://api.whatsapp.com/send?text=$post_title%20-%20$post_url";

    echo '<ul class="social_share_links">';
    echo '<li><a href="' . $facebook_link . '" target="_blank"><span class="icon-facebook"></span></a></li>';
    echo '<li><a href="' . $twitter_link  . '" target="_blank"><span class="icon-twitter-bird"></span></a></li>';
    echo '<li><a href="' . $linkedin_link . '" target="_blank"><span class="icon-linkedin"></span></a></li>';
    echo '<li><a href="' . $whatsapp_link . '" target="_blank"><span class="icon-whatsapp"></span></a></li>';
    echo '</ul>';
}
?>

<?php get_header(); ?>

<section class="container">
    <div class="content"><?php echo the_content(); ?></div>
</section>

<?php get_footer(); ?>

<!-- <?php social_share_links(get_the_ID()); ?> -->