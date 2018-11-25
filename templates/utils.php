<?php
	function getTimeElapsed($date){
		$formattedDate = date_create_from_format('Y-m-d H:i', $date);
		$currDate = new DateTime();
		$diff = $formattedDate->diff($currDate);
		$string = '';
		if ($diff->y > 0){
			$string = $diff->y . ' year';
			if ($diff->y > 1){
				$string .= 's';
			}
			$string .= ' ago';
		} else if ($diff->m > 0){
			$string = $diff->m . ' month';
			if ($diff->m > 1){
				$string .= 's';
			}
			$string .= ' ago';
		} else if ($diff->d > 0){
			if ($diff->d > 1){
				$string = $diff->d . ' days ago';
			} else {
				$string = 'Yesterday';
			}
		} else if ($diff->h > 0){
			$string = $diff->h . ' hour';
			if ($diff->h > 1){
				$string .= 's';
			}
			$string .= ' ago';
		} else if ($diff->i > 0){
			$string = $diff->i . ' minute';
			if ($diff->i > 1){
				$string .= 's';
			}
			$string .= ' ago';
		} else {
			$string = 'Just now';
		}
		return $string;
	}

	function getPicture($userPic) {
		return isset($userPic)? 
				'data:image/jpeg;base64,'.base64_encode($userPic):
				'../assets/profile-placeholder.png';
	}


?>