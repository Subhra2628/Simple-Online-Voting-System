<?php
session_start();
include 'Voting_database.php';
// Fetch all candidates
$sql = "SELECT * FROM candidates";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Candidates</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        form {
            margin-bottom: 20px;
        }
        form input, form button {
            padding: 10px;
            margin: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        form button {
            background-color: #007BFF;
            color: white;
            cursor: pointer;
        }
        form button:hover {
            background-color: #0056b3;
        }
        .delete-btn {
            color: white;
            background-color: red;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .delete-btn:hover {
            background-color: darkred;
        }
    </style>
</head>
<body>
    <h1>Manage Candidates</h1>
    
    <!-- Add Candidate Form -->
    <form method="POST" action="add_candidate.php">
        <input type="text" name="name" placeholder="Candidate Name" required>
        <input type="text" name="party" placeholder="Party Name" required>
        <button type="submit" name="add_candidate">Add Candidate</button>
    </form>

    <!-- Display Candidates -->
    <table>
        <thead>
            <tr>
               
                <th>Candidate Name</th>
                <th>Party</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                    
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['party']; ?></td>
                        <td>
                            <a href="delete_candidate.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this candidate?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No candidates found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <a href="admin_dashboard.php">Back to Dashboard</a>
</body>
</html>
