<?php

add_theme_support('post-thumbnails');

require_once get_template_directory() . '/inc/briefing.php';

function vergedigital_scripts()
{
    wp_enqueue_style('vergedigital-style', get_stylesheet_directory_uri() . '/css/style.css', array(), filemtime(get_stylesheet_directory() . '/css/style.css'));
    wp_enqueue_style('animate-css', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css', array(), '4.1.1');

    // jQuery no rodapé: no <head> ele bloqueava a renderização da página.
    // Nenhum script antes do footer depende dele.
    wp_deregister_script('jquery');
    wp_register_script('jquery', '//code.jquery.com/jquery-1.11.0.min.js', array(), '1.11.0', true);
    wp_enqueue_script('jquery');
    wp_deregister_script('jquery-migrate');
    wp_register_script('jquery-migrate', '//code.jquery.com/jquery-migrate-1.2.1.min.js', array('jquery'), '1.2.1', true);
    wp_enqueue_script('jquery-migrate');

    // Slick (carrossel de clientes/projetos) só existe na home — não precisa
    // pesar nas outras páginas. O <model-viewer> é carregado mais abaixo.
    if (is_front_page()) {
        wp_enqueue_style('slick-carousel', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', array(), '1.8.1');
        wp_enqueue_style('slick-carousel-theme', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css', array('slick-carousel'), '1.8.1');
        wp_enqueue_script('slick-carousel-js', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js', array('jquery'), '1.9.0', true);
    }

    // GSAP + plugins (100% grátis desde a v3.13) via CDN, só na home e no
    // header/footer globais — anima hero, serviços, projetos, contato e footer.
    wp_enqueue_script('gsap', 'https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/gsap.min.js', array(), '3.13.0', true);
    wp_enqueue_script('gsap-scrolltrigger', 'https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/ScrollTrigger.min.js', array('gsap'), '3.13.0', true);
    wp_enqueue_script('gsap-splittext', 'https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/SplitText.min.js', array('gsap'), '3.13.0', true);
    wp_enqueue_script('vergedigital-animations', get_stylesheet_directory_uri() . '/js/animations.js', array('gsap', 'gsap-scrolltrigger', 'gsap-splittext'), filemtime(get_stylesheet_directory() . '/js/animations.js'), true);
}
add_action('wp_enqueue_scripts', 'vergedigital_scripts');

// <model-viewer> (logo 3D do hero): o script (255 KB) + o logo.glb (291 KB)
// eram o caminho crítico mais longo da home. Agora só começam a baixar depois
// do "load", fora do caminho crítico; o 3D aparece logo em seguida.
function vergedigital_model_viewer_deferred()
{
    if (!is_front_page()) {
        return;
    }
    ?>
    <script>
        window.addEventListener('load', function () {
            var s = document.createElement('script');
            s.type = 'module';
            s.src = 'https://cdn.jsdelivr.net/npm/@google/model-viewer@4.1.0/dist/model-viewer.min.js';
            document.head.appendChild(s);
        });
    </script>
    <?php
}
add_action('wp_footer', 'vergedigital_model_viewer_deferred', 30);

// CSS que não participa da primeira pintura (carrossel e animações de
// entrada) carrega sem bloquear a renderização: media="print" + troca pra
// "all" quando termina de baixar.
function vergedigital_async_styles($tag, $handle)
{
    if (!in_array($handle, array('slick-carousel', 'slick-carousel-theme', 'animate-css'), true)) {
        return $tag;
    }
    $async = str_replace("media='all'", "media='print' onload=\"this.media='all'\"", $tag);
    return $async . '<noscript>' . $tag . '</noscript>';
}
add_filter('style_loader_tag', 'vergedigital_async_styles', 10, 2);

// Pré-carrega as fontes (texto e ícones): sem isso o navegador só descobre os
// arquivos depois de baixar e ler o style.css (mais um degrau na cadeia de
// requisições — o fontello era o fim da cadeia crítica no Lighthouse).
function vergedigital_preload_font()
{
    $dir = get_stylesheet_directory_uri() . '/fonts/';
    $fonts = array(
        'Rethink_Sans/RethinkSans-VariableFont_wght.woff2',
        'MaterialIconsRound-subset.woff2',
        'fontello/font/fontello.woff2',
    );
    foreach ($fonts as $font) {
        echo '<link rel="preload" href="' . esc_url($dir . $font) . '" as="font" type="font/woff2" crossorigin>' . "\n";
    }
}
add_action('wp_head', 'vergedigital_preload_font', 1);

// O WordPress calcula o "sizes" das imagens pela largura original (ex.: 1920px),
// então o navegador baixava o arquivo cheio mesmo com a coluna tendo no
// máximo 1224px (.container). Limitando aqui, ele escolhe uma versão menor.
function vergedigital_content_image_sizes($sizes, $size)
{
    $width = is_array($size) ? (int) $size[0] : 0;
    if ($width > 1224) {
        return '(max-width: 1224px) 100vw, 1224px';
    }
    return $sizes;
}
add_filter('wp_calculate_image_sizes', 'vergedigital_content_image_sizes', 10, 2);

// Novos uploads em PNG/JPEG ganham as versões redimensionadas em WebP (bem
// mais leves). Se o servidor não suportar WebP, o WordPress mantém o formato
// original. Não afeta imagens já enviadas nem o arquivo original.
function vergedigital_webp_subsizes($formats)
{
    $formats['image/png'] = 'image/webp';
    $formats['image/jpeg'] = 'image/webp';
    return $formats;
}
add_filter('image_editor_output_format', 'vergedigital_webp_subsizes');

// O script de emojis do WordPress (wp-emoji-release.min.js + CSS inline) só
// serve para navegadores antigos sem emoji nativo — era JS a mais no carregamento.
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');
remove_filter('the_content_feed', 'wp_staticize_emoji');
remove_filter('comment_text_rss', 'wp_staticize_emoji');
remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

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

// Categorias fixas do tema (links dos serviços, "ver mais" e a lista de
// projetos da home). Elas sempre existem: são recriadas se faltarem e não
// podem ser excluídas pelo painel.
function vergedigital_categorias_fixas()
{
    return array(
        'identidade-visual' => 'Identidade visual',
        'design-grafico'    => 'Design gráfico',
        'editorial'         => 'Editorial',
        'exibir-na-home'    => 'Exibir na home',
        'sites'             => 'Sites',
        'social-media'      => 'Social media',
        'todos'             => 'Todos',
    );
}

// Recria as que estiverem faltando. Roda só no painel, com uma única
// consulta para conferir todas de uma vez.
function vergedigital_garantir_categorias()
{
    $fixas = vergedigital_categorias_fixas();

    $existentes = get_terms(array(
        'taxonomy'   => 'category',
        'slug'       => array_keys($fixas),
        'hide_empty' => false,
        'fields'     => 'id=>slug',
    ));
    if (is_wp_error($existentes)) {
        return;
    }

    foreach (array_diff(array_keys($fixas), $existentes) as $slug) {
        wp_insert_term($fixas[$slug], 'category', array('slug' => $slug));
    }
}
add_action('admin_init', 'vergedigital_garantir_categorias');

// Bloqueia a exclusão (individual, em massa ou via REST) das categorias fixas.
function vergedigital_bloquear_exclusao_categoria($term_id, $taxonomy)
{
    if ('category' !== $taxonomy) {
        return;
    }

    $term = get_term($term_id, 'category');
    if ($term && !is_wp_error($term) && array_key_exists($term->slug, vergedigital_categorias_fixas())) {
        wp_die(
            esc_html(sprintf('A categoria "%s" é usada pelo tema e não pode ser excluída.', $term->name)),
            'Categoria protegida',
            array('response' => 403, 'back_link' => true)
        );
    }
}
add_action('pre_delete_term', 'vergedigital_bloquear_exclusao_categoria', 10, 2);

// Esconde o link "Excluir" dessas categorias na lista de Posts → Categorias.
function vergedigital_ocultar_excluir_categoria($actions, $term)
{
    if (array_key_exists($term->slug, vergedigital_categorias_fixas())) {
        unset($actions['delete']);
    }
    return $actions;
}
add_filter('category_row_actions', 'vergedigital_ocultar_excluir_categoria', 10, 2);

// Monta o link do WhatsApp com uma mensagem pronta (já codificada para URL).
// Use sempre com esc_url() no href: esc_url(vergedigital_whatsapp("Olá!"))
function vergedigital_whatsapp($mensagem = '', $numero = '5511974554227')
{
    $url = 'https://api.whatsapp.com/send?phone=' . $numero;
    if ('' !== $mensagem) {
        $url .= '&text=' . rawurlencode($mensagem);
    }
    return $url;
}
