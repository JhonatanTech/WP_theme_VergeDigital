<?php

add_theme_support('post-thumbnails');

function vergedigital_scripts()
{
    wp_enqueue_style('vergedigital-style', get_stylesheet_directory_uri() . '/css/style.css', array(), filemtime(get_stylesheet_directory() . '/css/style.css'));
    wp_enqueue_style('slick-carousel', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', array(), '1.8.1');
    wp_enqueue_style('slick-carousel-theme', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css', array('slick-carousel'), '1.8.1');
    wp_enqueue_style('animate-css', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css', array(), '4.1.1');

    wp_deregister_script('jquery');
    wp_register_script('jquery', '//code.jquery.com/jquery-1.11.0.min.js', array(), '1.11.0', false);
    wp_enqueue_script('jquery');
    wp_deregister_script('jquery-migrate');
    wp_register_script('jquery-migrate', '//code.jquery.com/jquery-migrate-1.2.1.min.js', array('jquery'), '1.2.1', false);
    wp_enqueue_script('jquery-migrate');
    wp_enqueue_script('slick-carousel-js', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js', array('jquery'), '1.9.0', true);
}
add_action('wp_enqueue_scripts', 'vergedigital_scripts');

function register_my_menus()
{
    register_nav_menus(
        array(
            'header' => __('Header Menu'),
            'other' => __('Other Menu')
        )
    );
}
add_action('init', 'register_my_menus');

function wordpress_pagination()
{
    global $wp_query;

    $big = 999999999;

    echo paginate_links(
        array(
            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format' => '?paged=%#%',
            'current' => max(1, get_query_var('paged')),
            'total' => $wp_query->max_num_pages,
            'prev_text' => '<span class="material-icons-round menu-mobile">navigate_before</span>',
            'next_text' => '<span class="material-icons-round menu-mobile">navigate_next</span>'
        )
    );
}

add_theme_support('title-tag');

function add_meta_tags()
{
    echo '<meta name="description" content="Um estúdio multifuncional que une design e programação para transformar ideias em soluções visuais e digitais. Fortaleça sua marca com a Vergê Digital.">';
    echo '<meta property="og:title" content="Vergê Digital – Design e Programação para Marcas que Querem Decolar" />';
    echo '<meta property="og:description" content="Estúdio criativo que une design gráfico, editorial, webdesign e social media com programação para impulsionar marcas e negócios." />';
    echo '<meta name="keywords" content="Vergê Digital, Design gráfico, Identidade visual, Programação, Webdesign, Social media, Design editorial, Criação de sites, Branding, Estúdio criativo" />';
    echo '<meta property="og:type" content="website" />';
    echo '<meta property="og:site_name" content="Vergê Digital" />';
}
add_action('wp_head', 'add_meta_tags');

/* add classe de sobre no body*/
function adicionar_classe_sobre_no_body($classes) {
    if (is_page('sobre')) {
        $classes[] = 'pagina-sobre';
    }
    return $classes;
}
add_filter('body_class', 'adicionar_classe_sobre_no_body');
