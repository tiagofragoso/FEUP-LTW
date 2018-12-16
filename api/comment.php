<?php
	include_once('../database/db_user.php');
	include_once('../templates/utils.php');
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
		if (!empty($_GET['snippet'])){
			$res = getSnippetComments($_GET['snippet']);
			foreach ($res as &$r) {
				$r['date'] = getTimeElapsed($r['date']);
			}
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
		header('Content-Type: application/json');
		if (empty($_SESSION['user'])) {
			http_response_code(403);
			echo json_encode(array (
				'success' => false,
				'reason' => 'Requires login' 
			));
			exit;
		}
		$data = json_decode(file_get_contents('php://input'), true);
		if (empty($data['snippet'])) {
			http_response_code(400);
			echo json_encode(array(
				'success' => false,
				'reason' => 'Missing snippet id'
			));
			exit;
		} else if (empty($data['text'])) {
			http_response_code(400);
			echo json_encode(array(
				'success' => false,
				'reason' => 'Missing comment text'
			));
			exit;
		} else {
			try {
				$currDate = (new DateTime())->format('Y-m-d H:i');
				$user = getUser($_SESSION['user']);
				$id = postComment($_SESSION['user'], $data['snippet'], $data['text'], $currDate, $data['parent']);
				http_response_code(200);
					echo json_encode(array(
						'success' => true,
						'data' => array('id' => $id, 'username' => $user['username'], 'date' => getTimeElapsed($currDate), 'name' => $user['name'])
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