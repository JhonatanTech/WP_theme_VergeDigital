<?php

add_theme_support('post-thumbnails');

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
