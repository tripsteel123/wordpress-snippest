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

if ( $updated === false ) {
    echo 'دخطا در ثیب ذلذع!';
} elseif($updated === 0) {
    echo 'هیچ داده ای تغییر نکرد';
} else {
    echo "Upodated Ok!";
}
