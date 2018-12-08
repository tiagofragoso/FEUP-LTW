<?php
    include_once('../includes/session.php');

    $request = $_SESSION['REQUEST_METHOD'];

    switch($request) {
        case 'POST':
            change_photo();
            break;
    }

    function change_photo() {
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
        $id = $_SESSION['user'];
        $filename = "/assests/$id.jpg";
        if (move_uploaded_file($data['photo'], $filename)) {
            http_response_code(200);
            echo json_encode(array(
                'success' => true,
            ));
            exit;
        } else {
            http_response_code(400);
            echo json_encode(array(
                'success' => false,
                'reason' => 'Could not save photo',
            ));
            exit;
        }
    }
?>