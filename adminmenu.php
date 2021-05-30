<?php session_start();

if (!$_SESSION['firstname']) {
  header("Location: signin.php");
}
?>
<link rel="stylesheet" href="static/master.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style>
.topnav a{
    width: 20%;
}
</style>
<div class="navbar navbar-dark bg-dark">
<a class="navbar-brand" href="viewcourse.php ">View all courses</a>
<a class="navbar-brand" href="addcourse.php ">Add courses</a>
<a class="navbar-brand" href="updatecourse.php ">Update courses</a>
<a class="navbar-brand" href="deletecourse.php ">Delete courses</a>
<a class="navbar-brand" href="courses.php">Home</a>
</div>
