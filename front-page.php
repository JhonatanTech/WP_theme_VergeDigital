<?php get_header(); ?>

<section class="about">
    <div class="content container">
        <div class="text">
            <img class="slogan" src="<?php echo get_stylesheet_directory_uri(); ?>/img/slogan.svg" alt="Caneca com código">

            <video muted autoplay playsinline loop class="mobile">
                <source src="<?php echo get_stylesheet_directory_uri(); ?>/img/MOEDA.mp4" type="video/webm" />
            </video>

            <p>Fazemos de tudo para<br> sua marca se <strong>destacar.</strong></p>
            <a class="primary" href="https://vergedigital.com.br/category/todos/">Conheça nosso portfólio <span class="material-icons-round">arrow_outward</span></a>
            <a class="secundary" href="https://wa.me/message/THVPRTFBOLWFE1">PEÇA SEU ORÇAMENTO<span class="material-icons-round">arrow_outward</span></a>
        </div>

        <!-- <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/moeda.svg" alt=""> -->

        <video muted autoplay playsinline loop class="desktop">
            <source src="<?php echo get_stylesheet_directory_uri(); ?>/img/MOEDA.mp4" type="video/webm" />
        </video>
    </div>
</section>

<section class="faixa">
    <img class="desktop" src="<?php echo get_stylesheet_directory_uri(); ?>/img/faixa.svg" alt="">
    <img class="mobile" src="<?php echo get_stylesheet_directory_uri(); ?>/img/faixa-mobile.svg" alt="">
</section>

<section class="servicos">
    <div class="container">
        <div class="text">
            <h2>Um estúdio <strong>colaborativo</strong> digital</h2>
            <p>Somos um estúdio formado por amigos criativos que se conheceram na faculdade e seguiram caminhos diferentes — mas que se complementam aqui na Vergê.</p>
            <strong>Do papel ao pixel, juntos transformamos ideias em realidade.</strong>
        </div>
        <ul class="lista">
            <li>
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/identidade.svg" alt="">
                <h3>Identidade<br>
                    visual</h3>
                <p>O primeiro passo para a sua marca. Definimos todas as diretrizes para um reconhecimento visual sólido e memorável.</p>
                <a href="">quero saber mais <span class="material-icons-round">
                        arrow_outward
                    </span></a>
            </li>
            <li>
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/editorial.svg" alt="">
                <h3>Design<br>
                    editorial</h3>
                <p>Livros, revistas, catálogos e apresentações. Conteúdos visuais bem estruturados para encantar e informar.</p>
                <a href="">quero saber mais <span class="material-icons-round">
                        arrow_outward
                    </span></a>
            </li>
            <li>
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/grafico.svg" alt="">
                <h3>Design<br>
                    gráfico</h3>
                <p>Materiais visuais personalizados para impressão ou digital, trazendo identidade e profissionalismo à marca.</p>
                <a href="">quero saber mais <span class="material-icons-round">
                        arrow_outward
                    </span></a>
            </li>
            <li>
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/webdesign.svg" alt="">
                <h3>Webdesign &<br>
                    Programação</h3>
                <p>Sites e plataformas funcionais, responsivas e impactantes para sua presença digital.</p>
                <a href="">quero saber mais <span class="material-icons-round">
                        arrow_outward
                    </span></a>
            </li>
            <li>
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/socialmedia.svg" alt="">
                <h3>Design de<br>
                    Social media</h3>
                <p>Criatividade estratégica para suas redes. Posts, templates e identidade digital para engajar seu público.</p>
                <a href="">quero saber mais <span class="material-icons-round">
                        arrow_outward
                    </span></a>
            </li>
        </ul>
    </div>
</section>

<section class="posts">
    <?php
    $args = array(
        'numberposts' => 5,
        'orderby' => 'date',
        'order' => 'DESC',
    );
    $my_posts = get_posts($args);
    //var_dump($my_posts); 
    ?>

    <div class="container">
        <h2>Nossos projetos de <strong>sucesso</strong></h2>
        <a href="https://vergedigital.com.br/category/todos/">ver mais <span class="material-icons-round">arrow_outward</span></a>

        <div class="posts">
            <?php if (!empty($my_posts)) {
                foreach ($my_posts as $p) { ?>
                    <div class="post">
                        <a href="<?php echo get_permalink($p->ID); ?>">
                            <?php echo get_the_post_thumbnail($p->ID) ? get_the_post_thumbnail($p->ID) : '<img src="' . get_stylesheet_directory_uri() . '/img/bg-about.jpg" alt="Caneca">'; ?>
                            <div class="preview">
                                <!-- <p class="date">
                                    <span class="material-icons-round">today</span>
                                    <?php echo get_the_time('d/m/Y', $p->ID); ?>
                                </p>
                                <p class="date">
                                    <span class="material-icons-round">person</span>
                                    <?php echo get_the_author_meta('display_name', $p->post_author); ?>
                                </p> -->
                                <h3><?php echo $p->post_title; ?></h3>
                                <!-- <p><?php echo $p->post_excerpt; ?></p> -->
                            </div>
                        </a>
                    </div>
            <?php }
                wp_reset_postdata();
            } ?>

            <div class="post seuprojeto">
                <a class="secundary" href="https://wa.me/message/THVPRTFBOLWFE1">
                    <span class="material-icons-round">add</span>
                    <h3>Seu projeto</h3>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="clientes">
    <div class="container">
        <h2>Alguns de nossos clientes</h2>

        <ul id="clientes" class="slick-clientes">
            <li><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/adoletra.svg" alt=""></li>
            <li><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/meulivrodebolso.svg" alt=""></li>
            <li><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/monada.svg" alt=""></li>
            <li><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/layla.svg" alt=""></li>
        </ul>
    </div>
</section>

<section class="newsletter">
    <div class="container">
        <div class="text">
            <h3>
                Sua marca merece um design à altura.
                Fale com a gente!
            </h3>
            <ul>
                <li><a href="https://wa.me/message/THVPRTFBOLWFE1"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/whats.svg" alt=""></a></li>
                <li><a href="https://www.instagram.com/vergedigital_/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/insta.svg" alt=""></a></li>
                <li><a href="https://www.behance.net/vergedigital_"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/behance.svg" alt=""></a></li>
            </ul>
        </div>
        <div class="glass">
            <h3>CONTATO</h3>
            <p>Eu busco por...</p>
            <div class="tags">
                <div class="tag active">IDENTIDADE VISUAL</div>
                <div class="tag blue">WEBDESIGN & PROGRAMAÇÃO</div>
                <div class="tag">SOCIAL MEDIA</div>
                <div class="tag">DESIGN GRÁFICO</div>
                <div class="tag">DESIGN EDITORIAL</div>
            </div>

            <form>
                <input type="text" placeholder="Seu nome" required>
                <input type="email" placeholder="Seu e-mail" required>
                <input type="tel" placeholder="+00 00 0000-0000" required>
                <textarea rows="3" placeholder="Nos conte sobre seu projeto"></textarea>

                <div class="checkbox-group">
                    <label>Prefiro receber minha proposta por:</label>
                    <div>
                        <input type="checkbox" id="whatsapp">
                        <label for="whatsapp">WhatsApp</label>
                    </div>
                    <div>
                        <input type="checkbox" id="email">
                        <label for="email">E-mail</label>
                    </div>
                </div>

                <button class="submit-btn" type="submit">ENVIAR</button>
            </form>
        </div>
    </div>
</section>

<?php get_footer(); ?>