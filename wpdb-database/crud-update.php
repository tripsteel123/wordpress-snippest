<?php
global $wpdb;
$table_name = $wpdb->prefix . 'your_table_name'; // نام جدول

// داده‌های جدیدی که می‌خواهید به‌روزرسانی کنید
$data = array(
    'name'  => 'New Name',  // مقدار جدید
    'email' => 'newemail@example.com'  // مقدار جدید
);
$format = ["%s" , "%s"];

// شرطی که باید برآورده شود (مثلاً بر اساس ID)
$where = array(
    'id' => 1  // شناسه رکوردی که باید به‌روزرسانی شود
);
$where_format = ["%d];

// اجرای عملیات به‌روزرسانی
$updated = $wpdb->update( $table_name, $data, $where , $format, $where_format  );

if ( $updated !== false ) {
    echo 'داده‌ها با موفقیت به‌روزرسانی شدند!';
} else {
    echo 'خطا در به‌روزرسانی داده‌ها!';
}
