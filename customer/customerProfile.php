<?php
session_start();

if (isset($_POST['sub3'])) {

    include("../connection.php");

    $pass = trim($_POST['pass1']);
    $cpass = trim($_POST['pass2']);
    // $phone_number=trim($_POST['phone_number']);

    if ($pass == $cpass) {
        $sql = 'UPDATE "USER" SET 	PASSWORD= :pass WHERE USER_ID= :id ';
        $stid = oci_parse($connection, $sql);
        oci_bind_by_name($stid, ':id', $id);
        oci_bind_by_name($stid, ':pass', $password);
        oci_execute($stid);
    }
}

if (isset($_POST['sub2'])) {
    // $delid = $_GET['id'];
    $id = $_SESSION['ID'];
    $sql = 'DELETE  FROM  "USER" WHERE USER_ID= :pid';
    $stid = oci_parse($connection, $sql);
    oci_bind_by_name($stid, ':pid', $id);
    oci_execute($stid);
}

if (isset($_POST['sub1'])) {

    include("../connection.php");
    $id = $_SESSION['ID'];
    $first_name = trim($_POST['first_name']);
    $middle_name = trim($_POST['middle_name']);
    $last_name = trim($_POST['last_name']);
    $add = trim($_POST['address']);
    $gender = trim($_POST['gender']);
    $email = trim($_POST['email']);
    $phone_number = trim($_POST['phone_number']);

    $sql = 'UPDATE "USER" SET 	FIRST_NAME= :f_name, MIDDLE_NAME = :m_name, LAST_NAME= :l_name, EMAIL= :mail,PHONE_NO=:num ,ADDRESS=:adds,GENDER=:gender WHERE USER_ID= :id ';

    $stid = oci_parse($connection, $sql);
    oci_bind_by_name($stid, ':id', $id);
    oci_bind_by_name($stid, ':f_name', $first_name);
    oci_bind_by_name($stid, ':m_name', $middle_name);
    oci_bind_by_name($stid, ':l_name', $last_name);
    oci_bind_by_name($stid, ':adds', $add);
    oci_bind_by_name($stid, ':gender', $gender);
    oci_bind_by_name($stid, ':mail', $email);
    oci_bind_by_name($stid, ':num', $phone_number);
    // oci_bind_by_name($stid ,':allergy_info',$allegery_info);

    oci_execute($stid);
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Customer Profile</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="custom_profi.css">
    <script src="https://kit.fontawesome.com/4d1256e00f.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include("../connection.php");

    $id = $_SESSION['ID'];
    $sql = 'SELECT * FROM "USER" WHERE USER_ID = :id';

    $database_connect = oci_parse($connection, $sql);
    oci_bind_by_name($database_connect, ':id', $id);
    oci_execute($database_connect);
    $row = oci_fetch_array($database_connect, OCI_ASSOC);

    ?>
    <form method='POST'>
        <section class='py-5 my-5'>
            <div class='container'>
                <h1 class="mb-5">Profile Settings</h1>
                <div class='bg-white shadow rounded-lg d-block d-sm-flex'>
                    <div class="profile-tab-nav border-right">
                        <div class="p-4">
                            <!-- <div class="img-circle text-center mb-3">
                                <img src="./img/user5.jpg" alt="Image" class="shadow">
                            </div> -->
                            <h4 class="text-center"><?php echo $_SESSION['username'] ?></h4>
                        </div>
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="account-tab" data-toggle="pill" href="#account" role="tab" aria-controls="account" aria-selected="true">
                                <i class="fa fa-home text-center mr-1"></i>
                                Account
                            </a>



                            <a class="nav-link" id="password-tab" data-toggle="pill" href="#password" role="tab" aria-controls="password" aria-selected="false">
                                <i class="fa fa-key text-center mr-1"></i>
                                Password
                            </a>


                            <!-- <a class="nav-link" id="security-tab" data-toggle="pill" href="#security" role="tab"
                                aria-controls="security" aria-selected="false">
                                <i class="fa fa-user text-center mr-1"></i>
                                Security
                            </a> -->
                            <a class="nav-link" id="wishlist-tab" data-toggle="pill" href="#wishlist" role="tab" aria-controls="application" aria-selected="false">
                                <i class="fa-sharp fa-regular fa-heart"></i>
                                Wishlist
                            </a>
                            <a class="nav-link" id="notification-tab" data-toggle="pill" href="#notification" role="tab" aria-controls="notification" aria-selected="false">
                                <i class="fa-duotone fa-clock-rotate-left"></i>
                                History
                            </a>
                            <a class="nav-link" id="mycart-tab" data-toggle="pill" href="#mycart" role="tab" aria-controls="notification" aria-selected="false">
                                <i class="fa-solid fa-cart-shopping"></i>
                                MyCart
                            </a>
                        </div>
                    </div>
                    <div class="tab-content p-4 p-md-5" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
                            <h3 class="mb-4">Profile Settings</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input type="text" name="first_name" class="form-control" value="<?php echo $row['FIRST_NAME']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>MIDDLE Name</label>
                                        <input type="text" name="middle_name" class="form-control" value="<?php
                                                                                                            if (empty($row['MIDDLE_NAME'])) {
                                                                                                                echo " ";
                                                                                                            } else {

                                                                                                                echo $row['MIDDLE_NAME'];
                                                                                                            } ?>">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>LAST Name</label>
                                        <input type="text" name="last_name" class="form-control" value="<?php echo $row['LAST_NAME']; ?>">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" name="email" class="form-control" value="<?php echo $row['EMAIL']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone number</label>
                                        <input type="text" name="phone_number" class="form-control" value="<?php echo $row['PHONE_NO']; ?>">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>GENDER</label>
                                        <input type="text" class="form-control" name="gender" value="<?php echo $row['GENDER']; ?>">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" class="form-control" name="address" value="<?php echo $row['ADDRESS']; ?>">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                </div>
                            </div>
                            <div>
                                <input type='submit' name='sub1' value='update'>
                                <input type='submit' name='sub2' value='Delete your account'>

                            </div>
                        </div>
                        <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                            <h3 class="mb-4">Password Settings</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Old password</label>
                                        <input type="password" class="form-control" value="<?php echo $row['PASSWORD']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>New password</label>
                                        <input type="password" class="form-control" name="pass1" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Confirm new password</label>
                                        <input type="password" class="form-control" name="pass2" value="">
                                    </div>
                                </div>
                            </div>
                            <div>

                                <input type='submit' name='sub3' vlaue='update'>

                                <!-- <button class="btn btn-primary">Update</button>
                                <button class="btn btn-light">Cancel</button> -->
                            </div>
                        </div>
                        <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
                            <h3 class="mb-4">Security Settings</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Login</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!-- <div class="form-group">
                                        <label>Two-factor auth</label>
                                        <input type="text" class="form-control">
                                    </div> -->
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="recovery">
                                            <label class="form-check-label" for="recovery">
                                                Recovery
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <!-- <button class="btn btn-primary">Update</button>
                                <button class="btn btn-light">Cancel</button> -->
                            </div>
                        </div>
                        <div class="tab-pane fade" id="application" role="tabpanel" aria-labelledby="application-tab">
                            <h3 class="mb-4">Wishlist</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="app-check">
                                            <label class="form-check-label" for="app-check">
                                                Update Products
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
                                            <label class="form-check-label" for="defaultCheck2">
                                                Checkout
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <!-- <button class="btn btn-primary">Update</button>
                                <button class="btn btn-light">Cancel</button> -->
                            </div>
                        </div>
                        <div class="tab-pane fade" id="notification" role="tabpanel" aria-labelledby="notification-tab">
                            <h3 class="mb-4">History Settings</h3>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="notification1">
                                    <label class="form-check-label" for="notification1">
                                        History
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="notification2">
                                    <label class="form-check-label" for="notification2">
                                        History
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="notification3">
                                    <label class="form-check-label" for="notification3">
                                        History
                                    </label>
                                </div>
                            </div>
                            <div>
                                <!-- <button class="btn btn-primary">Update</button>
                                <button class="btn btn-light">Cancel</button> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>



    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>