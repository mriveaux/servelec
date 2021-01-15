<?php

namespace HashElements\Modules\ContactInformation\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use HashElements\Group_Control_Header;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class ContactInformation extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'he-contact-information';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Contact Information', 'hash-elements');
    }

    /** Icon */
    public function get_icon() {
        return 'he-contact-information he-news-modules';
    }

    /** Category */
    public function get_categories() {
        return ['he-magazine-elements'];
    }

    /** Controls */
    protected function _register_controls() {


        $this->start_controls_section(
                'header', [
            'label' => esc_html__('Title', 'hash-elements'),
                ]
        );

        $this->add_group_control(
                Group_Control_Header::get_type(), [
            'name' => 'header',
            'label' => esc_html__('Header', 'hash-elements'),
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'content_section', [
            'label' => esc_html__('Contact Information', 'hash-elements'),
                ]
        );

        $this->add_control(
                'phone', [
            'label' => __('Phone', 'hash-elements'),
            'type' => Controls_Manager::TEXT,
            'default' => '+1989383939',
            'label_block' => true
                ]
        );

        $this->add_control(
                'link_phone', [
            'label' => __('Link Phone', 'hash-elements'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'hash-elements'),
            'label_off' => __('No', 'hash-elements'),
            'return_value' => 'yes',
            'default' => 'yes',
                ]
        );

        $this->add_control(
                'email', [
            'label' => __('Email', 'hash-elements'),
            'type' => Controls_Manager::TEXT,
            'default' => 'info@website.com',
            'label_block' => true
                ]
        );

        $this->add_control(
                'link_email', [
            'label' => __('Link Email', 'hash-elements'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'hash-elements'),
            'label_off' => __('No', 'hash-elements'),
            'return_value' => 'yes',
            'default' => 'yes',
                ]
        );

        $this->add_control(
                'website', [
            'label' => __('Website', 'hash-elements'),
            'type' => Controls_Manager::TEXT,
            'default' => 'http://google.com',
            'label_block' => true
                ]
        );

        $this->add_control(
                'link_website', [
            'label' => __('Link Website', 'hash-elements'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'hash-elements'),
            'label_off' => __('No', 'hash-elements'),
            'return_value' => 'yes',
            'default' => 'yes',
                ]
        );

        $this->add_control(
                'contact_address', [
            'label' => __('Contact Address', 'hash-elements'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => 'Avenue Park, California',
            'rows' => 5,
                ]
        );

        $this->add_control(
                'contact_time', [
            'label' => __('Contact Time', 'hash-elements'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => 'Sun - Friday 
9:00AM 6:00PM',
            'rows' => 5,
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'header_title_style', [
            'label' => esc_html__('Header Title', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'header_color', [
            'label' => esc_html__('Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .he-block-title' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'header_short_border_color', [
            'label' => esc_html__('Short Border Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .he-title-style3.he-block-title' => 'border-color: {{VALUE}}',
                '{{WRAPPER}} .he-title-style2.he-block-title span:before' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'header_long_border_color', [
            'label' => esc_html__('Long Border Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .he-title-style3.he-block-title:after' => 'background-color: {{VALUE}}',
                '{{WRAPPER}} .he-title-style2.he-block-title' => 'border-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'header_typography',
            'label' => esc_html__('Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .he-block-title'
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'contact_info_style', [
            'label' => esc_html__('Contact Info', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'spacing', [
            'label' => esc_html__('Spacing Between Items', 'hash-elements'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => 1
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 10,
            ],
            'selectors' => [
                '{{WRAPPER}} .he-contact-information ul li' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'content_typography',
            'label' => esc_html__('Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .he-contact-information ul li'
                ]
        );

        $this->add_control(
                'content_text_color', [
            'label' => esc_html__('Text Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .he-contact-information ul li' => 'color: {{VALUE}}'
            ],
                ]
        );

        $this->add_control(
                'content_anchor_color', [
            'label' => esc_html__('Anchor Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_2,
            ],
            'selectors' => [
                '{{WRAPPER}} .he-contact-information ul li a' => 'color: {{VALUE}}'
            ],
                ]
        );

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="he-contact-information">
            <?php
            $this->render_header();
            ?>

            <ul>
                <?php if (!empty($settings['phone'])): ?>
                    <li>
                        <i class="mdi mdi-cellphone-iphone"></i>
                        <span>
                            <?php
                            if ($settings['link_phone']) {
                                echo '<a href="tel:' . esc_html($settings['phone']) . '">';
                            }
                            ?>
                            <?php echo esc_html($settings['phone']); ?>
                            <?php
                            if ($settings['link_phone']) {
                                echo '</a>';
                            }
                            ?>
                        </span>
                    </li>
                <?php endif; ?>

                <?php if (!empty($settings['email'])): ?>
                    <li>
                        <i class="mdi mdi-email"></i>
                        <span>
                            <?php
                            if ($settings['link_email']) {
                                echo '<a href="mailto:' . esc_html($settings['email']) . '">';
                            }
                            ?>
                            <?php echo esc_html($settings['email']); ?>
                            <?php
                            if ($settings['link_email']) {
                                echo '</a>';
                            }
                            ?>
                        </span>
                    </li>
                <?php endif; ?>

                <?php if (!empty($settings['website'])): ?>
                    <li>
                        <i class="mdi mdi-earth"></i>
                        <span>
                            <?php
                            if ($settings['link_website']) {
                                echo '<a target="_blank" href="' . esc_html($settings['website']) . '">';
                            }
                            ?>
                            <?php echo esc_html($settings['website']); ?>
                            <?php
                            if ($settings['link_website']) {
                                echo '</a>';
                            }
                            ?>
                        </span>
                    </li>
                <?php endif; ?>

                <?php if (!empty($settings['contact_address'])): ?>
                    <li>
                        <i class="mdi mdi-map-marker"></i>
                        <span><?php echo wpautop(esc_html($settings['contact_address'])); ?></span>
                    </li>
                <?php endif; ?>

                <?php if (!empty($settings['contact_time'])): ?>
                    <li>
                        <i class="mdi mdi-clock-time-three"></i>
                        <span><?php echo wpautop(esc_html($settings['contact_time'])); ?></span>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
        <?php
    }

    /** Render Header */
    protected function render_header() {
        $settings = $this->get_settings();

        $this->add_render_attribute('header_attr', 'class', [
            'he-block-title',
            $settings['header_style']
                ]
        );

        $link_open = $link_close = "";
        $target = $settings['header_link']['is_external'] ? ' target="_blank"' : '';
        $nofollow = $settings['header_link']['nofollow'] ? ' rel="nofollow"' : '';

        if ($settings['header_link']['url']) {
            $link_open = '<a href="' . $settings['header_link']['url'] . '"' . $target . $nofollow . '>';
            $link_close = '</a>';
        }

        if ($settings['header_title']) {
            ?>
            <h2 <?php echo $this->get_render_attribute_string('header_attr'); ?>>
                <?php
                echo $link_open;
                echo '<span>';
                echo $settings['header_title'];
                echo '</span>';
                echo $link_close;
                ?>
            </h2>
            <?php
        }
    }

}
