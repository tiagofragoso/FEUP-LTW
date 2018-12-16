<?php
    include_once('../database/db_user.php');
    include_once('../includes/session.php');

    if (!isset($_SESSION['user'])) {
        header('Content-type: application/json');
        http_response_code(400);
        echo json_encode(array (
            'success' => false,
            'reason' => 'Requires login'
        ));
        exit;
    }

    $request = $_SERVER['REQUEST_METHOD'];

    switch($request) {
        case 'GET':
            get_follow();
            break;
        case 'POST':
            follow();
            break;
        case 'DELETE':
            unfollow();
            break;
    }

    function get_follow() {
        header('Content-Type: application/json');
        if (!empty($_GET['id'])) {
            $res  = hasFollow($_SESSION['user'], $_GET['id']);
            http_response_code(200);
            echo json_encode(array(
                'success' => true,
                'data' => array(
                    'hasFollow' => $res
                )));
        } else {
            http_response_code(400);
            echo json_encode(array(
                'success' => false,
                'reason' => 'Invalid request'
            ));
            exit;
        }
    }

    function follow() {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);
        if (empty($data['id'])) {
            http_response_code(400);
            echo json_encode(array(
                'success' => false,
                'reason' => 'Missing user id'
            ));
            exit;
        } else {
            try {
                followUser($_SESSION['user'], $data['id']);
                http_response_code(200);
                    echo json_encode(array(
                        'success' => true,
                    ));
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

    function unfollow() {
        header('Content-Type: application/json');
        if (empty($_GET['id'])) {
            http_response_code(400);
            echo json_encode(array(
                'success' => false,
                'reason' => 'Missing user id'
            ));
        } else {
            try {
                unfollowUser($_SESSION['user'], $_GET['id']);
                http_response_code(200);
                echo json_encode(array(
                    'success' => true,
                ));
            } catch (PDOException $err) {
                http_response_code(400);
                echo json_encode(array(
                    'success' => false,
                    'reason' => $err,
                ));
                exit;
            }
        }
    }

?>