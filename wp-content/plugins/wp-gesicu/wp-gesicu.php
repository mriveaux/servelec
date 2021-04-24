<?php

/**
 * Plugin Name: GESICU Custom Plugin for Wordpress
 * Plugin URI: https://gesicu.wordpress.com
 * Description: Tools for the website developed by GESICU & powered by Wordpress.
 * Version: 1.0.0
 * Author: Eng. Miguel Díaz Riveaux <mriveaux@nauta.cu>
 * Author URI: https://www.linkedin.com/in/mriveaux/
 * Developer: Eng. Miguel Díaz Riveaux <mriveaux@nauta.cu>
 * Developed on : 5.4
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: wp_gesicu
 * Domain Path: /languages
 *
 * This plugin, like WordPress, is licensed under the GPL.
 * Use it to make something cool, have fun, and share what you've learned with others.
 *
 * Copyright © 2020 GESICU. All Rights Reserved.
 */

if (!defined('WPINC')) {
    // If this file is called directly, abort.
    die;
}

if (!class_exists('WpGesicu')) {
    class WpGesicu
    {

        public function __construct()
        {

            include_once(ABSPATH . 'wp-admin/includes/plugin.php');

            //custom functions by @mriveaux
            $this->init_actions();
            $this->init_filters();

            wp_register_style('wp_gesicu_css', plugin_dir_url(__FILE__) . 'style.css');
            wp_enqueue_style('wp_gesicu_css');

            $this->init_cpt();

            add_theme_support( 'post-thumbnails' );
            add_image_size( 'sidebar-thumb', 120, 120, true ); // Hard Crop Mode
            add_image_size( 'homepage-thumb', 260, 180 ); // Soft Crop Mode
            add_image_size( 'singlepost-thumb', 840, 9999 ); // Unlimited Height Mode

        }

        function init_actions()
        {
            add_action('login_errors', [$this, 'gesicu_auth_login_errors']);
            add_action('init', [$this, 'gesicu_wp_remove_roles']);
            add_action('plugins_loaded', [$this, 'gesicu_init']);
            add_action('login_form', [$this, 'gesicu_auth_login_form']);
            add_action('login_enqueue_scripts', [$this, 'gesicu_auth_login_logo']);
            //servelec
            add_action('admin_menu', [$this, 'gesicu_create_admin_menu_servelec']);
            //session.cookie_*
            add_action('init', [$this, 'gesicu_wp_start_session'], 1);
            add_action('init', [$this, 'gesicu_wp_remove_head_links']);
            //add_action('wp_logout', [$this, 'gesicu_wp_end_session']);
            add_action('wp_login', [$this, 'gesicu_wp_start_session']);
            //Wordpress headers security
            add_action('send_headers', [$this, 'gesicu_wp_add_headers_security']);
            add_action('rest_api_init', [$this, 'gesicu_wp_add_headers_cors'], 15);
            add_action('wp_enqueue_scripts', [$this, 'gesicu_wp_no_more_jquery']);
            add_action('wp_enqueue_scripts', [$this, 'gesicu_wp_myphpinformation_scripts']);
            // remove version from head
            remove_action('wp_head', 'wp_generator');
        }

        function init_filters()
        {
            if (is_plugin_active('polylang/polylang.php')) {
                add_filter('pll_the_languages', [$this, 'widget_dropdown_languages'], 10, 2);
            }
            add_filter('login_headerurl', [$this, 'gesicu_wp_login_logo_url']);
            add_filter('login_headertitle', [$this, 'gesicu_wp_login_logo_url_title']);
            add_filter('upload_mimes', [$this, 'gesicu_wp_add_svg_mime_types']);
            add_filter('the_generator', [$this, 'gesicu_wp_security_remove_version']);
            add_filter('authenticate', [$this, 'gesicu_auth_validate_data'], 102, 3);
            add_filter('show_post_locked_dialog', '__return_false');
            add_filter('wp_check_post_lock_window', '__return_false');
            add_filter('login_headerurl', [$this, 'gesicu_auth_login_logo_url']);
            add_filter('login_headertitle', [$this, 'gesicu_auth_login_header_title']);
           // add_filter('site_transient_update_plugins', [$this, 'gesicu_wp_disable_plugin_update']);
            // remove version from rss
            add_filter('the_generator', '__return_empty_string');
            // remove the wordpress.org link from the Meta widget
            add_filter('widget_meta_poweredby', '__return_empty_string');
            add_filter('style_loader_src', [ $this, 'gesicu_wp_remove_version_scripts_styles'], 9999);
            add_filter('script_loader_src', [ $this,'gesicu_wp_remove_version_scripts_styles'], 9999);

            add_filter('jpeg_quality', function($arg){return 100;});
            add_filter( 'big_image_size_threshold', '__return_false' );
            add_filter( 'wp_image_editors', [$this, 'gesicu_use_gd_editor'] );
            add_filter('pre_option_link_manager_enabled', '__return_true'); //habilitar enlaces
            add_filter( 'auto_update_theme', '__return_false' );
            add_filter('gettext', [$this, 'gesicu_translate_markers']);
            add_filter( 'site_transient_update_themes', [$this, 'gesicu_remove_update_themes'] );

        }

        function init_cpt(){
//            require_once( 'cpt/Solicitud.php' );
//            new Solicitud();
        }

        function gesicu_remove_update_themes( $value ) {
            if ( isset( $value ) && is_object( $value ) ) {
                unset( $value->response['customizr'] );
            }
            return $value;
        }

        function gesicu_translate_markers ($translated)
        {
//            if (pll_current_language() == 'es') {
                $translated = str_ireplace('Marcadores', 'Enlaces de interés', $translated);
//            } else {
//                $translated = str_ireplace('Links', 'Enlaces de interés', $translated);
//            }

            return $translated;
        }

        function gesicu_use_gd_editor($array) {
            return array( 'WP_Image_Editor_GD', );
        }

        function gesicu_create_admin_menu_servelec ()
        {
            add_menu_page(
                __('Servelec', 'wp_gesicu'),
                'SERVELEC',
                'manage_options',
                'servelec',
                'servelec_settings',
                'dashicons-admin-home',
                29
            );
        }

        function gesicu_init()
        {
            $plugin_rel_path = basename(dirname(__FILE__)) . ''; /* Relative to WP_PLUGIN_DIR */
            load_plugin_textdomain('wp_gesicu', false, $plugin_rel_path);
            wp_dequeue_script('autosave');
        }

        function gesicu_auth_validate_data($user, $username, $password)
        {
            try {
                $dataPost = $_POST;
                if (is_array($dataPost) && !empty($dataPost)) {
                    // your validation here.
                    if (empty($username)) {
                        $user = new WP_Error('authentication_failed', __('<strong>ERROR</strong>: El campo Nombre de usuario es requerido.', 'wp_gesicu'));
                    }
                    if (empty($password)) {
                        $user = new WP_Error('authentication_failed', __('<strong>ERROR</strong>: El campo Contraseña es requerido.', 'wp_gesicu'));
                    }
                    if (!empty($username) && !empty($password)) {
                        $user = get_user_by('login', $username);
                        $sessions = WP_Session_Tokens::get_instance($user->ID);
                        $all_sessions = $sessions->get_all();
                        if (is_array($all_sessions) && count($all_sessions) > 0) {
                            if (in_array('administrator', $user->roles)) {
                                // admin can log in more than once
                                return $user;
                            } else {
                                $user = new WP_Error('authentication_failed', __('<strong>ERROR</strong>: Este usuario ya ha iniciado la sesión.', 'wp_gesicu'));
                            }
                        }
                    }
                    $ignore_codes = ['empty_username', 'empty_password'];
                    if (is_wp_error($user) && !in_array($user->get_error_code(), $ignore_codes)) {
                        do_action('wp_login_failed', $username);
                    }
                }
            } catch (Exception $exception) {
                throw $exception;
            }

            return $user;
        }

        function gesicu_auth_login_errors($error)
        {
            if (is_wp_error($error)) {
                return $error;
            }
            //check if that's the error you are looking for
            $pos = strpos($error, 'iniciado');
            if (is_int($pos)) {
                //its the right error so you can overwrite it
                $error = __('<strong>ERROR</strong>: Este usuario ya ha iniciado la sesión.', 'wp_gesicu');
            }

            return $error;
        }

        function gesicu_auth_login_form()
        {
            echo '<script type="application/javascript">
    		            document.getElementById( "user_login" ).autocomplete = "off";
    		            document.getElementById( "user_pass" ).autocomplete = "off";
			        </script>';
        }

        function gesicu_auth_login_logo()
        {
            ?>
            <style type="text/css">
                #login h1 a, .login h1 a {
                    background-image: url(/wp-content/uploads/images/logo.png);
                    height: 100px;
                    width: 100%;
                    /*height:100px;*/
                    /*width:300px;*/
                    background-size: 100% 100%;
                    background-repeat: no-repeat;
                    /*padding-bottom: 10px;*/
                }

                .forgetmenot {
                    display: none;
                }

                p#nav {
                    display: none;
                }
            </style>
            <?php
        }

        function gesicu_auth_login_logo_url($url)
        {
            if (pll_current_language() == 'en') {
                return home_url('home/');
            }

            return home_url();
        }

        function gesicu_auth_login_header_title()
        {
            return __('C.N.A SERVELEC', 'wp_gesicu');
        }

        function gesicu_wp_login_logo_url()
        {
            return home_url();
        }

        function gesicu_wp_login_logo_url_title()
        {
            return 'Sitio Web de la Cooperativa No Agropecuaria SERVELEC';
        }

        function gesicu_wp_security_remove_version($username)
        {
            return '';
        }

        function gesicu_wp_remove_roles()
        {
//            remove_role('editor');
//            remove_role('author');
//            remove_role('contributor');
//            remove_role('subscriber');
        }

        function gesicu_wp_start_session()
        {
            if (!session_id()) {
                session_start();
                session_regenerate_id(true);
                $currentCookieParams = session_get_cookie_params();
                $sidvalue = session_id();
                setcookie(
                    'PHPSESSID',//name
                    $sidvalue,//value
                    0,//expires at end of session
                    $currentCookieParams['path'],//path
                    $currentCookieParams['domain'],//domain
                    true, //secure,
                    true // HttpOnly
                );
            }elseif(session_status() == PHP_SESSION_ACTIVE) {
                @session_regenerate_id(true);
                @session_write_close();
                @session_set_cookie_params(0);
                if(parse_url($_SERVER["HTTP_REFERER"], PHP_URL_HOST) != $_SERVER["SERVER_NAME"]){
                    if (wp_validate_auth_cookie()==FALSE)
                    {
                        $user_id = get_current_user_id();
                        wp_set_auth_cookie($user_id, false, true);
                    }
                    session_destroy();
                    wp_redirect(site_url());
                    exit;
                }
                /*
                While this will protect users from having their session fixed and offering easy access to any would-be attacker, itwon’t helpmuch against another common session attack known as session hijacking. This is a rather generic termused to describe any means by which an attacker gains a user’s valid session identifier (rather than providing one of his own).
                For example, suppose that a user logs in. If the session identifier is regenerated, they have a new session ID. What if an attacker discovers this new ID and attempts to use it to gain access through that user’s session? It is then necessary to use other means to identify the user.
                One way to identify the user in addition to the session identifier is to check various request headers sent by the client. One request header that is particularly helpful and does not change between requests is the User-Agent header. Since it is unlikely (at least in most legitimate cases) that a user will change from one browser to another while using the same session, this header can be used to determine a possible session hijacking attempt.
                After a successful login attempt, store the User-Agent into the session:
                */
                $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
                /*
                Then, on subsequent page loads, check to ensure that the User-Agent has not changed. If it has changed, then that is cause for concern, and the user should log in again.
                */
                if ($_SESSION['user_agent'] != $_SERVER['HTTP_USER_AGENT'])
                {
                    // Force user to log in again
                    exit;
                }
            }
        }

        function gesicu_wp_add_headers_security()
        {
            @header( 'Set-Cookie: name=value;HttpOnly;Secure;SameSite=strict' );//Header always edit Set-Cookie ^(.*)$ $1;HttpOnly;Secure;SameSite=strict
            @header( 'X-Frame-Options: SAMEORIGIN' );
            @header( 'X-Content-Type-Options: nosniff' );
            @header( 'X-XSS-Protection: 1; mode=block' );
            @header( 'Expect-CT: max-age=86400, enforce' );
            @header( 'Strict-Transport-Security: max-age=31536000; includeSubDomains' );
//            @header( "X-Content-Security-Policy: default-src 'self' *.github.com *.wordpress.org secure.gravatar.com w.org s.w.org;\ font-src 'self' 'unsafe-inline' data: *.googleapis.com fonts.gstatic.com;\ style-src 'self' 'unsafe-inline' data: *.googleapis.com assets-cdn.github.com;\ media-src 'self' *.youtube-nocookie.com;\ frame-src 'self' *.youtube-nocookie.com;'");
//            @header( "Content-Security-Policy: default-src 'self' *.github.com *.wordpress.org secure.gravatar.com w.org s.w.org;\ font-src 'self' 'unsafe-inline' data: *.googleapis.com fonts.gstatic.com;\ style-src 'self' 'unsafe-inline' data: *.googleapis.com assets-cdn.github.com;\ media-src 'self' *.youtube-nocookie.com;\ frame-src 'self' *.youtube-nocookie.com;'");
            @header( 'unset X-Powered-By' );
            @header( 'unset ETag' );
            @header("Cache-Control: private, no-cache,  no-store, must-revalidate, proxy-revalidate, no-transform"); //HTTP 1.1
            @header("Pragma: no-cache"); //HTTP 1.0
            @header( 'Referrer-Policy: no-referrer-when-downgrade' );

        }

        function gesicu_wp_add_headers_cors()
        {
            add_filter( 'rest_pre_serve_request', function( $value ) {
                @header('Access-Control-Allow-Headers: Authorization, Content-Type, X-WP-Wpml-Language, X-WP-Nonce, X-Requested-With, X-Token-Auth', true);
                @header( 'Access-Control-Allow-Methods: POST, GET, PUT, DELETE' );
                @header( 'Access-Control-Allow-Credentials: true' );
//                @header( 'Access-Control-Allow-Origin: null' );
                return $value;
            } );
        }

        function gesicu_wp_remove_head_links() {
            remove_action('wp_head', 'rsd_link');
            remove_action('wp_head', 'wlwmanifest_link');
        }

        function gesicu_wp_remove_version_scripts_styles($src)
        {
            if (strpos($src, 'ver=') || strpos( $src, 'ver=' . get_bloginfo( 'version' ))) {
                $src = remove_query_arg('ver', $src);
            }
            return $src;
        }

        public static function activate()
        {
            // Agregar roles
//            add_role('gesicu_manager',
//                'gesicu Manager',
//                array(
//                    'read' => true,
//                    'edit_posts' => false,
//                    'delete_posts' => false,
//                    'publish_posts' => false,
//                    'upload_files' => true,
//                )
//            );

        }

        public static function deactivate()
        {

        }

        function gesicu_wp_add_svg_mime_types($mimes)
        {
            $mimes['svg'] = 'image/svg+xml';

            return $mimes;
        }

        function gesicu_wp_disable_plugin_update($value)
        {
            if (isset($value) && is_object($value)) {
//                if (isset($value->response['aryo-activity-log/aryo-activity-log.php'])) {
//                    unset($value->response['aryo-activity-log/aryo-activity-log.php']);
//                }
            }
            return $value;
        }

        function gesicu_wp_no_more_jquery()
        {
            wp_deregister_script('jquery');
            wp_enqueue_script('jquery', plugin_dir_url(__FILE__) . '/js/jquery-3.4.1.min.js', [], '3.4.1', false);
            wp_enqueue_script('jquery-comun', plugin_dir_url(__FILE__) . '/js/jquery-comun.js', [], '1.0.0', true);
        }

        function gesicu_wp_myphpinformation_scripts()
        {
            if (!is_admin()) {
                wp_deregister_script('jquery');
                wp_register_script('jquery', plugin_dir_url(__FILE__) . '/js/jquery-3.4.1.min.js', '3.4.1', false);
                wp_enqueue_script('jquery');
//                wp_register_style('tailwindcss', plugin_dir_url(__FILE__) . '/css/style_tailwindcss.css');
//                wp_enqueue_style('tailwindcss');
            }
        }

    }

    register_activation_hook(__FILE__, ['WpGesicu', 'activate']);
    register_deactivation_hook(__FILE__, ['WpGesicu', 'deactivate']);

    $wp_plugin_template = new WpGesicu();
}