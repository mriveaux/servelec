<?php

namespace HashElements\Modules\AdvertisementBanner\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class AdvertisementBanner extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'he-advertisement-banner';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Advertisement Banner', 'hash-elements');
    }

    /** Icon */
    public function get_icon() {
        return 'he-advertisement-banner he-news-modules';
    }

    /** Category */
    public function get_categories() {
        return ['he-magazine-elements'];
    }

    /** Controls */
    protected function _register_controls() {

        $this->start_controls_section(
                'content_section', [
            'label' => esc_html__('Advertisement Banner', 'hash-elements'),
                ]
        );

        $this->add_control(
                'image', [
            'label' => __('Advertisement Image', 'hash-elements'),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                'url' => Utils::get_placeholder_image_src(),
            ],
                ]
        );

        $this->add_control(
                'link', [
            'label' => __('Advertisement Link', 'hash-elements'),
            'type' => Controls_Manager::URL,
            'placeholder' => __('https://your-link.com', 'hash-elements'),
            'show_external' => true,
            'default' => [
                'url' => '',
                'is_external' => true,
                'nofollow' => true,
            ],
            'label_block' => true
                ]
        );

        $this->add_group_control(
                Group_Control_Image_Size::get_type(), [
            'name' => 'thumbnail',
            'exclude' => ['custom'],
            'include' => [],
            'default' => 'full',
                ]
        );

        $this->add_control(
                'alignment', [
            'label' => esc_html__('Banner Alignment', 'hash-elements'),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'left' => esc_html__('Left', 'hash-elements'),
                'center' => esc_html__('Center', 'hash-elements'),
                'right' => esc_html__('Right', 'hash-elements'),
            ],
            'default' => 'left',
                ]
        );

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $link = $settings['link']['url'];
        $target = $settings['link']['is_external'] ? ' target="_blank"' : '';
        $nofollow = $settings['link']['nofollow'] ? ' rel="nofollow"' : '';
        $alignment = $settings['alignment'];
        ?>
        <div class="he-advertisement-banner he-align-<?php echo esc_attr($alignment); ?>">
            <?php
            if (!empty($link)) {
                echo '<a href="' . esc_url($settings['link']['url']) . '"' . $target . $nofollow . '>';
            }

            echo Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'image');

            if (!empty($link)) {
                echo '</a>';
            }
            ?>
        </div>
        <?php
    }

}
