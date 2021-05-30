<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php
include "databasehandler.php";
include "navbar.php";

?>
  <head>

    <meta charset="utf-8">
    <title></title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="static/style.css">
  </head>
  <body>

<!--
  <form action="cart.php" method="POST"  class="searchform">
<button type="submit">Cart</button>
</form> -->
<h1>Computer Science courses</h1>

      <div class="grid-container">
    <?php


      $sqlc = "SELECT * FROM cart";
      $sqlm = "SELECT * FROM mycourses";
     if(isset($_POST['search']))
     {
       $sr=$_POST['search'];
       $sql = "SELECT ID, Name, Instructor,Price,image FROM course where Name LIKE '%$sr%'";
     }
     else {
       $sql = "SELECT ID, Name, Instructor,Price,image FROM course";
       $resultc = mysqli_query($mysqli,$sqlc);
       $resultm = mysqli_query($mysqli,$sqlm);
     }

    $result = mysqli_query($mysqli,$sql);



    if (mysqli_num_rows($result) > 0) {
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
        $coursetitle=$row["Name"];
        $courseId =$row["ID"];
        $instructor=$row["Instructor"];
        $price=$row["Price"];
        $photo=$row["image"];
        $photopath="images/$photo";
        $carted=false;
        $coursed=false;
        $resultc = mysqli_query($mysqli,$sqlc);
        $resultm = mysqli_query($mysqli,$sqlm);
        if (mysqli_num_rows($resultc) > 0){
          while($rowc = mysqli_fetch_assoc($resultc))
          { if (!empty($_SESSION['id'])) {
            if (($row["ID"]==$rowc["course_id"])&&($rowc["student_id"]==$_SESSION['id'])){
              $carted=true;
              break;
            }
          }

          }
        }

        if (mysqli_num_rows($resultm) > 0){
          while($rowm = mysqli_fetch_assoc($resultm))
          { if (!empty($_SESSION['id'])) {
            if (($row["ID"]==$rowm["course_id"])&&($rowm["student_id"]==$_SESSION['id'])){
              $coursed=true;
              break;
            }
          }

          }
        }

            echo '<li class="cards" style="list-style: none;">';
            echo '<div class="card">';
            echo '<div class="image">';

          echo '<img src="'.$photopath.'"/>';

            echo '</div>';
            echo '<div class="title">';
            echo $coursetitle."<br>";
            echo '</div>';
            echo ' <div class="Instuctor">' ;
            echo $instructor;
            echo '</div>';

           echo '<div class="price">';
           echo $price;
             echo '</div>';
           echo '<div class="currency">';
                echo "USD";

            echo '</div>';
            if ($carted==false && $coursed==false)
            {
                echo ' <button data-price="'. $price .'" data-carted="0" data-coursed="0" value="'. $courseId .'" class="add-to-cart">Add to cart';
            }
            else if($carted==false && $coursed==true)
            {
              echo ' <button data-price="'. $price .'" data-carted="0" data-coursed="1" value="'. $courseId .'" class="add-to-cart">Add to cart';
            }
            else {
                echo ' <button data-price="'. $price .'" data-carted="1" data-coursed="1" value="'. $courseId .'" class="add-to-cart">Add to cart';
            }
              ?>
            <?php
            echo '</button>';
            echo '</div>' ;
            echo '</li>';



      }
    } else {
      echo "0 results";
    }
    mysqli_close($mysqli);
    ?>
    <script>
    $(document).ready(function() {
         (function($) {
             $('#myInput').keyup(function() {
                var rex = new RegExp($(this).val(), 'i');
                       // var $t = $(this).children(":eq(4))");
                 $('.cards ').hide();

                       //Recusively filter the jquery object to get results.
                 $('.cards ').filter(function(i, v) {
                         //Get the 3rd column object here which is userNamecolumn
                     var $t = $(this);
                     return rex.test($t.text());
                     }).show();
                 })

         }(jQuery));
     });
    var y = document.getElementById("wlcm");
    var x = document.getElementsByClassName("add-to-cart");
    console.log(y.innerHTML.length);
    var numComments = x.length;
    if (!(y.innerHTML.length)==0){
      for (var i = 0; i < numComments; i++) {
          if(x[i].dataset.carted==0 && x[i].dataset.coursed==0)
        {
          console.log(x[i].dataset.carted);
          $(x[i]).one("click", function() {
            this.innerHTML = "Added to cart";
            this.style.background="#00ff7f";
            jQuery.ajax({
                    type: "POST",
                    url: "AddToCart.php",
                    data: {student_id:y.dataset.value,course_id:this.value, course_price: this.dataset.price }
                }
            );
          });
        }
        else if(x[i].dataset.carted==0 && x[i].dataset.coursed==1){
          x[i].innerHTML="Purchased";
          x[i].style.background='#00ff7f';
        }
        else {
          console.log("hi");
          console.log(x[i].dataset.coursed);
          console.log(x);
          x[i].innerHTML="Added";
          x[i].style.background='#0045efg';
        }
      }
    }
    else{
      for (var i = 0; i < numComments; i++) {
        x[i].addEventListener("click", function() {
          window.location.replace("signin.php");
        });
      }
    }

    </script>
  </div>
  </section>
  </body>
</html>
