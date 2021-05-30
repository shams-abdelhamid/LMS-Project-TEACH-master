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
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@500;600;700&display=swap" rel="stylesheet">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="functions/photoscript.js"></script>
<link rel="stylesheet" href="static/index.css">
<style media="screen">
.courses {
    width: 100%;
    padding-top: 93px;
    padding-bottom: 100px;
    background: url(images/download.jpg);
}
.counter {
    width: 100%;
    background: #fff;
    z-index: 2;
}
.counter_background {
    position: absolute;
    top: 2413px;
    left: 0;
    width: 100%;
    height: 70%;
    background-image:url(images/counter_background.jpg);
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center center;
}
.team {
    width: 100%;
    padding-top: 93px;
    background: url(images/download.jpg);
}
.footer {
    display: block;
    position: relative;
    width: 100%;
    background: #1e2434;
    padding-top: 104px;
    height: 100%;
    background: url(images/footer-skyline-background.jpg);
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center center;
}
.footer_background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}
</style>
  </head>
  <body>

    <?php
      if (isset($_POST['submit']))
      {
        if(isset($_POST['course']) && isset($_POST['link'])){
          $cname=$_POST['course'];
          $clink=$_POST['link'];
          $student_id=$_SESSION['id'];
          $errors= array();
          $file_name = $_FILES['cphoto']['name'];
          $file_size =$_FILES['cphoto']['size'];
          $file_tmp =$_FILES['cphoto']['tmp_name'];
          $file_type=$_FILES['cphoto']['type'];
          $temp=(explode('.',$_FILES['cphoto']['name']));
          $file_ext=strtolower(end($temp));
          $extensions= array("jpeg","jpg","png");

          if(in_array($file_ext,$extensions)=== false){
             $errors[]="extension not allowed, please choose a JPEG or PNG file.";
          }

          if($file_size > 2097152){
             $errors[]='File size must not exceed 2 MB';
          }

          if(empty($errors)==true){
             move_uploaded_file($file_tmp,"images/".$file_name);

          }else{
             print_r($errors);
          }

         $sql = "INSERT INTO coursesuggestion (student_id,name, image, link)
         VALUES ('".$student_id."','".$cname."', '".$file_name."', '".$clink."')";
         mysqli_query($mysqli,$sql);

         $sql2 ="SELECT * FROM students WHERE type= 2";
         $result = mysqli_query($mysqli,$sql2);
         $studentid=$_SESSION['id'];
         $message="This is a request for course suggestion. <br> Name: $cname <br> Link: $clink";
         if (mysqli_num_rows($result) > 0) {
           // output data of each row
           while($row = mysqli_fetch_assoc($result)) {
             $adminid=$row["id"];
             $sql1= "INSERT INTO chat_message (to_user_id,from_user_id,chat_message,status) VALUES('".$adminid."','".$studentid."','".$message."','1')";
             mysqli_query($mysqli,$sql1);
           }
         }

       }
     }


    ?>

<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
        <div class="home_slider_title" data-aos="fade-up">The Premium System Education</div>
      <img src="images/home_slider_1.jpg" style="background-size: cover;" alt="Los Angeles">
    </div>

    <div class="item">
      <img src="images/home1.jpg" style="width: 100%; max-height: 650px;" alt="Chicago">
    </div>

    <div class="item">
      <img src="images/h2-2.jpg" style="width: 100%; max-height: 650px;" alt="New York">
    </div>
  </div>

  <!-- Left and right controls -->
<div class="home_slider_nav home_slider_prev">
  <i class ="fa fa-angle-left" aria-hidden="true " href="#myCarousel" data-slide="prev"></i>
</div>
<div class="home_slider_nav home_slider_next">
  <i class ="fa fa-angle-right" aria-hidden="true " href="#myCarousel" data-slide="next"></i>
</div>
</div>

