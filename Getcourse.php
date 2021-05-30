<?php
    include "databasehandler.php";
    $sql="SELECT ID,Name FROM course";
    echo $_POST["type"];
    if($_POST["type"] == 5)
    {
      $result = mysqli_query($mysqli,$sql);
      if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
          $courseid=$row["ID"];
          $coursename=$row["Name"];
          ?>
            <option value="<?php echo $courseid ?>"><?php echo $coursename ?></option>
          <?php
        }
      }
    }
    $sql= "INSERT INTO cart (student_id,course_id,total) VALUES('".$_POST["student_id"]."','".$_POST["course_id"]."','".$_POST["course_price"]."')";
    echo $sql;
    mysqli_query($mysqli,$sql);

?>
