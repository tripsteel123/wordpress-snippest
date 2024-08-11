<?php
// enqueue ui-core and ui sortable jquery
function wpdocs_enqueue_custom_admin_style() {
    wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/example.js', array('jquery' , 'jquery-ui-core' , 'jquery-sortable'), '1.0.0', true );
}
add_action( 'admin_enqueue_scripts', 'wpdocs_enqueue_custom_admin_style' );


function add_course_meta_boxes() {
    add_meta_box(
        'course_playlist',
        'Course Play List',
        'render_course_playlist_meta_box',
        'course',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'add_course_meta_boxes');

function render_course_playlist_meta_box($post) {
    include "view.html";
}
