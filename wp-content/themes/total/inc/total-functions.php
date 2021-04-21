<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Total
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function total_body_classes($classes) {
    // Adds a class of group-blog to blogs with more than 1 published author.
    if (is_multi_author()) {
        $classes[] = 'group-blog';
    }

    $post_type = array('post', 'page');

    if (is_singular($post_type)) {
        global $post;
        $sidebar_layout = get_post_meta($post->ID, 'total_sidebar_layout', true);
        $total_hide_title = get_post_meta($post->ID, 'total_hide_title', true);

        if (!$sidebar_layout) {
            $sidebar_layout = 'right_sidebar';
        }

        $classes[] = 'ht_' . $sidebar_layout;
        $classes[] = !$total_hide_title ? 'ht-titlebar-enabled' : 'ht-titlebar-disabled';
    }

    $sticky_header = get_theme_mod('total_sticky_header_enable');

    if ($sticky_header == 'on') {
        $classes[] = 'ht-sticky-header';
    }

    $total_enable_frontpage = get_theme_mod('total_enable_frontpage', false);

    if (is_front_page() && $total_enable_frontpage) {
        $classes[] = 'ht-enable-frontpage';
    }

    return $classes;
}

add_filter('body_class', 'total_body_classes');

if (!function_exists('total_excerpt')) {

    function total_excerpt($content, $letter_count) {
        $new_content = strip_shortcodes($content);
        $new_content = strip_tags($new_content);
        $content = mb_substr($new_content, 0, $letter_count);

        if (($letter_count !== 0) && (strlen($new_content) > $letter_count)) {
            $content .= "...";
        }
        return $content;
    }

}

add_filter('wp_page_menu_args', 'total_change_wp_page_menu_args');

if (!function_exists('total_change_wp_page_menu_args')) {

    function total_change_wp_page_menu_args($args) {
        $args['menu_class'] = 'ht-menu ht-clearfix';
        return $args;
    }

}

function total_dynamic_styles() {
    echo "<style>";
    $total_service_left_bg = get_theme_mod('total_service_left_bg');
    $total_counter_bg = get_theme_mod('total_counter_bg');
    $total_cta_bg = get_theme_mod('total_cta_bg');
    echo '.ht-service-left-bg{ background-image:url(' . esc_url($total_service_left_bg) . ');}';
    echo '#ht-counter-section{ background-image:url(' . esc_url($total_counter_bg) . ');}';
    echo '#ht-cta-section{ background-image:url(' . esc_url($total_cta_bg) . ');}';
    echo "</style>";
}

add_action('wp_head', 'total_dynamic_styles');

function total_comment($comment, $args, $depth) {
    $tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
    ?>
    <<?php echo esc_attr($tag); ?> id="comment-<?php comment_ID(); ?>" <?php comment_class(empty($args['has_children']) ? 'parent' : '', $comment); ?>>
    <article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
        <footer class="comment-meta">
            <div class="comment-author vcard">
                <?php if (0 != $args['avatar_size']) echo get_avatar($comment, $args['avatar_size']); ?>
                <?php echo sprintf('<b class="fn">%s</b>', get_comment_author_link($comment)); ?>
            </div><!-- .comment-author -->

            <?php if ('0' == $comment->comment_approved) : ?>
                <p class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'total'); ?></p>
            <?php endif; ?>
            <?php edit_comment_link(esc_html__('Edit', 'total'), '<span class="edit-link">', '</span>'); ?>
        </footer><!-- .comment-meta -->

        <div class="comment-content">
            <?php comment_text(); ?>
        </div><!-- .comment-content -->

        <div class="comment-metadata ht-clearfix">
            <a href="<?php echo esc_url(get_comment_link($comment, $args)); ?>">
                <time datetime="<?php comment_time('c'); ?>">
                    <?php
                    /* translators: 1: comment date, 2: comment time */
                    printf(esc_html__('%1$s at %2$s', 'total'), get_comment_date('', $comment), get_comment_time());
                    ?>
                </time>
            </a>

            <?php
            comment_reply_link(array_merge($args, array(
                'add_below' => 'div-comment',
                'depth' => $depth,
                'max_depth' => $args['max_depth'],
                'before' => '<div class="reply">',
                'after' => '</div>'
            )));
            ?>
        </div><!-- .comment-metadata -->
    </article><!-- .comment-body -->
    <?php
}

