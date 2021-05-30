<?php
error_reporting(0);
include "databasehandler.php";
 session_start(); ?>
<html>
<head>
<link rel="stylesheet" href="static/master.css">
<link href="https://fonts.googleapis.com/css?family=Montserrat:500&display=swap" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>
<body>

            <div class="topnav" style="position:sticky; top: 0; z-index:10;">
              <?php
                if(!empty($_SESSION['firstname']))
                {
                  if($_SESSION['type']==1)
                  {
                    echo '<div class="logo">';
                    echo'<div class="logo_text">';
                    echo'<a href="index.php">';
                    echo'  TEA<span>CH</span>';
                    echo'</a>';
                    echo'</div>';
                      echo "<a id='wlcm' href='profile.php' data-value='".$_SESSION["id"]."'>Welcome</a>";
                    echo '</div>';

                    if( $_SERVER['PHP_SELF'] == '/lms/courses.php')
                    {
                      echo'<div class="search_wrap search_wrap_1">';
                      echo'<div class="search_box">';
                      echo'<input type="text" id="myInput" class="input" name="search" placeholder="What do you want to learn?">';
                      echo'</div>';
                      echo'</div>';
                    }
                    if($_SERVER['PHP_SELF'] == '/lms/mycourses.php'){
                      echo'<div class="search_wrap search_wrap_1">';
                      echo'<div class="search_box">';
                      echo'<input type="text" id="myInput" class="input" name="search" placeholder="Search...">';
                      echo'</div>';
                      echo'</div>';
                    }

                    echo '<nav>';
                      echo '<ul class="nav__links">';
                      $sql6="SELECT 1 from chat_message WHERE status=1 AND to_user_id= '".$_SESSION["id"]."' LIMIT 1";
                      $result6 = $mysqli->query($sql6);
                      if ($result6->num_rows > 0){
                        while($row6 = $result6->fetch_assoc()) {
                          echo '<span class="icon" style="position:relative; top:7px;"><i class="fas fa-comment"></i><div class="notification-badge limit active"><span class="number"></span></div></span><span class="icon1" style="position:relative; top:7px;"><i class="fas fa-shopping-cart"></i></span>';
                        }
                      }
                      else {
                        echo '<span class="icon" style="position:relative; top:7px;"><i class="fas fa-comment"></i></span><span class="icon1" style="position:relative; top:7px;"><i class="fas fa-shopping-cart"></i></span>';
                      }

                        echo '<li><a href="courses.php" style="color:black;">Browse Courses</a></li>';
                        ?>
                        <div id="dd" class="wrapper-dropdown-5" tabindex="1"><img src="<?php echo $_SESSION["picture"] ?>" alt="avatar"/> <span style="position:absolute; top:18px; left:57px; "><?php echo $_SESSION["firstname"] . " " . $_SESSION["lastname"]; ?></span>
                         <ul class="dropdown">
                           <li><a href="profile.php"><i class="icon-user"></i>Profile</a></li>
                           <li><a href="mycourses.php"><i class="icon-user"></i>My Courses</a></li>
                           <li><a href="survey.php"><i class="icon-remove"></i>Surveys</a></li>
                           <li><a href="signout.php"><i class="icon-remove"></i>Log out</a></li>
                         </ul>
                        </div>
                        <?php
                      echo '</ul>';
                    echo '</nav>';
                  }
                  else if($_SESSION['type']==2 || $_SESSION['type']==3 || $_SESSION['type']== 5 || $_SESSION['type']== 4){
                    header("Location: admin.php");
                  }
                }
                else
                {
                  echo '<div class="logo">';
                  echo'<div class="logo_text">';
                  echo'<a href="index.php">';
                  echo'  TEA<span>CH</span>';
                  echo'</div>';
                    echo '<nav>';
                    echo '</div>';
                      echo '<ul class="nav__links">';
                        echo "<li><a id='wlcm' href='profile.php'></a></li>";
                        echo '<li><a href="signin.php ">Log In</a></li>';
                      echo '</ul>';
                    echo '</nav>';
                    echo '<a class="cta" href="signin.php">Register</a>';
                }
                ?>
              </div>
</body>
</html>
<script type="text/javascript">
  $('.icon').click(function () {
    window.location.replace("chat.php");
  });
  $('.icon1').click(function () {
    window.location.replace("cart.php");
  });

  function DropDown(el) {
    this.dd = el;
    this.initEvents();
}
DropDown.prototype = {
    initEvents : function() {
        var obj = this;

        obj.dd.on('click', function(event){
            $(this).toggleClass('active');
            event.stopPropagation();
        });
    }
}
$(function() {

  var dd = new DropDown( $('#dd') );

  $(document).click(function() {
    // all dropdowns
    $('.wrapper-dropdown-5').removeClass('active');
  });

});
</script>
