<?php
if (!class_exists('Simple_Floating_Menu_Frontend')) {

    class Simple_Floating_Menu_Frontend {

        /**
         * Initialize the plugin.
         */
        public function __construct() {
            add_action('wp_footer', array($this, 'floating_menu_html'));

            // Add necesary CSS/JS
            add_action('wp_enqueue_scripts', array($this, 'load_scripts'));
        }

        public function load_scripts() {
            wp_enqueue_style('sfm-fontawesome', SFM_URL . 'assets/css/all.css', array(), '1.0.0');
            wp_enqueue_style('sfm-eleganticons', SFM_URL . 'assets/css/eleganticons.css', array(), '1.0.0');
            wp_enqueue_style('sfm-essential-icon', SFM_URL . 'assets/css/essential-icon.css', array(), '1.0.0');
            wp_enqueue_style('sfm-iconfont', SFM_URL . 'assets/css/icofont.css', array(), '1.0.0');
            wp_enqueue_style('sfm-materialdesignicons', SFM_URL . 'assets/css/materialdesignicons.css', array(), '1.0.0');
            wp_enqueue_style('sfm-style', SFM_URL . 'assets/css/style.css', array(), '1.0.0');
            wp_enqueue_style('sfm-fonts', self::sfm_fonts_url(), array(), '1.00');
            wp_add_inline_style('sfm-style', sfm_dymanic_styles());

            wp_enqueue_script('sfm-custom-scripts', SFM_URL . 'assets/js/custom-scripts.js', array(), '1.0.0', true);
        }

        public function floating_menu_html() {
            $class = array('sfm-floating-menu');
            $settings = Simple_Floating_Menu::get_settings();
            $buttons = $settings['buttons'];
            $enable_sfm = $settings['enable_sfm'];
            $enable_sfm_setting = $settings['enable_sfm_setting'];
            $class[] = isset($settings['position']) && $settings['position'] ? $settings['position'] : '';
            $class[] = isset($settings['style']) && $settings['style'] ? $settings['style'] : '';
            $class[] = isset($settings['orientation']) && $settings['orientation'] ? $settings['orientation'] : '';
            if ((is_admin() || $enable_sfm == 'yes') && $buttons) {
                ?>
                <div class="<?php echo esc_attr(implode(' ', $class)); ?>">
                    <?php if (current_user_can('administrator') && $enable_sfm_setting == 'yes') { ?>
                        <div class="sfm-button sfm-edit">
                            <div class="sfm-tool-tip"><a href="<?php echo admin_url('admin.php?page=simple-floating-menu') ?>"><?php echo esc_html__('Edit', 'simple-floating-menu') ?></a></div>
                            <a class="sfm-shape-button" target="_blank" href="<?php echo admin_url('admin.php?page=simple-floating-menu') ?>"><i class="icofont-gear"></i></a>
                        </div>
                    <?php } ?>

                    <?php
                    foreach ($buttons as $button) {
                        if ($button['url']) {
                            $target = isset($button['open_new_tab']) && $button['open_new_tab'] ? 'target="_blank"' : '';
                            $unique_id = $button['id'];
                            ?>
                            <div class="sfm-button <?php echo esc_attr($unique_id); ?>">
                                <?php if ($button['tool_tip_text']) { ?>
                                    <div class="sfm-tool-tip"><a <?php echo $target; ?> href="<?php echo esc_url($button['url']) ?>"><?php echo esc_html($button['tool_tip_text']) ?></a></div>
                                <?php } ?>
                                <a class="sfm-shape-button" <?php echo $target; ?> href="<?php echo esc_url($button['url']) ?>"><i class="<?php echo esc_attr($button['icon']) ?>"></i></a>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
                <?php
            }
        }

        public static function sfm_fonts_url() {
            $fonts_url = '';
            $settings = Simple_Floating_Menu::get_settings();
            $standard_font_family = array();
            $subsets = 'latin,latin-ext';

            /*
             * Translators: To add an additional character subset specific to your language,
             * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
             */
            $subset = _x('no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'simple-floating-menu');

            if ('cyrillic' == $subset) {
                $subsets .= ',cyrillic,cyrillic-ext';
            } elseif ('greek' == $subset) {
                $subsets .= ',greek,greek-ext';
            } elseif ('devanagari' == $subset) {
                $subsets .= ',devanagari';
            } elseif ('vietnamese' == $subset) {
                $subsets .= ',vietnamese';
            }
            $standard_font = sfm_standard_font_array();
            $google_font = sfm_google_font_array();

            foreach ($standard_font as $key => $value) {
                $standard_font_family[] = $value['family'];
            }

            if (isset($settings['tooltip_font']['family'])) {
                $font_family = $settings['tooltip_font']['family'];
                if (!in_array($font_family, $standard_font_family)) {
                    $font_array = sfm_search_key($google_font, 'family', $font_family);
                    $variants_array = $font_array['0']['variants'];
                    $variants_keys = array_keys($variants_array);
                    $variants = implode(',', $variants_keys);
                    $fonts = $font_family . ':' . str_replace('italic', 'i', $variants);
                    $fonts_url = add_query_arg(array(
                        'family' => urlencode($fonts),
                        'subset' => urlencode($subsets),
                            ), '//fonts.googleapis.com/css');
                }
            }

            return $fonts_url;
        }

    }

}

new Simple_Floating_Menu_Frontend;
