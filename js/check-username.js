$(document).ready(function()
{
 $("#username").keyup(function()
 {
  var name = $(this).val();

  if(name.length > 2)
  {
   $("#result").html('กำลังเช็คชื่อผู้ใช้...');

   /*$.post("username-check.php", $("#reg-form").serialize())
    .done(function(data){
    $("#result").html(data);
   });*/

   $.ajax({

    type : 'POST',
    url  : 'username-check.php',
    data : $(this).serialize(),
    success : function(data)
        {
              $("#check-username").html(data);
        }
    });
    return false;

  }
  else
  {
   $("#check-username").html('');
  }
 });

});
