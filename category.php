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
                    <a href="<?php echo get_permalink(); ?>">
                        <?php echo get_the_post_thumbnail(get_the_ID(), 'full') ? get_the_post_thumbnail(get_the_ID(), 'full') : '<img src="' . get_stylesheet_directory_uri() . '/img/thumbnail.jpg" alt="" width="1024" height="701" loading="lazy">'; ?>
                    </a>
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
    <a href="<?php echo esc_url(vergedigital_whatsapp('Olá, Vergê! Vi os projetos de ' . single_cat_title('', false) . ' no site e quero orçar o meu.')); ?>" class="contato">quero orçar meu projeto
        <span class="material-icons-round">arrow_outward</span></a>
</div>

<div class="container pagination">
    <?php wordpress_pagination(); ?>
</div>
<?php get_footer(); ?>