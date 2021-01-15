<?php
/**
 * The template for displaying content on the search results page.
 *
 * @package ThinkUpThemes
 */
?>

					<div class="blog-grid">

					<article id="post-<?php the_ID(); ?>" <?php post_class('blog-article'); ?>>	

						<div class="entry-content">
							<?php alante_thinkup_input_blogtitle(); ?>

							<div class="entry-meta">
								<?php alante_thinkup_input_blogauthor(); ?>
								<?php alante_thinkup_input_blogcategory2(); ?>
								<?php alante_thinkup_input_blogtag2(); ?>
							</div>

							<?php the_excerpt(); ?>
						</div>

						<footer class="entry-footer">

							<div class="entry-meta">
								<?php alante_thinkup_input_blogdate(); ?>
								<?php alante_thinkup_input_blogcomment(); ?>
							</div>

						</footer>

					</article><!-- #post-<?php get_the_ID(); ?> -->

					</div>