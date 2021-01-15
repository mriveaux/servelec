<?php

namespace HashElements;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

if (!function_exists('is_plugin_active')) {
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

final class HASHELE_Modules_Manager {

    private function is_module_active($module_id) {

        $options = get_option('element_pack_active_modules', []);
        return true;
    }

    public function __construct() {
        $this->require_files();
        $this->register_modules();
    }

    private function require_files() {
        require( HASHELE_PATH . 'base/module-base.php' );
    }

    public function register_modules() {
        $modules = [
            'ticker-module',
            'news-module-one',
            'news-module-two',
            'news-module-three',
            'news-module-four',
            'news-module-five',
            'news-module-six',
            'news-module-seven',
            'news-module-eight',
            'news-module-nine',
            'news-module-ten',
            'news-module-eleven',
            'news-module-twelve',
            'news-module-thirteen',
            'news-module-fourteen',
            'news-module-fifteen',
            'carousel-module-one',
            'tile-module-one',
            'tile-module-two',
            'tile-module-three',
            'square-plus-slider',
            'square-plus-featured-block',
            'square-plus-elastic-gallery',
            'square-plus-tab-block',
            'square-plus-logo-carousel',
            'total-slider',
            'total-progressbar',
            'total-featured-block',
            'total-portfolio-masonary',
            'total-service-block',
            'total-team-block',
            'total-counter-block',
            'total-testimonial-slider',
            'total-blog-module',
            'total-logo-carousel',
            'advertisement-banner',
            'contact-information',
            'personal-information',
            'timeline-module',
        ];

        foreach ($modules as $module) {
            if (!$this->is_module_active($module)) {
                continue;
            }
            $class_name = str_replace('-', ' ', $module);
            $class_name = str_replace(' ', '', ucwords($class_name));
            $class_name = __NAMESPACE__ . '\\Modules\\' . $class_name . '\Module'; /* HashElements\Modules\BlokOne\Module */

            $class_name::instance();
        }
    }

}

if (!function_exists('hash_elements_module_manager')) {

    /**
     * Returns an instance of the plugin class.
     * @since  1.0.0
     * @return object
     */
    function hash_elements_module_manager() {
        return new HASHELE_Modules_Manager();
    }

}
hash_elements_module_manager();
