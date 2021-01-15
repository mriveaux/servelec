<?php

namespace HashElements\Modules\SquarePlusTabBlock\Widgets;

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

class SquarePlusTabBlock extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'square-plus-tab-block';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Tab Block', 'hash-elements');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-tabs';
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
                'title', [
            'label' => __('Tab Title', 'hash-elements'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => 'Tab Title'
                ]
        );

        $repeater->add_control(
                'content_from', [
            'label' => __('Add Content From', 'hash-elements'),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'wisiwyg' => __('WISIWYG Editor', 'hash-elements'),
                'page' => __('Page', 'hash-elements')
            ],
            'default' => 'wisiwyg',
            'label_block' => true
                ]
        );

        $repeater->add_control(
                'content', [
            'label' => __('Tab Content', 'hash-elements'),
            'type' => Controls_Manager::WYSIWYG,
            'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
            'placeholder' => __('Type your description here', 'hash-elements'),
            'condition' => [
                'content_from' => ['wisiwyg']
            ],
                ]
        );

        $repeater->add_control('select_page', [
            'label' => 'Select Page',
            'type' => Controls_Manager::SELECT,
            'label_block' => true,
            'multiple' => false,
            'options' => $this->he_get_pages(),
            'condition' => [
                'content_from' => ['page']
            ],
                ]
        );

        $this->add_control(
                'tabs', [
            'label' => __('Tab List', 'hash-elements'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                [
                    'icon' => [
                        'value' => 'fas fa-star',
                        'library' => 'solid',
                    ],
                    'title' => 'Tab Title 1',
                    'content' => 'Nunc commodo, ligula nec vestibulum condimentum, elit ipsum pharetra est, eu convallis mauris massa eget justo. Proin hendrerit orci id turpis egestas, dictum eleifend massa vulputate. Quisque mattis egestas nulla, at ornare nibh blandit id. Donec fringilla urna vitae risus aliquam, a mattis eros ornare. Quisque maximus ex eros, at tincidunt arcu placerat tempus. Quisque at lacinia mauris, a auctor urna. Donec laoreet tincidunt nisi ac sodales.'
                ],
                [
                    'icon' => [
                        'value' => 'fas fa-star',
                        'library' => 'solid',
                    ],
                    'title' => 'Tab Title 2',
                    'content' => 'Proin vulputate eros id magna mattis mattis id sed odio. Aliquam commodo justo eget sodales lacinia. Sed leo diam, pellentesque quis maximus nec, gravida eget neque. Nulla justo mi, tempor vitae auctor vel, placerat quis turpis. Morbi ullamcorper nunc eget auctor iaculis. Proin eu metus finibus, consectetur quam et, sollicitudin sem. Aliquam tellus nibh, dignissim nec pellentesque sed, congue ut lorem. Integer commodo, nunc ac consectetur conv.'
                ],
                [
                    'icon' => [
                        'value' => 'fas fa-star',
                        'library' => 'solid',
                    ],
                    'title' => 'Tab Title 3',
                    'content' => 'Donec justo eros, luctus quis scelerisque id, ultricies sit amet odio. Vestibulum aliquam efficitur eleifend. Praesent dignissim faucibus ex vel sodales. Morbi aliquet libero at augue pharetra vehicula. Cras dapibus lorem efficitur nunc euismod convallis. Nunc molestie risus id lacinia consequat. Integer iaculis orci in ipsum vestibulum, non mattis justo ornare. Cras et lorem tempor ligula suscipit mollis. Nulla vitae augue non leo tempus finibus.'
                ]
            ],
            'title_field' => '{{{ title }}}',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'title_style', [
            'label' => esc_html__('Tab Title', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'title_typography',
            'label' => esc_html__('Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} ul.he-tab li a',
                ]
        );

        $this->add_control(
                'icon_size', [
            'label' => __('Tab Icon Size', 'hash-elements'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 10,
                    'max' => 80,
                    'step' => 1,
                ]
            ],
            'selectors' => [
                '{{WRAPPER}} ul.he-tab li a i' => 'font-size: {{SIZE}}{{UNIT}};',
            ],
                ]
        );

        $this->add_control(
                'icon_spacing', [
            'label' => __('Tab Icon Spacing', 'hash-elements'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 5,
                    'max' => 30,
                    'step' => 1,
                ]
            ],
            'selectors' => [
                '{{WRAPPER}} ul.he-tab li a i' => 'margin-right: {{SIZE}}{{UNIT}};',
            ],
                ]
        );

        $this->start_controls_tabs(
                'style_tabs'
        );

        $this->start_controls_tab(
                'style_normal_tab', [
            'label' => esc_html__('Normal', 'hash-elements'),
                ]
        );

        $this->add_control(
                'title_text_color', [
            'label' => esc_html__('Title Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} ul.he-tab li a span' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'title_icon_color', [
            'label' => esc_html__('Icon Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} ul.he-tab li a i' => 'color: {{VALUE}}',
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
                '{{WRAPPER}} .he-tab' => 'border-right: 1px solid {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'style_active_tab', [
            'label' => esc_html__('Active', 'hash-elements'),
                ]
        );

        $this->add_control(
                'title_text_color_hover', [
            'label' => esc_html__('Title Color (Active)', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} ul.he-tab li.he-active a span' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'title_icon_color_hover', [
            'label' => esc_html__('Icon Color (Active)', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} ul.he-tab li.he-active a i' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'title_border_color_hover', [
            'label' => esc_html__('Border Color (Active)', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .he-tab li.he-active:after' => 'background: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
                'tab_content_style', [
            'label' => esc_html__('Tab Content', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'tab_content_color', [
            'label' => esc_html__('Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .he-tab-content .he-tab-pane' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'tab_content_typography',
            'label' => esc_html__('Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .he-tab-content .he-tab-pane',
                ]
        );

        $this->add_control(
                'tab_content_padding', [
            'label' => esc_html__('Padding', 'hash-elements'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .he-tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
                ]
        );

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $id = $this->get_id();
        $tabs = $settings['tabs'];
        ?>
        <div class="he-tab-wrapper he-clearfix">
            <ul class="he-tab">
                <?php
                foreach ($tabs as $key => $tab) {
                    $square_tab_title = $tab['title'];
                    $tab_count = $key + 1;
                    $tab_id = 'he-' . $id . $tab_count;

                    if ($square_tab_title) {
                        ?>
                        <li class="he-tab-list<?php echo intval($key + 1); ?>">
                            <a href="#<?php echo $tab_id; ?>">
                                <?php
                                ob_start();
                                \Elementor\Icons_Manager::render_icon($tab['icon'], ['aria-hidden' => 'true']);
                                $icon_html = ob_get_clean();

                                echo $icon_html . '<span>' . esc_html($square_tab_title) . '</span>';
                                ?>
                            </a>
                        </li>
                        <?php
                    }
                }
                ?>
            </ul>

            <div class="he-tab-content">
                <?php
                foreach ($tabs as $key => $tab) {
                    $tab_count = $key + 1;
                    $tab_id = 'he-' . $id . $tab_count;
                    ?>
                    <div class="he-tab-pane animated zoomIn" id="<?php echo $tab_id; ?>">
                        <?php
                        if ($tab['content_from'] == 'wisiwyg') {
                            ?>
                            <div class="he-content"><?php echo do_shortcode($tab['content']); ?></div>
                            <?php
                        } else if ($tab['content_from'] == 'page') {
                            $square_tab_page = $tab['select_page'];
                            if ($square_tab_page) {
                                ?>
                                <div class="he-content">
                                    <?php
                                    // Get ID
                                    $get_id = $square_tab_page;
                                    // Check if page is Elementor page
                                    $elementor = get_post_meta($get_id, '_elementor_edit_mode', true);
                                    $siteorigin = get_post_meta($get_id, 'panels_data', true);

                                    // If Elementor
                                    if (class_exists('Elementor\Plugin') && $elementor) {
                                        echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($get_id);
                                    }

                                    // If Beaver Builder
                                    else if (class_exists('FLBuilder') && !empty($get_id)) {
                                        echo do_shortcode('[fl_builder_insert_layout id="' . $get_id . '"]');
                                    }

                                    // If Site Origin
                                    else if (class_exists('SiteOrigin_Panels') && $siteorigin) {
                                        echo SiteOrigin_Panels::renderer()->render($get_id);
                                    } else {
                                        // Get template content
                                        $template_id = get_post($get_id);

                                        if ($template_id && !is_wp_error($template_id)) {
                                            $content = $template_id->post_content;
                                        }
                                        // Display template content
                                        echo apply_filters('the_content', $content);
                                    }
                                    ?>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php
    }

    private function he_get_pages() {
        $pages = get_pages(array(
            'order' => 'ASC'
        ));
        $_pages = [];

        foreach ($pages as $key => $object) {
            $_pages[$object->ID] = ucfirst($object->post_title);
        }

        return $_pages;
    }

}
