<?php
    include_once('../database/db_user.php');

    $query = $_GET['query'];
    if (empty($query)) {
        die(header('Location: /pages/feed.php'));
    }

    $res = search($query);

    include_once('../templates/common.php');
    include_once('../templates/search.php');
    draw_header('SNIPZ - SEARCH', array('search'));
    draw_nav();
    draw_search($res['users'], $res['channels'], $res['snippets'], $query);
    draw_footer();

    function cmpString($a, $b) {
		global $query;
		$strA = $a['match'];
		$strB = $b['match'];
		return levenshtein($query, $strA) < levenshtein($query, $strB);
	}

	function search($query) {
		$snippets = searchSnippets($query);
		uasort($snippets, cmpString);
		$users = searchUsers($query);
		uasort($users, cmpString);
		$channels = searchChannels($query);
		uasort($channels, cmpString);
		return array(
			'snippets' => $snippets,
			'users' => $users,
			'channels' => $channels,
		);
	}



?>