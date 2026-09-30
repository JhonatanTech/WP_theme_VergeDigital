</main>

<footer>
    <div class="footer-card container">
        <div class="footer-card__top">
            <nav class="footer-card__nav" aria-label="Menu do rodapé">
                <a href="<?php echo esc_url(home_url('/')); ?>">Início</a>
                <a href="<?php echo esc_url(home_url('/#projetos')); ?>">Projetos</a>
                <a href="<?php echo esc_url(home_url('/#servicos')); ?>">Serviços</a>
                <a href="<?php echo esc_url(home_url('/#contato')); ?>">Contato</a>
            </nav>

            <div class="footer-card__contact">
                <ul class="footer-card__social">
                    <li><a href="<?php echo esc_url(vergedigital_whatsapp('Olá, Vergê! Vim pelo site e gostaria de mais informações sobre os serviços de vocês.')); ?>" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/whats.svg" alt="" width="62" height="61" loading="lazy"></a></li>
                    <li><a href="https://www.instagram.com/vergedigital_/" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/insta.svg" alt="" width="62" height="61" loading="lazy"></a></li>
                    <li><a href="https://www.behance.net/vergedigital_" target="_blank" rel="noopener noreferrer" aria-label="Behance"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/behance.svg" alt="" width="62" height="61" loading="lazy"></a></li>
                </ul>

                <p>E-mail: <a href="mailto:contato@vergedigital.com.br">contato@vergedigital.com.br</a></p>
                <p><a href="tel:+5511967416661">+55 11 96741-6661</a></p>
                <p class="footer-card__location">São Paulo, SP, Brasil</p>
            </div>
        </div>

        <div class="footer-card__wordmark" aria-hidden="true"><span>Vergê</span></div>
    </div>

    <p class="copyright">© <?php echo date('Y'); ?> por VERGÊ DIGITAL</p>
</footer>

<!-- Footer WordPress -->
<?php wp_footer(); ?>

<a href="<?php echo esc_url(vergedigital_whatsapp('Olá, Vergê! Estou navegando pelo site e gostaria de tirar uma dúvida.')); ?>" class="whatsapp-float" target="_blank" rel="noopener noreferrer" aria-label="Fale conosco pelo WhatsApp"><i class="icon-whatsapp"></i></a>

<script>
    // Slick só é carregado na home (functions.php); nas outras páginas não
    // há carrossel e .slick() nem existe.
    if (window.jQuery && jQuery.fn.slick) {
    jQuery(document).ready(function($) {
        jQuery('.slick-clientes').slick({
            slidesToShow: 4,
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
                        slidesToShow: 2
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

    // O Slick marca as bolinhas como abas (role="tablist"/"tab"/"presentation"
    // e os slides como "tabpanel"). Dentro de uma <ul> isso quebra a lista
    // para leitores de tela (o Lighthouse acusa). Aqui elas viram uma lista
    // simples de botões com nome claro, e o ativo é marcado com aria-current.
    function vergedigitalAcessibilidadeDots(slider) {
        var $dots = slider.$dots;
        if (!$dots || !$dots.length) {
            return;
        }
        var total = $dots.find('li').length;

        $dots.removeAttr('role');
        $dots.find('li').removeAttr('role').each(function(i) {
            jQuery(this).find('button')
                .removeAttr('role aria-selected aria-controls id tabindex')
                .attr('aria-label', 'Ver serviço ' + (i + 1) + ' de ' + total)
                .attr('aria-current', i === slider.currentSlide ? 'true' : null);
        });
        slider.$slides.removeAttr('role aria-describedby');
    }

    // setTimeout: o Slick roda o próprio initADA() logo DEPOIS de disparar
    // esses eventos e recolocaria os papéis — a limpeza precisa vir depois dele.
    jQuery('.lista').on('init reInit afterChange', function(event, slider) {
        setTimeout(function() {
            vergedigitalAcessibilidadeDots(slider);
        }, 0);
    });

    if (window.innerWidth <= 768) {
        // 1 card por vez (não 1.2): com o "espiar" do próximo card, o
        // texto dele aparecia cortado no meio da palavra, sem nenhum
        // tratamento visual — parecia quebrado.
        $('.lista').slick({
            slidesToShow: 1,
            arrows: false,
            dots: true,
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
    }
</script>
</body>

</html>