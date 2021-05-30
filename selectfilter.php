<?php
include('database_connection.php');

session_start();
if($_POST['val'] == 1){
  $query="SELECT * FROM students WHERE type=1 AND id !=".$_SESSION["id"];
}
else if($_POST['val'] == 2){
  $query="SELECT * FROM students WHERE type=2 AND id !=".$_SESSION["id"];
}
else {
  $query="SELECT * FROM students WHERE id !=".$_SESSION["id"];
}
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
foreach($result as $row) {
  $studentid= $row["id"];
  $studentfn= $row["firstname"];
  $studentln= $row["lastname"];
  $studentemail= $row["email"];
  $photo=$row["picture"];
  $photopath="images/$photo";
  ?>
  <div class="listcontainer" id="user_details" data-tousername="<?php echo $studentfn . " " . $studentln ?>" data-touserid="<?php echo $studentid ?>" >
    <div id="user_model_details"></div>
    <li class="clearfix">
      <img src="<?php echo $photopath ?>" alt="avatar" />
      <div class="about">
        <div class="name"><?php echo $studentfn . " ". $studentln .' '. count_unseen_message($row["id"], $_SESSION['id'], $connect) ?></div>
        <div class="status">
          <i class="fa fa-circle online"></i> online
        </div>
      </div>
    </li>
</div>
  <?php
}
?>
