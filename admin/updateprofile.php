

<?php
session_start();

 include('../connection.php');

    $user_role = null;
    $first_name = null;
    $middle_name = null;
    $last_name = null;
    $address = null;
    $email = null;
    $phone_number = null;
    $gender = null;
    $age = null;
    $status = null;
    $password = null;

    $user_role_error=" ";
    $first_name_error = " ";
    $middle_name_error = " ";
    $last_name_error = " ";
    $address_error = " ";
    $email_error = " ";
    $phone_number_error = null;
    $gender_error=null;
    $age_error = null;
    $status_error = null;
    $password_error = null;

    $cname="";

    $error=0;
//   Update Product code
  if(isset($_POST['sub']))
  {

            
            $first_name=trim($_POST['first_name']);
            $middle_name=trim($_POST['middle_name']);
            $last_name= trim($_POST['last_name']);
            $address= trim($_POST['address']);
            $email=trim($_POST['email']);
            $phone_number=trim($_POST['phone_number']);
            // $gender=trim($_POST['gender']);
            $age=trim($_POST['age']);
            $password=trim($_POST['password']);

        if(!preg_match ("/^[a-zA-z]*$/", $first_name)&& (!preg_match('/^[0-9]{10}+$/', $first_name)))
            {
                $first_name_error="First Name shouldn't contain special character & numeric values";
            }
            else
            {
                $Cname=$first_name;
            }

            if(empty($middle_name))
            {
                $cmiddle_name="";
            }
            elseif(!preg_match ("/^[a-zA-z ]*$/", $middle_name)&& (!preg_match('/^[0-9]{10}+$/', $middle_name)))
            {
                $middle_name_error="Middle Name shouldn't contain special character & numeric values";
            }
            
            else
            {
                $Cmiddle=$middle_name;
            }

            if(!preg_match ("/^[a-zA-z ]*$/", $last_name)&& (!preg_match('/^[0-9]{10}+$/', $last_name)))
            {
                $last_name_error="Last Name shouldn't contain special character & numeric values";
            }
            else
            {
                $Clast=$last_name;
            }

            if(!preg_match("/^[a-zA-Z0-9\s,']*$/", $address)) {
                $address_error = "Please enter a valid address";
            } else {
                $Cadd = $address;
            }

            
            if(!preg_match ("/^[a-zA-z ]*$/", $gender)&& (!preg_match('/^[0-9]{10}+$/', $gender)))
            {
                $last_name_error="enter value shouldn't contain special character & numeric values";
            }
            else
            {
                $Cgender=$gender;
            }


            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $email_error = "Please enter a valid email address";
            } else {
                $Cemail = $email;
            }


            if(strlen($phone_number))
            {
                $phone_number_error = "Please enter a valid phone number (10 digits)";
            }

            elseif(!preg_match("/^[0-9]{10}$/", $phone_number)){
                    $phone_number_error = "Please enter a valid phone number (10 digits)";
                }                
            else
            {
                $CPhone = $phone_number;
            }


            if (!is_numeric($age) || $age < 0) {
                $age_error = "Age should be a positive numeric value.";
            } 
            elseif($age>18 && $age <70)
            {
                $age_error = "Age should be greater than  18.";
            }
            
            {
                $Cage = $age;
            }

                
            }

            if(!empty($password))
            {
                    $uppercase = preg_match('@[A-Z]@', $password);
                    $lowercase = preg_match('@[a-z]@', $password);
                    $number    = preg_match('@[0-9]@', $password);
                    $specialChars = preg_match('@[^\w]@', $password);
                    
                    if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
                        $password_error= 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
                    }
                    else{
                        $Cpass=$password;
                    }

    }    

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="admindashboard.css"></link>
    <link rel="stylesheet" href="../css/upd_p.css"></link>
    <title>Document</title>
</head>

<body>
    
<?php
//   $_SESSION['id']=$_GET['id'];
  $id=$_SESSION['ID']; 
  $sql = 'SELECT * FROM "USER" WHERE USER_ID = :id';

  $database_connect = oci_parse($connection,$sql);
  oci_bind_by_name($database_connect, ':id', $id);
  oci_execute($database_connect);
  $row = oci_fetch_array($database_connect, OCI_ASSOC);

?>

    <div class="all">

        <form method="POST" action="" enctype=" ">
            <label>First Name</label>
            <input type="text" name ="first_name" value="<?php echo $row['FIRST_NAME'];?>">
            <p class="error password-error">
            <?php echo $first_name_error?>
            </p>

            <label>Middle Name</label>
            <input type="text" name ="middle_name"    value="<?php 
            if(empty($row['MIDDLE_NAME']))
            {
                echo "";
            }
            else
            {
                echo $row['FIRST_NAME'];
            };?>">
            <p class="error password-error">
            <?php echo $middle_name_error;?>
            </p>

            <label>Last Name</label>
            <input type="text" name="last_name" value="<?php echo $row['LAST_NAME'];?>"> 
            <p class="error password-error">
            <?php echo $last_name_error;?>
            </p>

            <label>Address</label>
            <input type="text" name ="address"    value="<?php echo $row['ADDRESS'];?>">
            <p class="error password-error">
            <?php echo $address_error;?>
            </p>

            <label>Email</label>
            <input type="text" name ="email" value="<?php echo $row['EMAIL'];?>">
            <p class="error password-error">
            <?php echo $email_error;?>
            </p>

            <label>Phone Number</label>
            <input type="text" name ="phone_number"   value="<?php echo $row['PHONE_NO'];?>">
            <p class="error password-error">
            <?php echo $phone_number;?>
            </p>

            <label>Age</label>
            <input type="number" name ="age" value="<?php echo $row['AGE'];?>">
            <p class="error password-error">
            <?php echo $age_error;?>
            </p>

            <label>Password</label>
            <input type="text" name ="password" value="<?php echo $row['PASSWORD'];?>">
            <p class="error password-error">
            <?php echo $password_error;?>
            </p>

            <input type="submit" name="sub" value="UPDATE" class="sub">
            <form>

    </div>

    <script type="text/javascript" src="ajaxWork.js"></script>    
    <script type="text/javascript" src="script.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>

</html>