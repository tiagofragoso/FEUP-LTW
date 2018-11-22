<?php

include_once('../database/db_user.php');

$arr = getSnippets();

echo json_encode($arr);

?>