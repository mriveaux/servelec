<?php

namespace HashElements\Modules\TimelineModule\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use HashElements\Group_Control_Query;
use HashElements\Group_Control_Header;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class TimelineModule extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'he-timeline-module';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Timeline Module', 'hash-elements');
    }

    /** Icon */
    public function get_icon() {
        return 'he-timeline-module he-news-modules';
    }

    /** Category */
    public function get_categories() {
        return ['he-magazine-elements'];
    }

    /** Controls */
    protected function _register_controls() {


        $this->start_controls_section(
                'header', [
            'label' => esc_html__('Header', 'hash-elements'),
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
                'section_post_query', [
            'label' => esc_html__('Content Filter', 'hash-elements'),
                ]
        );

        $this->add_group_control(
                Group_Control_Query::get_type(), [
            'name' => 'posts',
            'label' => esc_html__('Posts', 'hash-elements'),
                ]
        );

        $this->add_control(
                'posts_number', [
            'label' => __('No of Posts', 'hash-elements'),
            'type' => Controls_Manager::NUMBER,
            'min' => 5,
            'max' => 20,
            'step' => 1,
            'default' => 5,
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_post_block', [
            'label' => esc_html__('Post Block', 'hash-elements'),
                ]
        );

        $this->add_control('post_excerpt_length', [
            'label' => esc_html__('Excerpt Length', 'hash-elements'),
            'description' => esc_html__('Enter 0 to hide excerpt', 'hash-elements'),
            'type' => Controls_Manager::NUMBER,
            'min' => 0,
            'default' => 0
        ]);

        $this->add_control(
                'post_author', [
            'label' => esc_html__('Show Post Author', 'hash-elements'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Yes', 'hash-elements'),
            'label_off' => esc_html__('No', 'hash-elements'),
            'return_value' => 'yes',
            'separator' => 'before'
                ]
        );

        $this->add_control(
                'post_date', [
            'label' => esc_html__('Show Post Date', 'hash-elements'),
            'type' => Controls_Manager::SWITCHER,
            'default' => 'yes',
            'label_on' => esc_html__('Yes', 'hash-elements'),
            'label_off' => esc_html__('No', 'hash-elements'),
            'return_value' => 'yes',
                ]
        );

        $this->add_control(
                'post_comment', [
            'label' => esc_html__('Show Post Comments', 'hash-elements'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Yes', 'hash-elements'),
            'label_off' => esc_html__('No', 'hash-elements'),
            'return_value' => 'yes',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'additional_settings', [
            'label' => esc_html__('Additional Settings', 'hash-elements'),
                ]
        );

        $this->add_control(
                'date_format', [
            'label' => esc_html__('Date Format', 'hash-elements'),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'relative_format' => esc_html__('Relative Format (Ago)', 'hash-elements'),
                'default' => esc_html__('WordPress Default Format', 'hash-elements'),
                'custom' => esc_html__('Custom Format', 'hash-elements'),
            ],
            'default' => 'default',
            'separator' => 'before',
            'label_block' => true
                ]
        );

        $this->add_control(
                'custom_date_format', [
            'label' => esc_html__('Custom Date Format', 'hash-elements'),
            'type' => Controls_Manager::TEXT,
            'default' => 'F j, Y',
            'placeholder' => esc_html__('F j, Y', 'hash-elements'),
            'condition' => [
                'date_format' => 'custom'
            ]
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
                'post_title_style', [
            'label' => esc_html__('Title', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
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
                '{{WRAPPER}} .he-timeline .he-post-item h3' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'title_hover_color', [
            'label' => esc_html__('Title Color (Hover)', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .he-timeline .he-post-item h3 a:hover' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'title_typography',
            'label' => esc_html__('Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .he-timeline .he-post-item h3',
                ]
        );

        $this->add_control(
                'title_margin', [
            'label' => esc_html__('Margin', 'hash-elements'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .he-timeline .he-post-item h3' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'post_metas', [
            'label' => esc_html__('Metas', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'post_metas_color', [
            'label' => esc_html__('Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .he-timeline .he-post-item .he-post-meta' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'post_metas_typography',
            'label' => esc_html__('Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .he-timeline .he-post-item .he-post-meta',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'excerpt_style', [
            'label' => esc_html__('Excerpt', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'excerpt_color', [
            'label' => esc_html__('Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .he-timeline  .he-post-item .he-excerpt' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'excerpt_typography',
            'label' => esc_html__('Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .he-timeline .he-post-item .he-excerpt',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'timeline_style', [
            'label' => esc_html__('Time Line', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'timeline_border_color', [
            'label' => esc_html__('Line Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .he-timeline, {{WRAPPER}} .he-timeline .he-post-item:after' => 'border-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'timeline_dot_color', [
            'label' => esc_html__('Dot Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .he-timeline .he-post-item:after' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'timeline_dot_hover_color', [
            'label' => esc_html__('Dot Color (Hover)', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .he-timeline .he-post-item:hover:after' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();

        $this->render_header();
        ?>
        <div class="he-timeline">
            <?php
            $args = $this->query_args();
            $query = new \WP_Query($args);
            while ($query->have_posts()): $query->the_post();
                ?>
                <div class="he-post-item">
                    <?php $this->get_post_meta(); ?>
                    <h3 class="he-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <?php $this->get_post_excerpt(); ?>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
            ?>
        </div>
        <?php
    }

    /** Query Args */
    protected function query_args() {
        $settings = $this->get_settings();

        $post_type = $args['post_type'] = $settings['posts_post_type'];
        $args['orderby'] = $settings['posts_orderby'];
        $args['order'] = $settings['posts_order'];
        $args['ignore_sticky_posts'] = 1;
        $args['post_status'] = 'publish';
        $args['offset'] = $settings['posts_offset'];
        $args['posts_per_page'] = $settings['posts_number'];
        $args['post__not_in'] = $post_type == 'post' ? $settings['posts_exclude_posts'] : [];

        $args['tax_query'] = [];

        $taxonomies = get_object_taxonomies($post_type, 'objects');

        foreach ($taxonomies as $object) {
            $setting_key = 'posts_' . $object->name . '_ids';

            if (!empty($settings[$setting_key])) {
                $args['tax_query'][] = [
                    'taxonomy' => $object->name,
                    'field' => 'term_id',
                    'terms' => $settings[$setting_key],
                ];
            }
        }

        return $args;
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

    /** Get Post Metas */
    protected function get_post_meta() {
        $settings = $this->get_settings_for_display();
        $post_author = $settings['post_author'];
        $post_date = $settings['post_date'];
        $post_comment = $settings['post_comment'];

        if ($post_author == 'yes' || $post_date == 'yes' || $post_comment == 'yes') {
            ?>
            <div class="he-post-meta">
                <?php
                if ($post_author == 'yes') {
                    hash_elements_author_name();
                }

                if ($post_date == 'yes') {
                    $date_format = $settings['date_format'];

                    if ($date_format == 'relative_format') {
                        hash_elements_time_ago();
                    } else if ($date_format == 'default') {
                        hash_elements_post_date();
                    } else if ($date_format == 'custom') {
                        $format = $settings['custom_date_format'];
                        hash_elements_post_date($format);
                    }
                }

                if ($post_comment == 'yes') {
                    hash_elements_comment_count();
                }
                ?>
            </div>
            <?php
        }
    }

    /** Get Post Excerpt */
    protected function get_post_excerpt() {
        $settings = $this->get_settings_for_display();
        $excerpt_length = $settings['post_excerpt_length'];
        if ($excerpt_length) {
            ?>
            <div class="he-excerpt"><?php echo hash_elements_custom_excerpt($excerpt_length); ?></div>
            <?php
        }
    }

}
