<?php
session_start();
include("../connection.php");
$count=0;
if(isset($_POST['sub'])) 
{

    $otp=(int)($_POST['pass']);

    $pass=trim($_POST['pass']);
    $cpass=trim($_POST['cpass']);

    // if($otp==$_SESSION['pasotp'])
    if(empty($pas))
    {
        // $count+=1;
        // echo "<script>alert('please enter password');
        //                 document.location.href='resetpasswordconform.php';</script>";
    }
    if(empty($cpas))
    {
        // $count+=1;
        // echo "<script>alert('please enter password');
        //                 document.location.href='resetpasswordconform.php';</script>";
    }

    if($pass!=$cpass)
    {
        $count+=1;
        echo "<script>alert('please entee the same password');
                         document.location.href='resetpasswordconform.php';</script>";
    }


    if($pass==$cpass)
    {

        $uppercase = preg_match('@[A-Z]@', $pass);
        $lowercase = preg_match('@[a-z]@', $pass);
        $number    = preg_match('@[0-9]@', $pass);
        $specialChars = preg_match('@[^\w]@', $pass);
        
        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($pass) < 8) {
            $password_error= 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
            $count=$count+1;
        }
        else

        {
            if($count==0 && $otp==(int)$_SESSION['pasotp'])
            {
                $sql = 'UPDATE "USER" SET	PASSWORD=:passwo WHERE EMAIL= :upid ';

                $stid = oci_parse($connection, $sql);
                oci_bind_by_name($stid, ':passwo', $uid);
                oci_bind_by_name($stid ,':upid', $_SESSION['em']);
                $result = oci_execute($stid);
                if($result)
                {
                    unset($_SESSION['em']);
                    unset($_SESSION['pasotp']);
                    echo "<script>alert('pasword is change');
                    document.location.href='../login.php';</script>";
                }
            }
            else
            {
                echo "<script>alert('OTP not valid');
                         document.location.href='resetpasswordconform.php';</script>";
            }
            

        }
        
    }
    
}

?>






<!DOCTYPE html>
<html lang="en">
<style type="text/css">
    .all {
        margin-top: 200px;
        display: flex;
        justify-content: end;
        width: 50%;
    }
    .author {
        color: gray;
    }
    </style>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="resetpas.css">
    <title>Document</title>
</head>
<body>
<div class="all">
<form method="POST">
            <div class="mb-3 ">
            <label for="Password" class="form-label">OTP</label>
            <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="otp">
            <div id="emailHelp" class="form-text">We'll never share your password with anyone else.</div>
            </div>

        <div class="mb-3 ">
            <label for="Password" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="pass">
            <div id="emailHelp" class="form-text">We'll never share your password with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for=" confrom password" class="form-label">Conform Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="cpass">
        </div>
        <div class="mb-3 form-check">
            <!-- <input type="checkbox" class="form-check-input" id="exampleCheck1"> -->
            <!-- <label class="form-check-label" for="exampleCheck1">Check me out</label> -->
        </div>
        <input type="submit"  class="btn btn-primary" name="sub" value="Change">
        </form>
</div>
</body>
</html>