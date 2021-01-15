<?php

namespace HashElements\Modules\SquarePlusElasticGallery\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class SquarePlusElasticGallery extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'square-plus-elastic-gallery';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Elastic Gallery', 'hash-elements');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-photo-library';
    }

    /** Category */
    public function get_categories() {
        return ['he-square-elements'];
    }

    /** Controls */
    protected function _register_controls() {

        $this->start_controls_section(
                'content_section', [
            'label' => esc_html__('Content', 'hash-elements'),
                ]
        );

        $this->add_control(
                'gallery', [
            'label' => __('Add Images', 'hash-elements'),
            'type' => Controls_Manager::GALLERY,
            'default' => [],
                ]
        );

        $this->add_group_control(
                Group_Control_Image_Size::get_type(), [
            'name' => 'image',
            'exclude' => ['custom'],
            'include' => [],
            'default' => 'large',
                ]
        );

        $this->add_responsive_control(
                'image_height', [
            'label' => esc_html__('Image Height', 'hash-elements'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 100,
                    'max' => 1000,
                    'step' => 1,
                ],
            ],
            'devices' => ['desktop', 'tablet', 'mobile'],
            'desktop_default' => [
                'size' => 400,
                'unit' => 'px',
            ],
            'selectors' => [
                '{{WRAPPER}} .he-elasticstack' => 'height: {{SIZE}}{{UNIT}};',
            ],
                ]
        );

        $this->add_responsive_control(
                'image_width', [
            'label' => esc_html__('Image Width', 'hash-elements'),
            'description' => __('The image width will not extend beyond the container.', 'hash-elements'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 100,
                    'max' => 1000,
                    'step' => 1,
                ],
            ],
            'devices' => ['desktop', 'tablet', 'mobile'],
            'desktop_default' => [
                'size' => 400,
                'unit' => 'px',
            ],
            'selectors' => [
                '{{WRAPPER}} .he-elasticstack' => 'width: {{SIZE}}{{UNIT}};',
            ],
                ]
        );

        $this->add_control(
                'alignment', [
            'label' => esc_html__('Gallery Alignment', 'hash-elements'),
            'description' => esc_html__('When container width is greater than gallery width, the alignment option is useful.', 'hash-elements'),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'left' => esc_html__('Left', 'hash-elements'),
                'center' => esc_html__('Center', 'hash-elements'),
                'right' => esc_html__('Right', 'hash-elements'),
            ],
            'default' => 'left',
            'label_block' => true
                ]
        );

        $this->add_responsive_control(
                'top_spacing', [
            'label' => esc_html__('Top Spacing', 'hash-elements'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                ],
            ],
            'devices' => ['desktop', 'tablet', 'mobile'],
            'desktop_default' => [
                'size' => 20,
                'unit' => 'px',
            ],
            'selectors' => [
                '{{WRAPPER}} .he-image-stack' => 'margin-top: {{SIZE}}{{UNIT}};',
            ],
                ]
        );

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $id = $this->get_id();
        $gallery = $settings['gallery'];
        $alignment = $settings['alignment'];
        if ($gallery) {
            ?>
            <div class="he-image-stack he-elastic-<?php echo esc_attr($alignment); ?>">
                <ul id="he-elasticstack-<?php echo $id; ?>" class="he-elasticstack">
                    <?php
                    foreach ($gallery as $image) {
                        $image_url = Group_Control_Image_Size::get_attachment_image_src($image['id'], 'image', $settings);
                        $image_html = '<img src="' . esc_attr($image_url) . '" alt="' . esc_attr(\Elementor\Control_Media::get_image_alt($image)) . '" />';
                        ?>
                        <li><?php echo $image_html; ?></li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
            <?php
        }
    }

}
