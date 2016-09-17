$('document').ready(function()
{
  /* validation */
  $("#login-form").validate({
      rules:
   {
      username: {
      required: true
     },
      password: {
      required: true
     },
       messages:
      {
            username: "กรุณาใส่ชื่อผู้ใช้",
            password: "กรุณาใส่รหัสผ่าน"

       },
     },
    submitHandler: submitForm
  });
    /* validation */

    /* login submit */
    function submitForm()
    {
   var data = $("#login-form").serialize();

   $.ajax({

   type : 'POST',
   url  : 'login_process.php',
   data : data,
   beforeSend: function()
   {
    $("#error").fadeOut();
    $("#btn-login").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; กำลังเข้าสู่ระบบ ...');
   },
   success :  function(data)
      {
     if(data=="300"){

      $("#btn-login").html('<img src="btn-ajax-loader.gif" /> &nbsp; กำลังเข้าสู่ระบบ ...');
      //setTimeout(' window.location.href = "../user/index.php"; ',4000);
      setTimeout('window.location="user/index";', 4000);
     }
     else if(data=="700"){

      $("#btn-login").html('<img src="btn-ajax-loader.gif" /> &nbsp; กำลังเข้าสู่ระบบ ...');
      //setTimeout(' window.location.href = "../user/index.php"; ',4000);
      setTimeout('window.location="admin/index";', 4000);
     }
     else{

    $("#error").fadeIn(1000, function(){
    $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+data+' !</div>');
           $("#btn-login").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; เข้าสู่ระบบ');
         });
     }
     }
   });
    return false;
  }
    /* login submit */
});
