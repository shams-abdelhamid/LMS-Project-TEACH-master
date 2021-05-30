<?php
include "databasehandler.php";
?>
<link rel="stylesheet" href="static/master.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style>
.topnav a{
    width: 20%;
}
</style>
<?php
   if(isset($_POST['name'],$_FILES['image'], $_POST['link'])){
      $cname=$_POST['name']; 
      $clink = $_POST['link'];
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
    //  $extension=end(explode(".", $file_name ));
      $extensions= array("jpeg","jpg","png");

      if(in_array($file_ext,$extensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }

      if($file_size > 2097152){
         $errors[]='File size must not exceed 2 MB';
      }

      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"images/".$file_name);
         echo "Success";
      }else{
         print_r($errors);
      }


 $sql = "INSERT INTO coursesuggestion (name,image, link)
 VALUES ('$cname','$file_name', '$clink')";

 if ($mysqli->query($sql) === TRUE) {
   echo "New record created successfully";
 } else {
   echo "Error: " . $sql . "<br>" . $mysqli->error;
 }

 $mysqli->close();
 }
 ?>

<html>
  
<body>

  <form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
  Course name :  <input type="text" name="coursename" class="form-control" /> <br>
  Course link: <input type="url" name="courselink" clas= "form-control"/> <br>
  Course image : <input type="file" name="image"  class="form-control"/> <br>
     <input type="submit" class="btn btn-primary">
   </div>
  </form>

</body>
</html>