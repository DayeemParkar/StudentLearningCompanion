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

<html>  
      <head>  
           <meta charset="UTF-8">
           <meta name="viewport" content="width=device-width, initial-scale=1.0">
           <meta http-equiv="X-UA-Compatible" content="ie=edge">
           
           <title>Create Group</title>
 
           <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
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
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="goback">Go Back</button>
            </form>
        </div>
    </nav>
      
           <div class="container">  
                <br>  
                <br>  
                <h2 align="center">Create New Group</h2> 
                <div class="form-group">  
                     <form name="add_name" id="add_name">
                          <input type="text" name="groupname" placeholder="Enter name of group" class="form-control name_list"> 
                          <div class="table-responsive">  
                               <table class="table table-bordered" id="dynamic_field">
                                    <tr> 
                                         <td><input type="text" name="name[]" placeholder="Enter Name of Member" class="form-control name_list" /></td>  
                                         <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>  
                                    </tr>  
                               </table>  
                               <input type="button" name="submit" id="submit" class="btn btn-info" value="Create Group"> 
                          </div>  
                     </form>  
                </div>  
           </div>
           
           <?php
           
           if(isset($_POST["goback"])) {
               header("Location: tgroups.php");
           }

           ?>
      </body>  
 </html>  
 <script>  
 $(document).ready(function(){  
      var i=1;  
      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="name[]" placeholder="Enter Name of Member" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
      });  
      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  
      $('#submit').click(function(){            
           $.ajax({  
                url:"name.php",  
                method:"POST",  
                data:$('#add_name').serialize(),  
                success:function(data)  
                {  
                     alert(data);
                     $('#add_name')[0].reset();
                }
           });  
      });  
 });  
 </script>
   