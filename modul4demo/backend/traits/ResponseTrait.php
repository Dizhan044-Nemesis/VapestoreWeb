<?php
namespace Traits;

trait ResponseTrait {
    // Mengirimkan Response JSON
    public function sendResponse($data, $message = '', $status = 200) {
        header('Content-Type: application/json');
        echo json_encode([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ]);
        exit;
    }

    // Mengirimkan Error Response
    public function sendError($message, $status = 400) {
        header('Content-Type: application/json');
        echo json_encode([
            'status' => $status,
            'message' => $message,
            'data' => null
        ]);
        exit;
    }
}
?>
