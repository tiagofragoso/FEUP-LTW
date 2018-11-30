<?php
	include_once('../database/db_user.php');
	$request = $_SERVER['REQUEST_METHOD'];

	switch($request) {
		case 'POST':
			post_new_snippet();
			break;
		case 'GET':
			get_snippet();
			break;
	}

	function post_new_snippet() {
		header('Content-Type: application/json');
		$data = json_decode(file_get_contents('php://input'), true);
		if (empty($data['title'])) {
			http_response_code(400);
			echo json_encode(array(
				'success' => false,
				'reason' => 'Missing title'
			));
			exit;
		} else if (empty($data['code'])) {
			http_response_code(400);
			echo json_encode(array(
				'success' => false,
				'reason' => 'Missing file'
			));
			exit;
		} else {
			if (postSnippet($data['title'], $data['description'], $data['code'], $data['language'], 
				(new DateTime())->format('Y-m-d H:i'), $data['author'])){
					http_response_code(200);
					echo json_encode(array(
						'success' => true
					));
					exit;
			} else {
				http_response_code(400);
				echo json_encode(array(
					'success' => false,
					'reason' => 'Could not submit file'
				));
				exit;
			}
		}
	}

	function get_snippet() {
		header('Content-Type: application/json');
		if (isset($_GET['id'])){
			$res = getSnippet($_GET['id']);
			if (empty($res)){
				http_response_code(400);
				echo json_encode(array(
					'success' => false,
					'reason' => 'Invalid id'
				));
				exit;
			} else {
				http_response_code(200);
				echo json_encode($res);
				exit;
			}
		} else {
			http_response_code(400);
			echo json_encode(array(
				'success' => false,
				'reason' => 'No id'
			));
			exit;
		}
	}
?>