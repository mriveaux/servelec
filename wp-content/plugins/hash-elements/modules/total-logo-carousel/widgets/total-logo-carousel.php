<?php

namespace HashElements\Modules\TotalLogoCarousel\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Scheme_Color;
use Elementor\Utils;
use Elementor\Repeater;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class TotalLogoCarousel extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'total-logo-carousel';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Logo Carousel', 'hash-elements');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-carousel';
    }

    /** Category */
    public function get_categories() {
        return ['he-total-elements'];
    }

    /** Controls */
    protected function _register_controls() {

        $this->start_controls_section(
                'logo_section', [
            'label' => esc_html__('Logo Section', 'hash-elements'),
                ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
                'title', [
            'label' => __('Title', 'hash-elements'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => 'Title'
                ]
        );

        $repeater->add_control(
                'image', [
            'label' => __('Choose Image', 'hash-elements'),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                'url' => Utils::get_placeholder_image_src(),
            ],
                ]
        );

        $repeater->add_control(
                'logo_link', [
            'label' => __('Logo Link', 'hash-elements'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
                ]
        );

        $this->add_control(
                'slides', [
            'label' => __('Slides', 'hash-elements'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'title_field' => '{{{ title }}}',
                ]
        );

        $this->add_control(
                'link_new_tab', [
            'label' => __('Open Link in New Tab', 'hash-elements'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'hash-elements'),
            'label_off' => __('No', 'hash-elements'),
            'return_value' => 'yes',
            'default' => 'yes',
                ]
        );

        $this->add_group_control(
                Group_Control_Image_Size::get_type(), [
            'name' => 'thumb',
            'exclude' => ['custom'],
            'include' => [],
            'default' => 'full',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'carousel_section', [
            'label' => esc_html__('Carousel Settings', 'hash-elements'),
            'tab' => Controls_Manager::TAB_CONTENT,
                ]
        );

        $this->add_control(
                'autoplay', [
            'label' => esc_html__('Autoplay', 'hash-elements'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Yes', 'hash-elements'),
            'label_off' => esc_html__('No', 'hash-elements'),
            'return_value' => 'yes',
            'default' => 'yes',
                ]
        );

        $this->add_control(
                'pause_duration', [
            'label' => esc_html__('Pause Duration', 'hash-elements'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['s'],
            'range' => [
                's' => [
                    'min' => 1,
                    'max' => 20,
                    'step' => 1
                ],
            ],
            'default' => [
                'unit' => 's',
                'size' => 5,
            ],
            'condition' => [
                'autoplay' => 'yes',
            ],
                ]
        );

        $this->add_responsive_control(
                'no_of_slides', [
            'label' => esc_html__('No of Slides', 'hash-elements'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 1,
                    'max' => 10,
                ],
            ],
            'devices' => ['desktop', 'tablet', 'mobile'],
            'desktop_default' => [
                'size' => 5,
                'unit' => 'px',
            ],
            'tablet_default' => [
                'size' => 3,
                'unit' => 'px',
            ],
            'mobile_default' => [
                'size' => 2,
                'unit' => 'px',
            ],
                ]
        );

        $this->add_responsive_control(
                'slides_margin', [
            'label' => esc_html__('Spacing Between Slides', 'hash-elements'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'devices' => ['desktop', 'tablet', 'mobile'],
            'desktop_default' => [
                'size' => 30,
                'unit' => 'px',
            ],
            'tablet_default' => [
                'size' => 30,
                'unit' => 'px',
            ],
            'mobile_default' => [
                'size' => 30,
                'unit' => 'px',
            ],
                ]
        );

        $this->add_control(
                'dots', [
            'label' => esc_html__('Nav Dots', 'hash-elements'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Show', 'hash-elements'),
            'label_off' => esc_html__('Hide', 'hash-elements'),
            'return_value' => 'yes',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'navigation_style', [
            'label' => esc_html__('Navigation', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->start_controls_tabs(
                'nav_style_tabs'
        );

        $this->start_controls_tab(
                'nav_normal_tab', [
            'label' => __('Normal', 'hash-elements'),
                ]
        );

        $this->add_control(
                'dot_bg_color', [
            'label' => esc_html__('Dots Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .het-client-logo-slider .owl-dots .owl-dot' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'nav_hover_tab', [
            'label' => __('Hover', 'hash-elements'),
                ]
        );

        $this->add_control(
                'dot_bg_color_hover', [
            'label' => esc_html__('Dots Color (Hover)', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .het-client-logo-slider .owl-dots .owl-dot:hover' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $params = array(
            'autoplay' => $settings['autoplay'] == 'yes' ? true : false,
            'pause' => (int) $settings['pause_duration']['size'] * 1000,
            'items' => (int) $settings['no_of_slides']['size'],
            'items_tablet' => (int) $settings['no_of_slides_tablet']['size'],
            'items_mobile' => (int) $settings['no_of_slides_mobile']['size'],
            'margin' => (int) $settings['slides_margin']['size'],
            'margin_tablet' => (int) $settings['slides_margin_tablet']['size'],
            'margin_mobile' => (int) $settings['slides_margin_mobile']['size'],
            'dots' => $settings['dots'] == 'yes' ? true : false
        );
        $params = json_encode($params);
        ?>
        <div class="het-client-logo-slider owl-carousel" data-params='<?php echo $params ?>'>
            <?php
            if ($settings['slides']) {
                foreach ($settings['slides'] as $item) {
                    $image_url = Group_Control_Image_Size::get_attachment_image_src($item['image']['id'], 'thumb', $settings);
                    if (!$image_url) {
                        $image_url = Utils::get_placeholder_image_src();
                    }
                    $image_html = '<img src="' . esc_attr($image_url) . '" alt="' . esc_attr(\Elementor\Control_Media::get_image_alt($item['image'])) . '" />';

                    echo '<div class="het-logo-slide">';

                    if (!empty($item['logo_link'])) {
                        ?>
                        <a href="<?php echo esc_url($item['logo_link']) ?>" target="<?php echo esc_attr($target) ?>">
                            <?php echo $image_html; ?>
                        </a>
                        <?php
                    } else {
                        echo $image_html;
                    }
                    echo '</div>';
                }
            }
            ?>
        </div>
        <?php
    }

}
