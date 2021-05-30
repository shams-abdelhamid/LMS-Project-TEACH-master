<?php
include "databasehandler.php";
include "navbar.php"
?>
<?php
?>
<!DOCTYPE html>
<html>
  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel="stylesheet" href="static/stylec.css">
    <title>Cart</title>
  </head>
  <body>
    </div>
    <div class="container" style="margin-top: 30px;">
      <form method="post" action="">
        <table class="table table-borderless">
          <thead>
            <tr class="p-2 px-3 text-uppercase">
               <th>Id</th>
                <th >Product</th>
                <th>Price</th>
            </tr>
          </thead>
    <?php
      $i=1;
      $sum=0;
      if(!empty($_SESSION['firstname'])){
        $sql = "SELECT * FROM cart WHERE student_id='".$_SESSION["id"]."'";
        $result = mysqli_query($mysqli,$sql);


        while($row = mysqli_fetch_array($result)) {
          $courseid = $row[2];
          $courses = "SELECT Name,Instructor,image FROM course WHERE ID = '". $courseid ."'";
          $resultcourses = mysqli_query($mysqli,$courses);
          while($row1 = mysqli_fetch_array($resultcourses)){
            $photopath="images/$row1[2]";
            $sum+=$row[3];
            ?>
            <tr>
               <td class="align-middle"><?php echo $i; ?></td>
                 <th scope="row" class="border-0">
                      <div class="p-2">
                        <img src="<?php echo $photopath ?>"  alt="" width="150" class="img-fluid rounded shadow-sm">
                        <div class="ml-3 d-inline-block align-middle">
                          <h5 class="mb-0"> <?php echo $row1[0]; ?> </h5><span class="text-muted font-weight-normal font-italic d-block"><i> <?php echo $row1[1]; ?></i></span>
                        </div>
                      </div>
                    </th>
                 <td class="align-middle"> <?php echo $row[3]; ?>$</td>
                 <td class="align-middle"><a id ="delete" data-id="<?php echo $i; ?>" data-index="<?php echo $courseid; ?>" href="#" class="text-dark"><i class="fa fa-trash"></i></a></td>
                </tr>
          <?php
          }
      $i++;
      }
      }

    ?>
      </table>
      </form>
      <hr>
      <div id="total" ><h1>Total:  <?php echo $sum; ?>$</h1><button type="button" name="button" onclick="checkout()">CHECKOUT</button></div>
      <div id="overlay" style="display:none;">
      <div class="alert" id="alert" style="display:none;">
      <div class="alert success">
        <span id="closebtn"> Go to My Courses</span>
        <strong>Success!</strong> Thank you for purchasing.
        </div>
      </div>
    </div>
    </div>
		<script type="text/javascript">
		var x = document.getElementsByClassName("text-dark");
    var numComments = x.length;
    for (var i = 0; i < numComments; i++) {
		x[i].addEventListener("click", function() {
			var a = $(this).attr("data-index");
			var tr = $(this).closest('tr')
			jQuery.ajax({
							type: "POST",
							url: "RemoveFromCart.php",
							data: 'course_id='+ $(this).attr("data-index"),
							success:function(data) {
								tr.fadeOut(1000, function(){
                        $(this).remove();
                    });
                    setTimeout(function() {
                        location.reload();
                    },1000);

							}
			});
		});
	}

  function checkout() {
    var y = document.getElementById("wlcm");
    if (!(y.innerHTML.length)==0){
    document.getElementById("overlay").style.display = "block";
    document.getElementById("alert").style.display = "block";
    var close = document.getElementById("closebtn");

    jQuery.ajax({
            type: "POST",
            url: "AddToMyCourses.php",
    });

      close.onclick = function(){
        var div = this.parentElement;
        div.style.opacity = "0";
        // setTimeout(function(){ div.style.display = "none"; }, 600);
        window.location.href="mycourses.php";
      }
    }
    else{
      window.location.replace("signin.php");
    }
  }


		</script>
  </body>
</html>
