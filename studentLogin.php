<?php
session_unset();
if (session_status() == PHP_SESSION_ACTIVE) { 
    session_destroy();
}
session_start();
unset($_SESSION["teacher"]);
?>

<html>
    <head>
        <title>Student Learning Companion</title>

        <script>
            function signup()
            {
                document.querySelector(".login-form-container").style.cssText = "display: none;";
                document.querySelector(".signup-form-container").style.cssText = "display: block;";
                document.querySelector(".container").style.cssText = "background: linear-gradient(to bottom, rgb(56, 189, 149),  rgb(28, 139, 106));";
                document.querySelector(".button-1").style.cssText = "display: none";
                document.querySelector(".button-2").style.cssText = "display: block";
            };
            function login()
            {
                document.querySelector(".signup-form-container").style.cssText = "display: none;";
                document.querySelector(".login-form-container").style.cssText = "display: block;";
                document.querySelector(".container").style.cssText = "background: linear-gradient(to bottom, rgb(6, 108, 224),  rgb(14, 48, 122));";
                document.querySelector(".button-2").style.cssText = "display: none";
                document.querySelector(".button-1").style.cssText = "display: block";
            }
        </script>
        <style>   
            html {
                background-image: url('classroom.jpeg');
                background-size: 100% 100%;
            }
            * {
                margin: 0px;
                padding: 0px;
            }
            body {
                font-family: Arial, Helvetica, sans-serif;
            }
            .container {
                display: grid;
                grid-template-columns: 1fr 2fr;
                background: linear-gradient(to bottom, rgb(6, 108, 100),  rgb(14, 48, 122));
                width: 800px;
                height: 500px;
                margin: 20% 20%;;
                border-radius: 5px;
            }
            .content-holder {
                text-align: center;
                color: white;
                font-size: 14px;
                font-weight: lighter;
                letter-spacing: 2px;
                margin-top: 15%;
                padding: 50px;
            }
            .content-holder h2 {
                font-size: 34px;
                margin: 20px auto;
            }
            .content-holder p {
                margin: 30px auto;
            }
            .content-holder button {
                border:none;
                font-size: 15px;
                padding: 10px;
                border-radius: 6px;
                background-color: white;
                width: 150px;
                margin: 20px auto;
            }
            .box-2 {
                background-color: white;
                margin: 5px;
                height:92%;
            }
            .login-form-container {
                text-align: center;
                margin-top: 10%;
            }
            .login-form-container h1 {
                color: black;
                font-size: 24px;
                padding: 20px;
            }
            .input-field {
                box-sizing: border-box;
                font-size: 14px;
                padding: 10px;
                border-radius: 7px;
                border: 1px solid rgb(168, 168, 168);
                width: 250px;
                outline: none;
            }
            .login-button {
                box-sizing: border-box;
                color: white;
                font-size: 14px;
                padding: 13px;
                border-radius: 7px;
                border: none;
                width: 250px;
                outline: none;
                background-color: rgb(56, 102, 189);
            } 
            .button-2 {
                display: none;
            }
            .signup-form-container {
                position: relative;
                top: 50%;
                left: 50%;
                transform: translate(-50%,-60%);
                text-align: center;
                display: none;
            }
            .signup-form-container h1 {
                color: black;
                font-size: 24px;
                padding: 20px;
            }
            .signup-button {
                box-sizing: border-box;
                color: white;
                font-size: 14px;
                padding: 13px;
                border-radius: 7px;
                border: none;
                width: 250px;
                outline: none;
                background-color: rgb(56, 189, 149);  
            }
            h3:hover{
                color:rgb(150, 224, 147)
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="box-1">
                <div class="content-holder">
                    <h2>Welcome, Student</h2>
                    <button class="button-1" onclick="signup()">Sign up</button>
                    <button class="button-2" onclick="login()">Login</button>
                    <br><br><hr><br><br><a style="text-decoration: none; color:white" href="teacherLogin.php"><h3>Are you a Teacher?</h3></a> 
                </div>
            </div>
            <div class="box-2">
                <div class="login-form-container">
                    <h1>Login</h1>
                    <form action="userAuth.php" method="POST">
                    <input type="text" placeholder="Username" class="input-field" name="slnam" required>
                    <br><br>
                    <input type="password" placeholder="Password" class="input-field" name="slpass" required>
                    <br><br>
                    <input class="login-button" type="submit" value="Login" name="slog">
                    </form>
                </div>

                <div class="signup-form-container">
                    <h1>Sign Up</h1>
                    <form method="POST">
                    <input type="text" placeholder="Username" class="input-field" name="snam" required>
                    <br><br>
                    <input type="email" placeholder="Email" class="input-field" name="smail" required>
                    <br><br>
                    <input type="text" placeholder="Registration Number" class="input-field" name="sreg" required>
                    <br><br>
                    Gender
                    <select class="custom-select" name="sgen" required>
                        <option>Male</option>
                        <option>Female</option>
                        <option>Other</option>
                    </select>
                    <br><br>
                    <input type="password" placeholder="Password" class="input-field" name="spass" required>
                    <br><br>
                    <button class="signup-button" type="submit" name="ssign">Sign Up</button>
                    </form>
                </div>
            </div>
        </div>

        <?php
        
        include 'config.php';

        if (isset($_POST["ssign"])) {
            $uname = $_POST["snam"];
            $umail = $_POST["smail"];
            $ureg = $_POST["sreg"];
            $ugen = $_POST["sgen"];
            $upass = $_POST["spass"];
            
            $sql = "SELECT usern FROM student WHERE usern=$uname";
            $result = $con->query($sql);

            if ($result->num_rows == 0) {
                $sql = "INSERT INTO student (usern, pass, email, regNo, gender) 
                VALUES ('$uname', '$upass', '$umail', '$ureg', '$ugen')";
                $con->query($sql);
                header("Location:studentLogin.php");
            }
            else {
                echo "<script>alert('This username already exists');</script>";
            }
        }

        ?>
    </body>
</html>