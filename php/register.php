<?php
require_once 'db.php';

header('Content-Type: application/json');

$response = ['success' => false, 'message' => 'An unknown error occurred.'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Basic Validation
    if (empty($username) || empty($email) || empty($password)) {
        $response['message'] = 'Please fill in all fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['message'] = 'Invalid email format.';
    } else {
        // Check if user already exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        if ($stmt->fetch()) {
            $response['message'] = 'Username or email already exists.';
        } else {
            // Hash password and insert user
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            if ($stmt->execute([$username, $email, $hashed_password])) {
                $response['success'] = true;
                $response['message'] = 'Registration successful! You can now log in.';
            } else {
                $response['message'] = 'Failed to register. Please try again.';
            }
        }
    }
} else {
    $response['message'] = 'Invalid request method.';
}

echo json_encode($response);
?>
