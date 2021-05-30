<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


<?php include "databasehandler.php";
?>
 <link rel="stylesheet" href="static/master.css">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


<!DOCTYPE html>
<html>
<body>
    <?php


$id;
include "navbar.php";
$id=$_SESSION['id'];



$select = "SELECT * FROM survey WHERE id='".$id."' AND is_answered=0";

//echo $select;
$result = $mysqli->query($select);

//echo $result->num_rows;
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    if(!isset($_POST['level']))
    {
      echo "You have a survey to fill.";


      echo " <div class='form-group'>";
      echo " <h1>Please fill this survey</h1>";
      echo "<form action='' method='POST' >";

      echo "<label>What is your age ?</label>";
      echo " <br>";
      echo "  <select class='form-control' name='age' required>";
      echo "   <option value='Under 18'>Under 18</option>";
      echo "   <option value='18-24'>18-24</option>";
      echo "     <option value='25-34'>25-34</option>";
      echo "    <option value='35-44'>35-44</option>";
      echo "     <option value='45-54'>45-54</option>";
      echo "     <option value='55-65'>55-65</option>";
      echo "    <option value='65+'>65+</option>";
      echo "   </select>   ";
      echo "  <br>  ";

      echo "  <label>What is your education level?</label>";
      echo "  <br>";
      echo " <select class='form-control' name='level' required>";
      echo "   <option value='Undergraduate'>Undergraduate</option>";
      echo "    <option value='Graduate'>Graduate</option>";
      echo "  </select>     ";
      echo "  <br>  ";

      echo "  <label>What is your primary college of study?</label>";
      echo "  <br>";
      echo "  <select class='form-control' name='college' required>";
      echo "     <option value='Alsun'>Alsun</option>";
      echo "     <option value='Architecture'>Architecture</option>";
      echo "    <option value='Business Administration'>Business Administration</option>";
      echo "    <option value='Computer Science'>Computer Science</option>";
      echo "    <option value='Engineering'>Engineering</option>";
      echo "    <option value='Mass Communication'>Mass Communication</option>";
      echo "    <option value='Oral & Dental Medicine'>Oral & Dental Medicine</option>";
      echo "   <option value='Pharmacy'>Pharmacy</option>";
      echo "   <option value='Other'>Other</option>";

      echo "   </select> ";
      echo "   <br>";

      echo "   <label>What rate would you give this website?</label>";
      echo "  <br>";
      echo "  <select class='form-control' name='rateLms' required>";
      echo "     <option value= 1>1</option>";
      echo "    <option value=2>2</option>";
      echo "    <option value=3>3</option>";
      echo "   <option value=4>4</option>";
      echo "   <option value=5>5</option>";
      echo "  <option value=6>6</option>";
      echo "   <option value=7>7</option>";
      echo "   <option value=8>8</option>";
      echo "   <option value=9>9</option>";
      echo "   <option value=10>10</option>";

      echo "  </select> ";
      echo "  <br>";

      echo "  <label>What features are missing from this website?</label>";
      echo " <br>";
      echo " <input class='form-control' type='text' name='missing'  required>";
      echo " <br>";

      echo " <label>Would you recommend this platform to a friend?</label>";
      echo " <br> <select class='form-control' name='recommend' required>";
      echo "     <option value='Yes'>Yes</option>";
      echo "     <option value='Yes'>No</option>";
      echo "   </select>   ";
      echo " <br>";

      echo "   <input class='btn btn-primary' type='submit' name='submit' value='Submit'>";
      echo " </form>";
      echo " </div> ";

    }

   $msg="";
   if (isset($_POST['submit']))
   {
     $age=$_POST['age'];
     $level=$_POST['level'];
     $college=$_POST['college'];
     $rate=$_POST['rateLms'];
     $missing=$_POST['missing'];
     $recommend=$_POST['recommend'];
//WHERE id=$id
     $sql="UPDATE survey SET age='$age', level='$level', college='$college', rateLms='$rate', missing='$missing', recommend='$recommend', is_answered='1' WHERE id='$id'";
     if (mysqli_query($mysqli,$sql))
     {

     echo "Thank you for your feedback!";

   }
    }

  }
}

else {
  echo "You did not receive any survey.";
}
     ?>

  </body>
</html>
