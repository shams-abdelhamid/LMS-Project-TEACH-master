<?php
include('database_connection.php');
include "adminnav.php";
$fn = $_SESSION["firstname"];
if ($_SESSION['type']==3) {
  echo "ana auditor";
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
   <link rel="stylesheet" href="chat.css">
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
      <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800&display=swap" rel="stylesheet">
      <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/handlebars@latest/dist/handlebars.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/list.js/1.1.1/list.min.js"></script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css" rel="stylesheet" />

      <style media="screen">
      input{
        font-family: 'FontAwesome';
        background-color: #444752;
        border: none;
        color: white;
        padding: 13px;
      }
      input:hover{
        cursor: pointer;
      }
      </style>
    </head>
  <body>
    <div class="container clearfix">
      <div class="people-list" id="people-list">
        <div class="search" style="text-align: center;">
          <input type="text" class="inp" placeholder="search...">
          <i class="fa fa-search"></i>
          <div class="filter">
            <form action="" method="POST" class="searchform">
              <input type="submit" data-toggle="tooltip" title="Show Students" name="student" value="&#61447;"/>
              <input type="submit" data-toggle="tooltip" title="Show Admins" name="admin" value="&#xf013;"/>
              <input type="submit" data-toggle="tooltip" title="Show Instructors" name="group" value="&#xf086;"/>
              <input type="submit" data-toggle="tooltip" title="Show All" name="all" value="&#xf0c0;"/>
          </form>

          </div>
        </div>
        <ul class="list">
        <?php
        if(isset($_POST['student'])){
          $test=0;
          $query="SELECT * FROM students WHERE type=1 AND id !=".$_SESSION["id"];
        }
        else if (isset($_POST['admin'])){
          $query="SELECT * FROM students WHERE type !=1 AND type !=5 AND id !=".$_SESSION["id"];
        }
        else if (isset($_POST['group'])){
          $query="SELECT * FROM students WHERE type=5 AND id !=".$_SESSION["id"];
        }
        else{
          $query="SELECT * FROM students WHERE id !=".$_SESSION["id"];
        }

          $statement = $connect->prepare($query);
          $statement->execute();
          $result = $statement->fetchAll();
          foreach($result as $row) {
            $studentid= $row["id"];
            $studentfn= $row["firstname"];
            $studentln= $row["lastname"];
            $studentemail= $row["email"];
            $photo=$row["picture"];
            $photopath="images/$photo";
            ?>
            <div class="listcontainer" id="user_details" data-type="<?php echo $_SESSION['type']; ?>" data-tousername="<?php echo $studentfn . " " . $studentln ?>" data-touserid="<?php echo $studentid ?>" data-id="<?php echo $_GET['id_update']; ?>" data-name="<?php echo $_GET['update_name'] ?>" >
              <div id="user_model_details"></div>
              <li class="clearfix">
                <img src="<?php echo $photopath ?>" alt="avatar" />
                <div class="about">
                  <div class="name"><?php echo $_GET['update_name'] .','. $studentfn . " ". $studentln  .' '.count_unseen_message($row["id"], $_SESSION['id'], $connect) ?></div>
                  <div class="status">
                    <i class="fa fa-circle online"></i> online
                  </div>
                </div>
              </li>
          </div>
            <?php
          }
         ?>
         </ul>
      </div>

  </div>

    </div> <!-- end container -->
    <script type="text/javascript" src="chat.js"></script>

    <script type="text/javascript">
    $(document).ready(function(){
      setInterval(function(){
       update_chat_history_data();
       update_group_chat_history_data();
     }, 1000);
     function make_group_chat(group_chat_id, to_user_name)
     {
       var modal_content = '<div id="group_chat_dialog_'+group_chat_id+'" class="group_chat_dialog" title="Chat with '+to_user_name+'">';
       modal_content += '<div style="height:300px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:0x; padding:16px;" class="group_chat_history" data-groupchatid="'+group_chat_id+'" id="group_chat_history_'+group_chat_id+'">';
       modal_content += '</div>';
       modal_content += '<div class="form-group">';
       modal_content += '<textarea style="width: 100%; height: 125px;" name="group_chat_message_'+group_chat_id+'" id="group_chat_message_'+group_chat_id+'" class="form-control"></textarea>';
       modal_content += '</div><div class="form-group" align="right">';
       modal_content+= '<button type="button" name="send_group_chat" id="'+group_chat_id+'" class="btn btn-info send_group_chat">Send</button></div></div>';
       $('#group_model_details').html(modal_content);
     }
      function make_chat_dialog_box(to_user_id, to_user_name,name_update)
      {
        var ck=document.getElementById('user_details');
        console.log(ck.dataset.type);
        var modal_content = '<div id="user_dialog_'+to_user_id+'" class="user_dialog" title="Chat with '+name_update+', '+to_user_name+'">';
        modal_content += '<div style="height:300px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-touserid="'+to_user_id+'" id="chat_history_'+to_user_id+'">';
        modal_content += '</div>';
        modal_content += '<div class="form-group">';
        if (ck.dataset.type!=2) {
          modal_content += '<textarea style="width: 100%; height: 125px;" name="chat_message_'+to_user_id+'" id="chat_message_'+to_user_id+'" class="form-control"></textarea>';
          modal_content += '</div><div class="form-group" align="right">';
          modal_content+= '<button type="button" name="send_chat" id="'+to_user_id+'" class="btn btn-info send_chat">Send</button></div></div>';
        }
        $('#user_model_details').html(modal_content);
        test= $('#chat_history_'+to_user_id);
      }
      var x1 = document.getElementsByClassName("grouplistcontainer");
      var num1Comments = x1.length;
      for (var it = 0; it < num1Comments; it++) {
        x1[it].addEventListener("click", function() {
          $('.group_chat_dialog').dialog('open').remove();
            // y.innerHTML= this.dataset.name;
            var group_chat_id = $(this).data('groupchatid');
            var to_user_name = $(this).data('tousername');
            make_group_chat(group_chat_id, to_user_name);
            $("#group_chat_dialog_"+group_chat_id).dialog({
              autoOpen:false,
              draggable: false,
              width:400,
              position: {my: "center+160", at: "center", of: window},
            });
            $('#group_chat_dialog_'+group_chat_id).dialog('open');
        });
      }
        var x = document.getElementsByClassName("listcontainer");
        var y = document.getElementById("chat-with1");
        var numComments = x.length;
        for (var i = 0; i < numComments; i++) {
          x[i].addEventListener("click", function() {
            $('.user_dialog').dialog('open').remove();
              // y.innerHTML= this.dataset.name;
              var to_user_id = $(this).data('touserid');
              var name_update = $(this).data('name');
              console.log(name_update);
              var to_user_name = $(this).data('tousername');
              make_chat_dialog_box(to_user_id, to_user_name,name_update);
              $("#user_dialog_"+to_user_id).dialog({
                autoOpen:false,
                draggable: false,
                width:400,
                position: {my: "center+160", at: "center", of: window},
                  });
              $('#user_dialog_'+to_user_id).dialog('open');
          });
        }
        $(document).on('click', '.send_group_chat', function(){
          var group_chat_id = $(this).attr('id');
          var chat_message = $('#group_chat_message_'+group_chat_id).val();
          console.log(chat_message);
          var action = 'insert_data';
          if(chat_message != '')
          {
            $.ajax({
              url:"group_chat.php",
              method:"POST",
              data:{chat_message:chat_message, action:action,group_chat_id:group_chat_id},
              success:function(data){
                $('#group_chat_message_'+group_chat_id).val('');
                $('#group_chat_history_'+group_chat_id).html(data);
              }
            })
          }
        });
        $(document).on('click', '.send_chat', function(){
         var to_user_id = $(this).attr('id');
         var chat_message = $('#chat_message_'+to_user_id).val();
         var cld= document.getElementById('user_details');
         $.ajax({
          url:"insert_chat.php",
          method:"POST",
          data:{to_user_id:to_user_id, chat_message:chat_message,from:cld.dataset.id},
          success:function(data)
          {
           $('#chat_message_'+to_user_id).val('');
           $('#chat_history_'+to_user_id).html(data);
          }
         })
        });
        function fetch_group_chat_history(group_chat_id)
        {
          var group_chat_dialog_active = $('#is_active_group_chat_window').val();
          var action = "fetch_data";

            $.ajax({
              url:"group_chat.php",
              method:"POST",
              data:{group_chat_id:group_chat_id,action:action},
              success:function(data)
              {
                $('#group_chat_history_'+group_chat_id).html(data);
              }
            })

        }

        function update_group_chat_history_data()
        {
         $('.group_chat_history').each(function(){
          var group_chat_id = $(this).data('groupchatid');
          fetch_group_chat_history(group_chat_id);
         });
        }
        function fetch_user_chat_history(to_user_id)
        {
          var cld= document.getElementById('user_details');
         $.ajax({
          url:"fetch_user_chat_history.php",
          method:"POST",
          data:{to_user_id:to_user_id,from:cld.dataset.id},
          success:function(data){
           $('#chat_history_'+to_user_id).html(data);
          }
         })
        }

        function update_chat_history_data()
        {
         $('.chat_history').each(function(){
          var to_user_id = $(this).data('touserid');
          fetch_user_chat_history(to_user_id);
         });
        }
        });
    </script>

  </body>
</html>
