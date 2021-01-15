<?php
/**
 * The template for displaying all single posts.
 *
 * @package Total
 */
get_header();
$total_hide_title = get_post_meta($post->ID, 'total_hide_title', true);

if (!$total_hide_title) {
    ?>
    <header class="ht-main-header">
        <div class="ht-container">
            <?php the_title('<h1 class="ht-main-title">', '</h1>'); ?>
            <?php do_action('total_breadcrumbs'); ?>
        </div>
    </header><!-- .entry-header -->
<?php } ?>

<div class="ht-container">
    <div id="primary" class="content-area">
        <main id="main" class="site-main">

            <?php while (have_posts()) : the_post(); ?>

                <?php get_template_part('template-parts/content', 'single'); ?>

                <?php
                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>

            <?php endwhile; // End of the loop. ?>

        </main><!-- #main -->
    </div><!-- #primary -->

    <?php get_sidebar(); ?>

</div>

<?php
get_footer();
