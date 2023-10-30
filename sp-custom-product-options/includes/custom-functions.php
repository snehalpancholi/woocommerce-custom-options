<?php


// get _custom_fields from product and input fields and save them in cart item meta
function save_custom_fields_to_cart_item_meta($cart_item_data, $product_id) {
    $custom_fields = get_post_meta($product_id, '_custom_fields', true);

    if (!empty($custom_fields) && is_array($custom_fields)) {
        foreach ($custom_fields as $field) {
            if (isset($_POST[$field['field_name']])) {
                $cart_item_data['custom_fields'][] = array(
                    'field_name' => $field['field_name'],
                    'value' => sanitize_text_field($_POST[$field['field_name']]),
                );
            }

            if (isset($_POST[$field['field_name'] . '_options'])) {
                $cart_item_data['custom_fields'][] = array(
                    'field_name' => $field['field_name'],
                    'value' => sanitize_text_field($_POST[$field['field_name'] . '_options']),
                );
            }
        }
    }

    return $cart_item_data;
}

add_filter('woocommerce_add_cart_item_data', 'save_custom_fields_to_cart_item_meta', 10, 2);


// display custom fields in cart
function display_custom_fields_in_cart($item_name, $cart_item, $cart_item_key) {
    if (is_array($cart_item['custom_fields'])) {
        foreach ($cart_item['custom_fields'] as $field) {
            $item_name .= '<br/><span class="product-custom-field-label">' . esc_html($field['field_name']) . ':</span> ' . esc_html($field['value']);
        }
    }

    return $item_name;
}
add_filter('woocommerce_cart_item_name', 'display_custom_fields_in_cart', 10, 3);

// save custom fields to order item meta
function save_custom_fields_to_order_item_meta($item_id, $cart_item) {
    if (is_array($cart_item['custom_fields'])) {
        foreach ($cart_item['custom_fields'] as $field) {
            wc_add_order_item_meta($item_id, esc_html($field['field_name']), esc_html($field['value']));
        }
    }
}
add_action('woocommerce_add_order_item_meta', 'save_custom_fields_to_order_item_meta', 10, 2);

// display custom fields in order
function display_custom_fields_in_order($item_name, $item, $order) {
    if (is_array($item->get_meta('_custom_fields'))) {
        foreach ($item->get_meta('_custom_fields') as $field) {
            $item_name .= '<br/><span class="product-custom-field-label">' . esc_html($field['field_name']) . ':</span> ' . esc_html($field['value']);
        }
    }

    return $item_name;
}
add_filter('woocommerce_order_item_name', 'display_custom_fields_in_order', 10, 3);


// display custom fields in order email
function display_custom_fields_in_order_email($item_name, $item, $order) {
    if (is_array($item->get_meta('_custom_fields'))) {
        foreach ($item->get_meta('_custom_fields') as $field) {
            $item_name .= '<br/><span class="product-custom-field-label">' . esc_html($field['field_name']) . ':</span> ' . esc_html($field['value']);
        }
    }

    return $item_name;
}
add_filter('woocommerce_email_order_item_name', 'display_custom_fields_in_order_email', 10, 3);

// display custom fields in user account
function display_custom_fields_in_user_account($product_name, $item, $is_visible) {
    if (is_array($item->get_meta('_custom_fields'))) {
        foreach ($item->get_meta('_custom_fields') as $field) {
            $product_name .= '<br/><span class="product-custom-field-label">' . esc_html($field['field_name']) . ':</span> ' . esc_html($field['value']);
        }
    }

    return $product_name;
}
add_filter('woocommerce_order_item_name', 'display_custom_fields_in_user_account', 10, 3);