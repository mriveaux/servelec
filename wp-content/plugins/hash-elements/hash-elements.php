<?php

/**
 * Plugin Name: Hash Elements - Addons for Elementor
 * Description: Elementor addons for WordPress Themes developed by HashThemes https://hashthemes.com
 * Version: 1.0.5
 * Author: HashThemes
 * Author URI: https://hashthemes.com/
 * Text Domain: hash-elements
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /languages
 *
 */
/* If this file is called directly, abort */
if (!defined('WPINC')) {
    die();
}

define('HASHELE_VERSION', '1.0.5');

define('HASHELE_FILE', __FILE__);
define('HASHELE_PLUGIN_BASENAME', plugin_basename(HASHELE_FILE));
define('HASHELE_PATH', plugin_dir_path(HASHELE_FILE));
define('HASHELE_URL', plugins_url('/', HASHELE_FILE));

define('HASHELE_ASSETS_URL', HASHELE_URL . 'assets/');

if (!class_exists('Hash_Elements')) {

    class Hash_Elements {

        private static $instance = null;

        public static function get_instance() {
            // If the single instance hasn't been set, set it now.
            if (self::$instance == null) {
                self::$instance = new self;
            }
            return self::$instance;
        }

        public function __construct() {

            // Load translation files
            add_action('init', array($this, 'load_plugin_textdomain'));

            // Load necessary files.
            add_action('plugins_loaded', array($this, 'init'));
        }

        public function load_plugin_textdomain() {
            load_plugin_textdomain('hash-elements', false, basename(dirname(__FILE__)) . '/languages');
        }

        public function init() {

            // Check if Elementor installed and activated
            if (!did_action('elementor/loaded')) {
                add_action('admin_notices', array($this, 'required_plugins_notice'));
                return;
            }

            require( HASHELE_PATH . 'inc/helper-functions.php' );
            require( HASHELE_PATH . 'inc/widget-loader.php' );

            if ('yes' !== get_option('elementor_disable_color_schemes')) {
                update_option('elementor_disable_color_schemes', 'yes');
            }

            if ('yes' !== get_option('elementor_disable_typography_schemes')) {
                update_option('elementor_disable_typography_schemes', 'yes');
            }
        }

        public function required_plugins_notice() {
            $screen = get_current_screen();
            if (isset($screen->parent_file) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id) {
                return;
            }

            $plugin = 'elementor/elementor.php';

            if ($this->is_elementor_installed()) {
                if (!current_user_can('activate_plugins')) {
                    return;
                }

                $activation_url = wp_nonce_url('plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin);
                $admin_message = '<p>' . esc_html__('Ops! Hash Elements is not working because you need to activate the Elementor plugin first.', 'hash-elements') . '</p>';
                $admin_message .= '<p>' . sprintf('<a href="%s" class="button-primary">%s</a>', $activation_url, esc_html__('Activate Elementor Now', 'hash-elements')) . '</p>';
            } else {
                if (!current_user_can('install_plugins')) {
                    return;
                }

                $install_url = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=elementor'), 'install-plugin_elementor');
                $admin_message = '<p>' . esc_html__('Ops! Hash Elements is not working because you need to install the Elementor plugin', 'hash-elements') . '</p>';
                $admin_message .= '<p>' . sprintf('<a href="%s" class="button-primary">%s</a>', $install_url, esc_html__('Install Elementor Now', 'hash-elements')) . '</p>';
            }

            echo '<div class="error">' . $admin_message . '</div>';
        }

        /**
         * Check if theme has elementor installed
         *
         * @return boolean
         */
        public function is_elementor_installed() {
            $file_path = 'elementor/elementor.php';
            $installed_plugins = get_plugins();

            return isset($installed_plugins[$file_path]);
        }

    }

}

/**
 * Returns instanse of the plugin class.
 *
 * @since  1.0.0
 * @return object
 */
if (!function_exists('hash_elements')) {

    function hash_elements() {
        return Hash_Elements::get_instance();
    }

}

hash_elements();
