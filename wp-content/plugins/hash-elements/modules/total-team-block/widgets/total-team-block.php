<?php

namespace HashElements\Modules\TotalTeamBlock\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Utils;
use Elementor\Repeater;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class TotalTeamBlock extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'total-team-block';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Team Block', 'hash-elements');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-image-box';
    }

    /** Category */
    public function get_categories() {
        return ['he-total-elements'];
    }

    /** Controls */
    protected function _register_controls() {

        $this->start_controls_section(
                'team', [
            'label' => esc_html__('Team', 'hash-elements'),
                ]
        );

        $this->add_control(
                'member_image', [
            'label' => __('Choose Photo', 'hash-elements'),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                'url' => Utils::get_placeholder_image_src(),
            ],
                ]
        );

        $this->add_control(
                'member_name', [
            'label' => __('Name', 'hash-elements'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => __('John Doe', 'hash-elements'),
                ]
        );

        $this->add_control(
                'member_designation', [
            'label' => __('Designations', 'hash-elements'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => __('Engineer', 'hash-elements'),
                ]
        );

        $this->add_control(
                'member_description', [
            'label' => __('Description', 'hash-elements'),
            'type' => Controls_Manager::TEXTAREA,
            'rows' => 10,
            'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.'
                ]
        );


        $this->add_control(
                'button_text', [
            'label' => __('Button Text', 'hash-elements'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => __('Read More', 'hash-elements'),
                ]
        );

        $this->add_control(
                'button_link', [
            'label' => __('Button Link', 'hash-elements'),
            'type' => Controls_Manager::URL,
            'placeholder' => __('Enter URL', 'hash-elements'),
            'show_external' => true,
            'default' => [
                'url' => '#',
                'is_external' => false,
                'nofollow' => true,
            ],
                ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
                'social_icon_title', [
            'label' => __('Title', 'hash-elements'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
                ]
        );

        $repeater->add_control(
                'social_icon', [
            'label' => __('Social Icon', 'hash-elements'),
            'type' => Controls_Manager::ICONS,
                ]
        );

        $repeater->add_control(
                'social_icon_link', [
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
                'social_icons_block', [
            'label' => __('Add Social Icons', 'hash-elements'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                [
                    'social_icon_title' => __('Facebook', 'hash-elements'),
                    'social_icon' => [
                        'value' => 'fab fa-facebook-f',
                        'library' => 'brand',
                    ],
                    'social_icon_link' => [
                        'url' => '#',
                        'is_external' => true,
                        'nofollow' => true,
                    ]
                ]
            ],
            'title_field' => '{{{ social_icon_title }}}',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'additional Settings', [
            'label' => esc_html__('Additional Settings', 'hash-elements'),
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
                'title_style', [
            'label' => esc_html__('Title', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'title_bg_color', [
            'label' => esc_html__('Background Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#000',
            'selectors' => [
                '{{WRAPPER}} .het-title-wrap' => 'background: {{VALUE}}',
            ],
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
            'default' => '#FFF',
            'selectors' => [
                '{{WRAPPER}} .het-team-member .het-title-wrap h6' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'title_typography',
            'label' => esc_html__('Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .het-team-member .het-title-wrap h6',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'overlay_style', [
            'label' => esc_html__('Hover Overlay', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'overlay_bg_color', [
            'label' => esc_html__('Background Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#000000',
            'selectors' => [
                '{{WRAPPER}} .het-team-member-excerpt' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'overlay_text_color', [
            'label' => esc_html__('Text Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#FFFFFF',
            'selectors' => [
                '{{WRAPPER}} .het-team-member-excerpt *' => 'color: {{VALUE}}',
                '{{WRAPPER}} .het-team-member .het-team-member-excerpt h6:after' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'overlay_title_typography',
            'label' => esc_html__('Title Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .het-team-member-excerpt h6',
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'designation_typography',
            'label' => esc_html__('Designation Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .het-team-member .het-team-designation',
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'description_typography',
            'label' => esc_html__('Description Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .het-member-description-text',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'button_style', [
            'label' => esc_html__('Read More Button', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'button_typography',
            'label' => esc_html__('Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .het-team-detail a',
                ]
        );

        $this->add_control(
                'button_padding', [
            'label' => esc_html__('Padding', 'hash-elements'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .het-team-detail a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
                ]
        );

        $this->start_controls_tabs(
                'button_style_tabs'
        );

        $this->start_controls_tab(
                'normal_button_tab', [
            'label' => __('Normal', 'hash-elements'),
                ]
        );

        $this->add_control(
                'normal_button_bg_color', [
            'label' => esc_html__('Background Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#FFFFFF',
            'selectors' => [
                '{{WRAPPER}} .het-team-detail a' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'normal_button_text_color', [
            'label' => esc_html__('Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#333333',
            'selectors' => [
                '{{WRAPPER}} .het-team-detail a' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'hover_button_tab', [
            'label' => __('Hover', 'hash-elements'),
                ]
        );

        $this->add_control(
                'hover_button_bg_color', [
            'label' => esc_html__('Background Color (Hover)', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#333',
            'selectors' => [
                '{{WRAPPER}} .het-team-detail a:hover' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'hover_button_text_color', [
            'label' => esc_html__('Color (Hover)', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#FFF',
            'selectors' => [
                '{{WRAPPER}} .het-team-detail a:hover' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
                'social_icon_style', [
            'label' => esc_html__('Social Icon', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->start_controls_tabs(
                'social_icon_style_tabs'
        );

        $this->start_controls_tab(
                'normal_social_btn_tab', [
            'label' => __('Normal', 'hash-elements'),
                ]
        );

        $this->add_control(
                'normal_social_btn_bg_color', [
            'label' => esc_html__('Background Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#000000',
            'selectors' => [
                '{{WRAPPER}} .het-team-social-id a' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'normal_social_btn_icon_color', [
            'label' => esc_html__('Icon Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#FFFFFF',
            'selectors' => [
                '{{WRAPPER}} .het-team-social-id a' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'hover_social_btn_tab', [
            'label' => __('Hover', 'hash-elements'),
                ]
        );

        $this->add_control(
                'hover_social_btn_bg_color', [
            'label' => esc_html__('Background Color (Hover)', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#333',
            'selectors' => [
                '{{WRAPPER}} .het-team-social-id a:hover' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'hover_social_btn_icon_color', [
            'label' => esc_html__('Icon Color (Hover)', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#FFFFFF',
            'selectors' => [
                '{{WRAPPER}} .het-team-social-id a:hover' => 'color: {{VALUE}}',
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
        $social_icons_block = $settings['social_icons_block'];
        $target = $settings['button_link']['is_external'] ? ' target="_blank"' : '';
        $nofollow = $settings['button_link']['nofollow'] ? ' rel="nofollow"' : '';
        ?>
        <div class="het-team-member">

            <div class="het-team-member-image">
                <?php
                echo Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'member_image');
                ?>

                <div class="het-title-wrap">
                    <h6><?php echo esc_attr($settings['member_name']); ?></h6>
                </div>

                <div class="het-team-member-excerpt">
                    <div class="het-team-member-excerpt-wrap">
                        <h6><?php echo esc_attr($settings['member_name']); ?></h6>

                        <?php if ($settings['member_designation']) { ?>
                            <div class="het-team-designation"><?php echo esc_html($settings['member_designation']); ?></div>
                        <?php } ?>

                        <?php
                        if (isset($settings['member_description']) && !empty($settings['member_description'])) {
                            echo '<div class="het-member-description-text">';
                            echo esc_html($settings['member_description']);
                            echo '</div>';
                        }
                        ?>
                        <div class="het-team-detail">
                            <a href="<?php echo esc_url($settings['button_link']['url']); ?>"<?php echo $target . $nofollow; ?>>
                                <?php esc_html_e($settings['button_text']) ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>  

            <?php
            if (isset($social_icons_block) && !empty($social_icons_block)) {
                ?>
                <div class="het-team-social-id">
                    <?php
                    foreach ($social_icons_block as $key => $icon_block) {
                        $target = $icon_block['social_icon_link']['is_external'] ? ' target="_blank"' : '';
                        $nofollow = $icon_block['social_icon_link']['nofollow'] ? ' rel="nofollow"' : '';
                        ?>
                        <a target="_blank" href="<?php echo esc_url($icon_block['social_icon_link']['url']) ?>"<?php echo $target . $nofollow; ?>>
                            <?php \Elementor\Icons_Manager::render_icon($icon_block['social_icon'], ['aria-hidden' => 'true']); ?>
                        </a>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
        <?php
    }

}
