<?php
/**
 * The main template file.
 *
 * @package Total
 */
get_header();
?>

<?php if (is_home() && !is_front_page()) : ?>
    <header class="ht-main-header">
        <div class="ht-container">
            <h1 class="ht-main-title"><?php single_post_title(); ?></h1>
            <?php do_action('total_breadcrumbs'); ?>
        </div>
    </header><!-- .entry-header -->
<?php endif; ?>



<div class="ht-container">
    <div id="primary" class="content-area">
        <main id="main" class="site-main">

            <?php if (have_posts()) : ?>

                <?php /* Start the Loop */ ?>
                <?php while (have_posts()) : the_post(); ?>

                    <?php
                    /*
                     * Include the Post-Format-specific template for the content.
                     * If you want to override this in a child theme, then include a file
                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                     */
                    get_template_part('template-parts/content', 'summary');
                    ?>

                <?php endwhile; ?>

                <?php
                the_posts_pagination(
                        array(
                            'prev_text' => esc_html__('Prev', 'total'),
                            'next_text' => esc_html__('Next', 'total'),
                        )
                );
                ?>

            <?php else : ?>

                <?php get_template_part('template-parts/content', 'none'); ?>

            <?php endif; ?>

        </main><!-- #main -->
    </div><!-- #primary -->

    <?php get_sidebar(); ?>

</div>

<?php
get_footer();
