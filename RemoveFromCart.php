<?php
    include "databasehandler.php";

    $id = $_POST["course_id"];
    echo "hello";
    $sql = "DELETE from cart WHERE course_id ='". $id."'";
    echo $sql;
    mysqli_query($mysqli,$sql);



?>
