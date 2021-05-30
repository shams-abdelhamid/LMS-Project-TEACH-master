<?php include "databasehandler.php";
      session_start();     ?>
      <link rel="stylesheet" href="static/main.css">
      <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800&display=swap" rel="stylesheet">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
      <?php
      $msg="";
      $msg1="";
      $error="";
      if(isset($_POST['search']))
      {
        $sql5="SELECT 1 FROM students WHERE password = '".$_POST['password']."'";
        $res=mysqli_query($mysqli,$sql5);
        if(mysqli_num_rows($res) == 0){
          $msg1="-Password is incorrect.";
          $error = true;
        }
        $sql5="SELECT 1 FROM students WHERE email = '".$_POST['email']."'";
        $res=mysqli_query($mysqli,$sql5);
        if(mysqli_num_rows($res) == 0){
          $msg1="-No such email Exists.";
          $error = true;
        }
        if(!$error){
          $error = false;
          $msg1="";
          $sql="SELECT * FROM students WHERE email ='".$_POST['email']."' AND password='".$_POST['password']."'";
          $results=mysqli_query($mysqli,$sql);
          if ($results->num_rows>0)
          {
            $row=$results->fetch_assoc();
            $_SESSION["firstname"]=$row['firstname'];
            $_SESSION["lastname"]=$row['lastname'];
            $_SESSION["type"]=$row['type'];
            $_SESSION["id"]=$row['id'];
            $_SESSION["password"]=$row['password'];
            $_SESSION["picture"]="images/" .$row['picture'];
            header("Location: index.php");
          }
        }

      }

      if (isset($_POST['submit']) && !empty($_POST['submit']))
      {
        $firstname=$_POST['firstname'];
        $lastname=$_POST['lastname'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        $photo="depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg";


        // if(!preg_match('/[a-z0-9._%+-]+@+[a-z0-9._%+-]+.+[a-z0-9._%+-]/',$email)){
        //   $msg="-Please enter a valid email <br>";
        //   //echo "-Please enter a valid name <br>";
        //   $error = true;
        // }
        if(!preg_match('/^(?=.*[0-9])(?=.*[A-Z])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$/',$password)){
          $msg =  "Password should be at least 8 characters <br> should include at least: <br> -One upper case letter <br> -One number <br> -One special character.";
          $error=true;
          }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
          $msg="-Please enter a valid email <br>";
          //echo "-Please enter a valid email<br>";
          $error = true;
        }
        $sql4="SELECT 1 FROM students WHERE email = '".$email."'";
        $res=mysqli_query($mysqli,$sql4);
        if(mysqli_num_rows($res) > 0){
          $msg="-Email already registered<br>";
          $error = true;
        }

        if (!$error){
          $sql="INSERT INTO students (firstname,lastname,email,password,type,picture) VALUES('".$firstname."','".$lastname."','".$email."','".$password."',1,'".$photo."')";
          $error = false;
          if (mysqli_query($mysqli,$sql))
          {
              $msg="";
              $_SESSION["firstname"]=$firstname;
              $_SESSION["lastname"]=$lastname;
              $_SESSION["type"]=1;
              $sql="SELECT * FROM students WHERE email ='".$_POST['email']."' AND password='".$_POST['password']."'";
              $results=mysqli_query($mysqli,$sql);
              if ($results->num_rows>0)
              {
                $row=$results->fetch_assoc();
                $_SESSION["id"]=$row['id'];
                $_SESSION["picture"]="images/" .$row['picture'];
              }
              header("Location:index.php");
            }
            else {
            }
          }
        }



      ?>
    <body>
      <div class="main">
        <div class="container register-container" id="register-container">
          <form action="signin.php" method="POST" class="form" id="register-form">
            <h2 class="form_title title">Create Account</h2>
            <h4 style="color:red;"><?php echo $msg;?></h4>
            <label class="label2"><i class="far fa-user"></i><input class="formInput" name="firstname" type="text" placeholder='First Name' required></label>
            <label class="label2"><i class="far fa-user"></i><input class="formInput" name="lastname" type="text" placeholder="Last Name" required></label>
            <label class="label2"><i class="far fa-envelope"></i><input class="formInput" name="email" type="text" placeholder="Email" required></label>
            <label class="label2"><i class="fas fa-lock"></i><div class="icon"><i class="far fa-eye"></i></div><input class="formInputpass"  id="pass" name="password" type="password" placeholder="Password" required></label>
            <input type="submit" name="submit" value="SIGN UP">
          </form>
        </div>
        <div class="container login-container" id="login-container">
            <form action="signin.php" method="post" class="form" id="login-form">
            <h2 class="form_title title">Sign in</h2>
            <h4 style="color:red;"><?php echo $msg1;?></h4>
            <label class="label2"><i class="far fa-envelope"></i><input class="formInput" type="text" name="email" placeholder="Email" required></label>
            <label class="label2"><i class="fas fa-lock"></i><div class="icon"><i class="far fa-eye"></i></div><input class="formInputpass" id="pass" type="password" name="password" placeholder="Password" required></label>
            <input type="submit" name="search" value="SIGN IN">
          </form>
        </div>
        <div class="switch" id="switch-cnt">
          <div class="switch__circle"></div>
          <div class="switch__circle switch__circle--t"></div>
          <div class="switch__container" id="switch-c1">
            <h2 class="switch__title title">Welcome Back !</h2>
            <p class="switch__description description">To keep connected with us please login with your personal info</p>
            <button class="switch__button button switch-btn">SIGN IN</button>
          </div>
          <div class="switch__container is-hidden" id="switch-c2">
            <h2 class="switch__title title">Hello Friend !</h2>
            <p class="switch__description description">Enter your personal details and start journey with us</p>
            <button class="switch__button button switch-btn">SIGN UP</button>
          </div>
        </div>
      </div>

      <script type="text/javascript" src="login.js"></script>
      <script type="text/javascript">
      $('.icon').hover(function () {
         $('.formInputpass').attr('type', 'text');
      }, function () {
         $('.formInputpass').attr('type', 'password');
      });
      </script>
    </body>
