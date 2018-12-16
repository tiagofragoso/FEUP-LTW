<?php
	include_once('../database/db_user.php');
	include_once('../includes/session.php');
	$request = $_SERVER['REQUEST_METHOD'];

	switch($request) {
		case 'GET':
			get_languages();
			break;
		case 'POST':
			post_follow();
			break;
		case 'DELETE':
			delete_follow();
			break;
	}

	function get_languages() {
		header('Content-Type: application/json');
		try {
			$res = getChannels($_SESSION['user']);
			http_response_code(200);
			echo json_encode(array(
				'success' => true,
				'data' => $res
			));
		} catch (PDOException $err) {
			http_response_code(400);
			echo json_encode(array(
				'success' => false,
				'reason' => $err
			));
		}
	}

	function post_follow() {
		header('Content-Type: application/json');
		$data = json_decode(file_get_contents('php://input'), true);
		if (empty($_SESSION['user'])){
			http_response_code(403);
			echo json_encode(array(
				'success' => false,
				'reason' => 'Requires login'
			));
			exit;
		} else if (empty($data['channel'])){
			http_response_code(400);
			echo json_encode(array(
				'success' => false,
				'reason' => 'No channel code'
			));
			exit;
		} else {
			try {
				$res = followChannel($_SESSION['user'], $data['channel']);
				http_response_code(200);
				echo json_encode(array(
					'success' => true
				));
			} catch (PDOException $err) {
				http_response_code(400);
				echo json_encode(array(
					'success' => false,
					'reason' => $err
				));
			}
		}
	}

	function delete_follow() {
		header('Content-Type: application/json');
		if (empty($_SESSION['user'])){
			http_response_code(403);
			echo json_encode(array(
				'success' => false,
				'reason' => 'Requires login'
			));
			exit;
		} else if (empty($_GET['channel'])){
			http_response_code(400);
			echo json_encode(array(
				'success' => false,
				'reason' => 'No channel code'
			));
			exit;
		} else {
			try {
				$res = unfollowChannel($_SESSION['user'], $_GET['channel']);
				http_response_code(200);
				echo json_encode(array(
					'success' => true
				));
			} catch (PDOException $err) {
				http_response_code(400);
				echo json_encode(array(
					'success' => false,
					'reason' => $err
				));
			}
		}
	}
?>