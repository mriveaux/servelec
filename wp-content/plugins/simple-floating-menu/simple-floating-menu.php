<?php
/**
 * Plugin Name: Simple Floating Menu
 * Plugin URI: https://github.com/pzstar/simple-floating-menu
 * Description: Simple Floating Menu adds a stylish designed menu in your website.
 * Version: 1.0.3
 * Author: HashThemes
 * Author URI:  https://hashthemes.com
 * Text Domain: simple-floating-menu
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /languages
 *
 */
if (!defined('ABSPATH'))
    exit;

define('SFM_VERSION', '1.0.3');
define('SFM_FILE', __FILE__);
define('SFM_PLUGIN_BASENAME', plugin_basename(SFM_FILE));
define('SFM_PATH', plugin_dir_path(SFM_FILE));
define('SFM_URL', plugins_url('/', SFM_FILE));

if (!class_exists('Simple_Floating_Menu')) {

    class Simple_Floating_Menu {

        /**
         * Instance of this class.
         *
         * @var object
         */
        protected static $instance = null;

        /* Saved Settings */
        public $settings;

        /**
         * Return an instance of this class.
         *
         * @return object A single instance of this class.
         */
        public static function get_instance() {
            if (null == self::$instance) {
                self::$instance = new self;
            }

            return self::$instance;
        }

        /**
         * Initialize the plugin.
         */
        private function __construct() {

            // Load translation files
            add_action('init', array($this, 'load_plugin_textdomain'));

            // Add necesary backend JS
            add_action('admin_enqueue_scripts', array($this, 'load_backends'));

            // Include classes.
            $this->includes();

            // WP-Admin Menu
            add_action('admin_menu', array($this, 'load_menu'));

            add_action('admin_footer', array($this, 'sfm_dymanic_styles'));
        }

        /**
         * Load the plugin text domain for translation.
         */
        public function load_plugin_textdomain() {
            load_plugin_textdomain('simple-floating-menu', false, SFM_PATH . '/languages/');
        }

        /*
         * WP-ADMIN Menu for importer
         */

        public function load_menu() {
            // Add the menu item and page
            $page_title = esc_html__('Simple Floating Menu', 'simple-floating-menu');
            $menu_title = esc_html__('Simple Floating Menu', 'simple-floating-menu');
            $capability = 'manage_options';
            $slug = 'simple-floating-menu';
            $callback = array($this, 'settings_page_content');
            $icon = 'dashicons-admin-generic';
            $position = 100;

            add_menu_page($page_title, $menu_title, $capability, $slug, $callback, $icon, $position);
        }

        /**
         * Include plugin functions.
         */
        protected function includes() {
            include_once SFM_PATH . 'inc/style.php';
            include_once SFM_PATH . 'inc/font-icons.php';
            include_once SFM_PATH . 'inc/google-fonts-list.php';
            include_once SFM_PATH . 'frontend.php';
            include_once SFM_PATH . 'live-preview.php';
        }

        /*
          Register necessary backend js
         */

        public function load_backends() {
            wp_enqueue_script('chosen', SFM_URL . 'assets/js/chosen.jquery.js', array('jquery'), SFM_VERSION, true);
            wp_enqueue_script('webfont', SFM_URL . 'assets/js/webfont.js', array(), SFM_VERSION, true);
            wp_enqueue_script('sfm-admin-script', SFM_URL . 'assets/js/admin-scripts.js', array('jquery', 'wp-color-picker', 'jquery-ui-slider', 'jquery-ui-sortable'), SFM_VERSION, true);

            wp_enqueue_style('wp-color-picker');
            wp_enqueue_style('sfm-fontawesome', SFM_URL . 'assets/css/all.css', array(), SFM_VERSION);
            wp_enqueue_style('sfm-eleganticons', SFM_URL . 'assets/css/eleganticons.css', array(), SFM_VERSION);
            wp_enqueue_style('sfm-essential-icon', SFM_URL . 'assets/css/essential-icon.css', array(), SFM_VERSION);
            wp_enqueue_style('sfm-iconfont', SFM_URL . 'assets/css/icofont.css', array(), SFM_VERSION);
            wp_enqueue_style('sfm-materialdesignicons', SFM_URL . 'assets/css/materialdesignicons.css', array(), SFM_VERSION);
            wp_enqueue_style('chosen', SFM_URL . 'assets/css/chosen.css', array(), SFM_VERSION);
            wp_enqueue_style('sfm-fonts', Simple_Floating_Menu_Frontend::sfm_fonts_url(), array(), SFM_VERSION);
            wp_enqueue_style('sfm-admin-style', SFM_URL . 'assets/css/admin-style.css', array(), SFM_VERSION);
            wp_enqueue_style('sfm-style', SFM_URL . 'assets/css/style.css', array(), SFM_VERSION);
        }

        public static function default_settings() {
            $defaults = array(
                'enable_sfm' => 'yes',
                'enable_sfm_setting' => 'yes',
                'buttons' => array(array(
                        'id' => uniqid('sfm-'),
                        'icon' => 'icofont-dart',
                        'url' => 'http://',
                        'tool_tip_text' => '',
                        'open_new_tab' => true,
                        'button_bg_color' => '#000000',
                        'button_icon_color' => '#FFFFFF',
                        'button_bg_color_hover' => '#000000',
                        'button_icon_color_hover' => '#FFFFFF',
                        'tooltip_bg_color' => '#000000',
                        'tooltip_text_color' => '#FFFFFF',
                    )
                ),
                'tooltip_font' => array(
                    'family' => 'Open Sans',
                    'style' => '400',
                    'transform' => 'none',
                    'decoration' => 'none',
                    'size' => '16',
                    'line_height' => '1',
                    'letter_spacing' => '0',
                ),
                'position' => 'middle-right',
                'orientation' => 'vertical',
                'style' => 'sfm-rect',
                'button_height' => 50,
                'button_width' => 50,
                'icon_size' => 16,
                'icon_position' => 0,
                'top_offset' => 0,
                'bottom_offset' => 0,
                'left_offset' => 0,
                'right_offset' => 0,
                'button_spacing' => 5,
                'zindex' => 9
            );
            return $defaults;
        }

        public static function get_settings() {
            $defaults = self::default_settings();
            $sfm_settings = get_option('sfm_settings');
            $sfm_settings = wp_parse_args($sfm_settings, $defaults);
            return $sfm_settings;
        }

        public function settings_page_content() {
            ?>
            <div class="wrap">

                <div id="sfm-header">
                    <h3><?php esc_html_e('Simple Floating Menu Settings', 'simple-floating-menu'); ?></h3>

                    <div id="sfm-tab-wrapper" class="sfm-tab-wrapper">
                        <a id="sfm-buttons-nav" class="sfm-tab sfm-tab-active" href="#tab-sfm-buttons">
                            <i class="mdi mdi-animation"></i>
                            <?php esc_html_e('Buttons', 'simple-floating-menu'); ?>
                        </a>

                        <a id="sfm-setting-nav" class="sfm-tab" href="#tab-sfm-settings">
                            <i class="mdi mdi-settings"></i>
                            <?php esc_html_e('Settings', 'simple-floating-menu'); ?>
                        </a>		
                    </div>
                </div>

                <div id="sfm-form-wrap">
                    <form method="POST">
                        <?php
                        if (isset($_POST['updated']) && $_POST['updated'] === 'true') {
                            $this->handle_form();
                        }

                        $sfm_settings = self::get_settings();
                        ?>
                        <input type="hidden" name="updated" value="true" />
                        <?php wp_nonce_field('sfm_nonce_update', 'sfm_nonce'); ?>

                        <div class="form-row sfm-form-row">
                            <label class="form-label"><?php esc_html_e('Enable Floating Menu', 'simple-floating-menu'); ?></label>
                            <div class="form-field">
                                <div class="onoff-switch">
                                    <?php
                                    $enable_sfm = isset($sfm_settings['enable_sfm']) ? $sfm_settings['enable_sfm'] : 'yes';
                                    ?>
                                    <input type="checkbox" id="enable_sfm" name="sfm_settings[enable_sfm]" class="onoff-switch-checkbox" value="1" <?php checked($enable_sfm, 'yes'); ?>>
                                    <label class="onoff-switch-label" for="enable_sfm"></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row sfm-form-row">
                            <label class="form-label"><?php esc_html_e('Display Setting Button on Menu', 'simple-floating-menu'); ?><br/><span><?php esc_html_e('This menu only displays for the Administrator in the Frontend', 'simple-floating-menu'); ?></span></label>
                            <div class="form-field">
                                <div class="onoff-switch">
                                    <?php
                                    $enable_sfm_setting = isset($sfm_settings['enable_sfm_setting']) ? $sfm_settings['enable_sfm_setting'] : 'yes';
                                    ?>
                                    <input type="checkbox" id="enable_sfm_setting" name="sfm_settings[enable_sfm_setting]" class="onoff-switch-checkbox" value="1" <?php checked($enable_sfm_setting, 'yes'); ?>>
                                    <label class="onoff-switch-label" for="enable_sfm_setting"></label>
                                </div>
                            </div>
                        </div>

                        <div id="tab-sfm-buttons" class="sfm-form-page sfm-active">
                            <div id="sfm-buttons-settings">
                                <?php
                                $buttons = $sfm_settings['buttons'];
                                $count = count($buttons);
                                ?>
                                <div class="sfm-button-repeater" data-count="<?php echo esc_attr($count); ?>">
                                    <?php
                                    $count = 0;
                                    foreach ($buttons as $button) {
                                        ?>
                                        <div class="sfm-button-fields">
                                            <div class="sfm-button-fields-header">
                                                <div class="sfm-drag"><i class="icofont-drag"></i></div>
                                                <?php esc_html_e('Button', 'simple-floating-menu'); ?>
                                                <div class="sfm-remove"><i class="icofont-close-line"></i></div>
                                            </div>
                                            <div class="form-row">
                                                <label class="form-label"><?php esc_html_e('Choose Icon', 'simple-floating-menu'); ?></label>
                                                <div class="form-field">
                                                    <?php
                                                    echo '<div class="sfm-customizer-icon-box">';
                                                    echo '<div class="sfm-selected-icon">';
                                                    echo '<i class="' . esc_attr($button['icon']) . '"></i>';
                                                    echo '<span><i class="icofont-simple-down"></i></span>';
                                                    echo '</div>';
                                                    echo '<div class="sfm-icon-box">';
                                                    echo '<div class="sfm-icon-search">';
                                                    echo '<select>';

                                                    if (apply_filters('sfm_show_ico_font', true)) {
                                                        echo '<option value="icofont-list">' . esc_html__('Ico Font', 'simple-floating-menu') . '</option>';
                                                    }

                                                    if (apply_filters('sfm_show_font_awesome', true)) {
                                                        echo '<option value="fontawesome-list">' . esc_html__('Font Awesome', 'simple-floating-menu') . '</option>';
                                                    }

                                                    if (apply_filters('sfm_show_essential_icon', true)) {
                                                        echo '<option value="essential-icon-list">' . esc_html__('Essential Icon', 'simple-floating-menu') . '</option>';
                                                    }

                                                    if (apply_filters('sfm_show_material_icon', true)) {
                                                        echo '<option value="material-icon-list">' . esc_html__('Material Icon', 'simple-floating-menu') . '</option>';
                                                    }

                                                    if (apply_filters('sfm_show_elegant_icon', true)) {
                                                        echo '<option value="elegant-icon-list">' . esc_html__('Elegant Icon', 'simple-floating-menu') . '</option>';
                                                    }

                                                    echo '</select>';
                                                    echo '<input type="text" class="sfm-icon-search-input" placeholder="' . esc_html__('Type to filter', 'simple-floating-menu') . '" />';
                                                    echo '</div>';

                                                    if (apply_filters('sfm_show_ico_font', true)) {
                                                        echo '<ul class="sfm-icon-list icofont-list clearfix active">';
                                                        $sfm_icofont_icon_array = sfm_icofont_icon_array();
                                                        foreach ($sfm_icofont_icon_array as $sfm_icofont_icon) {
                                                            $icon_class = $button['icon'] == $sfm_icofont_icon ? 'icon-active' : '';
                                                            echo '<li class=' . esc_attr($icon_class) . '><i class="' . esc_attr($sfm_icofont_icon) . '"></i></li>';
                                                        }
                                                        echo '</ul>';
                                                    }

                                                    if (apply_filters('sfm_show_font_awesome', true)) {
                                                        echo '<ul class="sfm-icon-list fontawesome-list clearfix">';
                                                        $sfm_font_awesome_icon_array = sfm_font_awesome_icon_array();
                                                        foreach ($sfm_font_awesome_icon_array as $sfm_font_awesome_icon) {
                                                            $icon_class = $button['icon'] == $sfm_font_awesome_icon ? 'icon-active' : '';
                                                            echo '<li class=' . esc_attr($icon_class) . '><i class="' . esc_attr($sfm_font_awesome_icon) . '"></i></li>';
                                                        }
                                                        echo '</ul>';
                                                    }

                                                    if (apply_filters('sfm_show_essential_icon', true)) {
                                                        echo '<ul class="sfm-icon-list essential-icon-list clearfix">';
                                                        $sfm_essential_icon_array = sfm_essential_icon_array();
                                                        foreach ($sfm_essential_icon_array as $sfm_essential_icon) {
                                                            $icon_class = $button['icon'] == $sfm_essential_icon ? 'icon-active' : '';
                                                            echo '<li class=' . esc_attr($icon_class) . '><i class="' . esc_attr($sfm_essential_icon) . '"></i></li>';
                                                        }
                                                        echo '</ul>';
                                                    }

                                                    if (apply_filters('sfm_show_material_icon', true)) {
                                                        echo '<ul class="sfm-icon-list material-icon-list clearfix">';
                                                        $sfm_materialdesignicons_icon_array = sfm_materialdesignicons_array();
                                                        foreach ($sfm_materialdesignicons_icon_array as $sfm_materialdesignicons_icon) {
                                                            $icon_class = $button['icon'] == $sfm_materialdesignicons_icon ? 'icon-active' : '';
                                                            echo '<li class=' . esc_attr($icon_class) . '><i class="' . esc_attr($sfm_materialdesignicons_icon) . '"></i></li>';
                                                        }
                                                        echo '</ul>';
                                                    }

                                                    if (apply_filters('sfm_show_elegant_icon', true)) {
                                                        echo '<ul class="sfm-icon-list elegant-icon-list clearfix">';
                                                        $sfm_eleganticons_icon_array = sfm_eleganticons_array();
                                                        foreach ($sfm_eleganticons_icon_array as $sfm_eleganticons_icon) {
                                                            $icon_class = $button['icon'] == $sfm_eleganticons_icon ? 'icon-active' : '';
                                                            echo '<li class=' . esc_attr($icon_class) . '><i class="' . esc_attr($sfm_eleganticons_icon) . '"></i></li>';
                                                        }
                                                        echo '</ul>';
                                                    }

                                                    echo '</div>';
                                                    echo '<input class="sfm-icon" type="hidden" value="' . esc_attr($button['icon']) . '" name="sfm_settings[buttons][' . $count . '][icon]" data-default="icofont-dart"/>';
                                                    echo '</div>';
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <label class="form-label"><?php esc_html_e('Button Url', 'simple-floating-menu'); ?></label>
                                                <div class="form-field">
                                                    <input name="sfm_settings[buttons][<?php echo $count; ?>][url]" type="text" value="<?php echo esc_attr($button['url']); ?>" class="regular-text" data-default="http://" />
                                                    <p class="form-description"><?php esc_html_e('Leaving empty will not display the button', 'simple-floating-menu'); ?></p>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <label class="form-label"><?php esc_html_e('Tool Tip Text', 'simple-floating-menu'); ?></label>
                                                <div class="form-field">
                                                    <input name="sfm_settings[buttons][<?php echo $count; ?>][tool_tip_text]" type="text" value="<?php echo esc_html($button['tool_tip_text']); ?>" class="regular-text" />
                                                    <p class="form-description"><?php esc_html_e('This text will display on hovering the button', 'simple-floating-menu'); ?></p>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <label class="form-label"><?php esc_html_e('Open in New Tab', 'simple-floating-menu'); ?></label>
                                                <div class="form-field">
                                                    <label class="form-label">
                                                        <?php
                                                        $checkbox_val = isset($button['open_new_tab']) ? true : false;
                                                        ?>
                                                        <input name="sfm_settings[buttons][<?php echo $count; ?>][open_new_tab]" type="checkbox" value="1" <?php checked($checkbox_val, 1); ?>>
                                                        <?php esc_html_e('Open in New Tab', 'simple-floating-menu'); ?>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-flex form-col-2">
                                                    <div class="form-col">
                                                        <label class="form-label"><?php esc_html_e('Button Background Color', 'simple-floating-menu'); ?></label>
                                                        <div class="form-field">
                                                            <input class="sfm-color-picker sfm-button-bg-color" name="sfm_settings[buttons][<?php echo $count; ?>][button_bg_color]" type="text" value="<?php echo sanitize_hex_color($button['button_bg_color']); ?>" data-default="#000000"/>
                                                        </div>
                                                    </div>

                                                    <div class="form-col">
                                                        <label class="form-label"><?php esc_html_e('Button Icon Color', 'simple-floating-menu'); ?></label>
                                                        <div class="form-field"><input class="sfm-color-picker sfm-icon-color" name="sfm_settings[buttons][<?php echo $count; ?>][button_icon_color]" type="text" value="<?php echo sanitize_hex_color($button['button_icon_color']); ?>" data-default="#FFFFFF" /></div>
                                                    </div>
                                                    <div class="form-col">
                                                        <label class="form-label"><?php esc_html_e('Button Background Color Hover', 'simple-floating-menu'); ?></label>
                                                        <div class="form-field"><input class="sfm-color-picker sfm-button-bg-color-hover" name="sfm_settings[buttons][<?php echo $count; ?>][button_bg_color_hover]" type="text" value="<?php echo sanitize_hex_color($button['button_bg_color_hover']); ?>"  data-default="#000000"/></div>
                                                    </div>
                                                    <div class="form-col">
                                                        <label class="form-label"><?php esc_html_e('Button Icon Color Hover', 'simple-floating-menu'); ?></label>
                                                        <div class="form-field"><input class="sfm-color-picker sfm-icon-color-hover" name="sfm_settings[buttons][<?php echo $count; ?>][button_icon_color_hover]" type="text" value="<?php echo sanitize_hex_color($button['button_icon_color_hover']); ?>"  data-default="#FFFFFF"/></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-flex form-col-2">
                                                    <div class="form-col">
                                                        <label class="form-label"><?php esc_html_e('Tool Tip Background Color', 'simple-floating-menu'); ?></label>
                                                        <div class="form-field"><input class="sfm-color-picker sfm-tool-tip-bg-color" name="sfm_settings[buttons][<?php echo $count; ?>][tooltip_bg_color]" type="text" value="<?php echo sanitize_hex_color($button['tooltip_bg_color']); ?>" data-default="#000000"/></div>
                                                    </div>
                                                    <div class="form-col">
                                                        <label class="form-label"><?php esc_html_e('Tool Tip Text Color', 'simple-floating-menu'); ?></label>
                                                        <div class="form-field"><input class="sfm-color-picker sfm-tool-tip-text-color" name="sfm_settings[buttons][<?php echo $count; ?>][tooltip_text_color]" type="text" value="<?php echo sanitize_hex_color($button['tooltip_text_color']); ?>" data-default="#FFFFFF" /></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input name="sfm_settings[buttons][<?php echo $count; ?>][id]" type="hidden" class="sfm-unique-id" value="<?php echo esc_attr($button['id']); ?>">
                                        </div>
                                        <?php
                                        $count++;
                                    }
                                    ?>
                                </div>
                                <div class="sfm-add-new-button-fields"><a class="button" href="#"><i class="mdi mdi-plus"></i> <?php esc_html_e('Add New', 'simple-floating-menu'); ?></a></div>
                            </div>
                        </div>

                        <div id="tab-sfm-settings" class="sfm-form-page">
                            <table class="form-table">
                                <tbody>
                                    <tr>
                                        <th><label><?php esc_html_e('Button Position', 'simple-floating-menu'); ?></label></th>
                                        <td>
                                            <select class="sfm-button-position" name="sfm_settings[position]">
                                                <option value="top-left" <?php selected($sfm_settings['position'], 'top-left'); ?>><?php esc_html_e('Top Left', 'simple-floating-menu'); ?></option>
                                                <option value="top-middle" <?php selected($sfm_settings['position'], 'top-middle'); ?>><?php esc_html_e('Top Middle', 'simple-floating-menu'); ?></option>
                                                <option value="top-right" <?php selected($sfm_settings['position'], 'top-right'); ?>><?php esc_html_e('Top Right', 'simple-floating-menu'); ?></option>
                                                <option value="bottom-left" <?php selected($sfm_settings['position'], 'bottom-left'); ?>><?php esc_html_e('Bottom Left', 'simple-floating-menu'); ?></option>
                                                <option value="bottom-middle" <?php selected($sfm_settings['position'], 'bottom-middle'); ?>><?php esc_html_e('Bottom Middle', 'simple-floating-menu'); ?></option>
                                                <option value="bottom-right" <?php selected($sfm_settings['position'], 'bottom-right'); ?>><?php esc_html_e('Bottom Right', 'simple-floating-menu'); ?></option>
                                                <option value="middle-left" <?php selected($sfm_settings['position'], 'middle-left'); ?>><?php esc_html_e('Middle Left', 'simple-floating-menu'); ?></option>
                                                <option value="middle-right" <?php selected($sfm_settings['position'], 'middle-right'); ?>><?php esc_html_e('Middle Right', 'simple-floating-menu'); ?></option>
                                            </select>
                                        </td>
                                    </tr>

                                <th><label><?php esc_html_e('Orientation', 'simple-floating-menu'); ?></label></th>
                                <td>
                                    <select class="sfm-button-orientation" name="sfm_settings[orientation]">
                                        <option value="horizontal" <?php selected($sfm_settings['orientation'], 'horizontal'); ?>><?php esc_html_e('Horizontal', 'simple-floating-menu'); ?></option>
                                        <option value="vertical" <?php selected($sfm_settings['orientation'], 'vertical'); ?>><?php esc_html_e('Vertical', 'simple-floating-menu'); ?></option>
                                    </select>
                                </td>
                                </tr>

                                <tr>
                                    <th><label><?php esc_html_e('Button Style', 'simple-floating-menu'); ?></label></th>
                                    <td>
                                        <select class="sfm-button-style" name="sfm_settings[style]">
                                            <option value="sfm-rect" <?php selected($sfm_settings['style'], 'sfm-rect'); ?>><?php esc_html_e('Rectangle', 'simple-floating-menu'); ?></option>
                                            <option value="sfm-round" <?php selected($sfm_settings['style'], 'sfm-round'); ?>><?php esc_html_e('Round', 'simple-floating-menu'); ?></option>
                                            <option value="sfm-triangle" <?php selected($sfm_settings['style'], 'sfm-triangle'); ?>><?php esc_html_e('Triangle', 'simple-floating-menu'); ?></option>
                                            <option value="sfm-rhombus" <?php selected($sfm_settings['style'], 'sfm-rhombus'); ?>><?php esc_html_e('Rhombus', 'simple-floating-menu'); ?></option>
                                            <option value="sfm-pentagon" <?php selected($sfm_settings['style'], 'sfm-pentagon'); ?>><?php esc_html_e('Pentagon', 'simple-floating-menu'); ?></option>
                                            <option value="sfm-hexagon" <?php selected($sfm_settings['style'], 'sfm-hexagon'); ?>><?php esc_html_e('Hexagon', 'simple-floating-menu'); ?></option>
                                            <option value="sfm-star" <?php selected($sfm_settings['style'], 'sfm-star'); ?>><?php esc_html_e('Star', 'simple-floating-menu'); ?></option>
                                            <option value="sfm-rabbet" <?php selected($sfm_settings['style'], 'sfm-rabbet'); ?>><?php esc_html_e('Rabbet', 'simple-floating-menu'); ?></option>
                                            <option value="sfm-oval" <?php selected($sfm_settings['style'], 'sfm-oval'); ?>><?php esc_html_e('Oval', 'simple-floating-menu'); ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="sfm-seperator"><hr></td>
                                </tr>
                                <tr>
                                    <th><label><?php esc_html_e('Button Height', 'simple-floating-menu'); ?></label></th>
                                    <td>
                                        <?php
                                        echo '<div class="sfm-range-slider">';
                                        echo '<div class="range-input"  value="' . absint($sfm_settings['button_height']) . '" data-min="40" data-max="200" data-step="1"></div>';
                                        echo '<input class="range-input-selector sfm-button-height" type="hidden" value="' . absint($sfm_settings['button_height']) . '" name="sfm_settings[button_height]"/>';
                                        echo '</div>';
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php esc_html_e('Button Width', 'simple-floating-menu'); ?></label></th>
                                    <td>
                                        <?php
                                        echo '<div class="sfm-range-slider">';
                                        echo '<div class="range-input"  value="' . absint($sfm_settings['button_width']) . '" data-min="40" data-max="200" data-step="1"></div>';
                                        echo '<input class="range-input-selector sfm-button-width" type="hidden" value="' . absint($sfm_settings['button_width']) . '" name="sfm_settings[button_width]"/>';
                                        echo '</div>';
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="sfm-seperator"><hr></td>
                                </tr>
                                <tr>
                                    <th><label><?php esc_html_e('Icon Size', 'simple-floating-menu'); ?></label></th>
                                    <td>
                                        <?php
                                        echo '<div class="sfm-range-slider">';
                                        echo '<div class="range-input"  value="' . absint($sfm_settings['icon_size']) . '" data-min="10" data-max="60" data-step="1"></div>';
                                        echo '<input class="range-input-selector sfm-icon-size" type="hidden" value="' . absint($sfm_settings['icon_size']) . '" name="sfm_settings[icon_size]"/>';
                                        echo '</div>';
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php esc_html_e('Icon Vertical Position', 'simple-floating-menu'); ?></label></th>
                                    <td>
                                        <?php
                                        echo '<div class="sfm-range-slider">';
                                        echo '<div class="range-input"  value="' . absint($sfm_settings['icon_position']) . '" data-min="-40" data-max="40" data-step="1"></div>';
                                        echo '<input class="range-input-selector sfm-icon-position" type="hidden" value="' . absint($sfm_settings['icon_position']) . '" name="sfm_settings[icon_position]"/>';
                                        echo '</div>';
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="sfm-seperator"><hr></td>
                                </tr>
                                <tr>
                                    <th><label><?php esc_html_e('Tool Tip Typography', 'simple-floating-menu'); ?></label></th>
                                    <td>
                                        <ul class="sfm-typography-fields">
                                            <li class="sfm-typography-font-family">
                                                <div class="form-row">
                                                    <label class="form-label"><?php esc_html_e('Font Family', 'simple-floating-menu'); ?></label>

                                                    <div class="form-field">
                                                        <select name="sfm_settings[tooltip_font][family]" class="typography_face">

                                                            <?php
                                                            $standard_fonts = sfm_get_standard_font_families();
                                                            if ($standard_fonts) {
                                                                ?>
                                                                <optgroup label="Standard Fonts">
                                                                    <?php foreach ($standard_fonts as $standard_font) { ?>
                                                                        <option value="<?php echo esc_attr($standard_font); ?>" <?php selected($sfm_settings['tooltip_font']['family'], $standard_font); ?> ><?php echo esc_html($standard_font); ?></option>
                                                                    <?php } ?>
                                                                </optgroup>
                                                            <?php } ?>

                                                            <?php
                                                            $google_fonts = sfm_get_google_font_families();
                                                            if ($google_fonts) {
                                                                ?>
                                                                <optgroup label="Google Fonts">
                                                                    <?php foreach ($google_fonts as $google_font) { ?>
                                                                        <option value="<?php echo esc_attr($google_font); ?>" <?php selected($sfm_settings['tooltip_font']['family'], $google_font); ?>><?php echo esc_html($google_font); ?></option>
                                                                    <?php } ?>
                                                                </optgroup>
                                                            <?php } ?>

                                                        </select>
                                                    </div>
                                                </div>
                                            </li>

                                            <li class="sfm-typography-font-style">
                                                <div class="form-row">
                                                    <label class="form-label"><?php esc_html_e('Font Style', 'simple-floating-menu'); ?></label>

                                                    <div class="form-field">
                                                        <?php
                                                        $family = $sfm_settings['tooltip_font']['family'];
                                                        $font_weights = sfm_get_font_weight_choices($family);
                                                        if ($font_weights) {
                                                            ?>
                                                            <select name="sfm_settings[tooltip_font][style]" class="typography_font_style">
                                                                <?php foreach ($font_weights as $font_weight => $font_weight_label) { ?>
                                                                    <option value="<?php echo esc_attr($font_weight); ?>" <?php selected($sfm_settings['tooltip_font']['style'], $font_weight); ?>><?php echo esc_html($font_weight_label); ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </li>

                                            <li class="sfm-typography-text-transform">
                                                <div class="form-row">
                                                    <label class="form-label"><?php esc_html_e('Text Transform', 'simple-floating-menu'); ?></label>

                                                    <div class="form-field">
                                                        <?php
                                                        $text_transforms = sfm_get_text_transform_choices();
                                                        if ($text_transforms) {
                                                            ?>
                                                            <select name="sfm_settings[tooltip_font][transform]" class="typography_text_transform">
                                                                <?php foreach ($text_transforms as $key => $value) { ?>
                                                                    <option value="<?php echo esc_attr($key) ?>" <?php selected($sfm_settings['tooltip_font']['transform'], $key); ?>><?php echo esc_html($value); ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </li>

                                            <li class="sfm-typography-text-decoration">
                                                <div class="form-row">
                                                    <label class="form-label"><?php esc_html_e('Text Decoration', 'simple-floating-menu'); ?></label>

                                                    <div class="form-field">
                                                        <?php
                                                        $text_decorations = sfm_get_text_decoration_choices();
                                                        if ($text_decorations) {
                                                            ?>
                                                            <select name="sfm_settings[tooltip_font][decoration]" class="typography_text_decoration">
                                                                <?php foreach ($text_decorations as $key => $value) { ?>
                                                                    <option value="<?php echo esc_attr($key) ?>" <?php selected($sfm_settings['tooltip_font']['decoration'], $key); ?>><?php echo esc_html($value); ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </li>

                                            <li class="sfm-typography-font-size">
                                                <div class="form-row">
                                                    <label class="form-label"><?php esc_html_e('Font Size', 'simple-floating-menu'); ?></label>

                                                    <div class="form-field">
                                                        <div class="sfm-range-slider">
                                                            <div class="range-input"  value="<?php echo absint($sfm_settings['tooltip_font']['size']); ?>" data-min="10" data-max="60" data-step="1"></div>
                                                            <input class="range-input-selector" type="hidden" value="<?php echo absint($sfm_settings['tooltip_font']['size']); ?>" name="sfm_settings[tooltip_font][size]"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>


                                            <li class="sfm-typography-line-height">
                                                <div class="form-row">
                                                    <label class="form-label"><?php esc_html_e('Line Height', 'simple-floating-menu'); ?></label>

                                                    <div class="form-field">
                                                        <div class="sfm-range-slider">
                                                            <div class="range-input"  value="<?php echo esc_attr($sfm_settings['tooltip_font']['line_height']); ?>" data-min="0.5" data-max="5" data-step="0.1"></div>
                                                            <input class="range-input-selector" type="hidden" value="<?php echo esc_attr($sfm_settings['tooltip_font']['line_height']); ?>" name="sfm_settings[tooltip_font][line_height]"/>
                                                        </div>         
                                                    </div>
                                                </div>
                                            </li>


                                            <li class="sfm-typography-letter-spacing">
                                                <div class="form-row">
                                                    <label class="form-label"><?php esc_html_e('Letter Spacing', 'simple-floating-menu'); ?></label>

                                                    <div class="form-field">
                                                        <div class="sfm-range-slider">
                                                            <div class="range-input"  value="<?php echo esc_attr($sfm_settings['tooltip_font']['letter_spacing']); ?>" data-min="-5" data-max="5" data-step="0.1"></div>
                                                            <input class="range-input-selector" type="hidden" value="<?php echo esc_attr($sfm_settings['tooltip_font']['letter_spacing']); ?>" name="sfm_settings[tooltip_font][letter_spacing]"/>
                                                        </div>   
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="sfm-seperator"><hr></td>
                                </tr>
                                <tr class="sfm-top-offset-wrap">
                                    <th><label><?php esc_html_e('Floating Menu Top Offset', 'simple-floating-menu'); ?></label></th>
                                    <td>
                                        <?php
                                        echo '<div class="sfm-range-slider">';
                                        echo '<div class="range-input"  value="' . absint($sfm_settings['top_offset']) . '" data-min="0" data-max="200" data-step="1"></div>';
                                        echo '<input class="range-input-selector sfm-top-offset" type="hidden" value="' . absint($sfm_settings['top_offset']) . '" name="sfm_settings[top_offset]"/>';
                                        echo '</div>';
                                        ?>
                                    </td>
                                </tr>

                                <tr class="sfm-bottom-offset-wrap">
                                    <th><label><?php esc_html_e('Floating Menu Bottom Offset', 'simple-floating-menu'); ?></label></th>
                                    <td>
                                        <?php
                                        echo '<div class="sfm-range-slider">';
                                        echo '<div class="range-input"  value="' . absint($sfm_settings['bottom_offset']) . '" data-min="0" data-max="200" data-step="1"></div>';
                                        echo '<input class="range-input-selector sfm-bottom-offset" type="hidden" value="' . absint($sfm_settings['bottom_offset']) . '" name="sfm_settings[bottom_offset]"/>';
                                        echo '</div>';
                                        ?>
                                    </td>
                                </tr>

                                <tr class="sfm-left-offset-wrap">
                                    <th><label><?php esc_html_e('Floating Menu Left Offset', 'simple-floating-menu'); ?></label></th>
                                    <td>
                                        <?php
                                        echo '<div class="sfm-range-slider">';
                                        echo '<div class="range-input"  value="' . absint($sfm_settings['left_offset']) . '" data-min="0" data-max="200" data-step="1"></div>';
                                        echo '<input class="range-input-selector sfm-left-offset" type="hidden" value="' . absint($sfm_settings['left_offset']) . '" name="sfm_settings[left_offset]"/>';
                                        echo '</div>';
                                        ?>
                                    </td>
                                </tr>

                                <tr class="sfm-right-offset-wrap">
                                    <th><label><?php esc_html_e('Floating Menu Right Offset', 'simple-floating-menu'); ?></label></th>
                                    <td>
                                        <?php
                                        echo '<div class="sfm-range-slider">';
                                        echo '<div class="range-input"  value="' . esc_attr($sfm_settings['right_offset']) . '" data-min="0" data-max="200" data-step="1"></div>';
                                        echo '<input class="range-input-selector sfm-right-offset" type="hidden" value="' . esc_attr($sfm_settings['right_offset']) . '" name="sfm_settings[right_offset]"/>';
                                        echo '</div>';
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="sfm-seperator"><hr></td>
                                </tr>
                                <tr>
                                    <th><label><?php esc_html_e('Spacing Between Buttons', 'simple-floating-menu'); ?></label></th>
                                    <td>
                                        <?php
                                        echo '<div class="sfm-range-slider">';
                                        echo '<div class="range-input"  value="' . absint($sfm_settings['button_spacing']) . '" data-min="0" data-max="50" data-step="1"></div>';
                                        echo '<input class="range-input-selector sfm-button-spacing" type="hidden" value="' . absint($sfm_settings['button_spacing']) . '" name="sfm_settings[button_spacing]"/>';
                                        echo '</div>';
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php esc_html_e('Z Index', 'simple-floating-menu'); ?></label></th>
                                    <td>
                                        <?php
                                        echo '<input class="sfm-z-index" type="text" value="' . absint($sfm_settings['zindex']) . '" name="sfm_settings[zindex]"/>';
                                        ?>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <p class="submit">
                            <button type="submit" name="submit" class="button button-primary"><i class="mdi mdi-content-save"></i> <?php esc_html_e('Save Settings', 'simple-floating-menu'); ?></button>
                        </p>
                    </form>

                    <div class="sfm-live-demo">
                        <?php
                        $obj = new Simple_Floating_Menu_Frontend();
                        $obj->floating_menu_html();
                        ?>
                    </div>
                </div>
            </div> <?php
        }

        public function handle_form() {
            if (!isset($_POST['sfm_nonce']) || !wp_verify_nonce($_POST['sfm_nonce'], 'sfm_nonce_update')) {
                ?>
                <div class="sfm-error-notice sfm-notice">
                    <p><?php esc_html_e('Sorry, your nonce was not correct. Please try again.', 'simple-floating-menu'); ?></p>
                </div> <?php
                exit;
            } else {
                $sfm_settings = isset($_POST['sfm_settings']) ? $_POST['sfm_settings'] : '';
                //var_dump($sfm_settings);
                $defaults = self::default_settings();

                $valid_positions = array('top-left', 'top-right', 'top-middle', 'bottom-middle', 'bottom-left', 'bottom-right', 'middle-left', 'middle-right');
                $valid_styles = array('sfm-rect', 'sfm-round', 'sfm-triangle', 'sfm-rhombus', 'sfm-pentagon', 'sfm-hexagon', 'sfm-star', 'sfm-rabbet', 'sfm-oval');
                $valid_orientation = array('vertical', 'horizontal');
                $valid_icons = array_merge(sfm_font_awesome_icon_array(), sfm_materialdesignicons_array(), sfm_essential_icon_array(), sfm_icofont_icon_array(), sfm_eleganticons_array());
                $button_height = (int) $sfm_settings['button_height'];
                $button_width = (int) $sfm_settings['button_width'];
                $icon_size = (int) $sfm_settings['icon_size'];
                $icon_position = (int) $sfm_settings['icon_position'];
                $top_offset = (int) $sfm_settings['top_offset'];
                $bottom_offset = (int) $sfm_settings['bottom_offset'];
                $left_offset = (int) $sfm_settings['left_offset'];
                $right_offset = (int) $sfm_settings['right_offset'];
                $button_spacing = (int) $sfm_settings['button_spacing'];

                $sanitize_settings['enable_sfm'] = isset($sfm_settings['enable_sfm']) ? 'yes' : 'no';
                $sanitize_settings['enable_sfm_setting'] = isset($sfm_settings['enable_sfm_setting']) ? 'yes' : 'no';
                $sanitize_settings['position'] = in_array($sfm_settings['position'], $valid_positions) ? $sfm_settings['position'] : $defaults['position'];
                $sanitize_settings['orientation'] = in_array($sfm_settings['orientation'], $valid_orientation) ? $sfm_settings['orientation'] : $defaults['orientation'];
                $sanitize_settings['style'] = in_array($sfm_settings['style'], $valid_styles) ? $sfm_settings['style'] : $defaults['style'];
                $sanitize_settings['button_height'] = ( 40 <= $button_height && $button_height <= 200 && is_int($button_height)) ? $button_height : $defaults['button_height'];
                $sanitize_settings['button_width'] = ( 40 <= $button_width && $button_width <= 200 && is_int($button_width)) ? $button_width : $defaults['button_width'];
                $sanitize_settings['icon_size'] = ( 10 <= $icon_size && $icon_size <= 60 && is_int($icon_size)) ? $icon_size : $defaults['icon_size'];
                $sanitize_settings['icon_position'] = ( -40 <= $icon_position && $icon_position <= 40 && is_int($icon_position)) ? $icon_position : $defaults['icon_position'];
                $sanitize_settings['top_offset'] = ( 0 <= $top_offset && $top_offset <= 200 && is_int($top_offset)) ? $top_offset : $defaults['top_offset'];
                $sanitize_settings['bottom_offset'] = ( 0 <= $bottom_offset && $bottom_offset <= 200 && is_int($bottom_offset)) ? $bottom_offset : $defaults['bottom_offset'];
                $sanitize_settings['left_offset'] = ( 0 <= $left_offset && $left_offset <= 200 && is_int($left_offset)) ? $left_offset : $defaults['left_offset'];
                $sanitize_settings['right_offset'] = ( 0 <= $right_offset && $right_offset <= 200 && is_int($right_offset)) ? $right_offset : $defaults['right_offset'];
                $sanitize_settings['button_spacing'] = ( 0 <= $button_spacing && $button_spacing <= 200 && is_int($button_spacing)) ? $button_spacing : $defaults['button_spacing'];
                $sanitize_settings['zindex'] = (int) $sfm_settings['zindex'];

                $buttons_settings = $sfm_settings['buttons'];

                foreach ($buttons_settings as $index => $settings) {
                    foreach ($settings as $key => $value) {
                        if ($key == 'url') {
                            $sanitize_settings['buttons'][$index][$key] = esc_url_raw($value);
                        } elseif ($key == 'tool_tip_text') {
                            $sanitize_settings['buttons'][$index][$key] = sanitize_text_field($value);
                        } elseif ($key == 'open_new_tab') {
                            $sanitize_settings['buttons'][$index][$key] = isset($value) ? true : false;
                        } elseif ($key == 'icon') {
                            $sanitize_settings['buttons'][$index][$key] = in_array($value, $valid_icons) ? $value : '';
                        } elseif ($key == 'button_bg_color' || $key == 'button_icon_color' || $key == 'button_bg_color_hover' || $key == 'button_icon_color_hover' || $key == 'tooltip_bg_color' || $key == 'tooltip_text_color') {
                            $sanitize_settings['buttons'][$index][$key] = sanitize_hex_color($value);
                        } else {
                            $sanitize_settings['buttons'][$index][$key] = sanitize_text_field($value);
                        }
                    }
                }

                $sfm_standard_font = sfm_get_standard_font_families();
                $sfm_google_font = sfm_get_google_font_families();
                $font_size = (int) $sfm_settings['tooltip_font']['size'];
                $line_height = (float) $sfm_settings['tooltip_font']['line_height'];
                $letter_spacing = (float) $sfm_settings['tooltip_font']['letter_spacing'];

                $sfm_font = array_merge($sfm_standard_font, $sfm_google_font);

                $sanitize_settings['tooltip_font']['family'] = array_key_exists($sfm_settings['tooltip_font']['family'], $sfm_font) ? $sfm_settings['tooltip_font']['family'] : $defaults['tooltip_font']['family'];
                $sanitize_settings['tooltip_font']['style'] = array_key_exists($sfm_settings['tooltip_font']['style'], sfm_get_font_weight_choices($sfm_settings['tooltip_font']['family'])) ? $sfm_settings['tooltip_font']['style'] : $defaults['tooltip_font']['style'];
                $sanitize_settings['tooltip_font']['transform'] = array_key_exists($sfm_settings['tooltip_font']['transform'], sfm_get_text_transform_choices()) ? $sfm_settings['tooltip_font']['transform'] : $defaults['tooltip_font']['transform'];
                $sanitize_settings['tooltip_font']['decoration'] = array_key_exists($sfm_settings['tooltip_font']['decoration'], sfm_get_text_decoration_choices()) ? $sfm_settings['tooltip_font']['decoration'] : $defaults['tooltip_font']['decoration'];
                $sanitize_settings['tooltip_font']['size'] = ( 10 <= $font_size && $font_size <= 60 && is_int($font_size)) ? $font_size : (int) $defaults['tooltip_font']['size'];
                $sanitize_settings['tooltip_font']['line_height'] = ( 0.5 <= $line_height && $line_height <= 5 && is_float($line_height)) ? $line_height : (float) $defaults['tooltip_font']['line_height'];
                $sanitize_settings['tooltip_font']['letter_spacing'] = ( -5 <= $letter_spacing && $letter_spacing <= 5 && is_float($letter_spacing)) ? $letter_spacing : (float) $defaults['tooltip_font']['letter_spacing'];

                update_option('sfm_settings', $sanitize_settings);
                ?>
                <div class="sfm-success-notice sfm-notice">
                    <p><?php esc_html_e('Settings saved!', 'simple-floating-menu'); ?></p>
                </div>
                <?php
            }
        }

        public function sfm_dymanic_styles() {
            echo '<style>';
            echo sfm_dymanic_styles();
            echo '</style>';
        }

    }

}

function simple_floating_menu() {
    Simple_Floating_Menu::get_instance();
}

/**
 * Init the plugin.
 */
simple_floating_menu();
