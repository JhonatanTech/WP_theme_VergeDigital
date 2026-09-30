<?php
//Template Name: Briefing
// Página não indexável (ver inc/briefing.php). As perguntas vêm de
// vergedigital_briefing_sections().
?>
<?php get_header(); ?>

<?php $status = isset($_GET['briefing']) ? sanitize_key($_GET['briefing']) : ''; ?>

<div class="container briefing" id="briefing">
    <div class="briefing__intro">
        <span class="briefing__tag">Briefing</span>
        <h1>Webdesign &amp; programação</h1>
        <p>Olá! Agradecemos pelo contato e pelo seu interesse em realizar um site conosco. Para isso, gostaríamos de saber um pouco mais sobre sua ideia! Respondendo as questões abaixo teremos as informações básicas de que necessitamos para elaborar uma primeira versão do seu site.</p>
        <p>Caso tenha alguma dúvida, fale com nosso programador pelo número <a href="<?php echo esc_url(vergedigital_whatsapp('Olá! Estou preenchendo o briefing no site da Vergê e fiquei com uma dúvida.', '5511948410992')); ?>" target="_blank" rel="noopener noreferrer">+55 11 94841-0992</a>. Agradecemos desde já!</p>
    </div>

    <?php if ($status === 'enviado') : ?>
        <div class="briefing__aviso briefing__aviso--ok" role="status">
            <span class="material-icons-round">check_circle</span>
            <div>
                <strong>Briefing enviado!</strong>
                <p>Recebemos suas respostas e entraremos em contato em breve.</p>
            </div>
        </div>
    <?php else : ?>

        <?php if ($status === 'erro') : ?>
            <div class="briefing__aviso briefing__aviso--erro" role="alert">
                <span class="material-icons-round">error</span>
                <div>
                    <strong>Não conseguimos enviar.</strong>
                    <p>Confira os campos obrigatórios e tente de novo, ou fale com a gente pelo WhatsApp.</p>
                </div>
            </div>
        <?php endif; ?>

        <!-- toolname/tooldescription: WebMCP declarativo — agentes de IA podem
             preencher o briefing como uma ferramenta, usando os rótulos dos campos. -->
        <form class="briefing__form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>"
            toolname="enviar_briefing_site"
            tooldescription="Envia à Vergê Digital o briefing de um novo site: dados de contato, objetivos, público, páginas, conteúdo e referências de design. Os campos obrigatórios estão marcados como required.">
            <input type="hidden" name="action" value="vergedigital_briefing">
            <input type="hidden" name="redirect" value="<?php echo esc_url(get_permalink()); ?>">
            <?php wp_nonce_field('vergedigital_briefing', 'briefing_nonce', false); ?>

            <div class="briefing__hp" aria-hidden="true">
                <label for="briefing-site-url">Não preencha</label>
                <input type="text" id="briefing-site-url" name="site_url" tabindex="-1" autocomplete="off" toolparamdescription="Campo anti-spam: deixe sempre vazio.">
            </div>

            <p class="briefing__obrigatorio"><span>*</span> Indica uma pergunta obrigatória</p>

            <?php foreach (vergedigital_briefing_sections() as $i => $secao) : ?>
                <section class="briefing__secao">
                    <h2><span><?php echo str_pad($i + 1, 2, '0', STR_PAD_LEFT); ?></span> <?php echo esc_html($secao['titulo']); ?></h2>

                    <?php foreach ($secao['campos'] as $chave => $campo) :
                        $id = 'briefing-' . $chave;
                        $req = !empty($campo['required']);
                        $marca = $req ? ' <span class="req" aria-hidden="true">*</span>' : '';
                    ?>

                        <?php if ($campo['type'] === 'checkbox' || $campo['type'] === 'radio') :
                            $name = $campo['type'] === 'checkbox' ? $chave . '[]' : $chave;
                        ?>
                            <fieldset class="briefing__campo" <?php echo $req && $campo['type'] === 'checkbox' ? 'data-grupo-obrigatorio' : ''; ?>>
                                <legend><?php echo esc_html($campo['label']) . $marca; ?></legend>
                                <div class="briefing__opcoes">
                                    <?php foreach ($campo['options'] as $opcao) : ?>
                                        <label class="tag">
                                            <input type="<?php echo $campo['type']; ?>" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr($opcao); ?>" <?php echo $req && $campo['type'] === 'radio' ? 'required' : ''; ?>>
                                            <span><?php echo esc_html($opcao); ?></span>
                                        </label>
                                    <?php endforeach; ?>

                                    <?php if (!empty($campo['outro']) && $campo['type'] === 'radio') : ?>
                                        <label class="tag">
                                            <input type="radio" name="<?php echo esc_attr($name); ?>" value="__outro" data-outro="<?php echo esc_attr($id); ?>-outro" <?php echo $req ? 'required' : ''; ?>>
                                            <span><?php echo esc_html(rtrim(isset($campo['outro_label']) ? $campo['outro_label'] : 'Outro', ':')); ?></span>
                                        </label>
                                    <?php endif; ?>
                                </div>

                                <?php if (!empty($campo['outro'])) : ?>
                                    <label class="visually-hidden" for="<?php echo esc_attr($id); ?>-outro">Outro</label>
                                    <input class="briefing__outro" type="text" id="<?php echo esc_attr($id); ?>-outro" name="<?php echo esc_attr($chave); ?>_outro" placeholder="<?php echo esc_attr(isset($campo['outro_label']) ? $campo['outro_label'] . ' qual?' : 'Outro:'); ?>">
                                <?php endif; ?>
                            </fieldset>

                        <?php else : ?>
                            <div class="briefing__campo">
                                <label for="<?php echo esc_attr($id); ?>"><?php echo esc_html($campo['label']) . $marca; ?></label>
                                <?php if ($campo['type'] === 'textarea') : ?>
                                    <textarea id="<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($chave); ?>" rows="2" placeholder="Sua resposta" <?php echo $req ? 'required' : ''; ?>></textarea>
                                <?php else : ?>
                                    <input type="<?php echo $campo['type']; ?>" id="<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($chave); ?>" placeholder="Sua resposta" <?php echo !empty($campo['autocomplete']) ? 'autocomplete="' . esc_attr($campo['autocomplete']) . '"' : ''; ?> <?php echo $req ? 'required' : ''; ?>>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                    <?php endforeach; ?>
                </section>
            <?php endforeach; ?>

            <div class="briefing__enviar">
                <label class="briefing__switch">
                    <input type="checkbox" name="copia" value="1">
                    <span></span>
                    Enviar uma cópia das respostas para o meu e-mail
                </label>
                <button type="submit">Enviar briefing <span class="material-icons-round">arrow_outward</span></button>
            </div>
        </form>

        <script>
            (function () {
                var form = document.querySelector('.briefing__form');
                if (!form) return;

                // Grupos de checkbox obrigatórios: o HTML não tem "marque ao
                // menos um", então a validade fica no primeiro checkbox do grupo
                // (o "Outro:" preenchido também conta).
                var grupos = form.querySelectorAll('[data-grupo-obrigatorio]');

                function validaGrupo(grupo) {
                    var boxes = grupo.querySelectorAll('input[type="checkbox"]');
                    var outro = grupo.querySelector('.briefing__outro');
                    var ok = Array.prototype.some.call(boxes, function (b) { return b.checked; }) || (outro && outro.value.trim() !== '');
                    boxes[0].setCustomValidity(ok ? '' : 'Selecione ao menos uma opção.');
                }

                Array.prototype.forEach.call(grupos, function (grupo) {
                    validaGrupo(grupo);
                    grupo.addEventListener('input', function () { validaGrupo(grupo); });
                    grupo.addEventListener('change', function () { validaGrupo(grupo); });
                });

                // "Outro" em radio: digitar no campo marca a opção, e marcar a
                // opção torna o texto obrigatório.
                Array.prototype.forEach.call(form.querySelectorAll('input[data-outro]'), function (radio) {
                    var texto = document.getElementById(radio.getAttribute('data-outro'));
                    var inputs = form.querySelectorAll('input[name="' + radio.name + '"]');

                    function sync() { texto.required = radio.checked; }

                    texto.addEventListener('input', function () {
                        if (texto.value.trim() !== '') radio.checked = true;
                        sync();
                    });
                    Array.prototype.forEach.call(inputs, function (i) { i.addEventListener('change', sync); });
                });
            })();
        </script>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
