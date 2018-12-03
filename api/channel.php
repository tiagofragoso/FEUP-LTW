<?php
	include_once('../database/db_user.php');
	include_once('../includes/session.php');
	$request = $_SERVER['REQUEST_METHOD'];

	switch($request) {
		case 'GET':
			get_languages();
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
?>