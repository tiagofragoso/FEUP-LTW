<?php 
    include_once('../database/db_user.php');
    $request = $_SERVER['REQUEST_METHOD'];

    switch($request) {
        case 'GET':
            get_language_snippets();
            break;
    }

    function get_language_snippets() {
        header('Content-Type: application/json');
        try {
            $snippets = getLanguageSnippets($_GET['code']);
            http_response_code(200);
            echo json_encode(array(
                'success' => true,
                'data' => $snippets
            ));
        } catch (PDOException $err) {
            http_response_code(400);
            echo json_encode(array(
                'success' => false,
                'reason' => $err
            ));
        }
    }
?>