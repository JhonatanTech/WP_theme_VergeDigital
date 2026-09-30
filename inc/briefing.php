<?php
/**
 * Briefing de Webdesign & Programação.
 *
 * As perguntas vivem só aqui (vergedigital_briefing_sections) — o template
 * page-briefing.php monta o formulário a partir delas e o handler usa os
 * mesmos rótulos pra montar o e-mail, então pra adicionar/editar uma
 * pergunta basta mexer no array.
 *
 * A página não é indexável: meta robots + header X-Robots-Tag + fora do
 * sitemap nativo do WordPress.
 */

function vergedigital_briefing_sections()
{
    return array(
        array(
            'titulo' => 'Sobre você e o projeto',
            'campos' => array(
                'email' => array('label' => 'Seu e-mail', 'type' => 'email', 'required' => true, 'autocomplete' => 'email'),
                'nome' => array('label' => 'Qual seu nome?', 'type' => 'text', 'required' => true, 'autocomplete' => 'name'),
                'projeto' => array('label' => 'Qual o nome do projeto?', 'type' => 'text', 'required' => true),
                'area' => array('label' => 'Qual a área de atuação do seu negócio/empresa/produto?', 'type' => 'text', 'required' => true),
            ),
        ),
        array(
            'titulo' => 'Objetivos e público',
            'campos' => array(
                'mensagem' => array('label' => 'Qual a mensagem mais importante que o site deve passar para o usuário?', 'type' => 'textarea', 'required' => true),
                'dados' => array('label' => 'É necessário coletar dados dos visitantes? O que é preciso saber? Por quê?', 'type' => 'textarea'),
                'objetivos' => array(
                    'label' => 'Quais os objetivos do seu website?',
                    'type' => 'checkbox',
                    'required' => true,
                    'options' => array('Apresentação de produtos/serviços', 'Gerar leads e potenciais clientes', 'Serviço de streaming', 'Vendas/aumento de vendas', 'Plataforma de cursos', 'Download de arquivos'),
                ),
                'tipo' => array(
                    'label' => 'Qual o tipo de site?',
                    'type' => 'radio',
                    'required' => true,
                    'outro' => true,
                    'options' => array('Landing page', 'Institucional', 'Blog', 'E-commerce', 'Portal de notícias', 'Portfólio'),
                ),
                'publico' => array('label' => 'Qual seu público-alvo (ou potencial)?', 'type' => 'textarea', 'required' => true),
                'concorrentes' => array('label' => 'Quais seus principais concorrentes?', 'type' => 'textarea', 'required' => true),
                'oferta' => array('label' => 'O que o site irá oferecer ao seu público?', 'type' => 'textarea'),
                'acao' => array('label' => 'O que os visitantes devem fazer no site?', 'type' => 'textarea'),
                'habilidade' => array('label' => 'Qual a habilidade e capacidade técnica dos seus usuários com a internet?', 'type' => 'textarea'),
            ),
        ),
        array(
            'titulo' => 'Conteúdo e estrutura',
            'campos' => array(
                'atualizacao' => array('label' => 'Que informação do site mudará (atualização)? Com que frequência e abrangência?', 'type' => 'textarea'),
                'redes' => array('label' => 'Integração com quais redes sociais?', 'type' => 'text'),
                'paginas' => array(
                    'label' => 'Quais páginas são esperadas no seu site além da homepage? (caso não seja uma LP)',
                    'type' => 'checkbox',
                    'required' => true,
                    'outro' => true,
                    'options' => array('Política de Privacidade/Termos de Uso', 'Quem Somos (Apresentação)', 'Contato', 'Produtos', 'Serviços', 'Blog (inserção de conteúdo)', 'Portfólio', 'Parceiros', 'Representantes', 'Clientes', 'Equipe', 'Galeria de Fotos e/ou Vídeos', 'Trabalhe Conosco', 'Calendário de Eventos', 'Inscrições Online', 'Enquete/Questionários', 'Download de Arquivos (gratuito)', 'Download de Arquivos (pago/e-commerce)', 'Doações Online'),
                ),
                'idiomas' => array('label' => 'Quais idiomas?', 'type' => 'text', 'required' => true),
                'conteudo' => array('label' => 'Como receberemos o conteúdo do seu site? Possui copy pronta ou deseja incluir a escrita estratégica?', 'type' => 'textarea', 'required' => true),
            ),
        ),
        array(
            'titulo' => 'Identidade e domínio',
            'campos' => array(
                'identidade' => array(
                    'label' => 'Sua marca/empresa/pessoa já possui identidade visual?',
                    'type' => 'radio',
                    'required' => true,
                    'options' => array('Sim, já possuo, e vou enviar para vocês', 'Já possuo, mas pretendo orçar um novo logotipo com vocês', 'Não possuo, e pretendo orçar com vocês juntamente com o projeto do site', 'Não possuo, mas já possuo um colaborador que irá enviar para vocês'),
                ),
                'referencias' => array('label' => 'O que é esperado quanto ao design do site? Possui referências? (favor inserir os links)', 'type' => 'textarea'),
                'dominio' => array(
                    'label' => 'Por fim, seu site já possui um domínio? Se sim, qual?',
                    'type' => 'radio',
                    'required' => true,
                    'outro' => true,
                    'outro_label' => 'Sim:',
                    'options' => array('Não'),
                ),
            ),
        ),
    );
}

function vergedigital_is_briefing()
{
    return is_page_template('page-briefing.php') || is_page('briefing');
}

/* ---------- Não indexável ---------- */

