<?php session_start();

if (!$_SESSION['firstname']) {
  header("Location: signin.php");
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="static/master.css">
<!-- CSS only -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style>
.topnav a{
    width: 33.3333333333%;
}
</style>
<div class="navbar navbar-dark bg-dark">
<a class="navbar-brand" href="admin.php">Home</a>
<a class="navbar-brand" href="signout.php">Logout</a>
</div>

<?php
include "databasehandler.php";
$msg=" ";
$i = 0;
if(isset($_POST['sub'])){

$selected=$_POST["filter"];
$search=$_POST["search"];

echo "<table class='table'>";
echo "<tr>";
echo '<td>Student ID </td>';
echo '<td>Student Name </td>';
echo '<td>Course Name </td>';
echo '<td>Course Price </td>';
echo "</tr>";

if($selected=="bystudent")
{

 $sql = "SELECT course_id,student_id,firstname,lastname From students INNER JOIN mycourses ON students.id=mycourses.student_id WHERE firstname LIKE '%$search%' OR lastname LIKE '%$search%'";
 $result = $mysqli->query($sql);

 if ($result->num_rows > 0) {
 while($row = $result->fetch_assoc()) {
 $sql1 = "SELECT Name,Price From course where ID=".$row['course_id'];
 $result1 = $mysqli->query($sql1);
 while($row1 = $result1->fetch_assoc())
 {
 echo "<tr><td>" . $row['student_id'] . "</td><td>" . $row['firstname'] ." ".$row['lastname']. "</td><td>" . $row1['Name'] . "</td><td>" . $row1['Price'] . "</td></tr>";
 $i++;
  }

  }

  }else{

      $msg="No results found";
  }
}

elseif ($selected=="bycourse")
{

$sql = "SELECT course_id,student_id,Name,Price From course INNER JOIN mycourses ON course.ID=mycourses.course_id WHERE Name LIKE '%$search%'";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
$sql1 = "SELECT firstname,lastname From students where id=".$row['student_id'];
$result1 = $mysqli->query($sql1);
echo $mysqli->error;
while($row1 = $result1->fetch_assoc())
{
echo "<tr><td>" . $row['student_id'] . "</td><td>" . $row1['firstname'] ." ".$row1['lastname']. "</td><td>" . $row['Name'] . "</td><td>" . $row['Price'] . "</td></tr>";
$i++;
 }

 }

 }else{

     $msg="No results found";
 }

}

else
{

$sql = "SELECT course_id,student_id,Name,Price From course INNER JOIN mycourses ON course.ID=mycourses.course_id WHERE Price LIKE '%$search%'";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
$sql1 = "SELECT firstname,lastname From students where id=".$row['student_id'];
$result1 = $mysqli->query($sql1);
echo $mysqli->error;
while($row1 = $result1->fetch_assoc())
{
echo "<tr><td>" . $row['student_id'] . "</td><td>" . $row1['firstname'] ." ".$row1['lastname']. "</td><td>" . $row['Name'] . "</td><td>" . $row['Price'] . "</td></tr>";
$i++;
 }

 }

 }else{

     $msg="No results found";
 }

}

$mysqli->close();

}
?>






<h1>Search orders</h1>
<form action="" method="post">
  <select name="filter" style="margin:5px; width:188.67px;height:30px">
  <option value="bystudent">By student's name</option>
  <option value="bycourse">By course</option>
  <option value="byamount">By amount</option>
</select>
<input  type="text" id="search"  name="search" >
<input  type="submit"  name="sub">
</form>
<br><br>
<?php
if($msg!=" ")
echo $msg;

echo 'Total: ' .$i;

 ?>
