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
        $RFC5322EmailRegex = '/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD';
        if (empty($_SESSION['user'])){
            http_response_code(403);
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
            } else if (!preg_match('/^[\-a-zA-Z\s]{5,30}$/', $data['name'])) {
                http_response_code(400);
                echo json_encode(array(
                    'success' => false,
                    'reason' => 'Username invalid'
                ));
                exit;
            } else if (!preg_match('/^[-\w]{5,25}$/', $data['username'])) {
                http_response_code(400);
                echo json_encode(array(
                    'success' => false,
                    'reason' => 'Username invalid'
                ));
                exit;
            } else if (!preg_match($RFC5322EmailRegex, $data['email'])) {
                http_response_code(400);
                echo json_encode(array(
                    'success' => false,
                    'reason' => 'Password invalid'
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