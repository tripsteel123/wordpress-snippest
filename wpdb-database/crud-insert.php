<?php
## For Proper Ridirect ##
add_action('admin_init', 'form_submit');
## For Proper Ridirect ##
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
add_action('admin_notices', 'zlm_notices');
function zlm_notices() {
    if ( $_GET['page'] == "vip-users"  && isset($_GET['status']) && $_GET['status'] == 'success') {
        echo '<div class="notice notice-success is-dismissible">';
            echo "<p>کاربر با موفقت اضافه شد!</p>";
        echo '</div>';
    }
}
