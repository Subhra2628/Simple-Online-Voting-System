<?php
include 'Voting_database.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: user_login.php"); // Redirect to login page if not logged in
    exit;
}

// Check if a candidate ID is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['candidate_id'])) {
    $voter_id = $_SESSION['user_id']; // Get user ID from session
    $candidate_id = intval($_POST['candidate_id']); // Get candidate ID from form submission

   

    // Insert vote into the votes table
    $insertVoteSql = "INSERT INTO votes (user_id, candidate_id) VALUES (?, ?)";
    $stmt = $conn->prepare($insertVoteSql);
    $stmt->bind_param("si", $voter_id, $candidate_id);

    if ($stmt->execute()) {
        // Update the candidate's vote count
        $updateCandidateSql = "UPDATE candidates SET vote_count = vote_count + 1 WHERE id = ?";
        $updateStmt = $conn->prepare($updateCandidateSql);
        $updateStmt->bind_param("i", $candidate_id);
        $updateStmt->execute();
        $updateStmt->close();

        $_SESSION['message'] = "Your vote has been successfully cast!";
    } else {
        $_SESSION['message'] = "An error occurred while processing your vote. Please try again.";
    }

    $stmt->close();
    header("Location: user_dashboard.php");
    exit;
} else {
    // Redirect if no candidate ID is provided
    $_SESSION['message'] = "Invalid request.";
    header("Location: vote_now.php");
    exit;
}
?>
