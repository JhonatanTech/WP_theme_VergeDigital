<?php
// Set the Current Author Variable $curauth
$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
?>

<?php get_header(); ?>

<section class="author container">
    <div class="author-photo">
        <?php echo get_avatar($curauth->user_email, '90 '); ?>
    </div>

    <h1><span>Autor:</span> <?php echo $curauth->nickname; ?></h1>
    <p><strong>Website: </strong><a href="<?php echo $curauth->user_url; ?>"><?php echo $curauth->user_url; ?></a></p>
    <p><strong>Bio: </strong> <?php echo $curauth->user_description; ?></p>
</section>


<div class="category">
    <h2>Posts:</h2>
    <div class="container">
        <?php if (have_posts()) :
            while (have_posts()) : the_post(); ?>
                <div class="post">
                    <?php echo get_the_post_thumbnail($p->ID) ? get_the_post_thumbnail($p->ID) : '<img src="' . get_stylesheet_directory_uri() . '/img/bg-about.jpg" alt="Caneca">'; ?>
                    <div class="preview">
                        <p class="date">
                            <span class="material-icons-round">today</span>
                            <?php echo get_the_time('d/m/Y', $p->ID); ?>
                        </p>
                        <p class="date">
                            <span class="material-icons-round">person</span>
                            <a href="<?php echo esc_url(get_author_posts_url(get_post()->post_author)); ?>"><?php echo get_the_author_meta('display_name', $p->post_author); ?></a>
                        </p>
                        <h3><?php echo the_title(); ?></h3>
                        <p><?php echo get_the_excerpt(); ?></p>
                        <a href="<?php echo get_permalink($p->ID); ?>">Quero ler este post!<span class="material-icons-round">arrow_forward</span></a>
                    </div>
                </div>
            <?php endwhile;
        endif; ?>
    </div>
</div>

<div class="container pagination">
    <?php wordpress_pagination(); ?>
</div>

<?php get_footer(); ?>