<?php
session_start();
$timeout=900;
include 'Voting_database.php';

// Check if the admin is logged in
if (!isset($_SESSION['id'])) {
    header("Location: admin_login_form.php"); // Redirect to login page if not logged in
    exit;
}

// Display a logout message after 6 minutes of inactivity
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $timeout)) {
    session_unset();
    session_destroy();
    header("Location: admin_login_form.php");
    exit;
} else {
    $_SESSION['last_activity'] = time(); // Update the last activity time
}

// Fetch dashboard statistics
$total_users_query = "SELECT COUNT(*) AS total_users FROM users";
$total_candidates_query = "SELECT COUNT(*) AS total_candidates FROM candidates";
$total_votes_query = "SELECT COUNT(*) AS total_votes FROM votes";

$total_users_result = $conn->query($total_users_query)->fetch_assoc();
$total_candidates_result = $conn->query($total_candidates_query)->fetch_assoc();
$total_votes_result = $conn->query($total_votes_query)->fetch_assoc();

$total_users = $total_users_result['total_users'] ?? 0;
$total_candidates = $total_candidates_result['total_candidates'] ?? 0;
$total_votes = $total_votes_result['total_votes'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            text-align: center;
            padding: 20px;
        }
        h1 {
            background-color: #4CAF50;
            color: white;
            padding: 10px 0;
            margin-bottom: 30px;
        }
        .stats {
            display: flex;
            justify-content: space-around;
            margin-bottom: 30px;
        }
        .card {
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 5px;
            width: 30%;
        }
        .card h2 {
            margin: 10px 0;
            font-size: 24px;
        }
        .card p {
            color: gray;
        }
        .actions {
            margin-top: 20px;
        }
        .actions a {
            text-decoration: none;
            margin: 0 10px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border-radius: 5px;
        }
        .actions a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome, Admin</h1>
        <div class="stats">
            <div class="card">
                <h2><?php echo $total_users; ?></h2>
                <p>Total Registered Users</p>
            </div>
            <div class="card">
                <h2><?php echo $total_candidates; ?></h2>
                <p>Total Candidates</p>
            </div>
            <div class="card">
                <h2><?php echo $total_votes; ?></h2>
                <p>Total Votes Cast</p>
            </div>
        </div>

        <div class="actions">
            <a href="manage_users.php">Manage Users</a>
            <a href="manage_candidates.php">Manage Candidates</a>
            <a href="view_votes.php">View Votes</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>
