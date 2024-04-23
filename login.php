<?php
session_start();
include('connection.php');

if(isset($_GET['']))
{
    
}

if(isset($_POST['sub']))
        {
            $username = trim($_POST['name']);
            // echo $username;
        
            // echo $role;
        // $pw = md5($_POST['txtPassword']);
            // echo $pw;
            $pw = md5($_POST['pass']);

            $sql = 'SELECT * FROM "USER" WHERE EMAIL = :username AND PASSWORD = :pw';

            $database_connect = oci_parse($connection,$sql);

            oci_bind_by_name($database_connect, ':username', $username);
            oci_bind_by_name($database_connect, ':pw', $pw);
        
            oci_execute($database_connect);
            $row = oci_fetch_array($database_connect, OCI_ASSOC);

            if($row)
            {
                echo "you are lognin";
    

            $_SESSION['email']=$row['EMAIL'];
            $_SESSION['username']=$row['FIRST_NAME'].$space="  ".$row['LAST_NAME'];
            $_SESSION['ID'] = $row['USER_ID'];
            $_SESSION['trader_cat']=$row['TRADER_CATEGORY'];
            $_SESSION['address']=$row['ADDRESS'];
            // echo $_SESSION['username']
            
            if (strtoupper($row['USER_ROLE']) ==  'CUSTOMER')
            {
                // unset ($_SESSION['role']);
                $_SESSION['role'] =$row['USER_ROLE'];
                header("location:home1.php");
            }

            if (strtoupper($row['USER_ROLE']) == 'TRADER')
            {
                // unset ($_SESSION['role']);
                $_SESSION['role'] =$row['USER_ROLE'];
                header('location:home1.php');
            }

            if (strtoupper($row['USER_ROLE'])== 'ADMIN'){
                // unset ($_SESSION['role']);
                $_SESSION['role'] =$row['USER_ROLE'];
                header( 'location:home1.php');}

            }
            else
            {
                
                $error[] = 'incorrect email or password!';
            }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="./login.css">
</head>

<body class="login">
    <div class="image">
        <img src="./dbimage/Logo2.png" alt="logo" width="385" height="185">
    </div>
    <form action="" class="form" action="" method="POST">

        <h2>Sign In</h2>

        <?php
        if(isset($error)){
            foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
             }
        }
      ?>

        <div>
            <label>Email</label>
            <input type="text" name="name" placeholder="Email">
        </div>
        <div>
            <label>password</label>
            <input type="text" name="pass" placeholder="password">
        </div>
        <div class="checkbox">
            <input type="checkbox" name="box"><label>Remember Me </label>
        </div>
        <div class="submit1">
            <input type="submit" name="sub" value="Log In" class="sub">
        </div>
        <div class="d">
            <a href="" class="number">Register</a>
            <a href="" class="forgot"> Forgot Password</a>
            <hr>
        </div>
        <!-- <div class="submit1">
            <input type="submit" name="sub" value="Create a account" class="sub">
        </div> -->
    </form>

</body>

</html>