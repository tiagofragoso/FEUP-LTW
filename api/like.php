<?php
	include_once('../database/db_user.php');
	include_once('../includes/session.php');
	
	if (!isset($_SESSION['user'])) {
		header('Content-Type: application/json');
		http_response_code(403);
		echo json_encode(array (
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
		header('Content-Type: application/json');
		if (!empty($_GET['snippet'])){
			$res = hasLike($_SESSION['user'], $_GET['snippet']);
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
		if (empty($data['snippet'])) {
			http_response_code(400);
			echo json_encode(array(
				'success' => false,
				'reason' => 'Missing snippet id'
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
				postLike($_SESSION['user'], $data['snippet'], $data['isLike']);
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
		if (empty($_GET['snippet'])) {
			http_response_code(400);
			echo json_encode(array(
				'success' => false,
				'reason' => 'Missing snippet id'
			));
			exit;
		} else {
			try {
				deleteLike($_SESSION['user'], $_GET['snippet']);
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