<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: user_login.php"); // Redirect to login page if not logged in
    exit;
}

// Fetch user details from the session
$voter_id = $_SESSION['voter_id'];

// Check if the user has voted
include 'Voting_database.php';
$sql = "SELECT * FROM votes WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $voter_id);
$stmt->execute();
$hasVoted = $stmt->get_result()->num_rows > 0;
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            padding: 50px;
        }
        h1 {
            color: #333;
        }
        p {
            font-size: 18px;
            color: #555;
        }
        .options {
            margin-top: 30px;
        }
        .options a {
            text-decoration: none;
            color: white;
            background-color: #007BFF;
            padding: 10px 20px;
            margin: 10px;
            border-radius: 5px;
            display: inline-block;
        }
        .options a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to the User Dashboard</h1>
        <p>Hello, Voter ID: <strong><?php echo htmlspecialchars($voter_id); ?></strong></p>

        <?php if ($hasVoted): ?>
            <p>You have already voted. Thank you for participating!</p>
        <?php else: ?>
            <p> Please cast your vote!</p>
        <?php endif; ?>

        <div class="options">
            <a href="vote_now_form.php">Vote Now</a>
          
           
            <a href="user_logout.php">Logout</a>
        </div>
    </div>
</body>
</html>
