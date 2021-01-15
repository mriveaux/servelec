<?php
/**
 * Template Name: Blank Template(For Page Builders)
 *
 * @package Total
 */
get_header();
?>

<div class="ht-container">
    <div class="content-area">
        <main id="main" class="site-main">

            <?php while (have_posts()) : the_post(); ?>

                <?php the_content(); ?>

            <?php endwhile; // End of the loop. ?>

        </main><!-- #main -->
    </div><!-- #primary -->
</div>

<?php
get_footer();
