<?php include "databasehandler.php";
      session_start();   ?>

<!DOCTYPE html>
<html>
  <head>
    <title>add a user</title>
    <link rel="stylesheet" href="static/main.css">
  </head>
  <body>
    <?php
      $msg="";
      if (isset($_POST['submit']))
      {
        $firstname=$_POST['firstname'];
        $lastname=$_POST['lastname'];
        $email=$_POST['email'];
        $password=$_POST['password'];

          $sql="INSERT INTO students (firstname,lastname,email,password,type) VALUES('".$firstname."','".$lastname."','".$email."','".$password."',1)";
          if (mysqli_query($mysqli,$sql))
          {
              $msg= "added";
              $_SESSION["firstname"]=$firstname;
              $_SESSION["lastname"]=$lastname;
              $_SESSION["type"]=1;
              $sql="SELECT * FROM students WHERE email ='".$_POST['email']."' AND password='".$_POST['password']."'";
              $results=mysqli_query($mysqli,$sql);
              if ($results->num_rows>0)
              {
                $row=$results->fetch_assoc();
                $_SESSION["id"]=$row['id'];
              }
              header("Location: courses.php");
            }
            else {
              $msg= "not added!";
            }
          }
     ?>
    <div class="signform">
      <h1>Sign Up</h1>
      <h3 id="msg"><?php echo $msg; ?></h3>
      <form action="" method="post" >
        <input type="text" name="firstname" placeholder="Enter your first name" required><br>
        <input type="text" name="lastname" placeholder="Enter your last name" required><br>
        <input type="email" name="email" placeholder="Enter your email" required><br>
        <input type="password" name="password" placeholder="Enter your password" required><br>
        <input type="submit" name="submit" value="SignUp">
      </form>
      <a href="signin.php"><button type="button" name="button">Sign In</button></a>
    </div>
    <?php if($msg=="added"){header("Location: courses.php");} ?>
  </body>
</html>