<div class="features" id="section1">
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="section_title_container text-center">
          <h2 class="section_title" data-aos="fade-up" data-aos-anchor-placement="center-center">Welcome to TEACH E-Learning</h2>
          <div class="section_subtitle" data-aos="fade-up" data-aos-anchor-placement="center-center">
            <p>By connecting students all over the world to the best instructors, TEACH is helping individuals reach their goals and pursue their dreams.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="row features_row">
      <div class="col-lg-3 featur_col">
        <div class="feature text-center" data-aos="flip-left">
          <div class="feature_icon ">
            <img src="images/icon_1.png" alt="">
          </div>
          <h3 class="feature_title ">The Experts</h3>
          <div class="feature_text ">
            <p>From Ph.D.s and Ivy Leagues to teachers, doctors and professors. All available through TEACH.</p>
          </div>
        </div>
      </div>

      <div class="col-lg-3 featur_col">
        <div class="feature text-center" data-aos="flip-left">
          <div class="feature_icon">
            <img src="images/icon_2.png" alt="">
          </div>
          <h3 class="feature_title">Books & Library</h3>
          <div class="feature_text">
            <p>Variety of different Subjects, all available to learn through TEACH.</p>
          </div>
        </div>
      </div>

      <div class="col-lg-3 featur_col">
        <div class="feature text-center" data-aos="flip-left">
          <div class="feature_icon">
            <img src="images/icon_3.png" alt="">
          </div>
          <h3 class="feature_title">Best Courses</h3>
          <div class="feature_text">
            <p>Offering some of the best courses suitable for each student.</p>
          </div>
        </div>
      </div>

      <div class="col-lg-3 featur_col">
        <div class="feature text-center" data-aos="flip-left">
          <div class="feature_icon">
            <img src="images/icon_4.png" alt="">
          </div>
          <h3 class="feature_title">Award & Reward</h3>
          <div class="feature_text">
            <p>Obtain certificates once finishing the courses.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="courses" id="section2">
  <div class="row">
    <div class="col">
      <div class="section_title_container text-center">
        <h2 class="section_title" data-aos="fade-up" data-aos-anchor-placement="center-center">Popular Online Courses</h2>
        <div class="section_subtitle" data-aos="fade-up" data-aos-anchor-placement="center-center">
        <p>Dive into a Selection of our best courses, provided by some of the best tutors available.</p>
      </div>
    </div>
    </div>
  </div>
  <div class="row courses_row">
      <?php

        $sqlm = "SELECT * FROM course LIMIT 3";
        $resultm = mysqli_query($mysqli,$sqlm);

        if (mysqli_num_rows($resultm) > 0) {
          // output data of each row
          while($row = mysqli_fetch_assoc($resultm)) {
            $coursetitle=$row["Name"];
            $courseId =$row["ID"];
            $instructor=$row["Instructor"];
            $price=$row["Price"];
            $photo=$row["image"];
            $photopath="images/$photo";
            ?>
            <div class="col-lg-4 course_col" data-aos="flip-left">
            <div class="course">
              <div class="course_image">
                <img src="<?php echo $photopath ?>" alt="">
              </div>
              <div class="course_body">
                <h3 class="course_title"><a href="courses.php"><?php echo $coursetitle ?></a></h3>
                <div class="course_teacher">
                  <?php echo  $instructor ?>
                </div>
                <div class="course_text">
                  <p>Have an understanding and be able to Program the basic concepts of <?php echo $coursetitle ?></p>
                </div>
                <div class="course_footer">
                  <div class="course_price ml-auto">
                    <?php echo  '$' . $price ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
      <?php
          }
        }


       ?>
  </div>
  <div class="row">
    <div class="col">
      <div class="courses_button">
        <a href="courses.php">View all Courses</a>
      </div>
    </div>
  </div>
</div>


<div class="counter" id="section3">
  <div class="counter_background"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div class="counter_content">
          <h2 class="counter_title" data-aos="fade-up">Can't Find A Course?</h2>
          <div class="counter_text" data-aos="fade-up">
            <p>If you can't find a course that you're looking for. TEACH got you covered, you can suggest a course to us and we will happy to include the desired course.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="counter_form" data-aos="flip-left">
      <div class="row fill_height">
        <div class="col fill_height">
          <form method="POST" action="" enctype='multipart/form-data'>
            <div class="counter_form_title">Suggest a course</div>
            <input class="counter_input" type="text" placeholder="Name" name="course" required>
            <textarea class="counter_input counter_text_input" placeholder="Link to the course" name="link"></textarea>
            <input type="file" name="cphoto" id="cphoto"  class="counter_input"/>
            <button type="submit" class="counter_form_button" name="submit">Submit Now</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="team">
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="section_title_container text-center">
          <h2 class="section_title" data-aos="fade-up">Get to know our Tutors</h2>
          <div class="section_subtitle" data-aos="fade-up">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel gravida arcu. Vestibulum feugiat, sapien ultrices fermentum congue, quam velit venenatis sem</p>
          </div>
        </div>
      </div>
    </div>

    <div class="row team_row">
        <?php

          $sqlc = "SELECT * FROM students WHERE type=5 LIMIT 4";
          $resultc = mysqli_query($mysqli,$sqlc);

          if (mysqli_num_rows($resultc) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($resultc)) {
              $instructorfn=$row["firstname"];
              $instructorln=$row["lastname"];
              $image=$row['picture'];
              $photopath="images/$image";
              ?>
              <div class="col-lg-3 col-md-6 team_col" data-aos="flip-left">
              <div class="team_item">
                <div class="team_image">
                  <img src="<?php echo $photopath ?>" alt="">
                </div>
                <div class="team_body">
                  <h3 class="team_title"><a href="course.html"><?php echo $instructorfn=$row["firstname"] ." ". $instructorln=$row["lastname"]?></a></h3>
              </div>
            </div>
                </div>
        <?php
            }
          }


         ?>
  </div>

