<?php

namespace HashElements\Modules\SquarePlusFeaturedBlock\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Background;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class SquarePlusFeaturedBlock extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'square-plus-featured-block';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Featured Block', 'hash-elements');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-icon-box';
    }

    /** Category */
    public function get_categories() {
        return ['he-square-elements'];
    }

    /** Controls */
    protected function _register_controls() {

        $this->start_controls_section(
                'section_content', [
            'label' => esc_html__('Content', 'hash-elements'),
                ]
        );

        $this->add_control(
                'icon', [
            'label' => __('Icon', 'hash-elements'),
            'type' => Controls_Manager::ICONS,
            'default' => [
                'value' => 'fas fa-plane',
                'library' => 'solid',
            ],
                ]
        );

        $this->add_control(
                'title', [
            'label' => __('Title', 'hash-elements'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => 'Heading'
                ]
        );

        $this->add_control(
                'content', [
            'label' => __('Description', 'hash-elements'),
            'type' => Controls_Manager::TEXTAREA,
            'rows' => 10,
            'placeholder' => __('Type your description here', 'hash-elements'),
            'label_block' => true,
            'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.'
                ]
        );

        $this->add_control(
                'link', [
            'label' => __('Link', 'hash-elements'),
            'type' => Controls_Manager::URL,
            'placeholder' => __('https://your-link.com', 'hash-elements'),
            'show_external' => true,
            'default' => [
                'url' => '#',
                'is_external' => true,
                'nofollow' => true,
            ],
                ]
        );

        $this->add_control(
                'link_icon', [
            'label' => __('Read More Link Icon', 'hash-elements'),
            'type' => Controls_Manager::ICONS,
            'default' => [
                'value' => 'far fa-plus-square',
                'library' => 'regular',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'box_style', [
            'label' => esc_html__('Box Styles', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_group_control(
                Group_Control_Background::get_type(), [
            'name' => 'box_background',
            'label' => __('Background', 'hash-elements'),
            'types' => ['classic', 'gradient'],
            'selector' => '{{WRAPPER}} .he-featured-post:before',
                ]
        );

        $this->add_control(
                'box_padding', [
            'label' => esc_html__('Padding', 'hash-elements'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .he-featured-post' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
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
            'selectors' => [
                '{{WRAPPER}} .he-featured-icon i' => 'color: {{VALUE}}',
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
                'size' => 38,
            ],
            'selectors' => [
                '{{WRAPPER}} .he-featured-post .he-featured-icon' => 'font-size: {{SIZE}}{{UNIT}};',
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
                '{{WRAPPER}} .he-featured-post h4' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'title_border_color', [
            'label' => esc_html__('Border Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .he-featured-post h4:after' => 'background: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'title_typography',
            'label' => esc_html__('Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .he-featured-post h4',
                ]
        );

        $this->add_control(
                'title_margin', [
            'label' => esc_html__('Margin', 'hash-elements'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .he-featured-post h4' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'content_style', [
            'label' => esc_html__('Content', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'content_color', [
            'label' => esc_html__('Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .he-featured-excerpt' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'content_typography',
            'label' => esc_html__('Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .he-featured-excerpt',
                ]
        );

        $this->add_control(
                'content_margin', [
            'label' => esc_html__('Margin', 'hash-elements'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .he-featured-excerpt' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'link_style', [
            'label' => esc_html__('Read More Link', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'link_icon_size', [
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
                'size' => 26,
            ],
            'selectors' => [
                '{{WRAPPER}} .he-featured-readmore' => 'font-size: {{SIZE}}{{UNIT}};',
            ],
                ]
        );

        $this->add_control(
                'link_color', [
            'label' => esc_html__('Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} a.he-featured-readmore i' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'link_hover_color', [
            'label' => esc_html__('Hover Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} a.he-featured-readmore:hover i' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="he-featured-post">
            <div class="he-featured-icon">
                <?php \Elementor\Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']); ?>
            </div>

            <?php
            if (isset($settings['title']) && !empty($settings['title'])) {
                ?>
                <h4><?php echo esc_html($settings['title']); ?></h4>
                <?php
            }
            ?>

            <?php
            if (isset($settings['content']) && !empty($settings['content'])) {
                ?>
                <div class="he-featured-excerpt">
                    <?php
                    echo esc_html($settings['content']);
                    ?>
                </div>
                <?php
            }
            ?>

            <?php
            if (isset($settings['link']['url']) && !empty($settings['link']['url'])) {
                $target = $settings['link']['is_external'] ? ' target="_blank"' : '';
                $nofollow = $settings['link']['nofollow'] ? ' rel="nofollow"' : '';
                ?>
                <a href="<?php echo esc_url($settings['link']['url']); ?>" class="he-featured-readmore"<?php echo $target . $nofollow; ?>>
                    <?php \Elementor\Icons_Manager::render_icon($settings['link_icon'], ['aria-hidden' => 'true']); ?>
                </a>
                <?php
            }
            ?>
        </div>
        <?php
    }

}
