<?php
session_start();

include 'config.php';

if (isset($_POST["slog"])) {
    $uname = $_POST['slnam'];
    $upass = $_POST['slpass'];
        
    $sql = "SELECT userId FROM student WHERE usern='$uname' AND pass='$upass'";
    $result = $con->query($sql);
        
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        
        $_SESSION["student"] = (int)$row['userId'];
        $_SESSION["login_time"] = time();
        
        header("Location:student.php");
    }
    else {
        echo "<script>alert('Wrong username or password');</script>";
        header("Location:studentLogin.php");
    }
}

?>