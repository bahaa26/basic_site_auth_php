<?php
header('Content-Type: application/json');
session_start();

// Database configuration
$host = 'localhost';
$dbname = 'security_app';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    
    $email = $input['email'] ?? '';
    $password = $input['password'] ?? '';
    $role = $input['role'] ?? '';
    
    if (empty($email) || empty($password) || empty($role)) {
        echo json_encode(['success' => false, 'message' => 'All fields are required']);
        exit;
    }
    
    // MD5 hash the password (as requested)
    $hashedPassword = md5($password);
    
    // Check user credentials
    $stmt = $pdo->prepare("SELECT id, username, email, role FROM users WHERE email = ? AND password = ? AND role = ?");
    $stmt->execute([$email, $hashedPassword, $role]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];
        
        echo json_encode([
            'success' => true, 
            'message' => 'Login successful',
            'user' => $user
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid credentials or role']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>