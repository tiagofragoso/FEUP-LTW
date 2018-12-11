<?php
	include_once('../database/db_user.php');
	include_once('../includes/session.php');
	$request = $_SERVER['REQUEST_METHOD'];

	switch($request) {
		case 'GET':
			get_snippets();
			break;
		case 'POST':
			post_new_snippet();
			break;
	}
	
	function get_snippets() {
		header('Content-Type: application/json');
		if (empty($_GET['id'])){
			http_response_code(400);
			echo json_encode(array(
				'success' => false,
				'reason' => 'No id'
			));
			exit;
		} else {
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
				echo json_encode(array(
					'success' => true,
					'data' => $res
				));
				exit;
			}
			
		}
	}

	function post_new_snippet() {
		header('Content-Type: application/json');
		if (empty($_SESSION['user'])){
			http_response_code(403);
			echo json_encode(array(
				'success' => false,
				'reason' => 'Requires login'
			));
			exit;
		}
		$data = json_decode(file_get_contents('php://input'), true);
		if (!preg_match('/^[a-zA-Z]+[ :\-#.\w]{0,69}$/', $data['title'])) {
			http_response_code(400);
			echo json_encode(array(
				'success' => false,
				'reason' => 'Title invalid'
			));
			exit;
		} else if (empty($data['code'])) {
			http_response_code(400);
			echo json_encode(array(
				'success' => false,
				'reason' => 'File missing'
			));
			exit;
		} else if (empty($data['language'])) {
			http_response_code(400);
			echo json_encode(array(
				'success' => false,
				'reason' => 'Language missing'
			));
			exit;
		} else {
			if (postSnippet($data['title'], $data['description'], $data['code'], $data['language'], 
				(new DateTime())->format('Y-m-d H:i'), $_SESSION['user'])){
					http_response_code(201);
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

?>