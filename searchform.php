<form method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>">
    <input type="text" name="s" id="s" placeholder="Buscar por..." />
    <input type="hidden" value="post" name="post_type" id="post_type" />
    <button type="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e('Search'); ?>" class="material-icons-round">search</button>
</form>