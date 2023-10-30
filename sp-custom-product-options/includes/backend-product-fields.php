<?php

// Add a custom meta box for editing product fields
function custom_product_fields_meta_box() {
    add_meta_box(
        'custom-product-fields',
        'Custom Product Fields',
        'display_custom_product_fields_meta_box',
        'product',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'custom_product_fields_meta_box');

// Display the content of the meta box
function display_custom_product_fields_meta_box($post) {
    // Retrieve and display custom fields for the current product
    $custom_fields = get_post_meta($post->ID, '_custom_fields', true);

    if (empty($custom_fields) || !is_array($custom_fields)) {
        $custom_fields = array(
            array(
                'field_type' => '',
                'field_name' => '',
                'default_value' => '',
            ),
        );
    }

    // add custom.css in css directory
    wp_enqueue_style('custom-product-fields', SP_CUSTOM_PRODUCT_OPTIONS_PLUGIN_URL . 'css/custom.css', array(), '1.0');

    echo '<div class="custom-fields">';

    foreach ($custom_fields as $field) {
        if($field['field_type']!='')
        echo '<div class="custom-field">';
        else
        echo '<div class="custom-field style="display:none;">';

        echo '<label for="field_type">Field Type:</label>';
        echo '<select name="field_type[]" class="field-type">';
        echo '<option value="text" ' . selected($field['field_type'], 'text', false) . '>Text</option>';
        echo '<option value="select" ' . selected($field['field_type'], 'select', false) . '>Select</option>';
        echo '</select>';
        echo '<label for="field_name">Field Name:</label>';
        echo '<input type="text" name="field_name[]" class="field-name" value="' . esc_attr($field['field_name']) . '">';
        echo '<label for="default_value">Default Value (Comma-separated):</label>';

        echo '<input type="text" name="default_value[]" class="default-value" value="' . esc_attr($field['default_value']) . '">';


        echo '<a href="#" class="remove-field">Remove Field</a>';
        echo '</div>';
    }

    echo '</div>';

    echo '<a href="#" class="add-field">Add Field</a>';


    // add custom.js in this plugin directory
    wp_enqueue_script('custom-product-fields', SP_CUSTOM_PRODUCT_OPTIONS_PLUGIN_URL . 'js/custom.js', array('jquery'), '1.0', true);
}



// Save custom field values when the product is updated
function save_custom_product_field_data($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    // if post type is not product then do not save meta data
    if (get_post_type($post_id) != 'product') return;


    $field_types = $_POST['field_type'];
    $field_names = $_POST['field_name'];
    $default_values = $_POST['default_value'];

    $custom_fields = array();

    for ($i = 0; $i < count($field_names); $i++) {
        $field_type = sanitize_text_field($field_types[$i]);
    
        if($field_type=='')
           continue;

        $field_name = sanitize_text_field($field_names[$i]);
        $default_value = sanitize_text_field($default_values[$i]);

        if (!empty($field_name)) {
            $custom_fields[] = array(
                'field_type' => $field_type,
                'field_name' => $field_name,
                'default_value' => $default_value,
            );
        }
    }

    update_post_meta($post_id, '_custom_fields', $custom_fields);
}
add_action('save_post', 'save_custom_product_field_data');