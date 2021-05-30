<?php if (!isset($_SESSION['firstname'])) {
  session_start();
}
 ?>
<link rel="stylesheet" href="static/master.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style>
.topnav a{
    width: 20%;
}
</style>
<?php
    if($_SESSION['type']==3){
      echo '<div class="navbar navbar-dark bg-dark">';
      echo '<a class="navbar-brand" href="adminstudents.php">View Admin Accounts</a>';
      echo '<a class="navbar-brand" href="surverystudents.php">View Student Accounts</a>';
      echo '<a class="navbar-brand" href="signout.php">Logout</a>';
      echo '</div>';
    }
    else if($_SESSION['type']==4){
      echo '<div class="navbar navbar-dark bg-dark">';
      echo '<a class="navbar-brand" href="chat.php">Chat</a>';
      echo '<a class="navbar-brand" href="hraddpenalty.php">Add penalty to admin</a>';
      echo '<a class="navbar-brand" href="signout.php">Logout</a>';
      echo '</div>';
    }

    else if($_SESSION['type']==5){
      $id=$_SESSION['id'];
      echo '<div class="navbar navbar-dark bg-dark">';
      echo '<a class="navbar-brand" href="chat.php">Chat</a>';
      echo "<a class='navbar-brand' href='profile.php?id_update=$id'>My profile</a>";
      echo '<a class="navbar-brand" href="signout.php">Logout</a>';
      echo '</div>';
    }
    else{
      $id=$_SESSION['id'];
      echo '<div class="navbar navbar-dark bg-dark">';
      echo '<a class="navbar-brand" href="managecourses.php">Manage courses</a>';
      echo '<a class="navbar-brand" href="manageadmins.php">Accounts</a>';
      echo '<a class="navbar-brand" href="chat.php">Chat</a>';
      echo '<a class="navbar-brand" href="Suggestions.php">Suggestions</a>';
      echo '<a class="navbar-brand" href="searchorders.php">Search orders</a>';
      echo "<a class='navbar-brand' href='profile.php?id_update=$id'>My profile</a>";
      echo '<a class="navbar-brand" href="signout.php">Logout</a>';
      echo '</div>';
    }
?>
