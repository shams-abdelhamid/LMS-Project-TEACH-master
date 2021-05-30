<?php
include "databasehandler.php";
include "adminnav.php";
echo "hi ".$_SESSION['firstname'];
if (!$_SESSION['firstname']) {
  header("Location: signin.php");
}
?>
<html>

</html>
