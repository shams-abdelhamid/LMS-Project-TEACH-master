<?php
//database_connection.php

$connect = new PDO("mysql:host=localhost;dbname=lms", "root", "");

date_default_timezone_set('Africa/Cairo');

function fetch_user_last_activity($user_id, $connect)
{
 $query = "
 SELECT * FROM login_details
 WHERE user_id = '$user_id'
 ORDER BY last_activity DESC
 LIMIT 1
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  return $row['last_activity'];
 }
}

function fetch_user_chat_history($from_user_id, $to_user_id, $connect)
{

 $query = "
 SELECT * FROM chat_message
 WHERE (from_user_id = '".$from_user_id."'
 AND to_user_id = '".$to_user_id."')
 OR (from_user_id = '".$to_user_id."'
 AND to_user_id = '".$from_user_id."')
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $output = '<ul class="list-unstyled">';
 foreach($result as $row)
 {
  $user_name = '';
  if($row["from_user_id"] == $from_user_id)
  {
    if (($_SESSION['type']==2) || ($_SESSION['type']==3)) {
      $query1 = "
      SELECT * FROM students
      WHERE id = '$from_user_id'
      ";
      $statement1 = $connect->prepare($query1);
      $statement1->execute();
      $result1 = $statement1->fetchAll();

      foreach($result1 as $row1)
      {
        if ($row['reply']==0) {
          $user_name = '<b class="text-success" style="color:green;">'.$row1['firstname']. ' ' . $row1['lastname'].'</b>';
        }
        else if($row['reply']!=0) {
          $audid=$row['reply'];
          $query2 = "
          SELECT * FROM students
          WHERE id = '$audid'
          ";
          $statement2 = $connect->prepare($query2);
          $statement2->execute();
          $result2 = $statement2->fetchAll();
          foreach($result2 as $row2)
          {
            $user_name = '<b class="text-success" style="color:green;">'.$row2['firstname']. ' ' . $row2['lastname'].'</b>';
          }

        }

      }
    }
    else {
      $user_name = '<b class="text-success" style="color:green;">You</b>';
    }
  }
  else
  {
    if ($row['reply']==0) {
      $magic2=$row['from_user_id'];
    }
    else {
      $magic2=$row['reply'];
    }
   $user_name = '<b class="text-danger" style="color:red;">'.get_user_name($magic2, $connect).'</b>';
  }
    if($row['status'] == 0){
      $output .= '
      <li style="border-bottom:1px dotted #ccc">
       <p style="font-style: italic;">'.$user_name.' - '.$row["chat_message"].'
        <div align="right">
         - <small><em>'.$row['timestamp'].'</em></small>
        </div>
       </p>
      </li>
      ';
    }else if($row['status'] == 1){
      $output .= '
      <li style="border-bottom:1px dotted #ccc">
       <p style="font-weight: bold; text-decoration:underline;">'.$user_name.' - '.$row["chat_message"].'
        <div align="right">
         - <small><em>'.$row['timestamp'].'</em></small>
        </div>
       </p>
      </li>
      ';
    }
 }
 $output .= '</ul>';
 $query = "
 UPDATE chat_message
 SET status = '0'
 WHERE from_user_id = '".$to_user_id."'
 AND to_user_id = '".$from_user_id."'
 AND status = '1'
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 return $output;
}

function get_user_name($user_id, $connect)
{
 $query = "SELECT firstname,lastname FROM students WHERE id = '$user_id'";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  return $row['firstname'] .' '. $row['lastname'];
 }
}

function count_unseen_message($from_user_id, $to_user_id, $connect)
{
 $query = "
 SELECT * FROM chat_message
 WHERE from_user_id = '$from_user_id'
 AND to_user_id = '$to_user_id'
 AND status = '1'
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 $count = $statement->rowCount();
 $output = '';
 if($count > 0)
 {
  $output = '<span class="label label-success" style="background-color: green;">'.$count.'</span>';
 }
 return $output;
}

function fetch_is_type_status($user_id, $connect)
{
 $query = "
 SELECT is_type FROM login_details
 WHERE user_id = '".$user_id."'
 ORDER BY last_activity DESC
 LIMIT 1
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $output = '';
 foreach($result as $row)
 {
  if($row["is_type"] == 'yes')
  {
   $output = ' - <small><em><span class="text-muted">Typing...</span></em></small>';
  }
 }
 return $output;
}

function fetch_group_chat_history($from_user_id, $group_chat_id, $connect)
{
  if($_SESSION['type'] == 2)
  {
    $query = "
    SELECT * FROM chat_message
    WHERE to_user_id = '".$group_chat_id."'
    ORDER BY timestamp DESC
    ";
  }
  else {
    $query = "
    SELECT * FROM chat_message
    WHERE to_user_id = '0'
    AND groupchatid = '".$group_chat_id."'
    ORDER BY timestamp DESC
    ";
  }


 $statement = $connect->prepare($query);

 $statement->execute();

 $result = $statement->fetchAll();

 $output = '<ul class="list-unstyled">';
 foreach($result as $row)
 {
  $user_name = '';
  if($row["from_user_id"] == $_SESSION["id"])
  {
   $user_name = '<b class="text-success" style="color:green;">You</b>';
  }
  else
  {
   $user_name = '<b class="text-danger" style="color:red;">'.get_user_name($row['from_user_id'], $connect).'</b>';
  }

  $output .= '

  <li style="border-bottom:1px dotted #ccc">
   <p>'.$user_name.' - '.$row['chat_message'].'
    <div align="right">
     - <small><em>'.$row['timestamp'].'</em></small>
    </div>
   </p>
  </li>
  ';
 }
 $output .= '</ul>';
 return $output;
}


?>
