<?php
/**
 * The Header for Customizr.
 *
 * Displays all of the <head> section and everything up till <div id="main-wrapper">
 *
 * @package Customizr
 * @since Customizr 1.0
 */
if (apply_filters('czr_ms', false)) {
    //in core init => add_action( 'czr_ms_tmpl', array( $this , 'czr_fn_load_modern_template_with_no_model' ), 10 , 1 );
    //function czr_fn_load_modern_template_with_no_model( $template = null ) {
    //     $template = $template ? $template : 'index';
    //     $this -> czr_fn_require_once( CZR_MAIN_TEMPLATES_PATH . $template . '.php' );
    // }
    do_action('czr_ms_tmpl', 'header');
    return;
}
?>
    <!DOCTYPE html>
    <!--[if IE 7]>
<html class="ie ie7 no-js" <?php language_attributes(); ?>prefix="og: http://ogp.me/ns#" lang="es">
<![endif]-->
    <!--[if IE 8]>
<html class="ie ie8 no-js" <?php language_attributes(); ?>prefix="og: http://ogp.me/ns#" lang="es">
<![endif]-->
    <!--[if !(IE 7) | !(IE 8)  ]><!-->
<html class="no-js" <?php language_attributes(); ?>prefix="og: http://ogp.me/ns#" lang="es">
    <!--<![endif]-->
    <head>
        <meta charset="<?php bloginfo('charset'); ?>"/>
        <meta http-equiv="X-UA-Compatible" content="IE=EDGE"/>
        <?php if (!function_exists('_wp_render_title_tag')) : ?>
            <title><?php wp_title('|', true, 'right'); ?></title>
        <?php endif; ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta charset="<?php bloginfo('charset'); ?>"/>
        <meta name="language" content="Spanish">
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<!--        <meta http-equiv="cache-control" content="no-cache"/>-->
        <!--12 horas-->
        <meta http-equiv="expires" content="43200"/>

        <meta name="robots" content="index, follow">
        <meta name="revisit-after" content="30 days">
        <meta name="title" content="<?php if (empty(get_the_title())) {
            echo "C.N.A SERVELEC";
        } else {
            echo get_the_title();
        } ?>">
        <meta name="author" content="<?php if (empty(get_the_author())) {
            echo "Ing Miguel Díaz Riveaux <mdriveaux2015@gmail.com>";
        } else {
            echo "C.N.A SERVELEC " . get_the_author();
        } ?>">
        <meta name="reply-to" content="mdriveaux2015@gmail.com">
        <meta name="copyright" content="C.N.A SERVELEC"/>
        <meta name="keywords" content="servelec, CNA, C.N.A, cooperativa, cooperativa no agropecuaria, metrología, báscula, visor, celda, equipos de pesaje, equipos industriales, servicios, profesionalidad, calidad, seguridad, cuba, economía">
        <meta name="description" content="<?php if (empty(get_the_excerpt())) {
            echo "Somos una cooperativa no agropecuaria (C.N.A), especializada en la reparación, mantenimiento y puesta en marcha de sistemas y equipos de pesaje e industriales, brindando garantías y servicios de post-venta a nivel nacional, con un trabajo sostenido de más de 15 años hemos logrado ser líderes de este mercado a nivel nacional.";
        } else {
            echo get_the_excerpt();
        } ?>">
        <!-- Search Engine -->
        <meta name="image" content="https://www.servelec.cu/wp-content/uploads/2020/06/logo.png">
        <!-- Schema.org for Google -->
        <meta itemprop="name" content="<?php echo get_the_title(); ?>">
        <meta itemprop="description" content="<?php echo get_the_excerpt(); ?>">
        <meta itemprop="image" content="https://www.servelec.cu/wp-content/uploads/2020/06/logo.png">
        <!-- Open Graph general (Facebook, Pinterest & Google+) -->
        <meta name="og:title" content="<?php if (empty(get_the_title())) {
            echo "C.N.A SERVELEC";
        } else {
            echo get_the_title();
        } ?>">
        <meta name="og:description" content="<?php if (empty(get_the_excerpt())) {
            echo "Somos una cooperativa no agropecuaria (C.N.A), especializada en la reparación, mantenimiento y puesta en marcha de sistemas y equipos de pesaje e industriales, brindando garantías y servicios de post-venta a nivel nacional, con un trabajo sostenido de más de 15 años hemos logrado ser líderes de este mercado a nivel nacional.";
        } else {
            echo get_the_excerpt();
        } ?>">
        <meta name="og:url" content="<?php echo get_page_link(); ?>">
        <meta name="og:site_name" content="<?php echo get_bloginfo('charset'); ?>">
        <meta name="og:locale" content="<?php echo get_locale(); ?>">
        <meta property="og:type" content="website"/>
        <meta property="og:image" content="http://www.servelec.cu/wp-content/uploads/2020/06/logo.png"/>
        <meta property="og:image:secure_url" content="https://www.servelec.cu/wp-content/uploads/2020/06/logo.png"/>
        <meta property="og:image:type" content="image/png"/>
        <meta property="og:image:width" content="568"/>
        <meta property="og:image:height" content="178"/>
        <meta property="og:image:alt" content="Pesca Caribe Logo"/>
        <!-- Open Graph - Article -->
        <meta name="article:author" content="<?php echo get_the_author(); ?>">
        <meta property="article:author" content="<?php echo get_the_author(); ?>">
        <meta property="article:published_time" content="<?php echo get_the_date(); ?>">
        <!-- Twitter -->
        <meta name="twitter:title" content="<?php if (empty(get_the_title())) {
            echo "C.N.A SERVELEC";
        } else {
            echo get_the_title();
        } ?>">
        <meta name="twitter:description" content="<?php if (empty(get_the_excerpt())) {
            echo "Somos una cooperativa no agropecuaria (C.N.A), especializada en la reparación, mantenimiento y puesta en marcha de sistemas y equipos de pesaje e industriales, brindando garantías y servicios de post-venta a nivel nacional, con un trabajo sostenido de más de 15 años hemos logrado ser líderes de este mercado a nivel nacional.";
        } else {
            echo get_the_excerpt();
        } ?>">
        <meta name="twitter:image" content="https://www.servelec.cu/wp-content/uploads/2020/06/logo.png"/>
        <meta name="twitter:site" content="@mdriveaux">
        <meta name="twitter:creator" content="@mdriveaux">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:url" content="<?php echo get_page_link(); ?>"/>

        <link rev="made" href="mailto:mdriveaux2015@gmail.com">
        <link rel="profile" href="https://gmpg.org/xfn/11"/>
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
        <!-- html5shiv for IE8 and less  -->
        <!--[if lt IE 9]>
			<script src="<?php echo CZR_FRONT_ASSETS_URL ?>js/libs/html5.js"></script>
		<![endif]-->
        <?php wp_head(); ?>
    </head>
