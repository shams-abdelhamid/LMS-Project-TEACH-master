<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


<script src="functions/photoscript.js"></script>

<?php

include "databasehandler.php";
$id;
if(isset($_GET['id_update']))
{
include "adminnav.php";
$id=$_GET['id_update'];

}

else {
  include "navbar.php";
  $id=$_SESSION["id"];
}

if (!$_SESSION['firstname']) {
  header("Location: signin.php");
}
$msg="";
$error="";
$sql = "SELECT firstname , lastname ,email,password,picture,type,penalty FROM students WHERE id=$id";
$result = $mysqli->query($sql);


if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {

   $fn=$row['firstname'];
   $ln=$row['lastname'];
   $em=$row['email'];
   $pw=$row['password'];
   $pic=$row['picture'];
   $photopath="images/$pic";
   $type=$row['type'];
   if ($row['penalty']=="")
    {
     $pen="None";
   }

   else {
     $pen=$row["penalty"];
   }

  }


}
else {
  echo "0 results";
}


if(isset($_POST['subbutton'])){

		$newfname=$_POST['fname'];
    $_SESSION['firstname']=$newfname;
    $newlname=$_POST['lname'];
    $newemail=$_POST['email'];
 	  $newpass=$_POST['password'];
    if(!$_FILES['cphoto']['name'] == "")
   {

     $errors= array();
     $file_name = $_FILES['cphoto']['name'];
     $file_size =$_FILES['cphoto']['size'];
     $file_tmp =$_FILES['cphoto']['tmp_name'];
     $file_type=$_FILES['cphoto']['type'];
     $temp=(explode('.',$_FILES['cphoto']['name']));
     $file_ext=strtolower(end($temp));

    //  $extension=end(explode(".", $file_name ));
     $extensions= array("jpeg","jpg","png");

     if(in_array($file_ext,$extensions)=== false){
        $errors[]="extension not allowed, please choose a JPEG or PNG file.";
     }

     if($file_size > 2097152){
        $errors[]='File size must not exceed 2 MB';
     }

     if(empty($errors)==true){
        $pic=$file_name;
        move_uploaded_file($file_tmp,"images/".$file_name);

     }else{

         echo implode(',', $errors);
         echo "<br>";
         $error=1;


       //$flag=0;
     }


   }

    if(!preg_match('/^(?=.*[0-9])(?=.*[A-Z])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$/',$newpass)){
      $msg =  "Password should be at least 8 characters <br> should include at least: <br> -One upper case letter <br> -One number <br> -One special character.";
      $error=true;
      }

    if(!filter_var($newemail, FILTER_VALIDATE_EMAIL)){
      $msg="-Please enter a valid email <br>";
      //echo "-Please enter a valid email<br>";
      $error = true;
    }
    $sql4="SELECT 2 FROM students WHERE email = '".$newemail."'";
    $res=mysqli_query($mysqli,$sql4);
    if(mysqli_num_rows($res) > 1){
      $msg="-Email already registered<br>";
      $error = true;
    }

    if(!$error){
      $sql = "UPDATE students SET firstname='$newfname' ,lastname='$newlname' ,email='$newemail' ,password='$newpass',picture='$pic' WHERE id='$id'";
      $error = false;
      $msg="";
      $result = mysqli_query($mysqli,$sql);
      if($result)
      {

        echo '<script> alert("Sucess,information updated !")
        window.location = window.location.href
        </script>';
      //header( "refresh:2;url=profile.php" );
      }
      else
      {
        echo $sql;
      }
    }

	}
  $mysqli->close();
?>
<style media="screen">
.label2 .fa-eye{
      top: 27%;
      left: 91%;
      font-size: 15px;
      position: absolute;
}

.icon:hover{
      color: black;
      cursor: pointer;
}
.formInputpass{
  display: block;
    width: 100%;
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
}
</style>
  <div class="container">
    <h1 style="text-align:center">Edit Profile</h1>
    	<hr>
<form class="form-horizontal" action='' method='post' enctype='multipart/form-data'>
  	<div class="row">
        <!-- left column -->
        <div class="col-md-3">
          <div class="text-center">
            <img src='<?php echo $photopath?>' width='150px' id='cp' class='avatar img-circle'>

            <h6>Upload a different photo...</h6>

            <input type='file' name='cphoto' id='cphoto' class='form-control'>
          </div>
        </div>

        <!-- edit form column -->
        <div class="col-md-9">
          <h4 style="color:red;"><?php echo $msg ?></h4>
            <div class="form-group">
              <label class="col-lg-3 control-label">First name:</label>
              <div class="col-lg-8">
                <input class="form-control" type="text" value="<?php echo $fn?>" name="fname">
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Last name:</label>
              <div class="col-lg-8">
                <input class="form-control" value="<?php echo $ln?>" name="lname">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label">Email:</label>
              <div class="col-lg-8">
                <input class="form-control" value="<?php echo $em?>" name="email" >
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label">Password:</label>
              <div class="col-md-8">
                <label class="label2"><div class="icon" style="width:259%;"><i class="far fa-eye"></i><input type="password" class="formInputpass" value="<?php echo $pw?>" name="password"></label>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label"></label>
              <div class="col-md-8">
                <div class="text-center">
                <input type="submit" class="btn btn-primary" value="Save Changes" name="subbutton">
              </div>
              </div>
            </div>
          </form>
        </div>
    </div>
    <hr>
  </div>
  <script type="text/javascript">
  $('.icon').hover(function () {
     $('.formInputpass').attr('type', 'text');
  }, function () {
     $('.formInputpass').attr('type', 'password');
  });
  </script>
<?php

 if($type==2)
 {
   echo "<div class='text-center'>";
   echo "<h1>Your Status</h>";
   echo "</div>";
   echo " <h4 style='display:inline'>Current penalties (applied by HR ) : </h4>" ."<p style='color:red;display:inline;font-size:17px;font-weight:bold;'>$pen</p>";
 }

 ?>
