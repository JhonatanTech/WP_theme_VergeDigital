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
    <!-- <div class="search-header">
        <div class="container">
        <?php get_search_form(); ?>
        </div>
    </div> -->
    <header>
        <nav class="container">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="logo-link">
                <img class="logo" src="<?php echo get_stylesheet_directory_uri();  ?>/img/logo.svg"
                    alt="Logo Verge Digital">
            </a>
            <span class="material-icons-round menu-mobile">menu</span>
            <?php wp_nav_menu(array('theme_location' => 'header')); ?>
            <a href="https://wa.me/message/THVPRTFBOLWFE1" class="fale" target="_blank" rel="noopener noreferrer">Fale com a gente!</a>
        </nav>
    </header>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuIcon = document.querySelector('.menu-mobile');
            const menu = document.querySelector('.menu');

            menuIcon.addEventListener('click', () => {
                menu.classList.toggle('active'); // Adiciona ou remove a classe 'active'
            });

            // Opcional: Fecha o menu ao clicar fora dele
            document.addEventListener('click', (event) => {
                if (!menu.contains(event.target) && !menuIcon.contains(event.target)) {
                    menu.classList.remove('active');
                }
            });
        });
    </script>