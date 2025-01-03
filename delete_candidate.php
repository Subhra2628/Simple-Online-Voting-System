<?php   
session_start();
include 'Voting_database.php';

// Check if admin is logged in

// Handle delete candidate request
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete_sql = "DELETE FROM candidates WHERE id=?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        header("Location: manage_candidates.php");
        exit;
    } else {
        echo "Error deleting candidate.";
    }
    $stmt->close();
}
?>