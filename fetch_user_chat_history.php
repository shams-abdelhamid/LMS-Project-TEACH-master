<?php

//fetch_user_chat_history.php

include('database_connection.php');

session_start();
if ($_SESSION['type']==2 || ($_SESSION['type']==3) && isset($_POST['from'])) {
  echo fetch_user_chat_history($_POST['from'], $_POST['to_user_id'], $connect);
}
else if ($_SESSION['type']==1 || $_SESSION['type']== 4 || $_SESSION['type']== 5) {
  echo fetch_user_chat_history($_SESSION['id'], $_POST['to_user_id'], $connect);
}

else if ($_SESSION['type']==2) {
  echo fetch_user_chat_history($_SESSION['id'], $_POST['to_user_id'], $connect);
}
else if ($_SESSION['type']==3) {
  echo fetch_user_chat_history($_SESSION['id'], $_POST['to_user_id'], $connect);
}

?>
