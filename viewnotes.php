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

    <title>View Notes</title>

    <style>
        #searchForm {
            text-align: center;
        }
    </style>

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
                <li class="nav-item">
                    <a class="nav-link" href="addnotes.php">Add Notes</a>
                </li>
                <li class="nav-item active">
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
        <form id="searchForm" method="POST">
            <input class="form-control mr-sm-2" id="searchTxt" type="search"
            placeholder="Search Title/Content" aria-label="Search" name="searchTxt">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="searchBtn" style="width: 40%;">
            Search</button>
        </form>
    </div>

    <div class="container my-3">
        <h1>View Notes</h1>
        <hr>
        <div id="notesDisp" style="width: 100%;">
            <?php
            
            include 'config.php';

            function displayAll($sql) {
                include 'config.php';

                //$sql = "SELECT * FROM notes LIMIT 10";
                $result = $con->query($sql);
                $yourNotes = "";

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        if ($row['isTeacher'] == 0) {
                            $sql = "SELECT usern FROM student WHERE userId=" . $row['noteAuthor'];
                            $result1 = $con->query($sql);
    
                            if ($result1->num_rows == 1) {
                                $row1 = $result1->fetch_assoc();
                            }
                            $yourNotes .= "<div><h3>" . $row['noten'] . "</h3>
                               <h5>Author: " . $row1['usern'] . "</h5>
                               <p style='border: solid 1px; border-radius: 5px;'>" . $row['notec'] . "</p><hr></div>";
                        }
                        else {
                            $sql = "SELECT usern FROM teacher WHERE teachId=" . $row['noteAuthor'];
                            $result1 = $con->query($sql);
    
                            if ($result1->num_rows == 1) {
                                $row1 = $result1->fetch_assoc();
                            }
                            else {
                                echo "<script>alert('hmm');</script>";
                            }
                            $yourNotes .= "<div><h3>" . $row['noten'] . "</h3>
                               <h5>Author: " . $row1['usern'] . "</h5>
                               <p style='border: solid 1px; border-radius: 5px;'>" . $row['notec'] . "</p><hr></div>";
                        }
                    }
                }
                else {
                    $yourNotes = "<h5>No notes found!</h5>";
                }
                echo $yourNotes;
            }

            displayAll("SELECT noteAuthor, noten, notec, isTeacher FROM notes LIMIT 10");
            
            /*echo "<script>
            let elem = document.getElementById('notesDisp');
            let notes = '" . $yourNotes .
            "';elem.innerHTML = notes;
            </script>";*/
            
            if(isset($_POST["searchBtn"])) {
                if ($_POST["searchTxt"] == "") {
                    echo '<script>
                    document.getElementById("notesDisp").innerHTML = "";
                    </script>';
                    displayAll("SELECT noteAuthor, noten, notec, isTeacher FROM notes LIMIT 10");
                }
                else {
                    echo '<script>
                    document.getElementById("notesDisp").innerHTML = "";
                    </script>';
                    $searchTxt = $_POST["searchTxt"];
                    $selectTxt = strtoupper($searchTxt);
                    $sString = '%' . $selectTxt . '%';
                    $yourNotes = "";

                    $sql = "SELECT noteAuthor, noten, notec, isTeacher FROM notes 
                    WHERE UPPER(notec) LIKE ? 
                    OR UPPER(noten) LIKE ?";

                    $stmt = $con->prepare($sql); 
                    $stmt->bind_param('ss', $sString, $sString);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            if ($row['isTeacher'] == 0) {
                                $sql = "SELECT usern FROM student WHERE userId=" . $row['noteAuthor'];
                                $result1 = $con->query($sql);
        
                                if ($result1->num_rows == 1) {
                                    $row1 = $result1->fetch_assoc();
                                }
                                $yourNotes .= "<div><h3>" . $row['noten'] . "</h3>
                                   <h5>Author: " . $row1['usern'] . "</h5>
                                   <p style='border: solid 1px; border-radius: 5px;'>" . $row['notec'] . "</p><hr></div>";
                            }
                            else {
                                $sql = "SELECT usern FROM teacher WHERE teachId=" . $row['noteAuthor'];
                                $result1 = $con->query($sql);
        
                                if ($result1->num_rows == 1) {
                                    $row1 = $result1->fetch_assoc();
                                }
                                $yourNotes .= "<div><h3>" . $row['noten'] . "</h3>
                                   <h5>Author: " . $row1['usern'] . "</h5>
                                   <p style='border: solid 1px; border-radius: 5px;'>" . $row['notec'] . "</p><hr></div>";
                            }
                        }
                    }
                    else {
                        $yourNotes = "<h5>No notes found!</h5>";
                    }
                    echo $yourNotes;
                }
            }

            ?>
        </div>
    </div>

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