function total_breadcrumb_trial() {
    $args = array(
        'show_browse' => false,
    );
    breadcrumb_trail($args);
}

add_action('total_breadcrumbs', 'total_breadcrumb_trial');

remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action('woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10);
remove_action('woocommerce_archive_description', 'woocommerce_product_archive_description', 10);
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');

add_action('woocommerce_before_main_content', 'total_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'total_theme_wrapper_end', 10);
add_action('total_woocommerce_breadcrumb', 'woocommerce_breadcrumb', 10);
add_action('total_woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10);
add_action('total_woocommerce_archive_description', 'woocommerce_product_archive_description', 10);

function total_theme_wrapper_start() {
    echo '<header class="ht-main-header">';
    echo '<div class="ht-container">';
    echo '<h1 class="ht-main-title">';
    woocommerce_page_title();
    echo '</h1>';
    do_action('total_woocommerce_archive_description');
    do_action('total_woocommerce_breadcrumb');
    echo '</div>';
    echo '</header>';

    echo '<div class="ht-container">';
    echo '<div id="primary">';
}

function total_theme_wrapper_end() {
    echo '</div>';
    get_sidebar('shop');
    echo '</div>';
}

add_filter('woocommerce_show_page_title', '__return_false');

// Change number or products per row to 3
add_filter('loop_shop_columns', 'total_loop_columns');
if (!function_exists('total_loop_columns')) {

    function total_loop_columns() {
        return 3;
    }

}

// Display 9 products per page.
add_filter('loop_shop_per_page', 'total_product_per_page', 20);
if (!function_exists('total_product_per_page')) {

    function total_product_per_page() {
        return 9;
    }

}

function total_update_woo_thumbnail() {
    $catalog = array(
        'width' => '325', // px
        'height' => '380', // px
        'crop' => 1   // true
    );

    $single = array(
        'width' => '600', // px
        'height' => '600', // px
        'crop' => 1   // true
    );

    $thumbnail = array(
        'width' => '120', // px
        'height' => '120', // px
        'crop' => 1   // false
    );
    ;
    update_option('shop_catalog_image_size', $catalog);   // Product category thumbs
    update_option('shop_single_image_size', $single);   // Single product image
    update_option('shop_thumbnail_image_size', $thumbnail);  // Image gallery thumbs
}

add_action('init', 'total_update_woo_thumbnail');

//Change number of related products on product page
add_filter('woocommerce_output_related_products_args', 'total_related_products_args');

function total_related_products_args($args) {
    $args['posts_per_page'] = 3; // 3 related products
    $args['columns'] = 3; // arranged in 3 columns
    return $args;
}

add_filter('woocommerce_product_description_heading', '__return_false');

add_filter('woocommerce_product_additional_information_heading', '__return_false');

add_filter('woocommerce_pagination_args', 'total_change_prev_text');

function total_change_prev_text($args) {
    $args['prev_text'] = '&lang;';
    $args['next_text'] = '&rang;';
    return $args;
}

add_filter('body_class', 'woocommerce_column_class');

function woocommerce_column_class($classes) {
    $classes[] = 'columns-3';
    return $classes;
}

add_action('woocommerce_before_shop_loop_item_title', 'total_title_wrap', 20);

function total_title_wrap() {
    echo '<div class="total-product-title-wrap">';
}

add_action('woocommerce_after_shop_loop_item', 'total_title_wrap_close', 4);

function total_title_wrap_close() {
    echo '</div>';
}

/* Convert hexdec color string to rgb(a) string */

function total_hex2rgba($color, $opacity = false) {

    $default = 'rgb(0,0,0)';

    //Return default if no color provided
    if (empty($color))
        return $default;

    //Sanitize $color if "#" is provided 
    if ($color[0] == '#') {
        $color = substr($color, 1);
    }

    //Check if color has 6 or 3 characters and get values
    if (strlen($color) == 6) {
        $hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
    } elseif (strlen($color) == 3) {
        $hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
    } else {
        return $default;
    }

    //Convert hexadec to rgb
    $rgb = array_map('hexdec', $hex);

    //Check if opacity is set(rgba or rgb)
    if ($opacity) {
        if (abs($opacity) > 1)
            $opacity = 1.0;
        $output = 'rgba(' . implode(",", $rgb) . ',' . $opacity . ')';
    } else {
        $output = 'rgb(' . implode(",", $rgb) . ')';
    }

    //Return rgb(a) color string
    return $output;
}

function totalColourBrightness($hex, $percent) {
    // Work out if hash given
    $hash = '';
    if (stristr($hex, '#')) {
        $hex = str_replace('#', '', $hex);
        $hash = '#';
    }
    /// HEX TO RGB
    $rgb = array(hexdec(substr($hex, 0, 2)), hexdec(substr($hex, 2, 2)), hexdec(substr($hex, 4, 2)));
    //// CALCULATE 
    for ($i = 0; $i < 3; $i++) {
        // See if brighter or darker
        if ($percent > 0) {
            // Lighter
            $rgb[$i] = round($rgb[$i] * $percent) + round(255 * (1 - $percent));
        } else {
            // Darker
            $positivePercent = $percent - ($percent * 2);
            $rgb[$i] = round($rgb[$i] * $positivePercent) + round(0 * (1 - $positivePercent));
        }
        // In case rounding up causes us to go to 256
        if ($rgb[$i] > 255) {
            $rgb[$i] = 255;
        }
    }
    //// RBG to Hex
    $hex = '';
    for ($i = 0; $i < 3; $i++) {
        // Convert the decimal digit to hex
        $hexDigit = dechex($rgb[$i]);
        // Add a leading zero if necessary
        if (strlen($hexDigit) == 1) {
            $hexDigit = "0" . $hexDigit;
        }
        // Append to the hex string
        $hex .= $hexDigit;
    }
    return $hash . $hex;
}

function total_css_strip_whitespace($css) {
    $replace = array(
        "#/\*.*?\*/#s" => "", // Strip C style comments.
        "#\s\s+#" => " ", // Strip excess whitespace.
    );
    $search = array_keys($replace);
    $css = preg_replace($search, $replace, $css);

    $replace = array(
        ": " => ":",
        "; " => ";",
        " {" => "{",
        " }" => "}",
        ", " => ",",
        "{ " => "{",
        ";}" => "}", // Strip optional semicolons.
        ",\n" => ",", // Don't wrap multiple selectors.
        "\n}" => "}", // Don't wrap closing braces.
        "} " => "}\n", // Put each rule on it's own line.
    );
    $search = array_keys($replace);
    $css = str_replace($search, $replace, $css);

    return trim($css);
}

if (!function_exists('total_home_section')) {

    function total_home_section() {
        $defaults = apply_filters('total_home_sections', array(
            'total_about_section',
            'total_featured_section',
            'total_portfolio_section',
            'total_service_section',
            'total_team_section',
            'total_counter_section',
            'total_testimonial_section',
            'total_blog_section',
            'total_client_logo_section',
            'total_cta_section'
                )
        );
        $sections = get_theme_mod('total_frontpage_sections', $defaults);
        return $sections;
    }

}

/**
 * Remove hentry from post_class
 */
add_filter('post_class', 'total_remove_hentry_class');

function total_remove_hentry_class($classes) {
    if (is_singular(array('post', 'page'))) {
        $classes = array_diff($classes, array('hentry'));
    }
    return $classes;
}

add_filter('get_custom_logo', 'total_remove_itemprop');

function total_remove_itemprop() {
    $custom_logo_id = get_theme_mod('custom_logo');
    $html = sprintf('<a href="%1$s" class="custom-logo-link" rel="home">%2$s</a>', esc_url(home_url('/')), wp_get_attachment_image($custom_logo_id, 'full', false, array(
        'class' => 'custom-logo',
            ))
    );
    return $html;
}

function total_premium_demo_config($demos) {
    $premium_demos = array(
        'total' => array(
            'slug' => 'total',
            'name' => 'Total Plus - Total',
            'type' => 'pro',
            'buy_url' => 'https://hashthemes.com/wordpress-theme/total-plus/',
            'image' => 'https://hashthemes.com/import-files/total-plus/screen/total.jpg',
            'preview_url' => 'https://demo.hashthemes.com/total-plus/total/',
        ),
        'main-demo' => array(
            'slug' => 'main-demo',
            'name' => 'Total Plus - Main Demo',
            'type' => 'pro',
            'buy_url' => 'https://hashthemes.com/wordpress-theme/total-plus/',
            'image' => 'https://hashthemes.com/import-files/total-plus/screen/main-demo.jpg',
            'preview_url' => 'https://demo.hashthemes.com/total-plus/main/'
        ),
        'creative-agency' => array(
            'slug' => 'creative-agency',
            'name' => 'Total Plus - Creative Agency',
            'type' => 'pro',
            'buy_url' => 'https://hashthemes.com/wordpress-theme/total-plus/',
            'image' => 'https://hashthemes.com/import-files/total-plus/screen/creative-agency.jpg',
            'preview_url' => 'https://demo.hashthemes.com/total-plus/creative-agency'
        ),
        'one-page' => array(
            'slug' => 'one-page',
            'name' => 'Total Plus - One Page',
            'type' => 'pro',
            'buy_url' => 'https://hashthemes.com/wordpress-theme/total-plus/',
            'image' => 'https://hashthemes.com/import-files/total-plus/screen/one-page.jpg',
            'preview_url' => 'https://demo.hashthemes.com/total-plus/one-page'
        ),
        'construction' => array(
            'slug' => 'construction',
            'name' => 'Total Plus - Construction',
            'type' => 'pro',
            'buy_url' => 'https://hashthemes.com/wordpress-theme/total-plus/',
            'image' => 'https://hashthemes.com/import-files/total-plus/screen/construction.jpg',
            'preview_url' => 'https://demo.hashthemes.com/total-plus/construction'
    ));

    $demos = array_merge($demos, $premium_demos);

    return $demos;
}

add_action('hdi_import_files', 'total_premium_demo_config');

function total_register_required_plugins() {
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
        array(
            'name' => 'HashThemes Demo Importer',
            'slug' => 'hashthemes-demo-importer',
            'required' => false,
        ),
        array(
            'name' => 'Simple Floating Menu',
            'slug' => 'simple-floating-menu',
            'required' => false,
        ),
        array(
            'name' => 'Elementor',
            'slug' => 'elementor',
            'required' => false,
        ),
        array(
            'name' => 'Hash Elements',
            'slug' => 'hash-elements',
            'required' => false,
        ),
    );

    /*
     * Array of configuration settings. Amend each line as needed.
     *
     * TGMPA will start providing localized text strings soon. If you already have translations of our standard
     * strings available, please help us make TGMPA even better by giving us access to these translations or by
     * sending in a pull-request with .po file(s) with the translations.
     *
     * Only uncomment the strings in the config array if you want to customize the strings.
     */
    $config = array(
        'id' => 'total', // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '', // Default absolute path to bundled plugins.
        'menu' => 'total-install-plugins', // Menu slug.
        'has_notices' => true, // Show admin notices or not.
        'dismissable' => true, // If false, a user cannot dismiss the nag message.
        'dismiss_msg' => '', // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => true, // Automatically activate plugins after installation or not.
        'message' => '', // Message to output right before the plugins table.
    );

    tgmpa($plugins, $config);
}

add_action('tgmpa_register', 'total_register_required_plugins');
