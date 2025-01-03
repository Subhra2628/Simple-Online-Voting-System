<?php   
include 'Voting_database.php';
session_start();
if($_SERVER['REQUEST_METHOD']==='POST')
{
 $name=$_POST['username'];
 $password=$_POST['password'];
 $sql="SELECT * FROM admin WHERE username=?";
 $stmt=$conn->prepare($sql);
 $stmt->bind_param("s",$name);
 $stmt->execute();
 $result=$stmt->get_result()->fetch_assoc();
 if($result)
 {
    $hashed_password=$result['password'];
    if(password_verify($password,$hashed_password))
    {
        $_SESSION['id']=$result['id'];
        $_SESSION['name']=$result['username'];
        $_SESSION['last_activity']=time();
        header("Location:admin_dashboard.php");
        exit;
    }
    else
    {
        echo "<p style='text-align: center; color: red;'>Invalid Username or Password</p>";

    }
}
$stmt->close();
}
  