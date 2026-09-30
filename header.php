<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.svg" />

    <!-- Google fontes -->
    <!-- <link href="https://fonts.googleapis.com/css2?family=Rethink+Sans:ital,wght@0,400..800;1,400..800&display=swap" rel="stylesheet"> -->

    <title><?php wp_title('|', true, 'right');
            bloginfo('name'); ?></title>

    <!-- Open Graph (Facebook e LinkedIn) -->
    <meta property="og:title" content="<?php echo esc_attr(get_the_title()); ?>" />
    <meta property="og:description" content="<?php echo esc_attr(get_the_excerpt()); ?>" />
    <meta property="og:image" content="<?php echo esc_url(get_the_post_thumbnail_url(null, 'full')); ?>" />
    <meta property="og:url" content="<?php echo esc_url(get_permalink()); ?>" />
    <meta property="og:type" content="article" />
    <meta property="og:locale" content="en_US" />

    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="<?php echo esc_attr(get_the_title()); ?>" />
    <meta name="twitter:description" content="<?php echo esc_attr(get_the_excerpt()); ?>" />
    <meta name="twitter:image" content="<?php echo esc_url(get_the_post_thumbnail_url(null, 'full')); ?>" />
    <meta name="twitter:site" content="@vergedigital_" />

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
                <span class="material-icons-round menu-mobile">menu</span>
            </div>
            <?php wp_nav_menu(array('theme_location' => 'header')); ?>
            <a href="<?php echo esc_url(vergedigital_whatsapp('Olá, Vergê! Vim pelo site e gostaria de conversar sobre um projeto.')); ?>" class="fale" target="_blank" rel="noopener noreferrer">Fale com a gente!</a>
        </nav>
    </header>

    <main id="conteudo">

    <!-- O toggle do menu mobile (e a animação de entrada dos itens) agora
         vive em js/animations.js, junto com as demais animações GSAP do tema. -->