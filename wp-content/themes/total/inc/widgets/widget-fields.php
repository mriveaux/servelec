<?php
/**
 * @package Total
 */

function total_widgets_show_widget_field($instance = '', $widget_field = '', $total_field_value = '') {

    extract($widget_field);

    if(isset($total_widgets_default)){
        $total_field_value = !empty( $total_field_value ) ? $total_field_value : $total_widgets_default;
    }

    switch ($total_widgets_field_type) {

        // Standard text field
        case 'text' :
            ?>
            <p>
                <label for="<?php echo esc_attr($instance->get_field_id($total_widgets_name)); ?>"><?php echo esc_html($total_widgets_title); ?>:</label>
                <input class="widefat" id="<?php echo esc_attr($instance->get_field_id($total_widgets_name)); ?>" name="<?php echo esc_attr($instance->get_field_name($total_widgets_name)); ?>" type="text" value="<?php echo esc_html($total_field_value); ?>" />

                <?php if (isset($total_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($total_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        // Standard url field
        case 'url' :
            ?>
            <p>
                <label for="<?php echo esc_attr($instance->get_field_id($total_widgets_name)); ?>"><?php echo esc_html($total_widgets_title); ?>:</label>
                <input class="widefat" id="<?php echo esc_attr($instance->get_field_id($total_widgets_name)); ?>" name="<?php echo esc_attr($instance->get_field_name($total_widgets_name)); ?>" type="text" value="<?php echo esc_url($total_field_value); ?>" />

                <?php if (isset($total_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($total_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        // Textarea field
        case 'textarea' :
            ?>
            <p>
                <label for="<?php echo esc_attr($instance->get_field_id($total_widgets_name)); ?>"><?php echo esc_html($total_widgets_title); ?>:</label>
                <textarea class="widefat" rows="<?php echo absint($total_widgets_row); ?>" id="<?php echo esc_attr($instance->get_field_id($total_widgets_name)); ?>" name="<?php echo esc_attr($instance->get_field_name($total_widgets_name)); ?>"><?php echo wp_kses_post($total_field_value); ?></textarea>
            </p>
            <?php
            break;

        // Checkbox field
        case 'checkbox' :
            ?>
            <p>
                <input id="<?php echo esc_attr($instance->get_field_id($total_widgets_name)); ?>" name="<?php echo esc_attr($instance->get_field_name($total_widgets_name)); ?>" type="checkbox" value="1" <?php checked('1', $total_field_value); ?>/>
                <label for="<?php echo esc_attr($instance->get_field_id($total_widgets_name)); ?>"><?php echo esc_html($total_widgets_title); ?></label>

                <?php if (isset($total_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($total_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        // Radio fields
        case 'radio' :
            ?>
            <p>
                <?php
                echo esc_html($total_widgets_title);
                echo '<br />';
                foreach ($total_widgets_field_options as $total_option_name => $total_option_title) {
                    ?>
                    <input id="<?php echo esc_attr($instance->get_field_id($total_option_name)); ?>" name="<?php echo esc_attr($instance->get_field_name($total_widgets_name)); ?>" type="radio" value="<?php echo esc_attr($total_option_name); ?>" <?php checked($total_option_name, $total_field_value); ?> />
                    <label for="<?php echo esc_attr($instance->get_field_id($total_option_name)); ?>"><?php echo esc_html($total_option_title); ?></label>
                    <br />
                <?php } ?>

                <?php if (isset($total_widgets_description)) { ?>
                    <small><?php echo wp_kses_post($total_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        // Select field
        case 'select' :
            ?>
            <p>
                <label for="<?php echo esc_attr($instance->get_field_id($total_widgets_name)); ?>"><?php echo esc_html($total_widgets_title); ?>:</label>
                <select name="<?php echo esc_attr($instance->get_field_name($total_widgets_name)); ?>" id="<?php echo esc_attr($instance->get_field_id($total_widgets_name)); ?>" class="widefat">
                    <?php foreach ($total_widgets_field_options as $total_option_name => $total_option_title) { ?>
                        <option value="<?php echo esc_attr($total_option_name); ?>" id="<?php echo esc_attr($instance->get_field_id($total_option_name)); ?>" <?php selected($total_option_name, $total_field_value); ?>><?php echo esc_html($total_option_title); ?></option>
                    <?php } ?>
                </select>

                <?php if (isset($total_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($total_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        case 'number' :
            ?>
            <p>
                <label for="<?php echo esc_attr($instance->get_field_id($total_widgets_name)); ?>"><?php echo esc_html($total_widgets_title); ?>:</label><br />
                <input name="<?php echo esc_attr($instance->get_field_name($total_widgets_name)); ?>" type="number" step="1" min="1" id="<?php echo esc_attr($instance->get_field_id($total_widgets_name)); ?>" value="<?php echo absint($total_field_value); ?>" class="small-text" />

                <?php if (isset($total_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($total_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        case 'upload':
            $image = $image_class = "";
            if($total_field_value){ 
                $image = '<img src="'.esc_url($total_field_value).'" style="max-width:100%;"/>';    
                $image_class = ' hidden';
            }
            ?>
            <div class="attachment-media-view">

            <label for="<?php echo esc_attr($instance->get_field_id($total_widgets_name)); ?>"><?php echo esc_html($total_widgets_title); ?>:</label><br />
            
                <div class="placeholder<?php echo esc_attr($image_class); ?>">
                    <?php esc_html_e('No image selected', 'total'); ?>
                </div>
                <div class="thumbnail thumbnail-image">
                    <?php echo $image;  // WPCS: XSS OK. ?>
                </div>

                <div class="actions clearfix">
                    <button type="button" class="button total-delete-button align-left"><?php esc_html_e('Remove', 'total'); ?></button>
                    <button type="button" class="button total-upload-button alignright"><?php esc_html_e('Select Image', 'total'); ?></button>
                    
                    <input name="<?php echo esc_attr($instance->get_field_name($total_widgets_name)); ?>" id="<?php echo esc_attr($instance->get_field_id($total_widgets_name)); ?>" class="upload-id" type="hidden" value="<?php echo esc_url($total_field_value) ?>"/>
                </div>

            <?php if (isset($total_widgets_description)) { ?>
                <br />
                <small><?php echo wp_kses_post($total_widgets_description); ?></small>
            <?php } ?>

            </div>
            <?php                        
            break;
    }
}

function total_widgets_updated_field_value($widget_field, $new_field_value) {

    extract($widget_field);

    // Allow only integers in number fields
    if ($total_widgets_field_type == 'number') {
        return absint($new_field_value);

        // Allow some tags in textareas
    } elseif ($total_widgets_field_type == 'textarea') {
        // Check if field array specifed allowed tags
        if (!isset($total_widgets_allowed_tags)) {
            // If not, fallback to default tags
            $total_widgets_allowed_tags = '<p><strong><em><a>';
        }
        return strip_tags($new_field_value, $total_widgets_allowed_tags);

        // No allowed tags for all other fields
    } elseif ($total_widgets_field_type == 'url') {
        return esc_url_raw($new_field_value);
    } else {
        return strip_tags($new_field_value);
    }
}