<?php
/**
 * Blog functions.
 *
 * @package ThinkUpThemes
 */

/* ----------------------------------------------------------------------------------
	BLOG STYLE
---------------------------------------------------------------------------------- */

function alante_thinkup_input_stylelayout() {
	echo ' column-1';
}


/* ----------------------------------------------------------------------------------
	BLOG STYLE - CLASSES FOR STYLE 1
---------------------------------------------------------------------------------- */

function alante_thinkup_input_stylelayout_class1() {
global $post;

// Get theme options values.
$thinkup_blog_postswitch   = alante_thinkup_var ( 'thinkup_blog_postswitch' );
$thinkup_blog_style1layout = alante_thinkup_var ( 'thinkup_blog_style1layout' );

	if ( has_post_thumbnail( $post->ID ) and $thinkup_blog_postswitch !== 'option2' ) {
		if ( $thinkup_blog_style1layout !== 'option2' ) {
			echo '';
		}
	}
}

function alante_thinkup_input_stylelayout_class2() {
global $post;

// Get theme options values.
$thinkup_blog_postswitch   = alante_thinkup_var ( 'thinkup_blog_postswitch' );
$thinkup_blog_style1layout = alante_thinkup_var ( 'thinkup_blog_style1layout' );

	if ( has_post_thumbnail( $post->ID ) and $thinkup_blog_postswitch !== 'option2' ) {
		if ( $thinkup_blog_style1layout !== 'option2' ) {
			echo '';
		}
	}
}


/* ----------------------------------------------------------------------------------
	HIDE POST TITLE
---------------------------------------------------------------------------------- */

function alante_thinkup_input_blogtitle() {

	echo	'<h2 class="blog-title">',
			'<a href="' . esc_url( get_permalink() ) . '" title="' . esc_attr( sprintf( __( 'Permalink to %s', 'alante' ), the_title_attribute( 'echo=0' ) ) ) . '">' . get_the_title() . '</a>',
			'</h2>';
}


/* ----------------------------------------------------------------------------------
	BLOG CONTENT
---------------------------------------------------------------------------------- */

/* Input post thumbnail / featured media*/
function alante_thinkup_input_blogimage() {
global $post;

	 $post_id       = NULL;
	 $post_img      = NULL;
	 $post_img_full = NULL;

	if ( has_post_thumbnail() ) {

	 $post_id       = get_post_thumbnail_id( $post->ID );
	 $post_img_full = wp_get_attachment_image_src($post_id, 'full', true);

		echo '<div class="blog-thumb">',
			 '<a href="' . esc_url( get_permalink( $post->ID ) ) . '">' . get_the_post_thumbnail( $post->ID, 'alante-thinkup-column1-1/3' ) . '</a>',
			 '<div class="image-overlay">',
				'<div class="image-overlay-inner">',
				'<div class="hover-icons">',
				'<a class="hover-zoom prettyPhoto" href="' . esc_url( $post_img_full[0] ) . '"><i></i></a>',
				'<a class="hover-link" href="' . esc_url( get_permalink( $post->ID ) ) . '"><i></i></a>',
				'</div>',
			 '</div>',
		     '</div>';
	}
}

/* Input post excerpt / content to blog page */
function alante_thinkup_input_blogtext() {
global $post;

// Get theme options values.
$thinkup_blog_postswitch = alante_thinkup_var ( 'thinkup_blog_postswitch' );

	// Output full content - EDD plugin compatibility
	if( function_exists( 'EDD' ) and is_post_type_archive( 'download' ) ) {
		the_content();
		return;
	}

	// Output post content
	if ( is_search() ) {
		the_excerpt();
	} else if ( ! is_search() ) {
		if ( ( empty( $thinkup_blog_postswitch ) or $thinkup_blog_postswitch == 'option1' ) ) {
			if( ! is_numeric( strpos( $post->post_content, '<!--more-->' ) ) ) {
				the_excerpt();
			} else {
				the_content();
				wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'alante' ), 'after'  => '</div>', ) );
			}
		} else if ( $thinkup_blog_postswitch == 'option2' ) {
			the_content();
			wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'alante' ), 'after'  => '</div>', ) );
		}
	}
}


/* ----------------------------------------------------------------------------------
	BLOG META CONTENT & POST META CONTENT
---------------------------------------------------------------------------------- */

