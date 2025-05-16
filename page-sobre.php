<?php
//Template Name: Sobre
?>
<?php get_header(); ?>

<div class="container sobre">
    <h2>Um estúdio multifuncional com tudo que sua marca precisa para decolar.</h2>
    <p>A Vergê Digital nasceu em 2025 para unir duas áreas complementares: design e programação. Nossa missão é transformar ideias em soluções visuais e digitais impactantes, fortalecendo marcas e negócios.</p>
    <a href="">quero saber mais <span class="material-icons-round">arrow_outward</span></a>
</div>

<section class="servicos">
    <div class="container">
        <h2 class="servicos__titulo">Nossos serviços</h2>
        <div class="servicos__grid">

            <div class="servico-box destaque">
                <div class="servico-box__icone">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/identidade.svg" alt="Identidade visual">
                </div>
                <div class="servico-box__conteudo">
                    <h3>Identidade visual</h3>
                    <p>Acabou de criar sua marca? Comece pela identidade visual. Ela é a cara da sua marca: logo, cores e tudo o que faz seu negócio ser reconhecido de longe.</p>
                </div>
                <div class="servico-box__action">
                    <span class="material-icons-round">arrow_outward</span>
                </div>
            </div>

            <div class="servico-box">
                <div class="servico-box__icone">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/grafico.svg" alt="Design gráfico">
                </div>
                <div class="servico-box__conteudo">
                    <h3>Design gráfico</h3>
                    <p>Já tem uma identidade e precisa de um material profissional? Criamos cartões, apresentações, embalagens e tudo o que sua marca precisa.</p>
                </div>
                <div class="servico-box__action">
                    <span class="material-icons-round">arrow_outward</span>
                </div>
            </div>

            <div class="servico-box">
                <div class="servico-box__icone">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/editorial.svg" alt="Design editorial">
                </div>
                <div class="servico-box__conteudo">
                    <h3>Design editorial</h3>
                    <p>Seu conteúdo, mais atrativo e profissional. Criamos layouts para livros, revistas, catálogos e materiais informativos, sejam para impressão ou digitais.</p>
                </div>
                <div class="servico-box__action">
                    <span class="material-icons-round">arrow_outward</span>
                </div>
            </div>

            <div class="servico-box">
                <div class="servico-box__icone">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/webdesign.svg" alt="Webdesign & Programação">
                </div>
                <div class="servico-box__conteudo">
                    <h3>Webdesign & Programação</h3>
                    <p>Seu site está pronto para impressionar? Criamos plataformas intuitivas, responsivas e com design estratégico.</p>
                </div>
                <div class="servico-box__mockup">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/mockup-note.png" alt="Mac Pro 16">
                </div>
                <div class="servico-box__action">
                    <span class="material-icons-round">arrow_outward</span>
                </div>
            </div>

            <div class="servico-box">
                <div class="servico-box__icone">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/socialmedia.svg" alt="Social media">
                </div>
                <div class="servico-box__conteudo">
                    <h3>Social media</h3>
                    <p>Suas redes sociais com uma identidade forte, garantindo que o público sempre esteja em contato com você. Posts, templates e artes que engajam e vendem.</p>
                </div>
                <div class="servico-box__action">
                    <span class="material-icons-round">arrow_outward</span>
                </div>
            </div>
        </div>
    </div>
</section>

<hr class="container">

<section class="essencia">
    <div class="container essencia__container">
        <div class="essencia__texto">
            <h2>Nossa <span>essência</span></h2>
            <p>
                Somos um estúdio localizado em São Paulo, que acredita na fusão entre tecnologia e design para criar experiências marcantes.
                Com um olhar inovador e estratégico, buscamos entregar soluções funcionais, criativas e personalizadas para cada projeto.
            </p>
        </div>
        <div class="essencia__imagem">
            <img src="<?php echo get_template_directory_uri(); ?>/img/isotipo-glass.svg" alt="Forma abstrata" />
        </div>
    </div>
</section>


<?php get_footer(); ?>