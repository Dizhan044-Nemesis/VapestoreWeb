<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vape_store";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $id = isset($_GET['id']) ? intval($_GET['id']) : null;
        if ($id) {
            $sql = "SELECT * FROM products WHERE id = $id";
            $result = $conn->query($sql);
            echo json_encode($result->fetch_assoc());
        } else {
            $sql = "SELECT * FROM products";
            $result = $conn->query($sql);
            $products = [];
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
            echo json_encode($products);
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        $name = $data['name'];
        $description = $data['description'];
        $price = $data['price'];
        $image_url = $data['image_url'];

        $sql = "INSERT INTO products (name, description, price, image_url) VALUES ('$name', '$description', $price, '$image_url')";
        if ($conn->query($sql)) {
            echo json_encode(["success" => true, "id" => $conn->insert_id]);
        } else {
            echo json_encode(["error" => $conn->error]);
        }
        break;

    case 'PUT':
        $id = intval($_GET['id']);
        $data = json_decode(file_get_contents("php://input"), true);
        $name = $data['name'];
        $description = $data['description'];
        $price = $data['price'];
        $image_url = $data['image_url'];

        $sql = "UPDATE products SET name='$name', description='$description', price=$price, image_url='$image_url' WHERE id=$id";
        if ($conn->query($sql)) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["error" => $conn->error]);
        }
        break;

    case 'DELETE':
        $id = intval($_GET['id']);
        $sql = "DELETE FROM products WHERE id=$id";
        if ($conn->query($sql)) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["error" => $conn->error]);
        }
        break;

    default:
        echo json_encode(["error" => "Invalid request method"]);
        break;
}

$conn->close();
?>
