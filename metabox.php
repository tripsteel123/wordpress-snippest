<?php
function add_course_meta_boxes() {
    add_meta_box(
        'course_details',
        'Course Details',
        'render_course_meta_box',
        'course',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'add_course_meta_boxes');


#####################  view form #####################
function render_course_meta_box($post) {
    // Add nonce for security and authentication.
    wp_nonce_field('save_course_meta_box_nonce', 'course_meta_box_nonce');

    // Get current values.
    $teacher = get_post_meta($post->ID, '_course_teacher', true);
    $level = get_post_meta($post->ID, '_course_level', true);
    $price = get_post_meta($post->ID, '_course_price', true);

    // Teacher select options (example data, replace with actual data source).
    $teachers = array('John Doe', 'Jane Smith', 'Bill Johnson'); // Example teachers.

    // HTML for the meta box.
    echo '<label for="course_teacher">Teacher:</label>';
    echo '<select name="course_teacher" id="course_teacher">';
    foreach ($teachers as $teacher_option) {
        $selected = ($teacher_option == $teacher) ? 'selected' : '';
        echo '<option value="' . esc_attr($teacher_option) . '" ' . $selected . '>' . esc_html($teacher_option) . '</option>';
    }
    echo '</select>';

    echo '<label for="course_level">Course Level:</label>';
    echo '<select name="course_level" id="course_level">';
    echo '<option value="beginner" ' . selected($level, 'beginner', false) . '>Beginner</option>';
    echo '<option value="advanced" ' . selected($level, 'advanced', false) . '>Advanced</option>';
    echo '</select>';

    echo '<label for="course_price">Course Price:</label>';
    echo '<input type="number" name="course_price" id="course_price" value="' . esc_attr($price) . '" />';
}


#####################  save data #####################
function save_course_meta_box_data($post_id) {
    // Check nonce for security.
    if (!isset($_POST['course_meta_box_nonce']) || !wp_verify_nonce($_POST['course_meta_box_nonce'], 'save_course_meta_box_nonce')) {
        return;
    }

    // Check if auto-saving.
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check user permissions.
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Sanitize and save the data.
    if (isset($_POST['course_teacher'])) {
        update_post_meta($post_id, '_course_teacher', sanitize_text_field($_POST['course_teacher']));
    }

    if (isset($_POST['course_level'])) {
        update_post_meta($post_id, '_course_level', sanitize_text_field($_POST['course_level']));
    }

    if (isset($_POST['course_price'])) {
        update_post_meta($post_id, '_course_price', sanitize_text_field($_POST['course_price']));
    }
}
add_action('save_post', 'save_course_meta_box_data');

