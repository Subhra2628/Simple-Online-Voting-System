<?php
$servername="Localhost";
$username="root";
$password="";
$conn= new mysqli($servername,$username,$password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "CREATE DATABASE IF NOT EXISTS vote_database";
if ($conn->query($sql) === TRUE) {
    //echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}
$conn->select_db("vote_database");

$sql = "CREATE TABLE IF NOT EXISTS admin (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if ($conn->query($sql) === TRUE) {
    // echo "Admin table created";
}

$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if ($conn->query($sql) === TRUE) {
    // echo "User table created";
}

$sql = "SHOW COLUMNS FROM users LIKE 'voter_id'";
$result = $conn->query($sql);
if ($result->num_rows == 0) {
    $sql = "ALTER TABLE users 
            ADD voter_id VARCHAR(50) UNIQUE NOT NULL,
            ADD status TINYINT DEFAULT 0";
    if ($conn->query($sql) === TRUE) {
       // echo "Users table altered successfully.<br>";
    } else {
        echo "Error altering users table: " . $conn->error . "<br>";
    }
}

$sql = "CREATE TABLE IF NOT EXISTS candidates (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100),
    description TEXT,
    vote_count INT DEFAULT 0
)";
if ($conn->query($sql) === TRUE) {
    // echo "Candidates table created";
}

$sql = "SHOW COLUMNS FROM candidates LIKE 'party'";
$result = $conn->query($sql);
if ($result->num_rows == 0) {
    $sql = "ALTER TABLE candidates
            ADD party VARCHAR(255) NOT NULL,
            ADD votes INT DEFAULT 0";
    if ($conn->query($sql) === TRUE) {
        //echo "Candidates table altered successfully.<br>";
    } else {
        echo "Error altering candidates table: " . $conn->error . "<br>";
    }
}

$sql = "CREATE TABLE IF NOT EXISTS votes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    candidate_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (candidate_id) REFERENCES candidates(id),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if ($conn->query($sql) === TRUE) {
    // echo "Votes table created";
}

$name = "Myadmin";
$password = password_hash("myadmin@123", PASSWORD_BCRYPT);
$sql = "INSERT INTO admin (username, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $name, $password);
if ($stmt->execute()) {
    //echo "Admin added successfully!<br>";
} else {
    echo "Error adding admin: " . $stmt->error . "<br>";
}

?>