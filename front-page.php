<?php get_header(); ?>

<section class="about">
    <div class="content container">
        <div class="text">
            <img class="slogan" src="<?php echo get_stylesheet_directory_uri(); ?>/img/slogan.svg" alt="Do papel ao pixel" width="501" height="196" fetchpriority="high" decoding="async">

            <model-viewer class="mobile" src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.glb" alt="Logo da Vergê Digital em 3D" auto-rotate rotation-per-second="30deg" camera-controls touch-action="pan-y" interaction-prompt="none" disable-zoom disable-pan loading="eager"></model-viewer>

            <p>Fazemos de tudo para<br> sua marca se <strong>destacar.</strong></p>
            <div class="cta-group">
                <a class="primary" href="https://vergedigital.com.br/category/todos/">Conheça nosso portfólio <span class="material-icons-round">arrow_outward</span></a>
                <a class="secundary" href="<?php echo esc_url(vergedigital_whatsapp('Olá, Vergê! Vim pelo site e gostaria de pedir um orçamento para a minha marca.')); ?>">Peça seu orçamento<span class="material-icons-round">arrow_outward</span></a>
            </div>
        </div>

        <!-- <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/moeda.svg" alt=""> -->

        <model-viewer class="desktop" src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.glb" alt="Logo da Vergê Digital em 3D" auto-rotate rotation-per-second="30deg" camera-controls disable-zoom interaction-prompt="none" loading="eager"></model-viewer>
    </div>
</section>

<section class="clientes">
    <div class="container">
        <!-- <div> e não <ul>: o Slick embrulha os filhos em <div>s próprios,
             e aí os <li> ficavam fora de uma lista (erro de acessibilidade). -->
        <div id="clientes" class="slick-clientes">
            <div class="cliente"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/adoletra.svg" alt="Adoletra" width="284" height="73"></div>
            <div class="cliente"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/meulivrodebolso.svg" alt="Meu Livro de Bolso" width="281" height="109"></div>
            <div class="cliente"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/monada.svg" alt="Mônada" width="311" height="58"></div>
            <div class="cliente"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/layla.svg" alt="Layla" width="440" height="128"></div>
            <div class="cliente"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/adoletra.svg" alt="" width="284" height="73"></div>
            <div class="cliente"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/meulivrodebolso.svg" alt="" width="281" height="109"></div>
            <div class="cliente"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/monada.svg" alt="" width="311" height="58"></div>
            <div class="cliente"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/layla.svg" alt="" width="440" height="128"></div>
        </div>
    </div>
</section>

<!-- <section class="faixa">
    <img class="desktop" src="<?php echo get_stylesheet_directory_uri(); ?>/img/faixa.svg" alt="">
    <img class="mobile" src="<?php echo get_stylesheet_directory_uri(); ?>/img/faixa-mobile.svg" alt="">
</section> -->

<section class="servicos" id="servicos">
    <div class="container">
        <div class="text">
            <h2>Um estúdio <strong>colaborativo</strong> digital</h2>
            <p>Somos um estúdio formado por amigos criativos que se conheceram na faculdade e seguiram caminhos diferentes — mas que se complementam aqui na Vergê.</p>
            <strong>Do papel ao pixel, juntos transformamos ideias em realidade.</strong>
        </div>
        <!-- <div> e não <ul>/<li>: no celular o Slick embrulha os cards em
             <div>s próprios e a lista ficava inválida para leitores de tela. -->
        <div class="lista">
            <div class="servico servico-identidade-visual">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/identidade-320.webp" srcset="<?php echo get_stylesheet_directory_uri(); ?>/img/identidade-320.webp 320w, <?php echo get_stylesheet_directory_uri(); ?>/img/identidade.webp 700w" sizes="(max-width: 770px) calc(100vw - 112px), 160px" alt="" width="700" height="467" loading="lazy">
                <h3>Identidade<br>
                    visual</h3>
                <p>O primeiro passo para a sua marca. Definimos todas as diretrizes para um reconhecimento visual sólido e memorável.</p>
                <a href="<?php echo esc_url(home_url('/category/identidade-visual/')); ?>">Conhecer <span class="material-icons-round">
                        arrow_outward
                    </span></a>
            </div>
            <div class="servico servico-editorial">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/editorial-320.webp" srcset="<?php echo get_stylesheet_directory_uri(); ?>/img/editorial-320.webp 320w, <?php echo get_stylesheet_directory_uri(); ?>/img/editorial.webp 700w" sizes="(max-width: 770px) calc(100vw - 112px), 160px" alt="" width="700" height="467" loading="lazy">
                <h3>Design<br>
                    editorial</h3>
                <p>Livros, revistas, catálogos e apresentações. Conteúdos visuais bem estruturados para encantar e informar.</p>
                <a href="<?php echo esc_url(home_url('/category/editorial/')); ?>">Conhecer <span class="material-icons-round">
                        arrow_outward
                    </span></a>
            </div>
            <div class="servico servico-design-grafico">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/grafico-320.webp" srcset="<?php echo get_stylesheet_directory_uri(); ?>/img/grafico-320.webp 320w, <?php echo get_stylesheet_directory_uri(); ?>/img/grafico.webp 700w" sizes="(max-width: 770px) calc(100vw - 112px), 160px" alt="" width="700" height="467" loading="lazy">
                <h3>Design<br>
                    gráfico</h3>
                <p>Materiais visuais personalizados para impressão ou digital, trazendo identidade e profissionalismo à marca.</p>
                <a href="<?php echo esc_url(home_url('/category/design-grafico/')); ?>">Conhecer <span class="material-icons-round">
                        arrow_outward
                    </span></a>
            </div>
            <div class="servico servico-sites">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/webdesign-320.webp" srcset="<?php echo get_stylesheet_directory_uri(); ?>/img/webdesign-320.webp 320w, <?php echo get_stylesheet_directory_uri(); ?>/img/webdesign.webp 700w" sizes="(max-width: 770px) calc(100vw - 112px), 160px" alt="" width="700" height="467" loading="lazy">
                <h3>Webdesign &<br>
                    Programação</h3>
                <p>Sites e plataformas funcionais, responsivas e impactantes para sua presença digital.</p>
                <a href="<?php echo esc_url(home_url('/category/sites/')); ?>">Conhecer <span class="material-icons-round">
                        arrow_outward
                    </span></a>
            </div>
            <div class="servico servico-social-media">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/socialmedia-320.webp" srcset="<?php echo get_stylesheet_directory_uri(); ?>/img/socialmedia-320.webp 320w, <?php echo get_stylesheet_directory_uri(); ?>/img/socialmedia.webp 700w" sizes="(max-width: 770px) calc(100vw - 112px), 160px" alt="" width="700" height="467" loading="lazy">
                <h3>Design de<br>
                    Social media</h3>
                <p>Criatividade estratégica para suas redes. Posts, templates e identidade digital para engajar seu público.</p>
                <a href="<?php echo esc_url(home_url('/category/social-media/')); ?>">Conhecer <span class="material-icons-round">
                        arrow_outward
                    </span></a>
            </div>
        </div>
    </div>
