<?php get_header(); ?>

<section class="container">
    <div class="heading">
        <h1 class="subtitulo"><?php the_title(); ?></h1>
    </div>
    <hr class="container">
    <div class="content"><?php echo the_content(); ?></div>
</section>

<?php get_footer(); ?>