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
## for proccesss data
add_action('admin_init', 'form_submit');
function form_submit() {
    global $pagenow;
    if ($pagenow == 'admin.php' && isset($_GET['page']) && $_GET['page'] == 'vip-users') {
       if (isset($_POST['add_vip_user'])) {
           $full_name = $_POST['vip_user_full_name'];
           $email = $_POST['vip_user_email'];
           $birthday = $_POST['vip_user_dob'];
           global $wpdb;
           $data = [
               'full_name' => $full_name,
               'email' => $email,
               'birthday' => $birthday
           ];
           $inserted = $wpdb->insert($wpdb->prefix."prousers" , $data  , ['%s', '%s', '%s']);
           if ($inserted) {
               $user_id = $wpdb->insert_id;
               wp_safe_redirect(admin_url() . "admin.php?page=vip-users&status=success&user_inserted=$user_id");
           }else{

           }
       }
    }
}

## code for page submenu : 

// تابع نمایش لیست کاربران VIP در زیرمنو
function vip_users_list_page() {
    ?>
    <div class="wrap">
        <h1>لیست کاربران VIP</h1>
        <?php
        // واکشی لیست کاربران VIP
        $vip_users = get_users(array(
            'meta_key' => 'is_vip',
            'meta_value' => true
        ));

        if (!empty($vip_users)) {
            echo '<table class="widefat fixed striped">';
            echo '<thead><tr><th>نام کامل</th><th>تاریخ تولد</th><th>ایمیل</th></tr></thead>';
            echo '<tbody>';
            foreach ($vip_users as $vip_user) {
                $full_name = get_user_meta($vip_user->ID, 'vip_full_name', true);
                $dob = get_user_meta($vip_user->ID, 'vip_dob', true);
                echo '<tr>';
                echo '<td>' . esc_html($full_name) . '</td>';
                echo '<td>' . esc_html($dob) . '</td>';
                echo '<td>' . esc_html($vip_user->user_email) . '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p>هنوز هیچ کاربر VIPی ثبت نشده است.</p>';
        }
        ?>
    </div>
    <?php
}
