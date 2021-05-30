
$( document ).ready(function() {
  $('#cphoto').change(function(e){
  var tmppath = URL.createObjectURL(event.target.files[0]);
  console.log(tmppath);
  $('#cp').attr("src", tmppath);


});
});
