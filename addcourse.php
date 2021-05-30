<?php
//
include "databasehandler.php";
include "adminmenu.php";
if (!$_SESSION['firstname']) {
  header("Location: signin.php");
}
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<body>
  <h2>Course information..</h2>
  <form action="" method="POST" enctype="multipart/form-data" style="margin-top:1%">
    <div class="form-group">
   Course name :<input type="text" name="coursename" class="form-control" required /> <br>
   Course instructor :<input type="text" name="courseinstructor" class="form-control" required/> <br>
   Course price : <input type="text" name="courseprice" class="form-control" required/> <br>
   Course image : <input type="file" name="image"  class="form-control" required/> <br>
   <input type="submit" class="btn btn-primary">
   </div>
  </form>

</body>

<?php
   if(isset($_POST['coursename'],$_POST['courseinstructor'],$_POST['courseprice'],$_FILES['image'])){
      $cname=$_POST['coursename'];
      $cins=$_POST['courseinstructor'];
      $cprice=$_POST['courseprice'];
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $temp=(explode('.',$_FILES['image']['name']));
      $file_ext=strtolower(end($temp));
      $extensions= array("jpeg","jpg","png");
      $flag=1;
      if(in_array($file_ext,$extensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file. ";

      }

      if($file_size > 2097152){
         $errors[]='File size must not exceed 2 MB';
      }

      if(empty($errors)==true)
      {
        move_uploaded_file($file_tmp,"images/".$file_name);

      }


      else{
         echo implode(',', $errors);
         echo "<br>";
         $flag=0;
      }

      if (!is_numeric($cprice)) {
      echo("Price must be numerical value <br> ");
      $flag=0;
    }

   if (!preg_match ("/^[a-zA-Z ]*$/", $cins) ) {
   echo "Only alphabets and whitespace are allowed for instructor name <br>";
   $flag=0;
  }

  if($flag==1)
  {

    $sql = "INSERT INTO course (Name, Instructor, price,image)
    VALUES ('$cname', '$cins', '$cprice','$file_name')";

    if ($mysqli->query($sql) === TRUE ) {
      echo '<script> alert("New record created successfuly !")
      window.location = window.location.href
      </script>';
    } else {
      echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
  }


 $mysqli->close();
 }



?>
