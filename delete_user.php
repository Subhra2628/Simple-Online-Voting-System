<?php
include 'Voting_database.php';
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete_sql = "DELETE FROM users WHERE id=?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        header("Location: manage_users.php"); // Refresh the page
        exit;
    } else {
        echo "Error deleting user.";
    }
    $stmt->close();
}