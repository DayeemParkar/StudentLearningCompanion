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
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <style>
            .styled-table {
                text-align:center;
                border-collapse: collapse;
                margin: 25px 0;
                font-size: 0.9em;
                font-family: sans-serif;
                min-width: 80%;
            }
            .styled-table thead tr {
                background-color: #79869c;
                color: #ffffff;
            }
            .styled-table th, .styled-table td {
                padding: 12px 15px;
            }
            .styled-table tbody tr {
                border-bottom: 1px solid #dddddd;
            }

            .styled-table tbody tr:nth-of-type(even) {
                background-color: #f3f3f3;
            }

            .styled-table tbody tr:last-of-type {
                border-bottom: 2px solid #79869c;
            }
        </style>
        <title>Student Homepage</title>

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
                    <li class="nav-item active">
                        <a class="nav-link" href="teacher.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="taddnotes.php">Add Notes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tviewnotes.php">View Notes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tgroups.php">Groups</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tschedule.php">Schedule</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="teacherLogin.php">Logout</span></a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container my-3">
            <?php
            include 'config.php';
            $sql = "SELECT * FROM teacher WHERE teachId=" . $_SESSION["teacher"];
            $result = $con->query($sql);
            if ($result = $con->query($sql)) {
                while ($row = $result->fetch_assoc()) {
                    $name = $row["usern"];
                    $gender = $row["gender"];
                    $email = $row["email"];
                    $id = $_SESSION["teacher"];
                }
                echo "<br><br><center>
                <h1>Welcome, ".$name."</h1><br><br><br><br>
                <h3 style='color:#787878'><i>Personal Details</i></h3><br>
                <div class='card'>
                <div id='noteSec' style='width: 100%'>";
                echo '<br><table class="styled-table">
                <thead>
                    <tr>
                        <th>Teacher ID</th>
                        <th>Gender</th>
                        <th>Email ID</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>'.$id.'</td>
                        <td>'.$gender.'</td>
                        <td>'.$email.'</td>
                    </tr>
                </tbody>
                </table><br>';
                echo '</center>';
                $result->free();
            }
            ?>
        </div>

        <nav class="navbar fixed-bottom navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Created By - Akashdeep, Dayeem, Jay, Shivank</a>
        </nav>
        
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