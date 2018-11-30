<?php
	$request = $_SERVER['REQUEST_METHOD'];

	switch($request) {
		case 'POST':
			handle_post_req();
			break;
	}

	function handle_post_req() {
		header('Content-Type', 'application/json');
		$data = json_decode(file_get_contents('php://input'), true);

		if (empty($data['username'])) {
			http_response_code(400);
			echo json_encode([
				'success' => false,
				'reason' => 'Username is missing'
			]);
			exit;
		}
	}
?>