</div>
  <button id="scrollToTopBtn"><i class="fa fa-angle-up"></i></button>

<footer class="footer">
  <div class="footer_background">
  </div>
  <div class="container">
    <div class="row footer_row">
      <div class="col">
        <div class="footer_content">
          <div class="row">
            <div class="col-lg-3 footer_col">
              <div class="footer_section footer_about">
                <div class="footer_logo_container">
                  <a href="#">
                    <div class="footer_logo_text">
                      TEA<span>CH</span>
                    </div>
                  </a>
                </div>
                <div class="footer_about_text">
                  <p>Premium Education System. <br> <i>Each One To Teach One.</i></p>
                </div>
              </div>
            </div>
            <div class="col-lg-3 footer_col">
              <div class="footer_section footer_contact">
                <div class="footer_title">CONTACT US</div>
                <div class="footer_contant_info">
                  <ul style="color: white;">
                    <li>Email: TEACH.info@gmail.com</li>
                    <li>Phone: 01211300998</li>
                    <li>Misr International University</li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-3 footer_col">
              <div class="footer_section footer_links">
                <div class="footer_title">
                  CONTACT US
                </div>
                <div class="footer_links_container">
                  <ul>
                    <li><a style="color: white;" href="#myCarousel">Home</a></li>
                    <li><a style="color: white;" href="#section2">Courses</a></li>
                    <li><a style="color: white;" href="#section1">Features</a></li>
                    <li><a style="color: white;" href="#section3">Contact</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>

<!-- <form action="mycourses.php" method="POST"  class="searchform">
<button type="submit">My Courses</button>
</form> -->

    <script>
    AOS.init();
    $("a").on('click', function(event) {

        // Make sure this.hash has a value before overriding default behavior
        if (this.hash !== "") {
          // Prevent default anchor click behavior
          event.preventDefault();

          // Store hash
          var hash = this.hash;

          // Using jQuery's animate() method to add smooth page scroll
          // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
          $('html, body').animate({
            scrollTop: $(hash).offset().top
          }, 800, function(){

            // Add hash (#) to URL when done scrolling (default click behavior)
            window.location.hash = hash;
          });
        } // End if
      });

    var scrollToTopBtn = document.getElementById("scrollToTopBtn")
var rootElement = document.documentElement

window.onscroll = function() {scrollFunction()};
function scrollFunction() {
  if (document.body.scrollTop > 20 || rootElement.scrollTop > 20) {
    scrollToTopBtn.style.display = "block";
  } else {
    scrollToTopBtn.style.display = "none";
  }
}
function scrollToTop() {
  // Scroll to top logic
  rootElement.scrollTo({
    top: 0,
    behavior: "smooth"
  })
}
scrollToTopBtn.addEventListener("click", scrollToTop)



// Helper function from: http://stackoverflow.com/a/7557433/274826
function isElementInViewport(el) {
  // special bonus for those using jQuery
  if (typeof jQuery === "function" && el instanceof jQuery) {
    el = el[0];
  }
  var rect = el.getBoundingClientRect();
  return (
    (rect.top <= 0
      && rect.bottom >= 0)
    ||
    (rect.bottom >= (window.innerHeight || document.documentElement.clientHeight) &&
      rect.top <= (window.innerHeight || document.documentElement.clientHeight))
    ||
    (rect.top >= 0 &&
      rect.bottom <= (window.innerHeight || document.documentElement.clientHeight))
  );
}


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
    </script>
  </div>
  </section>
  </body>
</html>
