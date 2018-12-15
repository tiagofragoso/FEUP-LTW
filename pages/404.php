<?php
include_once('../includes/session.php');
include_once('../templates/common.php');
include_once('../database/db_user.php');
include_once('../templates/404.php');

draw_header('Page not found');
draw_nav();
draw_snippet();
draw_footer();