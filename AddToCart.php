<?php
    include "databasehandler.php";

    echo $_POST["course_id"];
    $sql= "INSERT INTO cart (student_id,course_id,total) VALUES('".$_POST["student_id"]."','".$_POST["course_id"]."','".$_POST["course_price"]."')";
    echo $sql;
    mysqli_query($mysqli,$sql);

?>
