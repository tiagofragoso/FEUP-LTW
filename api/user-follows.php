<?php
    include_once('../database/db_user.php');
	include_once('../includes/session.php');
	
    $request = $_SERVER['REQUEST_METHOD'];

    switch($request) {
        case 'GET':
            get();
            break;
    }

    function get() {
        header('Content-Type: application/json');
        if (!empty($_GET['id']) && !empty($_GET['query'])) {
            if ($_GET['query'] !== 'following' && $_GET['query'] !== 'followers'){
				http_response_code(400);
				echo json_encode(array(
					'success' => false,
					'reason' => 'Invalid request'
				));
				exit;
			}
			$res = $_GET['query'] === 'following'? getFollowing($_GET['id']): getFollowers($_GET['id']);
            http_response_code(200);
            echo json_encode(array(
                'success' => true,
                'data' => array(
					'success' => true,
                    'data' => $res
                )));
        } else {
            http_response_code(400);
            echo json_encode(array(
                'success' => false,
                'reason' => 'Invalid request'
            ));
            exit;
        }
    }
?>