// Input sticky post
function alante_thinkup_input_sticky() {
	printf( '<span class="sticky"><i class="fa fa-thumb-tack"></i><a href="%1$s" title="%2$s">' . __( 'Sticky', 'alante' ) . '</a></span>',
		esc_url( get_permalink() ),
		esc_attr( get_the_title() )
	);
}

/* Input blog date */
function alante_thinkup_input_blogdate() {
	printf( '<span class="date"><i class="fa fa-calendar-o"></i><a href="%1$s" title="%2$s"><time datetime="%3$s">%4$s</time></a></span>',
		esc_url( get_permalink() ),
		esc_attr( get_the_title() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);
}

/* Input blog comments */
function alante_thinkup_input_blogcomment() {

	if ( '0' != get_comments_number() ) {
		echo	'<span class="comment">';
			if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) {;
				comments_popup_link( __( '0 comments', 'alante' ), __( '1 comment', 'alante' ), __( '% comments', 'alante' ) );
			};
		echo	'</span>';
	}
}

/* Input blog categories - Style 1 */
function alante_thinkup_input_blogcategory1() {
$categories_list = get_the_category_list( __( ', ', 'alante' ) );

	if ( $categories_list && alante_thinkup_input_categorizedblog() ) {
		echo	'<span class="category">';
		printf( __( 'Category: %1$s', 'alante' ), $categories_list );
		echo	'</span>';
	};
}

/* Input blog categories - Style 2 */
function alante_thinkup_input_blogcategory2() {
$categories_list = get_the_category_list( __( ', ', 'alante' ) );

	if ( $categories_list && alante_thinkup_input_categorizedblog() ) {
		echo	'<span class="category">';
		printf( '%1$s', $categories_list );
		echo	'</span>';
	};
}


/* Input blog tags - Style 1 */
function alante_thinkup_input_blogtag1() {
$tags_list = get_the_tag_list( '', __( ', ', 'alante' ) );

	if ( $tags_list ) {
		echo	'<span class="tags">';
		printf( __( 'Tags: %1$s', 'alante' ), $tags_list );
		echo	'</span>';
	};
}

/* Input blog tags - Style 2 */
function alante_thinkup_input_blogtag2() {
$tags_list = get_the_tag_list( '', __( ', ', 'alante' ) );

	if ( $tags_list ) {
		echo	'<span class="tags">';
		printf( '%1$s', $tags_list );
		echo	'</span>';
	};
}

/* Input blog author */
function alante_thinkup_input_blogauthor() {
	printf( '<span class="author"> ' . __( 'By', 'alante' ) . ' <a href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'alante' ), get_the_author() ) ),
		get_the_author()
	);
}

//----------------------------------------------------------------------------------
//	CUSTOM READ MORE BUTTON.
//----------------------------------------------------------------------------------

/* Input 'Read more' link */
function alante_thinkup_input_readmore( $link ) {
global $post;

	// Make no changes if in admin area
	if ( is_admin() ) {
		return $link;
	}

	$link = '&#8230;<p class="more-link"><a href="' . esc_url( get_permalink($post->ID) ) . '"><span>' . esc_html__( 'Read More', 'alante') . '</span><i>&#43;</i></a></p>';

	return $link;
}
add_filter( 'excerpt_more', 'alante_thinkup_input_readmore' );
add_filter( 'the_content_more_link', 'alante_thinkup_input_readmore' );


/* ----------------------------------------------------------------------------------
	INPUT BLOG META CONTENT
---------------------------------------------------------------------------------- */

// Add format-media class to post article for featured image, gallery and video
function alante_thinkup_input_blogmediaclass($classes) {
global $post;

// Get theme options values.
$thinkup_blog_postswitch = alante_thinkup_var ( 'thinkup_blog_postswitch' );

	$featured_id = get_post_thumbnail_id( $post->ID );

	// Determine featured media to input
	if ( alante_thinkup_check_isblog() ) {
		if ( empty( $featured_id ) or $thinkup_blog_postswitch == 'option2' ) {
			$classes[] = 'format-nomedia';	
		} else if( has_post_thumbnail() ) {
			$classes[] = 'format-media';
		}
	}
	return $classes;
}
add_action( 'post_class', 'alante_thinkup_input_blogmediaclass');

/* Meta content (author, category, tag) */
function alante_thinkup_input_blogmeta_1() {

	echo '<div class="entry-meta">';
		if ( is_sticky() && is_home() && ! is_paged() ) { alante_thinkup_input_sticky(); }

		alante_thinkup_input_blogauthor();
		alante_thinkup_input_blogcategory2();
		alante_thinkup_input_blogtag2();
	echo '</div>';
}

