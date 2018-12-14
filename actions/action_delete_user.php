<?php 
    include_once('../database/db_user.php');
    include_once('../includes/session.php');

    deleteUser($_SESSION['user']);
    if (file_exists("../assets/" . $_SESSION['user'] . ".jpg")) {
        unlink("../assets/" . $_SESSION['user'] . ".jpg");
    }
    session_destroy();
    header("Location: ../pages/feed.php");
?>