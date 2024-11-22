<?php

// Allow from any origin (you can specify your frontend URL here if desired)
header("Access-Control-Allow-Origin: *");

// Allow certain methods (you can restrict this to only the methods you need)
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

// Allow headers (you can specify only the ones you need)
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Handle preflight requests (for methods other than GET/POST)
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

include_once('config/db.php');
include_once('routes/api.php');
?>
