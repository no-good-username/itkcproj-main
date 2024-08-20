<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['super_username'];
    $password = $_POST['super_password'];

    $sql = "SELECT * FROM supervisor WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: form.html');    
    } else {
        echo "Invalid login credentials.";
    }
}
?>
