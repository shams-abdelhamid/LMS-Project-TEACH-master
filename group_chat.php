<?php

//group_chat.php

include('database_connection.php');

session_start();

if($_POST["action"] == "insert_data")
{
 $data = array(
  ':from_user_id'  => $_SESSION["id"],
  ':chat_message'  => $_POST['chat_message'],
  ':status'   => '1',
  ':group_chat_id'  => $_POST['group_chat_id']
 );
if($_SESSION['type'] == 2)
{
  $query = "
  INSERT INTO chat_message
  (to_user_id,from_user_id, chat_message, status, groupchatid)
  VALUES (:group_chat_id, :from_user_id, :chat_message, :status, :group_chat_id)
  ";
}
else {
  $query = "
  INSERT INTO chat_message
  (from_user_id, chat_message, status, groupchatid)
  VALUES (:from_user_id, :chat_message, :status, :group_chat_id)
  ";

}

 $statement = $connect->prepare($query);

 if($statement->execute($data))
 {
  echo fetch_group_chat_history($_SESSION['id'], $_POST['group_chat_id'], $connect);
 }

}

if($_POST["action"] == "fetch_data")
{
 echo fetch_group_chat_history($_SESSION['id'], $_POST['group_chat_id'], $connect);
}

?>
