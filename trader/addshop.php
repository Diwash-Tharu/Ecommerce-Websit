<?php
session_start();
include('../connection.php');

$name = null;
$adds = null;
$shop_ty = null;
$shop_des = null;

$stock = null;
$allegery_info = null;
$image = null;
$image_err = " ";
$Product_name_error = " ";
$product_des_error = " ";
$Price_error = " ";
$quantity_error = " ";
$stock_error = null;
$allegery_info_error = null;
$product_price_error = null;

if (isset($_POST['sub'])) {
    $id = $_SESSION['ID'];
    $conf = "approve";
    $sql = 'SELECT * FROM "USER" WHERE 	USER_ID= :id';
    $datbase = oci_parse($connection, $sql);
    oci_bind_by_name($datbase, ':id', $id);
    // if(@(oci_execute($datbase))==TRUE)
    oci_execute($datbase);
    $row = oci_fetch_array($datbase, OCI_ASSOC);
    // $status=$row['STATUS'];
    // echo $status;
    if ($conf == $row['STATUS']) {
        $name = ucfirst(trim($_POST['name']));
        $adds = ucfirst(trim($_POST['address']));
        $shop_ty = ucfirst(trim($_POST['shop_type']));
        $shop_des = ucfirst(trim($_POST['shop_des']));
        $trader_id = ucfirst($_SESSION['ID']);


        $sql = 'SELECT * FROM "USER" WHERE USER_ID= :id';
        $datbases = oci_parse($connection, $sql);
        oci_bind_by_name($datbases, ':id', $id);
        oci_execute($datbases);
        while ($row = oci_fetch_array($datbases, OCI_ASSOC)) {
            $t_c = $row['TRADER_CATEGORY'];
        }
        $cat_type = ucfirst($t_c);

        if (!preg_match("/^[a-zA-z ]*$/", $name) && (!preg_match('/^[0-9]{10}+$/', $name))) {
            $Product_name_error = "Product name shouldn't contain special character";
        } else {
            $Cname = $name;
        }

        if (!preg_match("/^[a-zA-z ]*$/", $adds) && (!preg_match('/^[0-9]{10}+$/', $adds))) {
            $product_des_error = "Price descrpition doesn't meet the critria";
        } else {
            $Cadds = $adds;
        }

        if (!preg_match("/^[a-zA-z ]*$/",  $shop_ty) && (!preg_match('/^[0-9]{10}+$/',  $shop_ty))) {
            $Product_name_error = "Product name shouldn't contain special character";
        } else {
            $Cshop_ty = $shop_ty;
        }
        if (!preg_match("/^[a-zA-z ]*$/", $shop_des) && (!preg_match('/^[0-9]{10}+$/', $shop_des))) {
            $Product_name_error = "Product name shouldn't contain special character";
        } else {
            $Cshop_des = $shop_des;
        }



        $sql_query = 'SELECT COUNT(*) AS NUMBER_OF_ROWS FROM "SHOP" WHERE SHOP_NAME=:s_name';

        $data_qu = oci_parse($connection, $sql_query);
        oci_bind_by_name($data_qu, ':s_name', $Cname);

        oci_define_by_name($data_qu, 'NUMBER_OF_ROWS', $number_of_rows);

        oci_execute($data_qu);

        oci_fetch($data_qu);

        // echo $number_of_rows;


        if ($number_of_rows == 0) {
            $querry = 'INSERT INTO "SHOP" (USER_ID,SHOP_NAME,SHOP_ADDRESS,SHOP_TYPE,SHOP_DESCRIPTION) VALUES(:trader_id,:shop_name,:shop_address,:shop_type,:shop_des)';
            $stid = oci_parse($connection, $querry);

            oci_bind_by_name($stid, ':shop_name', $name);
            oci_bind_by_name($stid, ':shop_address', $Cadds);
            oci_bind_by_name($stid, ':shop_type', $Cshop_ty);
            oci_bind_by_name($stid, ':shop_des', $Cshop_des);
            oci_bind_by_name($stid, ':trader_id', $trader_id);

            if (oci_execute($stid)) {

                
            }

            $sql_query = 'SELECT COUNT(*) AS NUMBER_OF_ROWS FROM "PRODUCT_CATEGORY" WHERE CATEGORY_TYPE=:cat_name';
            $data_qu = oci_parse($connection, $sql_query);
            oci_bind_by_name($data_qu, ':cat_name', $cat_type);
            oci_define_by_name($data_qu, 'NUMBER_OF_ROWS', $number_of_rows);
            oci_execute($data_qu);
            oci_fetch($data_qu);
            if ($number_of_rows == 0) {

                $querry = 'INSERT INTO "PRODUCT_CATEGORY" (CATEGORY_TYPE) VALUES(:category_type)';
                $stids = oci_parse($connection, $querry);
                oci_bind_by_name($stids, ':category_type', $cat_type);
                oci_execute($stids);
            } else {
                // $phone_number=trim($_POST['phone_number']);

                $sql = 'UPDATE "PRODUCT_CATEGORY" SET 	CATEGORY_TYPE= :f_name WHERE CATEGORY_TYPE= :f_name';

                $stid = oci_parse($connection, $sql);
                // oci_bind_by_name($stid ,':id',$id);
                oci_bind_by_name($stid, ':f_name', $cat_type);

                // oci_bind_by_name($stid ,':allergy_info',$allegery_info);

                oci_execute($stid);
            }
        } else {
            $Product_name_error = "Shop name already exit";
        }
    } else {
        echo '<script>alert("Sorry yor at panding to approve by the admin")</script>';
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../dashboarde.css">
    </link>
    <link rel="stylesheet" href="./add.css">
    <title>Document</title>
</head>

<body>
    <?php
    include("adminHeader.php");
    include("admin_sidebar.php");

    ?>
    <div class="all">
        <form method="POST" action="" enctype="multipart/form-data">

            <label>Shop Name</label>
            <input type="text" name="name" value="<?php echo $name ?>">
            <p class="error password-error">
                <?php echo $Product_name_error; ?>
            </p>

            <label>Shop Address</label>
            <input type="text" name="address" value="<?php echo $adds ?>">
            <p class="error password-error">
                <?php echo $product_des_error ?>
            </p>

            <label>Shop Type</label>
            <input type="text" name="shop_type" value="<?php echo $shop_ty ?>">
            <p class="error password-error">
                <?php echo $product_des_error ?>
            </p>

            <label>Shop Description</label>
            <input type="text" name="shop_des" value="<?php echo $shop_des ?>">
            <p class="error password-error">
                <?php echo $product_des_error ?>
            </p>

            <label>Profile</label>
            <input type="file" class='inputbox' name="productimage" placeholder="UploadLogo"
                value="<?php echo $image ?>">
            <p class="error password-error">
                <?php echo $image_err; ?>
            </p>

            <input type="submit" name="sub" value="ADD SHOP" class="sub">
            <form>

    </div>

    <script type="text/javascript" src="ajaxWork.js"></script>
    <script type="text/javascript" src="script.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>

</html>