<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Voting System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }
        .container {
            width: 80%;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
        }
        p {
            color: #555;
            font-size: 1.2em;
        }
        .buttons {
            margin-top: 30px;
        }
        .button {
            display: inline-block;
            margin: 10px;
            padding: 15px 30px;
            font-size: 1em;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            background-color: #007BFF;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to the Online Voting System</h1>
        <p>Participate in a fair and secure election process.</p>
        <div class="buttons">
        <a href="user_registration.php" class="button">User Registration</a>
            <a href="user_login.php" class="button">User Login</a>
            <a href="admin_login.php" class="button">Admin Login</a>
        </div>
    </div>
</body>
</html>
