<?php 

	if (isset($_POST["Token"])) {
		
		   $_uv_Token=$_POST["Token"];

		   $conn = mysqli_connect("mysql.hostinger.in.th","u230592753_root","16.11.410","u230592753_xamxo") or die("Error connecting");

		   $q="INSERT INTO users (Token) VALUES ( '$_uv_Token') "
              ." ON DUPLICATE KEY UPDATE Token = '$_uv_Token';";
              
      mysqli_query($conn,$q) or die(mysqli_error($conn));

      mysqli_close($conn);

	}


 ?>