function vergedigital_briefing_robots($robots)
{
    if (vergedigital_is_briefing()) {
        $robots['noindex'] = true;
        $robots['nofollow'] = true;
        $robots['noarchive'] = true;
        unset($robots['max-image-preview']);
    }
    return $robots;
}
add_filter('wp_robots', 'vergedigital_briefing_robots', 99);

function vergedigital_briefing_headers()
{
    if (vergedigital_is_briefing() && !headers_sent()) {
        header('X-Robots-Tag: noindex, nofollow, noarchive', true);
    }
}
add_action('template_redirect', 'vergedigital_briefing_headers');

function vergedigital_briefing_sitemap_exclude($args, $post_type)
{
    if ($post_type !== 'page') {
        return $args;
    }

    $ids = get_posts(array(
        'post_type' => 'page',
        'fields' => 'ids',
        'posts_per_page' => -1,
        'meta_key' => '_wp_page_template',
        'meta_value' => 'page-briefing.php',
    ));
    $por_slug = get_page_by_path('briefing');
    if ($por_slug) {
        $ids[] = $por_slug->ID;
    }

    if ($ids) {
        $args['post__not_in'] = array_merge(isset($args['post__not_in']) ? $args['post__not_in'] : array(), $ids);
    }
    return $args;
}
add_filter('wp_sitemaps_posts_query_args', 'vergedigital_briefing_sitemap_exclude', 10, 2);

function vergedigital_briefing_body_class($classes)
{
    if (vergedigital_is_briefing()) {
        $classes[] = 'pagina-briefing';
    }
    return $classes;
}
add_filter('body_class', 'vergedigital_briefing_body_class');

/* ---------- Envio ---------- */

function vergedigital_briefing_valor($campo, $chave)
{
    $bruto = isset($_POST[$chave]) ? wp_unslash($_POST[$chave]) : '';
    $outro = isset($_POST[$chave . '_outro']) ? sanitize_text_field(wp_unslash($_POST[$chave . '_outro'])) : '';

    if ($campo['type'] === 'checkbox') {
        $valores = array_intersect(array_map('sanitize_text_field', (array) $bruto), $campo['options']);
        if (!empty($campo['outro']) && $outro !== '') {
            $valores[] = 'Outro: ' . $outro;
        }
        return implode(', ', $valores);
    }

    if ($campo['type'] === 'radio') {
        $valor = sanitize_text_field($bruto);
        if ($valor === '__outro') {
            return $outro !== '' ? (isset($campo['outro_label']) ? rtrim($campo['outro_label'], ':') : 'Outro') . ': ' . $outro : '';
        }
        return in_array($valor, $campo['options'], true) ? $valor : '';
    }

    if ($campo['type'] === 'email') {
        return sanitize_email($bruto);
    }

    return $campo['type'] === 'textarea' ? sanitize_textarea_field($bruto) : sanitize_text_field($bruto);
}

function vergedigital_briefing_handle()
{
    $voltar = isset($_POST['redirect']) ? esc_url_raw(wp_unslash($_POST['redirect'])) : '';
    $voltar = remove_query_arg('briefing', wp_validate_redirect($voltar, home_url('/')));

    if (!isset($_POST['briefing_nonce']) || !wp_verify_nonce(sanitize_key($_POST['briefing_nonce']), 'vergedigital_briefing')) {
        wp_safe_redirect(add_query_arg('briefing', 'erro', $voltar) . '#briefing');
        exit;
    }

    // Honeypot: campo invisível que só bot preenche.
    if (!empty($_POST['site_url'])) {
        wp_safe_redirect(add_query_arg('briefing', 'enviado', $voltar));
        exit;
    }

    $linhas = array();
    $faltando = false;

    foreach (vergedigital_briefing_sections() as $secao) {
        $linhas[] = "\n== " . strtoupper($secao['titulo']) . " ==\n";
        foreach ($secao['campos'] as $chave => $campo) {
            $valor = vergedigital_briefing_valor($campo, $chave);
            if (!empty($campo['required']) && $valor === '') {
                $faltando = true;
            }
            $linhas[] = $campo['label'] . "\n" . ($valor !== '' ? $valor : '—') . "\n";
        }
    }

    $email = sanitize_email(wp_unslash(isset($_POST['email']) ? $_POST['email'] : ''));
    if ($faltando || !is_email($email)) {
        wp_safe_redirect(add_query_arg('briefing', 'erro', $voltar) . '#briefing');
        exit;
    }

    $nome = sanitize_text_field(wp_unslash($_POST['nome']));
    $projeto = sanitize_text_field(wp_unslash($_POST['projeto']));
    $corpo = implode("\n", $linhas);

    $enviado = wp_mail(
        get_option('admin_email'),
        sprintf('Briefing Webdesign: %s (%s)', $projeto, $nome),
        $corpo,
        array('Reply-To: ' . $nome . ' <' . $email . '>')
    );

    if ($enviado && !empty($_POST['copia'])) {
        wp_mail(
            $email,
            'Cópia do seu briefing – Vergê Digital',
            "Olá, {$nome}! Recebemos seu briefing. Seguem suas respostas:\n" . $corpo
        );
    }

    wp_safe_redirect(add_query_arg('briefing', $enviado ? 'enviado' : 'erro', $voltar) . '#briefing');
    exit;
}
add_action('admin_post_nopriv_vergedigital_briefing', 'vergedigital_briefing_handle');
add_action('admin_post_vergedigital_briefing', 'vergedigital_briefing_handle');
