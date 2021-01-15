<?php

namespace HashElements\Modules\TotalPortfolioMasonary\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class TotalPortfolioMasonary extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'total-portfolio-masonary';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Portfolio Masonary', 'hash-elements');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-gallery-masonry';
    }

    /** Category */
    public function get_categories() {
        return ['he-total-elements'];
    }

    /** Controls */
    protected function _register_controls() {

        $this->start_controls_section(
                'section_post_query', [
            'label' => esc_html__('Content Filter', 'hash-elements'),
                ]
        );

        $this->add_control('category_ids', [
            'label' => esc_html__('Choose Category ', 'hash-elements'),
            'type' => Controls_Manager::SELECT2,
            'label_block' => true,
            'multiple' => true,
            'options' => $this->get_portfolio_category(),
                ]
        );

        $this->add_control(
                'exclude_posts', [
            'label' => __('Exclude Posts', 'hash-elements'),
            'type' => Controls_Manager::SELECT2,
            'label_block' => true,
            'multiple' => true,
            'options' => $this->get_posts(),
                ]
        );

        $this->add_control('orderby', [
            'label' => esc_html__('Order By', 'hash-elements'),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'date' => esc_html__('Date', 'hash-elements'),
                'modified' => esc_html__('Last Modified Date', 'hash-elements'),
                'rand' => esc_html__('Rand', 'hash-elements'),
                'comment_count' => esc_html__('Comment Count', 'hash-elements'),
                'title' => esc_html__('Title', 'hash-elements'),
                'ID' => esc_html__('Post ID', 'hash-elements'),
                'author' => esc_html__('Show Post Author', 'hash-elements'),
            ],
            'default' => 'date'
                ]
        );

        $this->add_control('order', [
            'label' => esc_html__('Order', 'hash-elements'),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'DESC' => esc_html__('Descending', 'hash-elements'),
                'ASC' => esc_html__('Ascending', 'hash-elements'),
            ],
            'default' => 'DESC'
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_settings', [
            'label' => esc_html__('Settings', 'hash-elements'),
                ]
        );

        $this->add_control(
                'active_cat', [
            'label' => esc_html__('Active Category', 'hash-elements'),
            'type' => Controls_Manager::SELECT,
            'label_block' => true,
            'default' => '*',
            'options' => array_merge(['*' => esc_html__('All', 'hash-elements')], $this->get_portfolio_category())
                ]
        );

        $this->add_control(
                'display_all_tab', [
            'label' => __('Display All Tab', 'hash-elements'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'hash-elements'),
            'label_off' => __('No', 'hash-elements'),
            'return_value' => 'yes',
            'default' => 'yes',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'tab_style', [
            'label' => esc_html__('Category Tab', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'tab_icon_color', [
            'label' => esc_html__('Icon Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#000000',
            'selectors' => [
                '{{WRAPPER}} .het-portfolio-cat-name-list i' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'tab_category_color', [
            'label' => esc_html__('Category Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .het-portfolio-cat-name' => 'color: {{VALUE}}; border-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'tab_category_hover_color', [
            'label' => esc_html__('Category Color (Hover & Active)', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#009dea',
            'selectors' => [
                '{{WRAPPER}} .het-portfolio-cat-name.active, {{WRAPPER}} .het-portfolio-cat-name:hover' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'tab_typography',
            'label' => esc_html__('Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .het-portfolio-cat-name-list',
                ]
        );

        $this->add_control(
                'tab_alignment', [
            'label' => __('Tab Alignment', 'square-plus'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'tab-align-right',
            'options' => [
                'tab-align-left' => __('Left', 'square-plus'),
                'tab-align-center' => __('Center', 'square-plus'),
                'tab-align-right' => __('Right', 'square-plus')
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'portfolio_style_tab', [
            'label' => esc_html__('Portfolio Block', 'hash-elements'),
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
                '{{WRAPPER}} .het-portfolio-caption h5' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'title_typography',
            'label' => esc_html__('Title Typography', 'hash-elements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .het-portfolio-caption h5',
                ]
        );

        $this->add_control(
                'portfolio_hover_bg', [
            'label' => esc_html__('Overlay Color on Hover', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#000000',
            'selectors' => [
                '{{WRAPPER}} .het-portfolio-caption' => 'background-color: {{VALUE}}',
            ],
            'separator' => 'before'
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'button_style', [
            'label' => esc_html__('Zoom & Link Button', 'hash-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
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
                'normal_button_icon_color', [
            'label' => esc_html__('Icon Color', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'default' => '#000000',
            'selectors' => [
                '{{WRAPPER}} .het-portfolio-caption a' => 'color: {{VALUE}}',
            ],
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
                '{{WRAPPER}} .het-portfolio-caption a' => 'background-color: {{VALUE}}',
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
                'hover_button_icon_color', [
            'label' => esc_html__('Icon Color (Hover)', 'hash-elements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .het-portfolio-caption a:hover' => 'color: {{VALUE}}',
            ],
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
            'selectors' => [
                '{{WRAPPER}} .het-portfolio-caption a:hover' => 'background-color: {{VALUE}}',
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
        $id = $this->get_id();
        ?>
        <div class="het-portfolio-container">
            <?php
            $portfolio_cat = $settings['category_ids'];
            $portfolio_active_cat = $settings['active_cat'];
            $active_tab = ($portfolio_active_cat == '*') ? '*' : '.hash-portfolio-' . $portfolio_active_cat;
            $show_all = $settings['display_all_tab'];
            $tab_alignment = $settings['tab_alignment'];

            if ($portfolio_cat) {
                ?>  
                <div class="het-portfolio-cat-name-list <?php echo esc_attr($tab_alignment); ?>" data-active="<?php echo $active_tab; ?>">
                    <i class="fa fa-th-large" aria-hidden="true"></i>
                    <?php if ($show_all) { ?>
                        <div class="het-portfolio-cat-name" data-filter="*">
                            <?php _e('All', 'hash-elements'); ?>
                        </div>
                        <?php
                    }
                    foreach ($portfolio_cat as $portfolio_cat_single) {
                        $category_slug = "";
                        $category_slug = get_category($portfolio_cat_single);

                        if (is_object($category_slug)) {
                            $category_slug = 'hash-portfolio-' . $category_slug->term_id;
                            ?>
                            <div class="het-portfolio-cat-name" data-filter=".<?php echo esc_attr($category_slug); ?>">
                                <?php echo esc_html(get_cat_name($portfolio_cat_single)); ?>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            <?php } ?>

            <div class="het-portfolio-post-wrap">
                <div class="het-portfolio-posts-<?php echo $id; ?>">
                    <?php
                    if ($portfolio_cat) {
                        $count = 1;
                        $args = $this->query_args();
                        $query = new \WP_Query($args);
                        if ($query->have_posts()):
                            while ($query->have_posts()): $query->the_post();
                                $categories = get_the_category();
                                $category_slug = "";
                                $cat_slug = array();

                                foreach ($categories as $category) {
                                    $cat_slug[] = 'hash-portfolio-' . $category->term_id;
                                }

                                $category_slug = implode(" ", $cat_slug);

                                if (has_post_thumbnail()) {
                                    $image_url = HASHELE_URL . 'assets/img/portfolio-small-blank.png';
                                    $total_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'total-portfolio-thumb');
                                    $total_image_large = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                                } else {
                                    $image_url = HASHELE_URL . 'assets/img/portfolio-small.png';
                                    $total_image = "";
                                }
                                ?>
                                <div class="het-portfolio <?php echo esc_attr($category_slug); ?>">
                                    <div class="het-portfolio-outer-wrap">
                                        <div class="het-portfolio-wrap" style="background-image: url(<?php echo esc_url($total_image[0]) ?>);">

                                            <img  class="no-lazyload" src="<?php echo esc_url($image_url); ?>" alt="<?php esc_attr(get_the_title()); ?>">

                                            <div class="het-portfolio-caption">
                                                <h5><?php the_title(); ?></h5>
                                                <a class="het-portfolio-link" href="<?php echo esc_url(get_permalink()); ?>"><i class="fa fa-link"></i></a>

                                                <?php if (has_post_thumbnail()) { ?>
                                                    <a class="het-portfolio-image" data-lightbox-gallery="gallery1" href="<?php echo esc_url($total_image_large[0]) ?>"><i class="fa fa-search"></i></a>
                                                    <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            endwhile;
                        endif;
                        wp_reset_postdata();
                    }
                    ?>
                </div>
                <?php ?>
            </div>
        </div>
        <?php
    }

    /** Query Args */
    protected function query_args() {
        $settings = $this->get_settings();

        $post_type = $args['post_type'] = 'post';
        $args['orderby'] = $settings['orderby'];
        $args['order'] = $settings['order'];
        $args['ignore_sticky_posts'] = 1;
        $args['post_status'] = 'publish';
        $args['posts_per_page'] = -1;
        $args['post__not_in'] = $post_type == 'post' ? $settings['exclude_posts'] : [];

        $args['tax_query'] = [];

        $taxonomies = get_object_taxonomies($post_type, 'objects');

        foreach ($taxonomies as $object) {
            $setting_key = $object->name . '_ids';

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

    private function get_posts() {
        /** Get All Posts */
        $post_list = get_posts(array(
            'post_type' => 'post',
            'orderby' => 'date',
            'order' => 'DESC',
            'posts_per_page' => -1,
        ));

        $posts = array();

        if (!empty($post_list) && !is_wp_error($post_list)) {
            foreach ($post_list as $post) {
                $posts[$post->ID] = $post->post_title;
            }
        }

        return $posts;
    }

    protected function get_portfolio_category() {
        $portfolio_categories = get_categories(array('taxonomy' => 'category', 'hide_empty' => 0));
        $portfolio_cat = array();
        foreach ($portfolio_categories as $portfolio_category) {
            $portfolio_cat[$portfolio_category->term_id] = $portfolio_category->cat_name;
        }

        return $portfolio_cat;
    }

}
