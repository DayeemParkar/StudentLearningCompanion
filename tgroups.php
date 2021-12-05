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

    <title>Groups</title>

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
                    <a class="nav-link" href="teacher.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="taddnotes.php">Add Notes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="tviewnotes.php">View Notes</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="tgroups.php">Groups</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="tschedule.php">Schedule</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="teacherLogin.php">Logout</span></a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" method="POST">
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="createGrp">Create a group</button>
          </form>
        </div>
    </nav>


    <div class="container my-3 rounded bg-light">
      <div class="row">
      <div class="col-8">
          <h1>Your Groups</h1>
          <hr>
          
            <?php

            include 'config.php';

            $result = mysqli_query($con,"SELECT * from groups where teachId =". $_SESSION["teacher"]);
            while($rows=$result->fetch_assoc())
            {
            ?>

            <div style="width: 100%;">

            <?php echo '<a class="nav-item group-display" href="tgroupmembers.php?id=' . $rows["groupId"] . '">';?>
            <h3><?php echo $rows['groupn']; ?></h3></a></div>
            <hr>
            <?php } ?>
      </div>
  </div>
  </div>

  <?php
  
  if(isset($_POST["createGrp"])) {
        header("Location: addgroupmembers.php");
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