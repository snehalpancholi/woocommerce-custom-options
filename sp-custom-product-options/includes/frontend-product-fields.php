<?php

function display_custom_input_fields_above_add_to_cart() {
    global $product;

    if (is_a($product, 'WC_Product')) {
        $custom_fields = get_post_meta($product->get_id(), '_custom_fields', true);

        if (!empty($custom_fields) && is_array($custom_fields)) {
            echo '<div class="custom-fields">';
            foreach ($custom_fields as $field) {
                echo '<div class="custom-field">';
                echo '<label for="' . esc_attr($field['field_name']) . '">' . esc_html($field['field_name']) . '</label>';
                if($field['field_type']!="select")
                echo '<input type="' . esc_attr($field['field_type']) . '" name="' . esc_attr($field['field_name']) . '" value="' . esc_attr($field['default_value']) . '" />';

                //  display custom options if available
                if (!empty($field['default_value'])) {
                    $defaultOptions = explode(',', $field['default_value']);
                    echo '<select name="' . esc_attr($field['field_name']) . '_options">';
                    echo '<option value="">Choose ' . esc_attr($field['field_name']) . '</option>';
                    foreach ($defaultOptions as $option) {
                        echo '<option value="' . esc_attr($option) . '">' . esc_html($option) . '</option>';
                    }
                    echo '</select>';
                }
                echo '</div>';
            }
            echo '</div>';
        }
    }
}
add_action('woocommerce_before_add_to_cart_button', 'display_custom_input_fields_above_add_to_cart');
