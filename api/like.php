<?php
	include_once('../database/db_user.php');
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
		header('Content-Type: application/json');
		if (isset($_GET['snippet']) && isset($_GET['user'])){
			$res = hasLike($_GET['user'], $_GET['snippet']);
			http_response_code(200);
			echo json_encode(array(
				'success' => true,
				'hasLike' => $res));

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
		if (empty($data['user'])) {
			http_response_code(400);
			echo json_encode(array(
				'success' => false,
				'reason' => 'Missing user'
			));
			exit;
		} else if (empty($data['snippet'])) {
			http_response_code(400);
			echo json_encode(array(
				'success' => false,
				'reason' => 'Missing snippet id'
			));
			exit;
		} else if (empty($data['isLike'])) {
			http_response_code(400);
			echo json_encode(array(
				'success' => false,
				'reason' => 'Missing like/dislike'
			));
			exit;
		} else {
			try {
				postLike($data['user'], $data['snippet'], $data['isLike']);
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

	function delete_like() {
		header('Content-Type: application/json');
		if (empty($_GET['user'])) {
			http_response_code(400);
			echo json_encode(array(
				'success' => false,
				'reason' => 'Missing user'
			));
			exit;
		} else if (empty($_GET['snippet'])) {
			http_response_code(400);
			echo json_encode(array(
				'success' => false,
				'reason' => 'Missing snippet id'
			));
			exit;
		} else {
			try {
				deleteLike($_GET['user'], $_GET['snippet']);
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