<?php
## for one row
global $wpdb;
$table_name = $wpdb->prefix . 'vip_users'; // نام جدول

// کوئری برای واکشی یک ردیف بر اساس ID
$id = 1; // مثلاً ID مورد نظر
$row = $wpdb->get_row( $wpdb->prepare(
    "SELECT * FROM $table_name WHERE id = %d", $id
) );

// نمایش داده‌ها
if($row) {
    echo 'Name: ' . esc_html($row->name);
    echo 'Email: ' . esc_html($row->email);
}

## for several rows
global $wpdb;
$table_name = $wpdb->prefix . 'your_table_name'; // نام جدول

// کوئری برای واکشی چندین ردیف
$results = $wpdb->get_results( "SELECT * FROM $table_name WHERE status = 'active'", OBJECT );

// نمایش داده‌ها
if ( $results ) {
    foreach ( $results as $row ) {
        echo 'Name: ' . esc_html($row->name) . '<br>';
        echo 'Email: ' . esc_html($row->email) . '<br>';
    }
}

## For get a specific data
global $wpdb;
$table_name = $wpdb->prefix . 'your_table_name'; // نام جدول

// کوئری برای واکشی یک مقدار خاص (مثلاً ایمیل)
$email = $wpdb->get_var( $wpdb->prepare(
    "SELECT email FROM $table_name WHERE id = %d", 1
) );

// نمایش ایمیل
if($email) {
    echo 'Email: ' . esc_html($email);
}

## prepare method for security stuff

$query = $wpdb->prepare(
    "SELECT * FROM $table_name WHERE id = %d AND status = %s",
    $id,        // جایگزینی %d
    'active'   // جایگزینی %s
);
$results = $wpdb->get_results( $query );
