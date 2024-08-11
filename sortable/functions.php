<?php
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
    include view.html;
}
