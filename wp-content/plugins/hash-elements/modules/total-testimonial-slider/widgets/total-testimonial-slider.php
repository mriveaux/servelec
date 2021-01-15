<?php

namespace HashElements\Modules\TotalTestimonialSlider\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Repeater;
use Elementor\Utils;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Tiled Posts Widget
 */
class TotalTestimonialSlider extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'total-testimonial-slider';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Testimonial Slider', 'hash-elements');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-testimonial-carousel';
    }

    /** Category */
    public function get_categories() {
        return ['he-total-elements'];
    }

    /** Controls */
    protected function _register_controls() {

        $this->start_controls_section(
                'testimonial', [
            'label' => esc_html__('Testimonial', 'hash-elements'),
                ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
                'name', [
            'label' => __('Name', 'hash-elements'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => __('John Doe', 'hash-elements'),
                ]
        );

        $repeater->add_control(
                'designation', [
            'label' => __('Designation', 'hash-elements'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => __('CEO - ABC Corp.', 'hash-elements'),
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
                'testimonial', [
            'label' => __('Testimonial', 'hash-elements'),
            'type' => Controls_Manager::TEXTAREA,
            'rows' => 10,
            'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
                ]
        );

        $this->add_control(
                'testimonial_block', [
            'label' => __('Testimonials', 'hash-elements'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'title_field' => '{{{ name }}}',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'slider_section', [
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
                'additional_settings', [
            'label' => esc_html__('Additional Settings', 'hash-elements'),
            'tab' => Controls_Manager::TAB_CONTENT,
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

        $this->end_controls_section();

        $this->start_controls_section(
                'name_style', [
            'label' => esc_html__('Name', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'name_color', [
            'label' => esc_html__('Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .het-testimonial h6' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'name_typography',
            'label' => esc_html__('Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .het-testimonial h6',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'designation_style', [
            'label' => esc_html__('Designation', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'designation_color', [
            'label' => esc_html__('Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .het-testimonial .het-testimonial-designation' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'designation_typography',
            'label' => esc_html__('Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .het-testimonial .het-testimonial-designation',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'testimonial_style', [
            'label' => esc_html__('Testimonial', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'testimonial_color', [
            'label' => esc_html__('Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .het-testimonial-excerpt ' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'testimonial_typography',
            'label' => esc_html__('Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .het-testimonial-excerpt ',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'thumb_style', [
            'label' => esc_html__('Thumbnail', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'thumb_outline_color', [
            'label' => esc_html__('Outline Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#000000',
            'selectors' => [
                '{{WRAPPER}} .het-testimonial-slider.owl-carousel .owl-item img' => 'border-color: {{VALUE}}',
            ],
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
                'nav_normal_bg_color', [
            'label' => esc_html__('Navigation Background Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#000000',
            'selectors' => [
                '{{WRAPPER}} .het-testimonial-slider.owl-carousel .owl-nav button' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'nav_icon_color', [
            'label' => esc_html__('Navigation Icon Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .het-testimonial-slider.owl-carousel .owl-nav button' => 'color: {{VALUE}}'
            ],
            'default' => '#FFFFFF',
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
            'default' => '#000000',
            'selectors' => [
                '{{WRAPPER}} .het-testimonial-slider .owl-dots .owl-dot' => 'background-color: {{VALUE}}',
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
            'default' => '#000000',
            'selectors' => [
                '{{WRAPPER}} .het-testimonial-slider.owl-carousel .owl-nav button:hover' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'nav_icon_hover_color', [
            'label' => esc_html__('Icon Color (Hover)', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#FFFFFF',
            'selectors' => [
                '{{WRAPPER}} .het-testimonial-slider.owl-carousel .owl-nav button:hover' => 'color: {{VALUE}}',
            ],
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
            'default' => '#000000',
            'selectors' => [
                '{{WRAPPER}} .het-testimonial-slider .owl-dots .owl-dot:hover' => 'background-color: {{VALUE}}',
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
        $testimonials = $settings['testimonial_block'];
        $params = array(
            'autoplay' => $settings['autoplay'] == 'yes' ? true : false,
            'pause' => (int) $settings['pause_duration']['size'] * 1000,
            'nav' => $settings['nav'] == 'yes' ? true : false,
            'dots' => $settings['dots'] == 'yes' ? true : false
        );
        $params = json_encode($params);
        ?>
        <div class="het-testimonial-slider owl-carousel" data-params='<?php echo $params ?>'>
            <?php
            foreach ($testimonials as $key => $testimonial) {
                ?>
                <div class="het-testimonial">
                    <div class="het-testimonial-excerpt">
                        <i class="fa fa-quote-left"></i>
                        <?php
                        if (isset($testimonial['testimonial']) && !empty($testimonial['testimonial'])) {
                            echo esc_html($testimonial['testimonial']);
                        }
                        ?>
                    </div>

                    <?php
                    $image_url = Group_Control_Image_Size::get_attachment_image_src($testimonial['image']['id'], 'thumbnail', $settings);
                    if (!$image_url) {
                        $image_url = Utils::get_placeholder_image_src();
                    }
                    echo '<img src="' . esc_attr($image_url) . '" alt="' . esc_attr(\Elementor\Control_Media::get_image_alt($testimonial['image'])) . '" />';
                    ?>

                    <h6><?php echo esc_html($testimonial['name']); ?></h6>

                    <?php if (isset($testimonial['designation']) && !empty($testimonial['designation'])) { ?>
                        <div class="het-testimonial-designation">
                            <?php echo esc_html($testimonial['designation']); ?>
                        </div>
                    <?php }
                    ?>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }

}
