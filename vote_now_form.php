<?php   
include 'Voting_database.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: user_login.php"); // Redirect to login page if not logged in
    exit;
}

$voter_id = $_SESSION['user_id']; 
$checkVoteSql = "SELECT * FROM votes WHERE user_id = ?";
$stmt = $conn->prepare($checkVoteSql);
$stmt->bind_param("s", $voter_id);
$stmt->execute();
$hasVoted = $stmt->get_result()->num_rows > 0;
$stmt->close();

// Fetch candidates from the database
$candidatesSql = "SELECT * FROM candidates";
$result = $conn->query($candidatesSql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vote Now</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f4f4f4;
        }
        .container {
            padding: 50px;
        }
        .candidate {
            padding: 10px;
            margin: 10px 0;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
        }
        .candidate span {
            font-size: 18px;
        }
        .candidate button {
            padding: 5px 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        .candidate button:hover {
            background-color: #0056b3;
        }
        .message {
            font-size: 18px;
            color: gray;
            margin-top: 30px;
        }
        .logout {
            margin-top: 20px;
        }
        .logout a {
            text-decoration: none;
            color: white;
            background-color: #007BFF;
            padding: 10px 20px;
            border-radius: 5px;
        }
        .logout a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Vote Now</h1>

        <?php if ($hasVoted): ?>
            <p class="message">You have already cast your vote. Thank you for participating!</p>
        <?php else: ?>
            <div class="candidates">
                <form action="vote_now.php" method="POST">
                    <?php if ($result && $result->num_rows > 0): ?>
                        <?php while ($candidate = $result->fetch_assoc()): ?>
                            <div class="candidate">
                                <span>Candidate Name: <?php echo htmlspecialchars($candidate['name']); ?> - Party Name: <?php echo htmlspecialchars($candidate['party']); ?></span>
                                <button type="submit" name="candidate_id" value="<?php echo $candidate['id']; ?>">Vote</button>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>No candidates available.</p>
                    <?php endif; ?>
                </form>
            </div>
        <?php endif; ?>

        <div class="logout">
            <a href="user_logout.php">Logout</a>
        </div>
    </div>
</body>
</html>
