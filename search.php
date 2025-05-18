<?php get_header(); ?>


<div class="container">
    <h1><?php single_cat_title() ?></h1><!-- Nome da categoria -->
    <?php the_archive_description() ?><!-- Descrição da categoria -->
</div>
<div class="category">
    <section class="container">
        <?php if (have_posts()) {
            while (have_posts()) {
                the_post(); ?><!-- Loop de posts -->
                <div class="post">
                    <?php echo get_the_post_thumbnail($p->ID) ? get_the_post_thumbnail($p->ID) : '<img src="' . get_stylesheet_directory_uri() . '/img/bg-about.jpg" alt="Caneca">'; ?>
                    <div class="preview">
                        <p class="date">
                            <span class="material-icons-round">today</span>
                            <?php echo get_the_time('d/m/Y', $p->ID); ?>
                        </p>
                        <p class="date">
                            <span class="material-icons-round">person</span>
                            <?php echo get_the_author_meta('display_name', $p->post_author); ?>
                        </p>
                        <h3><?php echo the_title(); ?></h3>
                        <p><?php echo get_the_excerpt(); ?></p>
                        <a href="<?php echo get_permalink($p->ID); ?>">Quero ler este post!<span class="material-icons-round">arrow_forward</span></a>
                    </div>
                </div>
            <?php }
        } else { ?>
            <div class="container erro-404">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/404.svg">
                <h1>Ops! Conteúdo não encontrado.</h1>
            </div>
        <?php } ?>
    </section>
</div>
<div class="container pagination">
    <?php wordpress_pagination(); ?>
</div>
<?php get_footer(); ?>