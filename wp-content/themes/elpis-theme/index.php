<?php
// index.php
get_header(); ?>
<main class="container" style="padding: 4rem 0;">
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
            the_content();
        endwhile;
    endif;
    ?>
</main>
<?php get_footer(); ?>
