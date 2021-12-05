<?php
session_start();

if(isset($_SESSION["student"]) && isset($_SESSION["login_time"]) && !isset($_SESSION["teacher"])) {
    if(time()-$_SESSION["login_time"] > 1800) {
        session_unset();
        session_destroy();
        echo "<script>alert('Session expired. Log in again');</script>";
        header("Location:studentLogin.php");
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

    <title>Student Notes</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
                <li class="nav-item active">
                    <a class="nav-link" href="addnotes.php">Add Notes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="viewnotes.php">View Notes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="groups.php">Groups</span></a>
                </li>
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
                <h5 class="card-title">Add a note</h5>
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
        <h1>Your Notes</h1>
        <hr>
        <div id="noteSec" style="width: 100%">

        <?php
    
        include 'config.php';
    
        $sql = "SELECT noten, notec FROM notes WHERE noteAuthor=" . $_SESSION["student"] . " AND isTeacher=0";
        $result = $con->query($sql);
        $yourNotes = "";
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $yourNotes .= "<div><h5> $row[noten] </h5>
                   <p> $row[notec] </p><hr></div>";
            }
        }
        else {
            $yourNotes = "<h5>You have not yet added any notes!</h5>";
        }
        echo $yourNotes;
    
        ?>

        </div>
    </div>

    <?php
    
    include 'config.php';
    
    if (isset($_POST["addBtn"])) {
        $title = $_POST["addTitle"];
        $content = $_POST["addTxt"];

        if ($title != "" && $content != "") {
            $sql = "INSERT INTO notes (noteAuthor, noten, notec, isTeacher) VALUES ($_SESSION[student], '$title', '$content', 0)";
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