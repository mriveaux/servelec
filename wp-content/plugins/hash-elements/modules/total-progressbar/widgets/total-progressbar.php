<?php

namespace HashElements\Modules\TotalProgressbar\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Repeater;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class TotalProgressbar extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'total-progressbar';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Progress Bar', 'hash-elements');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-skill-bar';
    }

    /** Category */
    public function get_categories() {
        return ['he-total-elements'];
    }

    /** Controls */
    protected function _register_controls() {

        $this->start_controls_section(
                'progressbar', [
            'label' => esc_html__('Progress Bars', 'hash-elements'),
                ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
                'progressbar_title', [
            'label' => __('Title', 'hash-elements'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
                ]
        );

        $repeater->add_control(
                'progressbar_percentage', [
            'label' => __('Percentage', 'hash-elements'),
            'type' => Controls_Manager::NUMBER,
            'min' => 0,
            'max' => 100,
            'step' => 1,
            'default' => 90,
                ]
        );

        $this->add_control(
                'progressbar_block', [
            'label' => __('Progress Bars', 'hash-elements'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                [
                    'progressbar_title' => __('Progress Bar #1', 'hash-elements'),
                ]
            ],
            'title_field' => '{{{ progressbar_title }}}',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'progressbar_style', [
            'label' => esc_html__('Progress Bar', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'progressbar_bg_color', [
            'label' => esc_html__('Background Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .het-progress-bar' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'progressbar_active_bg_color', [
            'label' => esc_html__('Active Background Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .het-progress-bar-length' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'progressbar_spacing', [
            'label' => __('Spacing between Progress bars (px)', 'hash-elements'),
            'type' => Controls_Manager::NUMBER,
            'min' => 0,
            'max' => 100,
            'step' => 1,
            'default' => 20,
            'selectors' => [
                '{{WRAPPER}} .het-progress' => 'margin-bottom: {{VALUE}}px',
            ],
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
            'selectors' => [
                '{{WRAPPER}} .het-progress h6' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'title_typography',
            'label' => esc_html__('Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .het-progress h6',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'percentage_style', [
            'label' => esc_html__('Percentage', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'progressbar_color', [
            'label' => esc_html__('Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .het-progress-bar-length span' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'progressbar_typography',
            'label' => esc_html__('Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .het-progress-bar-length span',
                ]
        );

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $progressbars = $settings['progressbar_block'];
        ?>
        <div class="het-about-sec">
            <div class="het-progress-bar-sec">
                <?php
                foreach ($progressbars as $key => $progressbar) {
                    ?>
                    <div class="het-progress">
                        <h6><?php echo esc_html($progressbar['progressbar_title']); ?></h6>
                        <div class="het-progress-bar">
                            <div class="het-progress-bar-length" style="width:<?php echo absint($progressbar['progressbar_percentage']); ?>%">
                                <span><?php echo absint($progressbar['progressbar_percentage']) . "%"; ?></span>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>          
        <?php
    }

}
