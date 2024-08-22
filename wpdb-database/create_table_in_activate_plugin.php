<?php

register_activation_hook(__FILE__, 'management_users_activate');
function management_users_activate()
{
    global $wpdb;
    ## get code by SHOW CREATE TABLE wp_prousers
    $tbl_name = $wpdb->prefix . "prousers";
    $sql = "
    CREATE TABLE `$tbl_name` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ID`)
    ) 
        ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
    ";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta( $sql );
}

