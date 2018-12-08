<?php
    include_once('../includes/session.php');

    $request = $_SERVER['REQUEST_METHOD'];

    switch($request) {
        case 'POST':
            change_photo();
            break;
    }

    function change_photo() {
        header('Content-Type: application/json');
        if (empty($_SESSION['user'])) {
            http_response_code(400);
            echo json_encode(array(
                'success' => false,
                'reason' => 'Requires login'
            ));
            exit;
        }
        
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $_SESSION['user'];
        $filename = $_SERVER['DOCUMENT_ROOT']."/assets/$id.jpg";

        $encodedData = str_replace(' ','+', $data['photo']);
        $decodedData = base64_decode($encodedData);

        try {
            if ($res = file_put_contents($filename, $decodedData)) {
                http_response_code(200);
                echo json_encode(array(
                    'success' => true,
                ));
                exit;
            } else {
                http_response_code(400);
                echo json_encode(array(
                    'success' => false,
                    'reason' => 'Couln not save photo',
                ));
                exit;
            }
        } catch (Throwable $th) {
            http_response_code(400);
            echo json_encode(array(
                'success' => false,
                'reason' => $th,
            ));
            exit;
        }
        
    }
?>