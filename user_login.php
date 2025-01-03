<?php
session_start();
include 'Voting_database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if ($result) {
        if (password_verify($password, $result['password'])) {
            $_SESSION['user_id'] = $result['id'];
            $_SESSION['voter_id'] = $result['voter_id'];
            header("Location: user_dashboard.php");
            exit;
        } else {
            echo "<p style='color: red; text-align: center;'>Invalid Password</p>";
        }
    } else {
        echo "<p style='color: red; text-align: center;'>Invalid Email</p>";
    }

    $stmt->close();
}
?>