/* Meta content (date, comment) */
function alante_thinkup_input_blogmeta_2() {

	echo '<div class="entry-meta">';
		alante_thinkup_input_blogdate();
		alante_thinkup_input_blogcomment();
	echo '</div>';
}


/* ----------------------------------------------------------------------------------
	INPUT POST META CONTENT
---------------------------------------------------------------------------------- */

function thinkup_input_postmedia() {
global $post;

	// Set output variable to avoid php errors
	$output = NULL;

	if ( get_post_format() == 'image' ) {

		$output .= '<div class="post-thumb">' . get_the_post_thumbnail( $post->ID, 'column1-1/4' ) . '</div>';

	}

	// Output featured items if set
	if ( ! empty( $output ) ) {
		echo $output;
	}
}

// Add format-media class to post article for featured image, gallery and video
function thinkup_input_postmediaclass($classes) {
global $post;
global $wp_embed;

	if ( is_singular( 'post' ) ) {
		if ( get_post_format() == 'image' or get_post_format() == 'gallery' or get_post_format() == 'video' ) {
			if( has_post_thumbnail() ) {
				$classes[] = 'format-media';
			}
		} else {
			$classes[] = 'format-nomedia';			
		}
	}
	return $classes;
}
add_action( 'post_class', 'thinkup_input_postmediaclass');

function alante_thinkup_input_postmeta() {

	echo '<header class="entry-header entry-meta">';
		alante_thinkup_input_blogauthor();
		alante_thinkup_input_blogdate();
		alante_thinkup_input_blogcomment();
		alante_thinkup_input_blogcategory1();
		alante_thinkup_input_blogtag1();
	echo '</header><!-- .entry-header -->';
}


/* ----------------------------------------------------------------------------------
	SHOW AUTHOR BIO
---------------------------------------------------------------------------------- */

/* HTML for Author Bio */
function alante_thinkup_input_postauthorbiocode() {

	echo	'<div id="author-bio">',
			'<div id="author-image" class="one_sixth">',
			'<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '"/>' . get_avatar( get_the_author_meta( 'email' ), '90' ) . '</a>',
			'</div>',
			'<div id="author-text" class="five_sixth last">',
			'<h3>' . __( 'About the Author', 'alante' ) . '</h3>',
			wpautop( get_the_author_meta( 'description' ) ),
			'</div>',
			'</div>';
}

/* Output Author Bio */
function alante_thinkup_input_postauthorbio() {

// Get theme options values.
$thinkup_post_authorbio = alante_thinkup_var ( 'thinkup_post_authorbio' );

	if ( $thinkup_post_authorbio == '1' ) {
		alante_thinkup_input_postauthorbiocode();
	}
}


/* ----------------------------------------------------------------------------------
	TEMPLATE FOR COMMENTS AND PINGBACKS (PREVIOUSLY IN TEMPLATE-TAGS).
---------------------------------------------------------------------------------- */

/* Display comments at bottom of post, page and project pages. */
function alante_thinkup_input_allowcomments() {
	if ( comments_open() || '0' != get_comments_number() )
		comments_template( '/comments.php', true );
}


/* ----------------------------------------------------------------------------------
	TEMPLATE FOR COMMENTS AND PINGBACKS (PREVIOUSLY IN TEMPLATE-TAGS).
---------------------------------------------------------------------------------- */

function alante_thinkup_input_commenttemplate( $comment, $args, $depth ) {

	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'alante'); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'alante' ), ' ' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">

			<header>
				<?php echo get_avatar( $comment, 60 ); ?>
			</header>

			<footer>
				<span class="comment-author">
					<?php printf( '%s - ', sprintf( '%s', get_comment_author_link() ) ); ?>
				</span>

				<span class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</span>

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'alante'); ?></em>
					<br />
				<?php endif; ?>

				<span class="comment-meta">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time datetime="<?php esc_attr( comment_time( 'c' ) ); ?>">
					<?php
						/* translators: 1: date, 2: time */
						printf( '%1$s', get_comment_date() ); ?>
					</time></a>
					<?php edit_comment_link( __( 'Edit', 'alante' ), ' ' );
					?>
				</span>

			<div class="comment-content"><?php comment_text(); ?></div>
			</footer>
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}

/* List comments in single page */
function alante_thinkup_input_comments() {
	$args = array( 
		'callback' => 'alante_thinkup_input_commenttemplate',
	);
	wp_list_comments( $args );
}