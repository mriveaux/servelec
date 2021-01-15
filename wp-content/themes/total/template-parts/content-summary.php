<?php
/**
 * Template part for displaying posts.
 *
 * @package Total
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('total-hentry'); ?>>
    <?php if ('post' == get_post_type()) : ?>
        <div class="entry-meta ht-post-info">
            <?php total_posted_on(); ?>
        </div><!-- .entry-meta -->
    <?php endif; ?>


    <div class="ht-post-wrapper">
        <?php if (has_post_thumbnail()): ?>
            <figure class="entry-figure">
                <?php
                $total_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'total-blog-header');
                ?>
                <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($total_image[0]); ?>" alt="<?php echo esc_attr(get_the_title()) ?>"></a>
            </figure>
        <?php endif; ?>

        <header class="entry-header">
            <?php the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>
        </header><!-- .entry-header -->

        <div class="entry-categories">
            <?php echo total_entry_category(); // WPCS: XSS OK.  ?>
        </div>

        <div class="entry-summary">
            <?php
            echo esc_html(wp_trim_words(get_the_content(), 130));
            ?>
        </div><!-- .entry-content -->

        <div class="entry-readmore">
            <a href="<?php the_permalink(); ?>"><?php esc_html_e('Read More', 'total'); ?></a>
        </div>
    </div>
</article><!-- #post-## -->
