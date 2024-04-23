<?php
session_start();
// $userotp="";
// $otp="";
include('../connection.php');


if(isset($_POST['resend_otp'])) 
{
    unset($_SESSION['otp']);
    $userotp= (int)$_POST['text'];

    $otp=rand(10000, 99999);
    // $_SESSION['otp']=$otp;
      $dummey_email="t-diwash21@tbc.edu.np";
    // $subject="Email Verification";
    // $to_email=$_SESSION['otpEmail'];
    $to_email=$dummey_email;
    $message="Your Email verification code is:".$otp;
    include('mail.php');
    $_SESSION['otp']=$otp;
}
if(isset($_POST['sub'])) 
{

    $userotp= (int)$_POST['text'];
    // var_dump( $userotp);
    // var_dump($_SESSION['otp']);

      $querry ='SELECT * FROM "USER" WHERE EMAIL = :mail';
      $data_base = oci_parse($connection,$querry);
                
      oci_bind_by_name( $data_base, ':mail', $_SESSION['otpEmail']);
      oci_execute($data_base);
                            
      while($row = oci_fetch_array( $data_base, OCI_ASSOC))
      {
          $id=$row['USER_ID'];
      }
      // echo $id;
        if($userotp==$_SESSION['otp'])   
            {
              $otp_to=$_SESSION['otpEmail'];
              $to_email=$otp_to;
              $subject="LOG IN SUCCESSFULL";
              $message="You have been succesfully login";
              include('mail.php');
              header("location:login.php");
              unset($_SESSION['otpEmail']);
            } 
            else
            {
                      $sql = 'DELETE  FROM  "USER" WHERE USER_ID = :pid';
                      $stid = oci_parse($connection,$sql);

                      oci_bind_by_name($stid,':pid', $id);

                      if(oci_execute($stid)){

                        unset($_SESSION['otpEmail']);
                        echo "<script>alert('Unbale to register due to invalid otp');
                        document.location.href='http://localhost/project/chz/registerTrader.php';</script>";
                    
        
            }
        
         
}    


}  
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/otp.css">
    <title>Document</title>
</head>

<body>
  <div class="image">
  <!-- background-image:url('../dbimage/Screenshot 2023-05-05 014610.png'); -->
  <img src="dbimage/Screenshot 2023-05-05 014610.png" alt="Forest" >
</div>
  <div class="all">
    
                <div class="fom">
                  <fieldset>
                <form method="POST">
                  <label>
                   <h3> Check mail to get OTP<h3>
                  </label>
                    <div class="modal-body">

                        <input type="number" name="text" class="tex" >
                    
                        <input type="submit" class="btn" name="sub" value="Verify OTP">
                        <p>If you did'n get</p>
                        <input type="submit" class="btn" name="resend_otp" value="Resend OTP">
                        </div>
                    
                </form>
              </fieldset>
               
            </div>
    </div>   
             
            
</body>

</html>