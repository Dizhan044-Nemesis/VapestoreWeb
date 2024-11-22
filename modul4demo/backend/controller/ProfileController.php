<?php
namespace Controller;

include_once('traits/ResponseTrait.php');
use Traits\ResponseTrait;

class ProfileController {
    use ResponseTrait;

    protected $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Fetch Profile
    public function getProfile() {
        $sql = "SELECT * FROM users LIMIT 1";
        $result = $this->conn->query($sql);
        
        if ($result->num_rows > 0) {
            $profile = $result->fetch_assoc();
            $this->sendResponse($profile, "Profile found.", 200);
        } else {
            $this->sendError("Profile not found.", 404);
        }
    }

    // Create Profile
    public function createProfile($data) {
        if (!empty($data->name) && !empty($data->email) && !empty($data->address)) {
            $name = $data->name;
            $email = $data->email;
            $address = $data->address;

            $sql = "INSERT INTO users (name, email, address) VALUES ('$name', '$email', '$address')";
            
            if ($this->conn->query($sql) === TRUE) {
                $this->sendResponse(null, "Profile created successfully.", 201);
            } else {
                $this->sendError("Error creating profile: " . $this->conn->error, 500);
            }
        } else {
            $this->sendError("Please provide name, email, and address.", 400);
        }
    }

    // Update Profile
    public function updateProfile($data) {
        if (!empty($data->name) && !empty($data->email) && !empty($data->address)) {
            $name = $data->name;
            $email = $data->email;
            $address = $data->address;

            $sql = "UPDATE users SET name='$name', email='$email', address='$address' WHERE email='$email'";

            if ($this->conn->query($sql) === TRUE) {
                $this->sendResponse(null, "Profile updated successfully.", 200);
            } else {
                $this->sendError("Error updating profile: " . $this->conn->error, 500);
            }
        } else {
            $this->sendError("Please provide name, email, and address.", 400);
        }
    }
}
?>
