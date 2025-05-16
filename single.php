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
    <div class="heading">
        <h1 class="subtitulo"><?php the_title(); ?></h1>
        <!-- <p class="date">
            <span class="material-icons-round">today</span>
            <?php echo get_the_time('d/m/Y', get_post()->ID); ?>
        </p>
        <p class="author">
            <span class="material-icons-round">person</span>
            <a href="<?php echo esc_url(get_author_posts_url(get_post()->post_author)); ?>"><?php echo get_the_author_meta('display_name', get_post()->post_author); ?></a>
        </p> -->
        <?php the_post_thumbnail('full'); ?>
        <!-- <p><?php the_excerpt(); ?></p> -->
    </div>
    <hr>
    <div class="content"><?php echo the_content(); ?></div>
</section>

<?php get_footer(); ?>

<!-- <?php social_share_links(get_the_ID()); ?> -->