</section>

<section class="posts" id="projetos">
    <?php
    // Só os posts marcados com a categoria "Exibir na home", sem limite.
    $args = array(
        'numberposts'   => -1,
        'category_name' => 'exibir-na-home',
        'orderby'       => 'date',
        'order'         => 'DESC',
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
                        <!-- O título (.preview) só aparece no hover, com display: none, e
                             leitores de tela ignoram texto escondido: o aria-label garante o nome. -->
                        <a href="<?php echo esc_url(get_permalink($p->ID)); ?>" aria-label="<?php echo esc_attr(get_the_title($p->ID)); ?>">
                            <?php
                            // Grade de 3 colunas (2 no tablet, 1 no celular): "medium_large"
                            // (768px) + sizes evita baixar a imagem original inteira.
                            $thumb_attr = array('sizes' => '(max-width: 770px) 100vw, (max-width: 900px) 50vw, 408px', 'loading' => 'lazy');
                            echo has_post_thumbnail($p->ID)
                                ? get_the_post_thumbnail($p->ID, 'medium_large', $thumb_attr)
                                : '<img src="' . get_stylesheet_directory_uri() . '/img/thumbnail.jpg" alt="" width="1024" height="701" loading="lazy">'; ?>
                            <div class="preview">
                                <!-- <p class="date">
                                    <span class="material-icons-round">today</span>
                                    <?php echo get_the_time('d/m/Y', $p->ID); ?>
                                </p>
                                <p class="date">
                                    <span class="material-icons-round">person</span>
                                    <?php echo get_the_author_meta('display_name', $p->post_author); ?>
                                </p> -->
                                <h3><?php echo esc_html(get_the_title($p->ID)); ?></h3>
                                <!-- <p><?php echo $p->post_excerpt; ?></p> -->
                            </div>
                        </a>
                    </div>
            <?php }
                wp_reset_postdata();
            } ?>

            <div class="post seuprojeto">
                <a class="secundary" href="<?php echo esc_url(vergedigital_whatsapp('Olá, Vergê! Vi os projetos de vocês no site e quero tirar o meu do papel. Podemos conversar?')); ?>">
                    <span class="material-icons-round">add</span>
                    <h3>Seu projeto</h3>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="newsletter" id="contato">
    <div class="container">
        <div class="text">
            <h3>
                Sua marca merece <br>
                um design à altura.<br>
                Fale com a gente!
            </h3>
            <ul>
                <li><a href="<?php echo esc_url(vergedigital_whatsapp('Olá, Vergê! Vim pela seção de contato do site e gostaria de falar com vocês.')); ?>" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/whats.svg" alt="" width="62" height="61"></a></li>
                <li><a href="https://www.instagram.com/vergedigital_/" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/insta.svg" alt="" width="62" height="61"></a></li>
                <li><a href="https://www.behance.net/vergedigital_" target="_blank" rel="noopener noreferrer" aria-label="Behance"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/behance.svg" alt="" width="62" height="61"></a></li>
            </ul>
        </div>
        <div class="glass">
            <h3>CONTATO</h3>

            <!--
                Ao enviar, o script abaixo monta a mensagem com os campos e abre
                o WhatsApp do estúdio (não há envio de e-mail no servidor).
                toolname/tooldescription/toolparamdescription: WebMCP declarativo,
                para agentes de IA usarem o formulário como uma ferramenta
                (auditoria "Navegação agêntica" do Lighthouse).
            -->
            <form id="contato-form" data-whatsapp="<?php echo esc_url(vergedigital_whatsapp()); ?>"
                toolname="solicitar_orcamento"
                tooldescription="Pede um orçamento à Vergê Digital, estúdio de design e programação. Monta uma mensagem com os dados informados e devolve o link do WhatsApp do estúdio com a mensagem pronta para envio.">
                <fieldset class="tags">
                    <legend>Eu busco por...</legend>

                    <label class="tag">
                        <input type="radio" name="interesse" value="Identidade visual" checked toolparamdescription="Serviço de interesse: Identidade visual, Webdesign & Programação, Social media, Design gráfico ou Design editorial.">
                        <span>Identidade visual</span>
                    </label>
                    <label class="tag">
                        <input type="radio" name="interesse" value="Webdesign & Programação">
                        <span>Webdesign & Programação</span>
                    </label>
                    <label class="tag">
                        <input type="radio" name="interesse" value="Social media">
                        <span>Social media</span>
                    </label>
                    <label class="tag">
                        <input type="radio" name="interesse" value="Design gráfico">
                        <span>Design gráfico</span>
                    </label>
                    <label class="tag">
                        <input type="radio" name="interesse" value="Design editorial">
                        <span>Design editorial</span>
                    </label>
                </fieldset>

                <div class="field">
                    <label class="visually-hidden" for="contato-nome">Seu nome</label>
                    <input type="text" id="contato-nome" name="nome" placeholder="Seu nome" autocomplete="name" required>
                </div>
                <div class="field">
                    <label class="visually-hidden" for="contato-email">Seu e-mail</label>
                    <input type="email" id="contato-email" name="email" placeholder="Seu e-mail" autocomplete="email" required>
                </div>
                <div class="field">
                    <label class="visually-hidden" for="contato-telefone">Seu telefone</label>
                    <input type="tel" id="contato-telefone" name="telefone" placeholder="+00 00 0000-0000" autocomplete="tel" required toolparamdescription="Telefone com DDI e DDD, por exemplo +55 11 91234-5678.">
                </div>
                <div class="field">
                    <label class="visually-hidden" for="contato-mensagem">Sua mensagem</label>
                    <textarea id="contato-mensagem" name="mensagem" rows="3" placeholder="Nos conte sobre seu projeto" required toolparamdescription="Descrição do projeto: o que precisa, prazo e qualquer referência."></textarea>
                </div>

                <fieldset class="checkbox-group">
                    <legend>Prefiro receber minha proposta por:</legend>
                    <label class="tag">
                        <input type="checkbox" name="contato_preferido[]" value="WhatsApp" toolparamdescription="Canais preferidos para receber a proposta: WhatsApp e/ou E-mail.">
                        <span>WhatsApp</span>
                    </label>
                    <label class="tag">
                        <input type="checkbox" name="contato_preferido[]" value="E-mail">
                        <span>E-mail</span>
                    </label>
                </fieldset>

                <p class="form-privacy">Ao enviar, abrimos o WhatsApp com sua mensagem pronta. Seus dados são usados só para retornarmos seu contato — nada de spam.</p>

                <button class="submit-btn" type="submit">
                    Enviar
                    <span class="material-icons-round">arrow_outward</span>
                </button>
            </form>
            <script>
                (function () {
                    var form = document.getElementById('contato-form');
                    if (!form) return;

                    // Monta a mensagem a partir dos campos e devolve o link do WhatsApp.
                    function montarLink() {
                        var dados = new FormData(form);
                        var canais = dados.getAll('contato_preferido[]');
                        var linhas = [
                            'Olá, Vergê! Vim pelo formulário de contato do site.',
                            '',
                            'Interesse: ' + (dados.get('interesse') || '—'),
                            'Nome: ' + (dados.get('nome') || '—'),
                            'E-mail: ' + (dados.get('email') || '—'),
                            'Telefone: ' + (dados.get('telefone') || '—'),
                            'Prefiro receber a proposta por: ' + (canais.length ? canais.join(' e ') : '—'),
                            '',
                            dados.get('mensagem') || ''
                        ];
                        return form.dataset.whatsapp + '&text=' + encodeURIComponent(linhas.join('\n'));
                    }

                    form.addEventListener('submit', function (event) {
                        event.preventDefault();
                        var link = montarLink();

                        // Chamado por um agente de IA (WebMCP): devolve o link em vez de abrir.
                        if (event.agentInvoked && typeof event.respondWith === 'function') {
                            event.respondWith(Promise.resolve(
                                'Mensagem pronta. Para concluir o pedido de orçamento, abra este link do WhatsApp da Vergê Digital e envie a mensagem: ' + link
                            ));
                            return;
                        }

                        window.open(link, '_blank', 'noopener');
                    });
                })();
            </script>
        </div>
    </div>
</section>

<?php get_footer(); ?>