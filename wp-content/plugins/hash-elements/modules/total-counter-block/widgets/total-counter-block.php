<?php

namespace HashElements\Modules\TotalCounterBlock\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class TotalCounterBlock extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'total-counter-block';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Counter Block', 'hash-elements');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-counter';
    }

    /** Category */
    public function get_categories() {
        return ['he-total-elements'];
    }

    /** Controls */
    protected function _register_controls() {

        $this->start_controls_section(
                'counter', [
            'label' => esc_html__('Counter', 'hash-elements'),
                ]
        );

        $this->add_control(
                'counter_icon', [
            'label' => __('Icon', 'hash-elements'),
            'type' => Controls_Manager::ICONS,
            'default' => [
                'value' => 'fas fa-star',
                'library' => 'solid',
            ],
                ]
        );


        $this->add_control(
                'counter_title', [
            'label' => __('Title', 'hash-elements'),
            'type' => Controls_Manager::TEXT,
            'default' => __('Counter Heading', 'hash-elements'),
            'label_block' => true,
                ]
        );

        $this->add_control(
                'counter_number', [
            'label' => __('Counter Number', 'hash-elements'),
            'type' => Controls_Manager::NUMBER,
            'min' => 0,
            'max' => 1000000,
            'step' => 1,
            'default' => 999,
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'icon_style', [
            'label' => esc_html__('Icon', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'icon_color', [
            'label' => esc_html__('Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#000000',
            'selectors' => [
                '{{WRAPPER}} .het-counter-icon' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'icon_size', [
            'label' => __('Icon Size', 'hash-elements'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 10,
                    'max' => 80,
                    'step' => 1,
                ]
            ],
            'default' => [
                'unit' => 'px',
                'size' => 36,
            ],
            'selectors' => [
                '{{WRAPPER}} .het-counter-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
            ],
                ]
        );

        $this->add_control(
                'border_color', [
            'label' => esc_html__('Border Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#000000',
            'selectors' => [
                '{{WRAPPER}} .het-counter' => 'border-color: {{VALUE}}',
                '{{WRAPPER}} .het-counter:before, {{WRAPPER}} .het-counter:after' => 'background: {{background}}'
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'number_style', [
            'label' => esc_html__('Number', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'number_color', [
            'label' => esc_html__('Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#000000',
            'selectors' => [
                '{{WRAPPER}} .het-counter-count' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'number_typography',
            'label' => esc_html__('Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .het-counter-count',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'title_style', [
            'label' => esc_html__('Title', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'title_color', [
            'label' => esc_html__('Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#000000',
            'selectors' => [
                '{{WRAPPER}} .het-counter-title' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'title_typography',
            'label' => esc_html__('Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .het-counter-title',
                ]
        );

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="het-counter">
            <div class="het-counter-icon">
                <?php \Elementor\Icons_Manager::render_icon($settings['counter_icon'], ['aria-hidden' => 'true']); ?>
            </div>

            <div class="het-counter-count odometer" data-count="<?php echo absint($settings['counter_number']); ?>">
                99
            </div>

            <h6 class="het-counter-title">
                <?php echo esc_html($settings['counter_title']); ?>
            </h6>
        </div>
        <?php
    }

}
