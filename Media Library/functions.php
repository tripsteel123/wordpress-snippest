<?php
/*
Plugin Name: My Media Library Plugin
Description: A plugin to upload files using the WordPress Media Library.
Version: 1.0
Author: Your Name
*/
define('ZLM_PLG_URL' , plugin_dir_url( __FILE__ ));
// اضافه کردن اسکریپت های لازم
add_action('admin_enqueue_scripts', 'mmlp_enqueue_scripts');
function mmlp_enqueue_scripts($hook) {
    if ($hook != 'toplevel_page_media-library-uploader') {
        return;
    }
    wp_enqueue_media();
    wp_enqueue_script('mmlp_script', plugins_url('mmlp-script.js', __FILE__), array('jquery'), null, true);
}
add_action('admin_menu', 'mmlp_add_admin_menu');
function mmlp_add_admin_menu() {
    add_menu_page('Media Library Uploader', 'Media Library Uploader', 'manage_options', 'media-library-uploader', 'mmlp_page_content', 'dashicons-upload', 26);
}

// محتوای صفحه پلاگین
function mmlp_page_content() {
    ?>
    <div class="wrap">
        <h1>Upload File Using Media Library</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('mmlp_options_group');
            do_settings_sections('media-library-uploader');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// ثبت تنظیمات
add_action('admin_init', 'mmlp_settings_init');
function mmlp_settings_init() {
    register_setting('mmlp_options_group', 'mmlp_options');

    add_settings_section(
        'mmlp_settings_section',
        __('Media Library File', 'mmlp'),
        'mmlp_settings_section_callback',
        'media-library-uploader'
    );

    add_settings_field(
        'mmlp_file',
        __('Select File', 'mmlp'),
        'mmlp_file_render',
        'media-library-uploader',
        'mmlp_settings_section'
    );
}

function mmlp_settings_section_callback() {
    echo __('Upload or select a file from the WordPress Media Library.', 'mmlp');
}

function mmlp_file_render() {
    $options = get_option('mmlp_options');
    $file_id = isset($options['mmlp_file']) ? $options['mmlp_file'] : '';
    ?>
    <input type="hidden" id="mmlp_file" name="mmlp_options[mmlp_file]" value="<?php echo esc_attr($file_id); ?>" />
    <button type="button" class="button" id="mmlp_file_button">Select File</button>
    <div id="mmlp_file_preview">
        <?php if ($file_id): ?>
            <img src="<?php echo esc_url(wp_get_attachment_url($file_id)); ?>" style="max-width: 300px;" />
        <?php endif; ?>
    </div>
    <?php
}


// اضافه کردن اسکریپت های لازم
add_action('admin_enqueue_scripts', 'mmlp_enqueue_scripts');
function mmlp_enqueue_scripts($hook) {
    if ($hook != 'toplevel_page_media-library-uploader') {
        return;
    }
    wp_enqueue_media();
    wp_enqueue_script('mmlp_script', plugins_url('mmlp-script.js', __FILE__), array('jquery'), null, true);
}
