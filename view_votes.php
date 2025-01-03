<?php
include 'Voting_database.php';
session_start();
if(!isset($_SESSION['id']))
{
    echo"Session Out";
   header('Location: admin_login_form.php');
}
$sql = "SELECT  candidates.name, candidates.party, COUNT(votes.candidate_id) AS total_votes 
        FROM candidates 
        LEFT JOIN votes ON candidates.id = votes.candidate_id 
        GROUP BY candidates.id, candidates.name, candidates.party 
        ORDER BY total_votes DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Votes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            text-align: center;
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            margin-bottom: 20px;
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
        a {
            display: inline-block;
            margin: 10px 0;
            padding: 10px 20px;
            text-decoration: none;
            color: white;
            background-color: #007BFF;
            border-radius: 5px;
        }
        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>View Votes</h1>

    <!-- Display Voting Results -->
    <table>
        <thead>
            <tr>
              
                <th>Candidate Name</th>
                <th>Party</th>
                <th>Total Votes</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                       
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['party']; ?></td>
                        <td><?php echo $row['total_votes']; ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No votes have been cast yet</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <a href="admin_dashboard.php">Back to Dashboard</a>
</body>
</html>