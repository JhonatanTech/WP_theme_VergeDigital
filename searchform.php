<form method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>" role="search"
    toolname="buscar_projetos"
    tooldescription="Busca nos projetos e posts do portfólio da Vergê Digital e abre a página de resultados.">
    <input type="text" name="s" id="s" placeholder="Buscar por..." aria-label="Buscar projetos"
        toolparamdescription="Termo de busca, por exemplo o nome de um cliente ou o tipo de projeto (identidade visual, site, livro)." />
    <input type="hidden" value="post" name="post_type" id="post_type" />
    <button type="submit" id="searchsubmit" class="material-icons-round" aria-label="Buscar">search</button>
</form>
