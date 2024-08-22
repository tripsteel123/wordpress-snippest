<?php
// اضافه کردن منوی مدیریت کاربران VIP
function vip_users_admin_menu() {
    add_menu_page(
        'مدیریت کاربران VIP', // عنوان صفحه
        'کاربران VIP', // عنوان منو
        'manage_options', // قابلیت دسترسی
        'vip-users', // شناسه منو
        'vip_users_management_page', // تابع برای نمایش محتوا
        'dashicons-star-filled', // آیکون منو
        6 // موقعیت منو
    );

    // زیرمنوی نمایش کاربران VIP
    add_submenu_page(
        'vip-users', // شناسه منوی والد
        'لیست کاربران VIP', // عنوان صفحه
        'نمایش کاربران VIP', // عنوان زیرمنو
        'manage_options', // قابلیت دسترسی
        'vip-users-list', // شناسه زیرمنو
        'vip_users_list_page' // تابع برای نمایش محتوا
    );
}
add_action('admin_menu', 'vip_users_admin_menu');

// نمایش صفحه مدیریت کاربران VIP
function vip_users_management_page() {
    ?>
    <div class="wrap">
        <h1>مدیریت کاربران VIP</h1>
        <form method="post" action="">
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">نام کامل</th>
                    <td>
                        <input type="text" name="vip_user_full_name" placeholder="نام کامل" required />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">تاریخ تولد</th>
                    <td>
                        <input type="date" name="vip_user_dob" required />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">ایمیل</th>
                    <td>
                        <input type="email" name="vip_user_email" placeholder="ایمیل کاربر" required />
                    </td>
                </tr>
                <tr valign="top">
                    <td colspan="2">
                        <input type="submit" name="add_vip_user" class="button button-primary" value="افزودن" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <?php
}


