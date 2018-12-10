<?php 
    include_once('../database/db_user.php');
    include_once('../includes/session.php');

    if (!isset($_SESSION['user'])) {
        header('Content-Type: application/json');
        http_response_code(400);
        echo json_encode(array(
            'success' => false,
            'reason' => 'Requires login'
        ));
        exit;
    }

    $request = $_SERVER['REQUEST_METHOD'];

    switch($request) {
        case 'GET':
            get_like();
            break;
        case 'POST':
            post_like();
            break;
        case 'DELETE':
            delete_like();
            break;
    }

    function get_like() {
        header('Content-Type: application/ json');
        if (isset($_GET['comment'])) {
            $res = hasLikeComment($_SESSION['user'], $_GET['comment']);
            http_response_code(200);
            echo json_encode(array(
                'success' => true,
                'data' => array(
                    'hasLike' => $res
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

    function post_like() {
		header('Content-Type: application/json');
		$data = json_decode(file_get_contents('php://input'), true);
		if (!isset($data['comment'])) {
			http_response_code(400);
			echo json_encode(array(
				'success' => false,
				'reason' => 'Missing comment id'
			));
			exit;
		} else if (!isset($data['isLike'])) {
			http_response_code(400);
			echo json_encode(array(
				'success' => false,
				'reason' => 'Missing like/dislike'
			));
			exit;
		} else {
			try {
				postLikeComment($_SESSION['user'], $data['comment'], $data['isLike']);
				http_response_code(200);
					echo json_encode(array(
						'success' => true,
					));
					exit;
			} catch (PDOException $err) {
				http_response_code(400);
				echo json_encode(array(
					'success' => false,
					'reason' => $err
				));
				exit;
			}
		}
    }
    
    function delete_like() {
		header('Content-Type: application/json');
		if (!isset($_GET['comment'])) {
			http_response_code(400);
			echo json_encode(array(
				'success' => false,
				'reason' => 'Missing comment id'
			));
			exit;
		} else {
			try {
				deleteLikeComment($_SESSION['user'], $_GET['comment']);
				http_response_code(200);
					echo json_encode(array(
						'success' => true
					));
					exit;
			} catch (PDOException $err) {
				http_response_code(400);
				echo json_encode(array(
					'success' => false,
					'reason' => $err
				));
				exit;
			}
		}
	}
?>