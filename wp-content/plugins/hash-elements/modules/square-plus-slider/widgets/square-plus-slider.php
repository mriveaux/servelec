<?php

namespace HashElements\Modules\SquarePlusSlider\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Utils;
use Elementor\Repeater;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class SquarePlusSlider extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'square-plus-slider';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Slider', 'hash-elements');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-post-slider';
    }

    /** Category */
    public function get_categories() {
        return ['he-square-elements'];
    }

    /** Controls */
    protected function _register_controls() {

        $this->start_controls_section(
                'slider', [
            'label' => esc_html__('Slider', 'hash-elements'),
                ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
                'slider_image', [
            'label' => __('Choose Image', 'hash-elements'),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                'url' => Utils::get_placeholder_image_src(),
            ],
                ]
        );

        $repeater->add_control(
                'slider_title', [
            'label' => __('Title', 'hash-elements'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => __('Slider Title', 'hash-elements'),
                ]
        );

        $repeater->add_control(
                'slider_description', [
            'label' => __('Description', 'hash-elements'),
            'type' => Controls_Manager::TEXTAREA,
            'rows' => 5,
            'default' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'hash-elements'),
                ]
        );

        $repeater->add_control(
                'button_text', [
            'label' => __('Button Text', 'hash-elements'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => __('Read More', 'hash-elements'),
                ]
        );

        $repeater->add_control(
                'button_link', [
            'label' => __('Button Link', 'hash-elements'),
            'type' => Controls_Manager::URL,
            'placeholder' => __('Enter URL', 'hash-elements'),
            'show_external' => true,
            'default' => [
                'url' => '',
                'is_external' => true,
                'nofollow' => true,
            ],
                ]
        );

        $this->add_control(
                'slider_block', [
            'label' => __('Sliders', 'hash-elements'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                [
                    'slider_title' => __('Title', 'hash-elements'),
                ]
            ],
            'title_field' => '{{{ slider_title }}}',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'slider_settings', [
            'label' => esc_html__('Slider Settings', 'hash-elements'),
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
            'label' => esc_html__('Pause Duration (In Seconds)', 'hash-elements'),
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

        $this->add_control(
                'nav', [
            'label' => esc_html__('Nav Arrow', 'hash-elements'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Show', 'hash-elements'),
            'label_off' => esc_html__('Hide', 'hash-elements'),
            'return_value' => 'yes',
            'default' => 'yes'
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'caption_style', [
            'label' => esc_html__('Caption', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'caption_bg_color', [
            'label' => esc_html__('Background Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .he-slide-caption' => 'background: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'caption_border_color', [
            'label' => esc_html__('Side Border Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .he-slide-caption' => 'border-left: 3px solid {{VALUE}}; border-right: 3px solid {{VALUE}}',
            ],
            'separator' => 'after'
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'title_typography',
            'label' => esc_html__('Title Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .he-slide-cap-title',
                ]
        );

        $this->add_control(
                'title_color', [
            'label' => esc_html__('Title Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .he-slide-cap-title' => 'color: {{VALUE}}',
            ],
            'separator' => 'after'
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'description_typography',
            'label' => esc_html__('SubTitle Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .he-slide-cap-desc',
                ]
        );

        $this->add_control(
                'description_color', [
            'label' => esc_html__('SubTitle Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .he-slide-cap-desc' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'button_style', [
            'label' => esc_html__('Button', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'button_typography',
            'label' => esc_html__('Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .he-slide-cap-button a',
                ]
        );

        $this->add_control(
                'button_padding', [
            'label' => esc_html__('Padding', 'hash-elements'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .he-slide-cap-button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
                ]
        );

        $this->start_controls_tabs(
                'button_style_tabs'
        );

        $this->start_controls_tab(
                'button_normal_tab', [
            'label' => __('Normal', 'hash-elements'),
                ]
        );

        $this->add_control(
                'button_bg_color', [
            'label' => esc_html__('Background Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .he-slide-cap-button a' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'button_color', [
            'label' => esc_html__('Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .he-slide-cap-button a' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'button_hover_tab', [
            'label' => __('Hover', 'hash-elements'),
                ]
        );

        $this->add_control(
                'button_bg_hover_color', [
            'label' => esc_html__('Background Color (Hover)', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .he-slide-cap-button a:hover' => 'background: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'button_hover_color', [
            'label' => esc_html__('Text Color (Hover)', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .he-slide-cap-button a:hover' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

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
                'nav_normal_bg_color', [
            'label' => esc_html__('Background Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .he-bx-slider.owl-carousel .owl-nav button' => 'background: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'nav_normal_color', [
            'label' => esc_html__('Icon Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .he-bx-slider.owl-carousel .owl-nav button i' => 'color: {{VALUE}}',
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
                'nav_hover_bg_color', [
            'label' => esc_html__('Background Color (Hover)', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .he-bx-slider.owl-carousel .owl-nav button:hover' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'nav_hover_color', [
            'label' => esc_html__('Icon Color (Hover)', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .he-bx-slider.owl-carousel .owl-nav button:hover i' => 'color: {{VALUE}}',
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
        $pause_duration = ( isset($settings['pause_duration']['size']) ) ? $settings['pause_duration']['size'] * 1000 : 5000;
        $sliders = $settings['slider_block'];
        $params = array(
            'autoplay' => $settings['autoplay'] == 'yes' ? true : false,
            'pause' => (int) $pause_duration,
            'nav' => $settings['nav'] == 'yes' ? true : false
        );
        $params = json_encode($params);
        ?>
        <div class="he-bx-slider owl-carousel" data-params='<?php echo $params ?>'>
            <?php
            if ($sliders) {
                foreach ($sliders as $slider) {
                    ?>
                    <div class="he-slide">
                        <img src="<?php echo esc_url($slider['slider_image']['url']); ?>" alt="<?php echo esc_attr($slider['slider_title']); ?>">

                        <?php if ($slider['slider_title'] || $slider['slider_description']) { ?>
                            <div class="he-container">
                                <div class="he-slide-caption">
                                    <div class="he-slide-cap-title">
                                        <?php echo esc_html($slider['slider_title']); ?>
                                    </div>

                                    <div class="he-slide-cap-desc">
                                        <?php echo esc_html($slider['slider_description']); ?>

                                        <?php
                                        if (!empty($slider['button_link']['url'])) {
                                            $target = $slider['button_link']['is_external'] ? ' target="_blank"' : '';
                                            $nofollow = $slider['button_link']['nofollow'] ? ' rel="nofollow"' : '';
                                            ?>
                                            <div class="he-slide-cap-button">
                                                <a href="<?php echo esc_url($slider['button_link']['url']); ?>"<?php echo $target . $nofollow; ?>><?php echo esc_html($slider['button_text']); ?></a>
                                            </div>
                                        <?php } ?>
                                    </div>

                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <div class="he-banner-shadow"><img src="<?php echo esc_url(HASHELE_URL . '/assets/img/banner-shadow.png'); ?>" alt="<?php esc_attr_e('Banner Shadow', 'hash-elements'); ?>"></div>
        <?php
    }

}
