$('document').ready(function()
{
     /* validation */
  $("#register-form").validate({
      rules:
   {
   username: {
      required: true,
      minlength: 3
   },
   fullname: {
      required: true,
   },
   password: {
     required: true,
     minlength: 8,
     maxlength: 16
   },
   cpassword: {
     required: true,
     equalTo: '#password'
   },
   user_email: {
            required: true,
            email: true
            },
    },
       messages:
    {
            username: "กรุณาใส่ชื่อผู้ใช้",
            fullname: "กรุณาใส่ชื่อเต็ม",
            password:{
                      required: "กรุณาใส่รหัสผ่าน",
                      minlength: "กรุณาใส่รหัสผ่านขั้นต่ำ 8 ตัว"
                     },
   cpassword:{
      required: "กรุณากรอกรหัสผ่านซ้ำ",
      equalTo: "รหัสผ่านไม่ตรงกัน"
       }
       },
    submitHandler: submitForm
       });
    /* validation */

    /* form submit */
    function submitForm()
    {
    var data = $("#register-form").serialize();

    $.ajax({

    type : 'POST',
    url  : 'register_process.php',
    data : data,
    beforeSend: function()
    {
     $("#error").fadeOut();
     $("#btn-submit").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; กำลังสมัครสมาชิก ...');
    },
    success :  function(data)
         {
        if(data==1){

         $("#error").fadeIn(1000, function(){

           $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; ชื่อผู้ใช้มีอยู่แล้ว</div>');
           $("#btn-submit").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; สมัครสมาชิก');

         });

        }
        else if(data=="registered")
        {

         $("#btn-submit").html('<img src="btn-ajax-loader.gif" /> &nbsp; กำลังสมัครสมาชิก ...');
        // setTimeout('$(".form-signin").fadeOut(500, function(){ $(".signin-form").load("index.php"); }); ',500);
        alert('สำเร็จ');
        setTimeout('window.location="index.php";', 2000);

        }
        else{

         $("#error").fadeIn(1000, function(){

      $("#error").html('<div class="alert alert-danger"><span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+data+' !</div>');

         $("#btn-submit").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; สมาชิกสมาชิก');

         });

        }
         }
    });
    return false;
  }

});
