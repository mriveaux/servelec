<?php

/**
 * Include external files
 */
require_once('inc/pagination.inc.php');
require_once('inc/template-tags.inc.php');

/**
 * Include CSS files
 */
function theme_enqueue_scripts() {
    wp_enqueue_style( 'Font_Awesome', 'https://use.fontawesome.com/releases/v5.6.1/css/all.css' );
    wp_enqueue_style( 'Bootstrap_css', get_template_directory_uri() . '/css/bootstrap.min.css' );
    wp_enqueue_style( 'MDB', get_template_directory_uri() . '/css/mdb.min.css' );
    wp_enqueue_style( 'Style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_script( 'jQuery', get_template_directory_uri() . '/js/jquery.min.js', array(), '3.3.1', true );
    wp_enqueue_script( 'Tether', get_template_directory_uri() . '/js/popper.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'Bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'MDB', get_template_directory_uri() . '/js/mdb.min.js', array(), '1.0.0', true );

    wp_enqueue_style( 'pageScrollIndicator_css', get_template_directory_uri() . '/addons/pageScrollIndicator/pageScrollIndicator.css' );
    wp_enqueue_script( 'pageScrollIndicator_js', get_template_directory_uri() . '/addons/pageScrollIndicator/pageScrollIndicator.js' );

}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_scripts' );

/**
 * Setup Theme
 */
function mdbtheme_setup() {
    // Add featured image support
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'mdbtheme_setup');

/**
 * Register our sidebars and widgetized areas.
 */
function mdb_widgets_init() {

    register_sidebar( array(
        'name'          => 'Sidebar',
        'id'            => 'sidebar',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
    ) );

}
add_action( 'widgets_init', 'mdb_widgets_init' );