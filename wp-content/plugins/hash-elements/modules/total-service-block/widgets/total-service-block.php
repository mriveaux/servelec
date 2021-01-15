<?php

namespace HashElements\Modules\TotalServiceBlock\Widgets;

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

class TotalServiceBlock extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'total-service-block';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Services Block', 'hash-elements');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-toggle';
    }

    /** Category */
    public function get_categories() {
        return ['he-total-elements'];
    }

    /** Controls */
    protected function _register_controls() {

        $this->start_controls_section(
                'services', [
            'label' => esc_html__('Services', 'hash-elements'),
                ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
                'icon', [
            'label' => __('Icon', 'hash-elements'),
            'type' => Controls_Manager::ICONS,
            'default' => [
                'value' => 'fas fa-star',
                'library' => 'solid',
            ],
                ]
        );

        $repeater->add_control(
                'services_title', [
            'label' => __('Title', 'hash-elements'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => 'Heading'
                ]
        );

        $repeater->add_control(
                'services_description', [
            'label' => __('Description', 'hash-elements'),
            'type' => Controls_Manager::TEXTAREA,
            'rows' => 8,
            'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.'
                ]
        );

        $repeater->add_control(
                'button_text', [
            'label' => __('Button Text', 'hash-elements'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => __('Read More', 'hash-elements')
                ]
        );

        $repeater->add_control(
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

        $this->add_control(
                'services_block', [
            'label' => __('Services', 'hash-elements'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                [
                    'services_title' => __('Heading', 'hash-elements'),
                    'services_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
                    'button_link' => [
                        'url' => '#',
                        'is_external' => false,
                        'nofollow' => true,
                    ],
                    'button_text' => __('Read More', 'hash-elements')
                ]
            ],
            'title_field' => '{{{ services_title }}}',
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
                'icon_bg_color', [
            'label' => esc_html__('Background Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#000',
            'selectors' => [
                '{{WRAPPER}} .het-service-icon, {{WRAPPER}} .het-service-post-wrap:after' => 'background-color: {{VALUE}}',
                '{{WRAPPER}} .het-active .het-service-icon' => 'box-shadow: 0px 0px 0px 2px #FFF, 0px 0px 0px 4px {{VALUE}}'
            ],
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
            'default' => '#FFF',
            'selectors' => [
                '{{WRAPPER}} .het-service-icon i' => 'color: {{VALUE}}',
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
                '{{WRAPPER}} .het-service-excerpt h5' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'title_typography',
            'label' => esc_html__('Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .het-service-excerpt h5',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'description_style', [
            'label' => esc_html__('Description', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'description_color', [
            'label' => esc_html__('Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .het-service-excerpt-text' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'description_typography',
            'label' => esc_html__('Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .het-service-excerpt-text',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'link_style', [
            'label' => esc_html__('Link', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'link_typography',
            'label' => esc_html__('Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .het-service-text a',
                ]
        );

        $this->start_controls_tabs(
                'link_style_tabs'
        );

        $this->start_controls_tab(
                'normal_link_tab', [
            'label' => __('Normal', 'hash-elements'),
                ]
        );

        $this->add_control(
                'normal_link_icon_color', [
            'label' => esc_html__('Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .het-service-text a' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'hover_link_tab', [
            'label' => __('Hover', 'hash-elements'),
                ]
        );

        $this->add_control(
                'hover_link_icon_color', [
            'label' => esc_html__('Color (Hover)', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .het-service-text a:hover' => 'color: {{VALUE}}',
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
        ?>
        <div class="het-service-post-wrap">
            <?php
            foreach ($settings['services_block'] as $key => $service) {
                ?>
                <div class="het-service-post he-clearfix">
                    <div class="het-service-icon">
                        <?php \Elementor\Icons_Manager::render_icon($service['icon'], ['aria-hidden' => 'true']); ?>
                    </div>

                    <div class="het-service-excerpt">
                        <h5><?php echo esc_attr($service['services_title']); ?></h5>

                        <div class="het-service-text">
                            <div class="het-service-excerpt-text">
                                <?php
                                if (isset($service['services_description']) && !empty($service['services_description'])) {
                                    echo esc_html($service['services_description']);
                                }
                                ?>
                            </div>

                            <?php
                            if (!empty($service['button_link']['url'])) {
                                $target = $service['button_link']['is_external'] ? ' target="_blank"' : '';
                                $nofollow = $service['button_link']['nofollow'] ? ' rel="nofollow"' : '';
                                ?>
                                <div class="het-service-link">
                                    <a href="<?php echo esc_url($service['button_link']['url']); ?>" <?php echo $target . $nofollow; ?>>
                                        <?php echo esc_html($service['button_text']); ?> <i class="fas fa-chevron-right" aria-hidden="true"></i>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }

}
