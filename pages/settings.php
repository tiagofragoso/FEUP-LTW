<?php 
    include_once('../includes/session.php');
    include_once('../templates/profile.php');
    include_once('../templates/common.php');
    include_once('../database/db_user.php');

    if (!isset($_SESSION['user'])) {
        die(header('Location: /pages/login.php'));
    }

    draw_header('SNIPZ - SETTINGS');
    draw_nav();
    draw_settings_profile();
    draw_footer();
?>