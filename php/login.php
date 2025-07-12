<?php
require_once 'db.php';

header('Content-Type: application/json');

$response = ['success' => false, 'message' => 'Invalid credentials.'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($password)) {
        $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            $response['success'] = true;
            $response['message'] = 'Login successful!';
        } else {
            $response['message'] = 'Invalid username or password.';
        }
    } else {
        $response['message'] = 'Please enter username and password.';
    }
} else {
    $response['message'] = 'Invalid request method.';
}

echo json_encode($response);
?>
