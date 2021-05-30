<?php

//insert_chat.php

include('database_connection.php');
session_start();
$magic;
if ($_SESSION['type']==3 && isset($_POST['from'])) {
  $magic=$_POST['from'];
  $magicval=$_SESSION['id'];
}
else {
  $magic=$_SESSION['id'];
  $magicval=0;
}
$data = array(
 ':to_user_id'  => $_POST['to_user_id'],
 ':from_user_id'  => $magic,
 ':chat_message'  => $_POST['chat_message'],
 ':reply'  => $magicval,
 ':status'   => '1'
);

$query = "
INSERT INTO chat_message
(to_user_id, from_user_id, chat_message, reply, status)
VALUES (:to_user_id, :from_user_id, :chat_message, :reply, :status)
";

$statement = $connect->prepare($query);

if($statement->execute($data))
{
 echo fetch_user_chat_history($_SESSION['id'], $_POST['to_user_id'], $connect);
}

?>
