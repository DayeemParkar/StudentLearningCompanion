<?php
session_start();

include 'config.php';

$id = (int)$_GET["id"];

//check if url is valid
if (!isset($_GET["id"])) {
    echo "<script>alert('Group does not exist!');</script>";
    header("Location:groups.php");
}
//check if group exists
else {
    $sql = "SELECT groupId from groups WHERE groupId=$id";
    $result = $con->query($sql);
    if ($result->num_rows != 1) {   
        echo "<script>alert('Group does not exist!');</script>";
        header("Location:groups.php");
    }
}

//check if session is valid
if(isset($_SESSION["student"]) && isset($_SESSION["login_time"]) && !isset($_SESSION["teacher"])) {
    if(time()-$_SESSION["login_time"] > 1800) {
        session_unset();
        session_destroy();
        echo "<script>alert('Session expired. Log in again');</script>";
        header("Location:studentLogin.php");
    }

    //check if user has access to group
    $sql = "SELECT userId from usergroups WHERE groupId=$id AND userId=$_SESSION[student]";
    $result = $con->query($sql);
    if ($result->num_rows != 1) {   
        echo "<script>alert('You dont have access to this group!');</script>";
        header("Location:groups.php");
    }
}
else {
    echo "<script>alert('Session expired. Log in again');</script>";
    header("Location:studentLogin.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Add Group Notes</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
        .group-display {
            color: rgba(0, 0, 0, 0.7);
        }
        .group-display:hover {
            color: rgba(0, 0, 0, 1);
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="">Student Learning Companion</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="student.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="groups.php">Groups</span></a>
                </li>
                <?php
                
                echo '
                <li class="nav-item">
                    <a class="nav-link" href="groupmembers.php?id=' . $_GET["id"] . '">Group Members</span></a>
                </li>
                <li class="nav-item active">
                <a class="nav-link" href="addgnotes.php?id=' . $_GET["id"] . '">Add Group Notes</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="viewgnotes.php?id=' . $_GET["id"] . '">View Group Notes</a>
                </li>';
                
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="schedule.php">Schedule</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="studentLogin.php">Logout</span></a>
                </li>
            </ul>
        </div>
    </nav>


    <div class="container my-3">
        <h1>Create New Notes</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Add group note</h5>
                <form method="POST">
                <div class="form-group">
                    <textarea class="form-control" id="addTitle" name="addTitle" rows="1" placeholder="Title"></textarea>
                    <textarea class="form-control" id="addTxt" name="addTxt" rows="3"></textarea>
                </div>
                <button class="btn btn-primary" id="addBtn" name="addBtn">Add Note</button>
                </form>
            </div>
        </div>
        <hr>
        <h1>Your Group Notes</h1>
        <hr>
        <div id="notes" class="row container-fluid">

        <?php
    
        include 'config.php';

        $id = (int)$_GET["id"];
    
        $sql = "SELECT noten, notec FROM groupnotes WHERE noteAuthor=" . $_SESSION["student"] . " AND groupId=$id AND isTeacher=0";
        $result = $con->query($sql);
        $yourNotes = "";
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $yourNotes .= "<div><h5> $row[noten] </h5>
                   <p> $row[notec] </p><hr></div>";
            }
        }
        else {
            $yourNotes = "<h5>You have not yet added any notes in this group!</h5>";
        }
        echo $yourNotes;
    
        ?>
        
        </div>
    </div>

    <?php
    
    include 'config.php';

    $id = (int)$_GET["id"];
    
    if (isset($_POST["addBtn"])) {
        $title = $_POST["addTitle"];
        $content = $_POST["addTxt"];

        if ($title != "" && $content != "") {
            $sql = "INSERT INTO groupnotes (groupId, noteAuthor, noten, notec, isTeacher) 
            VALUES ($id, $_SESSION[student], '$title', '$content', 0)";
            mysqli_query($con, $sql);
        }

        header("Refresh:0");
    }

    ?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>

</html>