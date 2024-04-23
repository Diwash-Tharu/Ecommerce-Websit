<?php
session_start();
            include "adminHeader.php";
            include "admin_sidebar.php";
            include('../connection.php');
// include('../connection.php');
$name = null;
$product_des = null;
$Price = null;
$quantity = null;
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

$cname = "";
if (isset($_POST['sub'])) {
    $id = $_SESSION['ID'];
    $name = ucfirst(trim($_POST['name']));
    $product_des =ucfirst( trim($_POST['product_des']));
    $Price = trim($_POST['Price']);
    $quantitys = trim($_POST['quantity']);
    $stock = trim($_POST['stock']);
    $allegery_info = trim($_POST['allergy_info']);
    $shopNmae_id=trim($_POST['shopname']);

    // echo $shopNmae;
    $image = $_FILES["productimage"]["name"];
    $utype = $_FILES['productimage']['type'];
    $utmpname = $_FILES['productimage']['tmp_name'];
    //$usize = $_FILES['productimage']['size'];
    $ulocation = "../dbimage/product/" . $image;

    $USER_ID = $_SESSION['ID'];
    // $querry = 'SELECT * FROM "SHOP" WHERE USER_ID = :USER_Id';
    // $data_base = oci_parse($connection, $querry);

    // oci_bind_by_name($data_base, ':USER_Id', $USER_ID);
    // oci_execute($data_base);

    // while ($row = oci_fetch_array($data_base, OCI_ASSOC)) {

    //     $shop_id = $row['SHOP_ID'];
    // }

    if(empty($shopNmae_id))
    {
        $error_shop_name="please enter the shop name";
    }
    else
    {
        $shop_id=$shopNmae_id;
    }


    // $cto_type=$_SESSION['trader_cat'];

    $sql = 'SELECT * FROM "USER" WHERE USER_ID= :id';
    $datbases = oci_parse($connection, $sql);
    oci_bind_by_name($datbases, ':id', $id);
    oci_execute($datbases);
    while ($row = oci_fetch_array($datbases, OCI_ASSOC)) {
        $t_c = $row['TRADER_CATEGORY'];
    }
    $cat_type = ucfirst($t_c);

    $querry = 'SELECT * FROM "PRODUCT_CATEGORY" WHERE CATEGORY_TYPE = :p_cat_id';
    $data_ba = oci_parse($connection, $querry);

    oci_bind_by_name($data_ba, ':p_cat_id', $cat_type);
    oci_execute($data_ba);

    while ($row = oci_fetch_array($data_ba, OCI_ASSOC)) {

        $Pcat_id = $row['PRODUCT_CATEGORY_ID'];
    }


    if (!preg_match("/^[a-zA-z ]*$/", $name)) {
        $Product_name_error = "Product name shouldn't contain special character";
    } else {
        $Cname = $name;
    }

    if (!preg_match("/^[a-zA-z ]*$/", $product_des) && (!preg_match('/^[0-9]{10}+$/', $product_des))) {
        $product_des_error = "Price descrpition doesn't meet the critria";
    } else {
        $Cproduct_des = $product_des;
    }


    if (!preg_match("/^[a-zA-z ]*$/", $allegery_info)) {
        $allegery_info_error = "Product name shouldn't contain special character";
    } else {

        $Callergy = $allegery_info;
    }

    if (empty($image)) {
        $image_err = "please enter the image";
    } else {
        $Cimage = $image;
    }


    $sql_query = 'SELECT COUNT(*) AS NUMBER_OF_ROWS FROM "PRODUCT" WHERE PRODUCT_NAME=:p_name';

    $data_qus = oci_parse($connection, $sql_query);
    oci_bind_by_name($data_qus, ':p_name', $Cname);

    oci_define_by_name($data_qus, 'NUMBER_OF_ROWS', $number_of_rows);

    oci_execute($data_qus);
    oci_fetch($data_qus);

    // echo $number_of_rows;
    if ($number_of_rows == 0) {


        $sql = 'INSERT INTO "PRODUCT" (PRODUCT_NAME,PRODUCT_DESCRIPTION,PRICE,QUANTITY,STOCK_CHECK,ALLERGY_INFO,PRODUCT_IMAGE,PRODUCT_CATEGORY_ID,SHOP_ID)
                                    VALUES(:product_name,:product_desc,:price,:quantity,:stoke,:allergy,:product_image,:product_cat,:shop_id)';
        $stid = oci_parse($connection, $sql);

        oci_bind_by_name($stid, ':product_name', $Cname);
        oci_bind_by_name($stid, ':product_desc', $Cproduct_des);
        oci_bind_by_name($stid, ':price', $Price);
        oci_bind_by_name($stid, ':quantity', $quantitys);
        oci_bind_by_name($stid, ':stoke', $stock);
        oci_bind_by_name($stid, ':allergy', $Callergy);
        oci_bind_by_name($stid, ':product_image', $Cimage);
        oci_bind_by_name($stid, ':product_cat', $Pcat_id);
        oci_bind_by_name($stid, ':shop_id', $shop_id);

        if (oci_execute($stid)) {
            if (move_uploaded_file($utmpname, $ulocation)) {
                echo "<script>window.alert('Data Inserted Successfully!')</script>";
                // header("Location:traderdashboard.php");
            } else {
                echo "Unable to insert file";
            }
        }
        // $sum =  'SELECT * FROM "PRODUCT"  WHERE PRODUCT_CATEGORY_ID =:id';

        // $data_qu = oci_parse($connection,$sum);
        // oci_bind_by_name($data_qu, ':id',$Pcat_id);

        // oci_execute($data_qu);
        // $total_sum = 0;
        // // Fetch the results and add each number to the total sum
        // while ($row = oci_fetch_array($data_qu, OCI_ASSOC)) {
        //     $total_sum += $row['QUANTITY'];
        // }

        $sql_query = 'SELECT COUNT(*) AS NUMBER_OF_ROWS FROM "PRODUCT" WHERE PRODUCT_CATEGORY_ID=:p_name';

        $data_qu = oci_parse($connection, $sql_query);
        oci_bind_by_name($data_qu, ':p_name', $Pcat_id);
        oci_define_by_name($data_qu, 'NUMBER_OF_ROWS', $number_of_rows);
        oci_execute($data_qu);
        oci_fetch($data_qu);

        if ($number_of_rows > 0) {
            $querry = 'UPDATE "PRODUCT_CATEGORY" SET  NO_OF_ITEM = :sum WHERE PRODUCT_CATEGORY_ID = :id';
            $done = oci_parse($connection, $querry);
            oci_bind_by_name($done, ':id', $Pcat_id);
            oci_bind_by_name($done, ':sum', $number_of_rows);
            oci_execute($done);
        } else {
            echo '<script>alert("you should add catogeory at first")</script>';
        }
    } else {
        echo '<w>alert("Product are already exit")</script>';
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
    <link rel="stylesheet" href="../dashboarde.css">
    </link>
    <link rel="stylesheet" href="./add.css">
    <title>Document</title>
</head>

<body>
    <?php
    // include ("adminHeader.php");
    // include("admin_sidebar.php"); 
    ?>
    <div class="all">
        <form method="POST" action="" enctype="multipart/form-data">

            <label>Product Name</label>
            <input type="text" name="name" value="<?php echo $name ?>">
            <p class="error password-error">
                <?php echo $Product_name_error; ?>
            </p>

            <label>Product Description</label>
            <input type="text" name="product_des" value="<?php echo $product_des ?>">
            <p class="error password-error">
                <?php echo $product_des_error ?>
            </p>

            <label>Price</label>
            <input type="number" name="Price" min="1" value="<?php echo $Price ?>">
            <p class="error password-error">
                <?php echo $product_price_error; ?>
            </p>

            <label>Quantity</label>
            <input type="number" name="quantity" min="1" max="100" value="<?php echo $quantity ?>">
            <p class="error password-error">
                <?php echo $quantity_error; ?>
            </p>

            <label>Available Stock</label>
            <input type="text" name="stock"  value="<?php echo $stock ?>">
            <p class="error password-error">
                <?php echo $stock_error; ?>
            </p>

            <label>Allergy Info</label>
            <input type="text" name="allergy_info" value="<?php echo $allegery_info ?>">
            <p class="error password-error">
                <?php echo $allegery_info_error; ?>
            </p>
            <!-- 
            <label>Shop Name</label>
            <input type="text" name ="allergy_info" value="<?php echo $allegery_info ?>">
            <p class="error password-error">
            <?php echo $allegery_info_error; ?>
            </p> -->


            <label>Shop Name</label>
            <select class="inputbox" name="shopname">
                <option value="">Please Select Shop</option>
                <?php
                $sql = 'SELECT * FROM "SHOP" WHERE USER_ID = :user_id';
                $stid = oci_parse($connection, $sql);
                oci_bind_by_name($stid, ':user_id', $_SESSION['ID']);
                oci_execute($stid);

                while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
                    echo "<option value=" . $row['SHOP_ID'] . ">" . $row['SHOP_NAME'] . "</option>";
                }

                ?>
            </select>
            <label>Product Image</label>
            <input type="file" class='inputbox' name="productimage" placeholder="UploadLogo"
                value="<?php echo $image ?>">
            <p class="error password-error">
                <?php echo $image_err; ?>
            </p>

            <input type="submit" name="sub" value="ADD PRODUCT" class="sub">
            <form>

    </div>
    <script type="text/javascript" src="ajaxWork.js"></script>
    <script type="text/javascript" src="script.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>