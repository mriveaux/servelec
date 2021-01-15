<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package Total
 */
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php // You can start editing here -- including this comment!  ?>

    <?php if (have_comments()) : ?>
        <h3 class="comments-title">
            <?php
            $total_comment_count = get_comments_number();
            if ('1' === $total_comment_count) {
                printf(
                        /* translators: 1: title. */
                        esc_html__('One thought on &ldquo;%1$s&rdquo;', 'total'), '<span>' . get_the_title() . '</span>'
                );
            } else {
                printf(// WPCS: XSS OK.
                        /* translators: 1: comment count number, 2: title. */
                        esc_html(_nx('%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $total_comment_count, 'comments title', 'total')), number_format_i18n($total_comment_count), '<span>' . get_the_title() . '</span>'
                );
            }
            ?>
        </h3>

        <ul class="comment-list">
            <?php
            wp_list_comments(array(
                'callback' => 'total_comment'
            ));
            ?>
        </ul><!-- .comment-list -->

        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // Are there comments to navigate through? ?>
            <nav id="comment-nav-above" class="navigation pagination">
                <?php paginate_comments_links(); ?>
            </nav><!-- #comment-nav-above -->
        <?php endif; // Check for comment navigation. ?>

    <?php endif; // Check for have_comments(). ?>

    <?php
    // If comments are closed and there are comments, let's leave a little note, shall we?
    if (!comments_open() && '0' != get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
        ?>
        <p class="no-comments"><?php esc_html_e('Comments are closed.', 'total'); ?></p>
    <?php endif; ?>

    <?php
    $commenter = wp_get_current_commenter();
    $req = get_option('require_name_email');
    $aria_req = ( $req ? " aria-required='true'" : '' );

    $fields = array(
        'author' =>
        '<div class="author-email-url ht-clearfix"><p class="comment-form-author"><input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) .
        '" size="30"' . $aria_req . ' placeholder="' . esc_attr__('Name', 'total') . ( $req ? '*' : '' ) . '" /></p>',
        'email' =>
        '<p class="comment-form-email"><input id="email" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) .
        '" size="30"' . $aria_req . ' placeholder="' . esc_attr__('Email', 'total') . ( $req ? '*' : '' ) . '" /></p>',
        'url' =>
        '<p class="comment-form-url"><input id="url" name="url" type="text" value="' . esc_attr($commenter['comment_author_url']) .
        '" size="30" placeholder="' . esc_attr__('Website', 'total') . '" /></p></div>',
    );

    if (has_action('set_comment_cookies', 'wp_set_comment_cookies') && get_option('show_comments_cookies_opt_in')) {
        $consent = empty($commenter['comment_author_email']) ? '' : ' checked="checked"';
        $fields['cookies'] = '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' . '<label for="wp-comment-cookies-consent">' . esc_html__('Save my name, email, and website in this browser for the next time I comment.', 'total') . '</label></p>';
    }


    $args = array(
        'fields' => apply_filters('comment_form_default_fields', $fields),
        'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="' . esc_attr__('Comment', 'total') . '">' .
        '</textarea></p>',
    );
    ?>

    <?php comment_form($args); ?>

</div><!-- #comments -->
