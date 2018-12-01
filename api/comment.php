<?php
	include_once('../database/db_user.php');
	include_once('../includes/session.php');
	
	$request = $_SERVER['REQUEST_METHOD'];

	switch($request) {
		case 'GET':
			get_comments();
			break;
		case 'POST':
			post_comment();
			break;
	}

	function get_comments() {
		header('Content-Type: application/json');
		if (isset($_GET['snippet'])){
			$res = getSnippetComments($_GET['snippet']);
			http_response_code(200);
			echo json_encode(array(
				'success' => true,
				'data' => $res
			));

		} else {
			http_response_code(400);
			echo json_encode(array(
				'success' => false,
				'reason' => 'Invalid request'
			));
			exit;
		}
	}

	function post_comment() {
		if (!isset($_SESSION['user'])) {
			header('Content-Type: application/json');
			http_response_code(400);
			echo json_encode(array (
				'success' => false,
				'reason' => 'Requires login' 
			));
			exit;
		}
		header('Content-Type: application/json');
		$data = json_decode(file_get_contents('php://input'), true);
		if (!isset($data['snippet'])) {
			http_response_code(400);
			echo json_encode(array(
				'success' => false,
				'reason' => 'Missing snippet id'
			));
			exit;
		} else if (!isset($data['text'])) {
			http_response_code(400);
			echo json_encode(array(
				'success' => false,
				'reason' => 'Missing comment text'
			));
			exit;
		} else {
			try {
				$currDate = (new DateTime())->format('Y-m-d H:i');
				postComment($_SESSION['user'], $data['snippet'], $data['text'], $currDate);
				http_response_code(200);
					echo json_encode(array(
						'success' => true,
						'data' => array('username' => $_SESSION['username'], 'date' => $currDate)
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