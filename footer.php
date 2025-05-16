<?php
$categories = get_categories(array(
    'orderby' => 'name',
    'order'   => 'ASC'
));
?>

<footer>
    <nav class="container">
        <div class="about">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/imagotipo.svg">
        </div>
        <hr>
        <div class="links">
            <div class="itens">
                <h3>Redes sociais</h2>
                <ul class="redes">
                    <li><a href="https://wa.me/message/THVPRTFBOLWFE1"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/whats.svg" alt=""></a></li>
                    <li><a href="https://www.instagram.com/vergedigital_/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/insta.svg" alt=""></a></li>
                    <li><a href="https://www.behance.net/vergedigital_"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/behance.svg" alt=""></a></li>
                </ul>
            </div>
            <div class="itens">
                <h3>Contato</h2>
                <ul>
                    <a href="tel:+5511967416661">+55 11 96741-6661</a><br><br>
                    <a href="mailto:contato@vergedigital.com.br">contato@vergedigital.com.br</a>
            </div>
            <div class="itens">
                <h4>© 2025 por VERGÊ DIGITAL</h4>
            </div>
        </div>
    </nav>
</footer>

<!-- Footer WordPress -->
<?php wp_footer(); ?>

<a href="https://wa.me/message/THVPRTFBOLWFE1" class="fale">Fale com a gente!</a>

<script>
    jQuery(document).ready(function($) {
        jQuery('.slick-clientes').slick({
            slidesToShow: 2,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            arrows: false,
            dots: false,
            infinite: true,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
    });

    if (window.innerWidth <= 768) {
        $('.lista').slick({
            slidesToShow: 1.2,
            arrows: false,
            dots: false,
            infinite: false
        });
    }

    $(document).ready(function() {
        function slickInitIfMobile() {
            if ($(window).width() <= 768 && !$('.lista').hasClass('slick-initialized')) {
                $('.lista').slick({
                    slidesToShow: 1,
                    arrows: true,
                    dots: false,
                    infinite: false,
                    mobileFirst: true,
                });
            } else if ($(window).width() > 768 && $('.lista').hasClass('slick-initialized')) {
                $('.lista').slick('unslick');
            }
        }

        slickInitIfMobile(); // on load
        $(window).on('resize', slickInitIfMobile); // on resize
    });
</script>

<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/script.js"></script>
</body>

</html>