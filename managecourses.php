<?php include "adminmenu.php";
if (!$_SESSION['firstname']) {
  header("Location: signin.php");
}
?>
