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

    <title>Schedule</title>

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
                <li class="nav-item">
                    <a class="nav-link" href="viewnotes.php">View Notes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="groups.php">Groups</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="schedule.php">Schedule</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="studentLogin.php">Logout</span></a>
                </li>
            </ul>
        </div>
    </nav>


    <div class="container">
        <div class="table-responsive">
            <form method="POST">
                <h3>Add Event</h3>
                <div class="form-group" style="text-align: center;">
                <input class="form-control mr-sm-2" id="event" type="text"
                placeholder="Event Name" aria-label="Search" name="event">
                <input class="form-control mr-sm-2" id="day" type="text"
                placeholder="Event Day" aria-label="Search" name="day">
                <div class="input-group" style="vertical-align: middle;">
                <label for="from">Start Time:</label>
                <input class="form-control input-sm" id="from" type="time"
                placeholder="Start Time" aria-label="Search" name="from" style="text-align: center;">
                <label for="to">End Time:</label>
                <input class="form-control input-sm" id="to" type="time"
                placeholder="End Time" aria-label="Search" name="to" style="text-align: center;">
                </div>
                <br>
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="addBtn" style="width: 40%;">
                Add Event</button>
                </div>
            </form>
            <hr>
            <table class="table table-bordered text-center">
                <thead>
                    <tr class="bg-light-gray">
                        <th class="text-uppercase">Day</th>
                        <th class="text-uppercase">Event</th>
                        <th class="text-uppercase">Start Time</th>
                        <th class="text-uppercase">End Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    include 'config.php';

                    $isDisplayed = false;

                    function displayS() {
                        include 'config.php';
                        
                        $sql = "SELECT * FROM schedule WHERE userId=$_SESSION[student] ORDER BY eventDay";
                        $result = mysqli_query($con, $sql);
    
                        if($result->num_rows > 0)
                        {
                            while($row = $result->fetch_assoc())
                            {
                                echo "<tr> <td> $row[eventDay] </td>
                                <td> $row[title] </td>
                                <td> $row[fromT] </td>
                                <td> $row[toT] </td> </tr>";
                            }
                        }
                        $isDisplayed = true;
    
                        $result->free();
                    }

                    if (!$isDisplayed) {
                        displayS();
                    }

                    if (isset($_POST["addBtn"])) {
                        $event = $_POST["event"];
                        $day = $_POST["day"];
                        $fromT = $_POST["from"];
                        $toT = $_POST["to"];

                        if ($event != "" && $day != "" && $fromT != "" && $toT != "") {
                            $sql = "INSERT INTO schedule VALUES ($_SESSION[student], '$event', '$fromT', '$toT', '$day')";
                            mysqli_query($con, $sql);
                            echo '<script>
                            document.getElementsByTagName("tbody")[0].innerHTML = "";
                            </script>';
                            displayS();
                        }
                    }

                    ?>
                </tbody>
            </table>
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