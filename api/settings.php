<?php 
    include_once('../database/db_user.php');
    include_once('../includes/session.php');
    $request = $_SERVER['REQUEST_METHOD'];

    switch($request) {
        case 'POST':
            post_settings();
            break;
        case 'GET':
            get_settings();
            break;
        case 'DELETE':
            delete_user();
            break;
    }

    function post_settings() {
        if (empty($_SESSION['user'])){
            http_response_code(400);
            echo json_encode(array(
                'success' => false,
                'reason' => 'Requires login'
            ));
            exit;
        }
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);
        if (empty($data['username'])) {
            http_response_code(400);
            echo json_encode(array(
                'success' => false,
                'reason' => 'Missing username'
            ));
            exit;
        } else if(empty($data['email'])) {
            http_response_code(400);
            echo json_encode(array(
                'success' => false,
                'reason' => 'Missing email'
            ));
            exit;
        } else {
            $idUsername = getUserByUsername($data['username'])['id'];
            $idEmail = getUserByEmail($data['email'])['id'];

            if ($idUsername !== $_SESSION['user'] && isset($idUsername)) {
                http_response_code(400);
                echo json_encode(array(
                    'success' => false,
                    'reason' => 'Username already in use'
                ));
                exit;
            } else if ($idEmail !== $_SESSION['user'] && isset($idEmail)) {
                http_response_code(400);
                echo json_encode(array(
                    'success' => false,
                    'reason' => 'Email already in use'
                ));
                exit;
            } else if (updateUser($_SESSION['user'], $data['username'], $data['name'], $data['email'])) {
                http_response_code(200);
                echo json_encode(array(
                    'success' => true
                ));
                exit;
            } else {
                http_response_code(400);
                echo json_encode(array(
                    'success' => false,
                    'reason' => 'Could not update profile'
                ));
                exit;
            }
        }
    }

    function get_settings() {
        header('Content-Type: application/json');
        $res = getUser($_SESSION['user']);
        if (empty($res)) {
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
                'data' => array(
                    'name' => $res['name'],
                    'username' => $res['username'],
                    'email' => $res['email']
                )));
            exit;
        }
    }

    function delete_user() {
        header('Content-Type: application/json');
        if (empty($_SESSION['user'])) {
            http_response_code(403);
            echo json_encode(array(
                'success' => false,
                'reason' => 'Requires login'
            ));
            exit;
        } else {
            try {
                deleteUser($_SESSION['user']);
                http_response_code(200);
                echo json_encode(array(
                    'success' => true
                ));
                exit;
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
?>