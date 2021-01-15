<?php
/**
 * @package Square
 */

add_action('widgets_init', 'total_register_contact_info');

function total_register_contact_info() {
    register_widget('total_contact_info');
}

class Total_Contact_Info extends WP_Widget {

    public function __construct() {
        parent::__construct(
                'total_contact_info', 'Total - Contact Info', array(
                'description' => esc_html__('A widget to display Contact Information', 'total')
                )
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $fields = array(
            'title' => array(
                'total_widgets_name' => 'title',
                'total_widgets_title' => esc_html__('Title', 'total'),
                'total_widgets_field_type' => 'text',
            ),
            'phone' => array(
                'total_widgets_name' => 'phone',
                'total_widgets_title' => esc_html__('Phone', 'total'),
                'total_widgets_field_type' => 'text',
            ),
            'contact_info_email' => array(
                'total_widgets_name' => 'email',
                'total_widgets_title' => esc_html__('Email', 'total'),
                'total_widgets_field_type' => 'text',
            ),
            'website' => array(
                'total_widgets_name' => 'website',
                'total_widgets_title' => esc_html__('Website', 'total'),
                'total_widgets_field_type' => 'text',
            ),
            'address' => array(
                'total_widgets_name' => 'address',
                'total_widgets_title' => esc_html__('Contact Address', 'total'),
                'total_widgets_field_type' => 'textarea',
                'total_widgets_row' => '4'
            ),
            'time' => array(
                'total_widgets_name' => 'time',
                'total_widgets_title' => esc_html__('Contact Time', 'total'),
                'total_widgets_field_type' => 'textarea',
                'total_widgets_row' => '3'
            ),
        );

        return $fields;
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {
        extract($args);

        $title = isset( $instance['title'] ) ? $instance['title'] : '' ;
        $phone = isset( $instance['phone'] ) ? $instance['phone'] : '' ;
        $email = isset( $instance['email'] ) ? $instance['email'] : '' ;
        $website = isset( $instance['website'] ) ? $instance['website'] : '' ;
        $address = isset( $instance['address'] ) ? $instance['address'] : '' ;
        $time = isset( $instance['time'] ) ? $instance['time'] : '' ;

        echo $before_widget; // WPCS: XSS OK.
        ?>
        <div class="ht-contact-info">
            <?php
            if (!empty($title)):
                echo $before_title . esc_html($title) . $after_title; // WPCS: XSS OK.
            endif;
            ?>

            <ul>
                <?php if (!empty($phone)): ?>
                    <li><i class="fa fa-phone"></i><?php echo wp_kses_post($phone); ?></li>
                <?php endif; ?>

                <?php if (!empty($email)): ?>
                    <li><i class="fa fa-envelope"></i><?php echo wp_kses_post($email); ?></li>
                <?php endif; ?>

                <?php if (!empty($website)): ?>
                    <li><i class="fa fa-globe"></i><?php echo wp_kses_post($website); ?></li>
                <?php endif; ?>

                <?php if (!empty($address)): ?>
                    <li><i class="fa fa-map-marker"></i><?php echo wp_kses_post(wpautop($address)); ?></li>
                <?php endif; ?>

                <?php if (!empty($time)): ?>
                    <li><i class="fa fa-clock-o"></i><?php echo wp_kses_post(wpautop($time)); ?></li>
                    <?php endif; ?>
            </ul>
        </div>
        <?php
        echo $after_widget; // WPCS: XSS OK.
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param	array	$new_instance	Values just sent to be saved.
     * @param	array	$old_instance	Previously saved values from database.
     *
     * @uses	total_widgets_updated_field_value()		defined in widget-fields.php
     *
     * @return	array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ($widget_fields as $widget_field) {

            extract($widget_field);

            // Use helper function to get updated field values
            $instance[$total_widgets_name] = total_widgets_updated_field_value($widget_field, $new_instance[$total_widgets_name]);
        }

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param	array $instance Previously saved values from database.
     *
     * @uses	total_widgets_show_widget_field()		defined in widget-fields.php
     */
    public function form($instance) {
        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ($widget_fields as $widget_field) {

            // Make array elements available as variables
            extract($widget_field);
            $total_widgets_field_value = !empty($instance[$total_widgets_name]) ? esc_attr($instance[$total_widgets_name]) : '';
            total_widgets_show_widget_field($this, $widget_field, $total_widgets_field_value);
        }
    }

}
