<?php include "databasehandler.php";
      session_start();
      if (!$_SESSION['firstname']) {
        header("Location: signin.php");
      }
         ?>
      <link rel="stylesheet" href="static/master.css">
      <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <style>
      .topnav a{
          width: 33.3333333333%;
      }
      </style>
      <div class="navbar navbar-dark bg-dark">
      <a class="navbar-brand" href="manageadmins.php">Add Account</a>
      <a class="navbar-brand" href="deleteadmin.php">Delete Account</a>
      <a class="navbar-brand" href="adminstudents.php">View Accounts</a>
      <a class="navbar-brand" href="admin.php">Home</a>
      <a class="navbar-brand" href="signout.php">Logout</a>
      </div>

<!DOCTYPE html>
<html>
  <head>
    <title>Add an account</title>
  </head>
  <body>
    <?php
      $msg="";
        if(isset($_POST['submit']))
        {
        $firstname=$_POST['firstname'];
        $lastname=$_POST['lastname'];
        $email=$_POST['email'];
        $type=$_POST['type'];
        $courseID = isset($_POST['instructor']) ? $_POST['instructor'] : 0;
        $password=$_POST['password'];
        $verifypassword=$_POST['verifypassword'];
        $picture="depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg";
            if ($_SESSION['password']==$verifypassword) {
              $sql="INSERT INTO students (firstname,lastname,email,password,type,courseid,picture) VALUES('".$firstname."','".$lastname."','".$email."','".$password."','".$type."','".$courseID."','".$picture."')";
              if (mysqli_query($mysqli,$sql))
              {
                  $msg= "added";
              }
              else {
                  $msg= "not added!";
              }
            }
          }
     ?>
    <div class="form-group">
      <h1>Add an account</h1>
      <h3 id="msg"><?php echo $msg; ?></h3>
      <form action="" method="post" >
        <input class="form-control" type="text" name="firstname" placeholder="Enter first name" required><br>
        <input class="form-control" type="text" name="lastname" placeholder="Enter last name" required><br>
        <input class="form-control" type="email" name="email" placeholder="Enter email" required><br>
        <select class="form-control" name="type" id="type">
          <option value="1">Customer</option>
          <option value="2">Admin</option>
          <option value="3">Auditor</option>
          <option value="4">HR</option>
          <option value="5">Instructor</option>
        </select>
        <br>
        <select class="form-control" name="instructor" id="instructor">
          <!-- AJAX-->
       </select>
       <br>
        <input class="form-control" type="password" name="password" placeholder="Enter password" required><br>
        <input class="form-control" type="password" name="verifypassword" placeholder="verify ur admin password" required><br>
        <input class="btn btn-primary send_chat" type="submit" name="submit" value="Add">
      </form>
    </div>
  </body>
  <script type="text/javascript">
      var typeField = document.getElementById('type');
      var instructorField = document.getElementById('instructor');

      function getTimes(type) {
        $.ajax({
          type: "POST",
          url: "Getcourse.php",
          data: {
            type: type
          },
          success: function(data) {
            instructorField.innerHTML = data;
          }
        });
      }

      function removeOptions(selectbox) {
        var i;
        for (i = selectbox.options.length - 1; i >= 0; i--) {
          selectbox.remove(i);
        }
      }
      typeField.addEventListener('change', function() {
        removeOptions(instructorField);
        getTimes(this.value);
      });
  </script>
</html>
