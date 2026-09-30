<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.svg" />

    <!-- Google fontes -->
    <!-- <link href="https://fonts.googleapis.com/css2?family=Rethink+Sans:ital,wght@0,400..800;1,400..800&display=swap" rel="stylesheet"> -->

    <!-- O <title> é gerado pelo WordPress (add_theme_support('title-tag') em
         functions.php). Montá-lo aqui com wp_title() + bloginfo() repetia o
         nome do site no Google ("Home - Vergê DigitalVergê Digital"), porque
         o plugin de SEO já devolve o título completo pelo wp_title(). -->

    <?php // Com o Yoast SEO ativo, ele já gera Open Graph e Twitter Cards: o tema não duplica.
    if (!defined('WPSEO_VERSION')) : ?>
    <!-- Open Graph (Facebook e LinkedIn) -->
    <meta property="og:title" content="<?php echo esc_attr(wp_get_document_title()); ?>" />
    <meta property="og:description" content="<?php echo esc_attr(vergedigital_descricao()); ?>" />
    <meta property="og:image" content="<?php echo esc_url(get_the_post_thumbnail_url(null, 'full')); ?>" />
    <meta property="og:url" content="<?php echo esc_url(get_permalink()); ?>" />
    <meta property="og:type" content="<?php echo is_singular('post') ? 'article' : 'website'; ?>" />
    <meta property="og:locale" content="pt_BR" />

    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="<?php echo esc_attr(wp_get_document_title()); ?>" />
    <meta name="twitter:description" content="<?php echo esc_attr(vergedigital_descricao()); ?>" />
    <meta name="twitter:image" content="<?php echo esc_url(get_the_post_thumbnail_url(null, 'full')); ?>" />
    <meta name="twitter:site" content="@vergedigital_" />
    <?php endif; ?>

    <!-- Header WordPress -->
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <!-- Tela de carregamento: preta, logo girando no meio. Propositalmente
         independente do GSAP (CSS puro + este script isolado) — se o GSAP
         não carregar do CDN por algum motivo, a tela preta ainda some
         sozinha. Some assim que o HTML é lido (DOMContentLoaded), sem
         esperar imagens e o 3D: esperar o "load" atrasava o LCP e o Speed
         Index no Lighthouse. Timeout de segurança de 2,5s. -->
    <div id="preloader" class="preloader" aria-hidden="true">
        <img class="preloader__logo" src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.svg" alt="" width="70" height="70" fetchpriority="high">
    </div>
    <script>
        (function () {
            var pre = document.getElementById('preloader');
            if (!pre) return;
            var done = false;

            function hide() {
                if (done) return;
                done = true;
                pre.classList.add('is-hidden');
                window.dispatchEvent(new CustomEvent('preloaderhidden'));
                // Tira do layout depois do fade (0,3s no CSS).
                setTimeout(function () { pre.style.display = 'none'; }, 300);
            }

            if (document.readyState !== 'loading') {
                hide();
            } else {
                document.addEventListener('DOMContentLoaded', hide);
            }
            setTimeout(hide, 2500);
        })();
    </script>

    <!-- <div class="search-header">
        <div class="container">
        <?php get_search_form(); ?>
        </div>
    </div> -->

    <header>
        <nav class="container">
            <div class="logo-menu-group">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="logo-link">
                    <img class="logo" src="<?php echo get_stylesheet_directory_uri();  ?>/img/logo.svg"
                        alt="Logo Verge Digital" width="70" height="70">
                </a>
                <!-- <button> (e não <span>): controle clicável precisa de papel e nome
                     na árvore de acessibilidade, para leitores de tela e agentes de IA. -->
                <button type="button" class="material-icons-round menu-mobile" aria-label="Abrir menu" aria-expanded="false">menu</button>
            </div>
            <?php wp_nav_menu(array('theme_location' => 'header')); ?>
            <a href="<?php echo esc_url(vergedigital_whatsapp('Olá, Vergê! Vim pelo site e gostaria de conversar sobre um projeto.')); ?>" class="fale" target="_blank" rel="noopener noreferrer">Fale com a gente!</a>
        </nav>
    </header>

    <main id="conteudo">

    <!-- O toggle do menu mobile (e a animação de entrada dos itens) agora
         vive em js/animations.js, junto com as demais animações GSAP do tema. -->