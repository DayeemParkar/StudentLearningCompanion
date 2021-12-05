<?php
session_start();

if(isset($_SESSION["teacher"]) && isset($_SESSION["login_time"]) && !isset($_SESSION["student"])) {
    if(time()-$_SESSION["login_time"] > 1800) {
        session_unset();
        session_destroy();
        echo "<script>alert('Session expired. Log in again');</script>";
        header("Location:teacherLogin.php");
    }
}
else {
    echo "<script>alert('Session expired. Log in again');</script>";
    header("Location:teacherLogin.php");
}

include 'config.php';

 $number = count($_POST["name"]);
 $groupname = $_POST["groupname"];

 if($number > 0 && $groupname != "")
 {
     $hasMembers = false;

     $sql = "INSERT INTO groups (teachId, groupn) VALUES ('$_SESSION[teacher]', '$groupname')";
     mysqli_query($con, $sql);

     for($i=0; $i<$number; $i++)
      {  
           if(trim($_POST["name"][$i] != ''))  
           {  
                $nm = $_POST["name"][$i];
                $uid = 0;
                $gid = 0;

                $sql1 = "SELECT userId from student where usern = '$nm'";
                $result1 = mysqli_query($con, $sql1);
                if ($result1->num_rows == 1) {
                    $row = $result1->fetch_assoc();
                    $uid = (int)$row['userId'];
                }
                $sql2 = "SELECT groupId from groups where groupn = '$groupname' AND teachId=$_SESSION[teacher]";
                $result2 = mysqli_query($con, $sql2);
                if ($result2->num_rows == 1) {
                    $row = $result2->fetch_assoc();
                    $gid = (int)$row['groupId'];
                }
                if ($uid != 0 && $gid != 0) {
                    $sql3 = "INSERT INTO usergroups VALUES ($uid, $gid)"; 
                    mysqli_query($con, $sql3);
                    $hasMembers = true;
                }  
           }  
      }
      if (!$hasMembers) {
          $sql = "DELETE FROM groups WHERE groupn = '$groupname' AND teachId=$_SESSION[teacher]";
          mysqli_query($con, $sql);
          echo "Failed to create group. Students do not exist";
      }
      else {
          echo "Successfully created group";
      }
 }  
 else  
 {  
     echo "Select atleast one member";
 }  
 ?>