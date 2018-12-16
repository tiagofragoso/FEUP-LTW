<?php
    include_once('../database/db_user.php');
    include_once('../templates/utils.php');

    $search = $_GET['search'];
    if (!isset($search)) {
        die(header('Location: /pages/feed.php'));
    }

    $res = search($search);

    include_once('../templates/common.php');
    include_once('../templates/search.php');
    draw_header('SNIPZ - SEARCH', array('search'));
    draw_nav();
    draw_search($res['users'], $res['channels'], $res['snippets'], $search);
    draw_footer();
?>