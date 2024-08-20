<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin.html');
    exit;
}

include 'db.php';

if (isset($_GET['id'])) {
    $school_id = intval($_GET['id']);
    
    // Prepare and execute the delete query
    $sql = "DELETE FROM schools WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $school_id);
    
    if ($stmt->execute()) {
        // If successful, redirect back to the admin dashboard with a success message
        header('Location: admin_dashboard.php?message=School+deleted+successfully');
    } else {
        // If there's an error, redirect with an error message
        header('Location: admin_dashboard.php?message=Error+deleting+school');
    }

    $stmt->close();
}

$conn->close();
?>
