<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php
include "databasehandler.php";
include "navbar.php";

if (!$_SESSION['firstname']) {
  header("Location: signin.php");
}
?>
  <head>

    <meta charset="utf-8">
    <title></title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="static/style.css">

  </head>
  <body>


      <h1>Computer Science courses </h1>



      <div class="grid-container">
    <?php




    if(!empty($_SESSION['firstname'])){

      $sqlc = "SELECT course_id FROM mycourses WHERE student_id='".$_SESSION["id"]."'";
      $resultc = mysqli_query($mysqli,$sqlc);
      if (mysqli_num_rows($resultc) > 0) {
        // output data of each row
        while($rowc = mysqli_fetch_assoc($resultc)) {
          $courseid=$rowc["course_id"];

          if(isset($_POST['search']))
          {
            $sr=$_POST['search'];
            $courses = "SELECT ID, Name, Instructor,image FROM course WHERE id ='".$courseid."' AND Name LIKE '%$sr%'";
          }
          else {
            $courses = "SELECT ID, Name, Instructor,image FROM course WHERE id ='".$courseid."'";
          }
          $resultcourses = mysqli_query($mysqli,$courses);
          while($row1 = mysqli_fetch_array($resultcourses)){

            $coursetitle=$row1["Name"];
            $courseId =$row1["ID"];
            $instructor=$row1["Instructor"];
            $photo=$row1["image"];
            $photopath="images/$photo";

            echo '<li class="cards" style="list-style: none;">';
              echo '<div class="card" style="height:300px;">';
              echo '<div class="image">';

            echo '<img src="'.$photopath.'"/>';

              echo '</div>';
              echo '<div class="title">';
              echo $coursetitle."<br>";
              echo '</div>';
              echo ' <div class="Instuctor">' ;
              echo $instructor;
              echo '</div>';


              echo ' <div class="add-to-cart" style="background-color: #34A89A;cursor:pointer; text-align: center;"><a href="chat.php?id_course='.$courseid.'" style="text-decoration:none; color:white;">Instructor Q&A</a>';
              echo '</button>';
              echo '</div>' ;
              echo '</li>';

            }
        }
      } else {
        echo "0 results";
      }
      mysqli_close($mysqli);
    }
    else{
      echo '<div class="alert">';
        echo "No courses are purchased. Enroll in courses to start learning.";
      echo '</div>';
    }

    ?>
<script type="text/javascript">
$(document).ready(function() {
     (function($) {
         $('#myInput').keyup(function() {
            var rex = new RegExp($(this).val(), 'i');
                   // var $t = $(this).children(":eq(4))");
             $('.cards ').hide();

                   //Recusively filter the jquery object to get results.
             $('.cards ').filter(function(i, v) {
                     //Get the 3rd column object here which is userNamecolumn
                 var $t = $(this);
                 return rex.test($t.text());
                 }).show();
             })

     }(jQuery));
 });
</script>
  </div>
  </section>
  </body>
</html>
