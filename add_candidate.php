<?php
session_start();
include 'Voting_database.php';

// Check if admin is logged in
if (!isset($_SESSION['id'])) {
    header("Location: admin_login_form.php");
    exit;
}

// Handle add candidate request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_candidate'])) {
    $name = $_POST['name'];
    $party = $_POST['party'];
    $sql = "INSERT INTO candidates (name, party) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $name, $party);
    if ($stmt->execute()) {
        header("Location: manage_candidates.php");
        exit;
    } else {
        echo "Error adding candidate.";
    }
    $stmt->close();
}

