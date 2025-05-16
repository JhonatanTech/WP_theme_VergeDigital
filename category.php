<?php get_header(); ?>

<div class="category">

    <div class="container header-category">
        <h1 class=""><?php single_cat_title() ?></h1><!-- Nome da categoria -->

        <div class="category-buttons">
            <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="<?php if (!is_category()) echo 'active'; ?>">Todos</a>

            <?php
            $categories = get_categories([
                'orderby' => 'name',
                'order'   => 'ASC'
            ]);

            foreach ($categories as $category) :
                $slug = esc_attr($category->slug);
                $active = (is_category($slug)) ? 'active' : '';
            ?>
                <a href="<?php echo get_category_link($category->term_id); ?>"
                    class="category-<?php echo $slug; ?> <?php echo $active; ?>">
                    <?php echo esc_html($category->name); ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <section class="container">
        <?php if (have_posts()) {
            while (have_posts()) {
                the_post(); ?><!-- Loop de posts -->
                <div class="post">
                    <a href="<?php echo get_permalink($p->ID); ?>">
                        <?php echo get_the_post_thumbnail($p->ID) ? get_the_post_thumbnail($p->ID) : '<img src="' . get_stylesheet_directory_uri() . '/img/bg-about.jpg" alt="Caneca">'; ?>
                        <!-- <div class="preview">
                        <p class="date">
                            <span class="material-icons-round">today</span>
                            <?php echo get_the_time('d/m/Y', $p->ID); ?>
                        </p>
                        <p class="date">
                            <span class="material-icons-round">person</span>
                            <a href="<?php echo esc_url(get_author_posts_url(get_post()->post_author)); ?>"><?php echo get_the_author_meta('display_name', $p->post_author); ?></a>
                        </p>
                        <h3><?php echo the_title(); ?></h3>
                        <p><?php echo get_the_excerpt(); ?></p>
                        <a href="<?php echo get_permalink($p->ID); ?>">Quero ler este post!<span class="material-icons-round">arrow_forward</span></a>
                    </div> --></a>
                </div>
            <?php }
        } else { ?>
            <div class="container erro-404">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/404.svg">
                <h1>Ops! Conteúdo não encontrado nesta categoria.</h1>
            </div>
        <?php } ?>
    </section>
</div>

<div class="container orcar">
    <a href="https://wa.me/message/THVPRTFBOLWFE1" class="contato">quero orçar meu projeto
        <span class="material-icons-round">arrow_outward</span></a>
</div>

<div class="container pagination">
    <?php wordpress_pagination(); ?>
</div>
<?php get_footer(); ?>