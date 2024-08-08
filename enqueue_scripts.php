<?php
//for enqueue scripts in login&register pages use This:
function themeslug_enqueue_style() {
   wp_enqueue_style( 'style-name', get_stylesheet_uri() );
   wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/example.js', array(), '1.0.0', true );
}

add_action( 'login_enqueue_scripts', 'themeslug_enqueue_style', 10 );

##################################

//for enqueue scripts in front pages use This:

function wpdocs_theme_name_scripts() {
    wp_enqueue_style( 'style-name', get_stylesheet_uri() );
    wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/example.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'wpdocs_theme_name_scripts' );

##################################

//for enqueue scripts in admin pages use This:

function wpdocs_enqueue_custom_admin_style() {
    wp_enqueue_style( 'style-name', get_stylesheet_uri() );
    wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/example.js', array(), '1.0.0', true );
}
add_action( 'admin_enqueue_scripts', 'wpdocs_enqueue_custom_admin_style' );