<?php
do_action('__before_body');
?>

<body <?php body_class(); ?> <?php echo apply_filters('tc_body_attributes', '') ?>>
<?php
// see https://github.com/presscustomizr/customizr/issues/1722
if (function_exists('wp_body_open')) {
    wp_body_open();
} else {
    do_action('wp_body_open');
}
if (apply_filters('czr_skip_link', true)) :
    ?>
    <a class="screen-reader-text skip-link"
       href="<?php echo apply_filters('czr_skip_link_anchor', '#content'); ?>"><?php esc_html_e('Skip to content', 'customizr') ?></a>
<?php
endif;
?>
<?php do_action('__before_page_wrapper'); ?>

<div id="tc-page-wrap" class="<?php echo implode(" ", apply_filters('tc_page_wrap_class', array())) ?>">

<?php do_action('__before_header'); ?>

    <header class="<?php echo implode(" ", apply_filters('tc_header_classes', array('tc-header', 'clearfix', 'row-fluid'))) ?>">
        <?php
        // The '__header' hook is used with the following callback functions (ordered by priorities) :
        //CZR_header_main::$instance->tc_logo_title_display(), CZR_header_main::$instance->czr_fn_tagline_display(), CZR_header_main::$instance->czr_fn_navbar_display()
        do_action('__header');
        ?>
    </header>
<?php
//This hook is used for the slider : CZR_slider::$instance->czr_fn_slider_display()
do_action('__after_header')
?>