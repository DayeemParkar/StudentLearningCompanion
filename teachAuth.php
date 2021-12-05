<?php
session_start();

include 'config.php';

if (isset($_POST["tlog"])) {
    $uname = $_POST['tlnam'];
    $upass = $_POST['tlpass'];
        
    $sql = "SELECT teachId FROM teacher WHERE usern='$uname' AND pass='$upass'";
    $result = $con->query($sql);
        
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        
        $_SESSION["teacher"] = (int)$row['teachId'];
        $_SESSION["login_time"] = time();
        
        header("Location:teacher.php");
    }
    else {
        echo "<script>alert('Wrong username or password');</script>";
        header("Location:studentLogin.php");
    }
}

?>