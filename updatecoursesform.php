<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="functions/photoscript.js"></script>
<?php
include "databasehandler.php";
include"adminmenu.php";
if(isset($_GET['id_update']))
{

 $upid=$_GET['id_update'];
 $sql = "SELECT * FROM course where ID='$upid'";
 $result = $mysqli->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $coursetitle=$row["Name"];
    $courseId =$row["ID"];
    $instructor=$row["Instructor"];
    $price=$row["Price"];
    $photo=$row["image"];
    $photopath="images/$photo";


  }



}
else {
  echo "0 results";
}

}

if(isset ($_POST['subbutton']))
{

 $newtitle=$_POST['ctitle'];
 $newinstructor=$_POST['cinstructor'];
 $newprice=$_POST['cprice'];
 $flag=1;
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
     $photo=$file_name;
     move_uploaded_file($file_tmp,"images/".$file_name);

  }else{

      echo implode(',', $errors);
      echo "<br>";
      $flag=0;


    //$flag=0;
  }


}

 //$upid=$_GET['id_update'];
 if (!is_numeric($newprice)) {
 echo("Price must be numerical value <br> ");
 $flag=0;
 }

 if (!preg_match ("/^[a-zA-Z ]*$/", $newinstructor) ) {

 echo "Only alphabets and whitespace are allowed for instructor name <br>";
 $flag=0;
 }

   if($flag==1)
   {

     $sql1 = "UPDATE course SET Name='$newtitle', Instructor='$newinstructor', Price='$newprice' , image='$photo' WHERE Id='$upid'";

     if ($mysqli->query($sql1) === TRUE) {
       echo '<script> alert("Sucess,information updated !")
       window.location = window.location.href
       </script>';
     } else {
       echo "Error: " . $sql1 . "<br>" . $mysqli->error;
     }
   }
   }



?>


<div class="container">
  <h1 style="text-align:center">Edit course</h1>
    <hr>
<form class="form-horizontal" action='' method='post' enctype='multipart/form-data'>
  <div class="row">
      <!-- left column -->
      <div class="col-md-3">
        <div class="text-center" style="margin-top:28px">
          <img src='<?php echo $photopath?>' width='150px' id='cp' class='avatar img-circle'>

          <h6>Upload a different photo...</h6>

          <input type='file' name='cphoto' id='cphoto' class='form-control' style="height:38px">
        </div>
      </div>

      <!-- edit form column -->
      <div class="col-md-9">

          <div class="form-group">
            <label class="col-lg-3 control-label">Course Name:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="<?php echo $coursetitle?>" name="ctitle">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Instructor:</label>
            <div class="col-lg-8">
              <input class="form-control" value="<?php echo $instructor?>" name="cinstructor">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Price:</label>
            <div class="col-lg-8">
              <input class="form-control" value="<?php echo $price?>" name="cprice" >
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
