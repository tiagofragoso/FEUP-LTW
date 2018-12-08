<?php
	include_once('../database/db_user.php');
	include_once('../includes/session.php');

	$request = $_SERVER['REQUEST_METHOD'];

	switch($request) {
		case 'PUT':
			login();
			break;
		case 'POST':
			signup();
			break;
		case 'DELETE':
			logout();
			break;
	}

	function login() {
		header('Content-Type', 'application/json');
		$data = json_decode(file_get_contents('php://input'), true);
		if (empty($data['username'])) {
			http_response_code(400);
			echo json_encode([
				'success' => false,
				'reason' => 'Username is missing'
			]);
			exit;
		} else if (empty($data['password'])) {
			http_response_code(400);
			echo json_encode([
				'success' => false,
				'reason' => 'Password is missing'
			]);
			exit;
		} else {
			try {
				if ($row = validLogin($data['username'], $data['password'])){
					$_SESSION['user'] = $row['id'];
					http_response_code(200);
					echo json_encode([
						'success' => true
					]);
					exit;
				} else {
					http_response_code(400);
					echo json_encode([
						'success' => false,
						'reason' => 'Invalid credentials'
					]);
					exit;
				}
			} catch (PDOException $err) {
				http_response_code(400);
				echo json_encode([
					'success' => false,
					'reason' => $err
				]);
				exit;
			}
		}
	}

	function signup() {
		header('Content-Type', 'application/json');
		$data = json_decode(file_get_contents('php://input'), true);
		if (empty($data['username'])) {
			http_response_code(400);
			echo json_encode([
				'success' => false,
				'reason' => 'Username is missing'
			]);
			exit;
		} else if (empty($data['password'])) {
			http_response_code(400);
			echo json_encode([
				'success' => false,
				'reason' => 'Password is missing'
			]);
			exit;
		} else if (empty($data['email'])) {
			http_response_code(400);
			echo json_encode([
				'success' => false,
				'reason' => 'Email is missing'
			]);
			exit;
		} else {
			try {
				if ($id = registerUser($data['email'], $data['username'], $data['password'])){
					$_SESSION['user'] = $id;
					http_response_code(200);
					echo json_encode([
						'success' => true
					]);
					exit;
				}
			} catch (PDOException $err) {
				http_response_code(400);
				echo json_encode([
					'success' => false,
					'reason' => $err
				]);
				exit;
			}
		}
	}
?>