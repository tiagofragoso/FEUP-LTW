<?php
    include_once('../database/db_user.php');

    $search = $_GET['search'];
    if (!isset($search)) {
        die(header('Location: /pages/feed.php'));
    }

    $users = searchSnippets($search);
    $channels = searchChannels($search);
    $snippets = searchSnippets($search);

    include_once('../templates/common.php');
    include_once('../templates/search.php');
    draw_header('SNIPZ - SEARCH');
    draw_nav();
    draw_search();
    draw_footer();
?>