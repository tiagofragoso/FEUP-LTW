<?php
	include_once('../database/db_user.php');
	include_once('../templates/utils.php');
	$request = $_SERVER['REQUEST_METHOD'];

	switch($request) {
		case 'GET':
			perform_search();
			break;
	}

	function cmpString($a, $b) {
		global $query;
		$strA = $a['match'];
		$strB = $b['match'];
		return levenshtein($query, $strA) < levenshtein($query, $strB);
	}

	function perform_search(){
		header('Content-Type: application/json');
		if (empty($_GET['query'])) {
			http_response_code(400);
			echo json_encode(array(
				'success' => false,
				'reason' => 'Missing query'
			));
		}
		try {
			$query = $_GET['query'];
			$snippets = searchSnippets($query);
			uasort($snippets, cmpString);
			$users = searchUsers($query);
			uasort($users, cmpString);
			$channels = searchChannels($query);
			uasort($channels, cmpString);
			http_response_code(200);
			echo json_encode(array(
				'success' => true,
				'data' => array(
					'snippets' => $snippets,
					'users' => $users,
					'channels' => $channels,
				)
			));
		} catch (PDOException $err) {
			http_response_code(400);
			echo json_encode(array(
				'success' => false,
				'reason' => $err
			));
		}
	}