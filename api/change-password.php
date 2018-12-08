<?php
    include_once('../database/db_user.php');
    include_once('../includes/session.php');
    $request = $_SERVER['REQUEST_METHOD'];

    switch($request) {
        case 'POST':
            change_password();
            break;
    }

    function change_password() {
        if (empty($_SESSION['user'])) {
            http_response_code(400);
            echo json_encode(array(
                'success' => false,
                'reason' => 'Requires login'
            ));
            exit;        
        }
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);
        if (empty($data['oldPassword'])) {
            http_response_code(400);
            echo json_encode(array(
                'success' => false,
                'reason' => 'Missing old password'
            ));
            exit;
        } else if(empty($data['newPassword'])) {
            http_response_code(400);
            echo json_encode(array(
                'success' => false,
                'reason' => 'Missing new password'
            ));
            exit;
        } else if ($res = validUserId($_SESSION['user'], $data['oldPassword'])) {
                if (changePassword($_SESSION['user'], $data['newPassword'])) {
                    http_response_code(200);
                    echo json_encode(array(
                        'success' => true,
                    ));
                    exit;
                } else {
                    http_response_code(400);
                    echo json_encode(array(
                        'success' => false,
                        'reason' => 'Could not change password'
                    ));
                    exit;
                }
        } else {
            http_response_code(400);
            echo json_encode(array(
                'success' => false,
                'reason' => 'Invalid password'
            ));
            exit;
        }
    }
?>