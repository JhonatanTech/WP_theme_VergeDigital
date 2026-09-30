<?php get_header(); ?>

<section class="container">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="post">
                <a href="<?php the_permalink(); ?>">
                    <?php echo get_the_post_thumbnail(get_the_ID()) ? get_the_post_thumbnail(get_the_ID()) : '<img src="' . get_stylesheet_directory_uri() . '/img/thumbnail.jpg" alt="' . esc_attr(get_the_title()) . '" width="1024" height="701" loading="lazy">'; ?>
                    <h3><?php the_title(); ?></h3>
                    <p><?php echo get_the_excerpt(); ?></p>
                </a>
            </div>
        <?php endwhile;
    else : ?>
        <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
    <?php endif; ?>
</section>

<div class="container pagination">
    <?php wordpress_pagination(); ?>
</div>

<?php get_footer(); ?>