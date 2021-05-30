<?php
    include "databasehandler.php";
session_start();

    $sql ="SELECT * FROM students WHERE type= 4";
    $result = mysqli_query($mysqli,$sql);
    $auditorid=$_SESSION['id'];
    $adminid=$_POST['admin_id'];
    $adminname= $_POST['admin_fnname'] ." " .$_POST['admin_lnname'];
    $message="This is an investigation request for a misbehavior of a administrator. <br> Name: $adminname <br> ID: $adminid";
    echo $message;
    if (mysqli_num_rows($result) > 0) {
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
        $hrid=$row["id"];
        $sql1= "INSERT INTO chat_message (to_user_id,from_user_id,chat_message,status) VALUES('".$hrid."','".$auditorid."','".$message."','1')";
        mysqli_query($mysqli,$sql1);
      }
    }

?>
