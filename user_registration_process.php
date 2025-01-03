<?php
include 'Voting_database.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST')
 {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $voter_id = $_POST['voter_id'];
    if (empty($voter_id)) {
        die("Voter ID cannot be empty."); // Handle missing voter_id
    }
    $check_sql = "SELECT * FROM users WHERE voter_id = ? ";
    $stmt_check = $conn->prepare($check_sql);
    $stmt_check->bind_param("s", $voter_id,);
    $stmt_check->execute();
    $result = $stmt_check->get_result();

    if ($result->num_rows > 0) 
    {
        die("Error: Voter ID already exists. Please use a unique Voter ID.");
    }
    $check_email_sql = "SELECT * FROM users WHERE email = ?";
    $stmt_check_email = $conn->prepare($check_email_sql);
    $stmt_check_email->bind_param("s", $email);
    $stmt_check_email->execute();
    $email_result = $stmt_check_email->get_result();

    if ($email_result->num_rows > 0) {
        die("Error: Email ID already exists. Please use a unique Email ID.");
    }
    
    
    $sql = "INSERT INTO users (name, email, password, voter_id) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $password, $voter_id);
    if ($stmt->execute()) {
        echo "<p style='color: green; text-align: center;'>Registration successful!<br> Your Voter ID is $voter_id<br>Your Email Id is $email</p>";
        echo"<br> <a href='user_login_form.php'>Log-In</a>";
    }
   
   
     else {
        echo "<p style='color: red; text-align: center;'>Duplicate Entry </p>";
    }
  
    $stmt->close();
}