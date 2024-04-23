
<?php
session_start();

  include('../../connection.php');

  $name = null;
    $product_des = null;
    $Price = null;
    $quantity = null;
    $stock = null;
    $allegery_info = null;
    $image = null;
    $image_err=" ";
    $Product_name_error = " ";
    $product_des_error = " ";
    $Price_error = " ";
    $quantity_error = " ";
    $stock_error = null;
    $allegery_info_error = null;
    $product_price_error=null;

    $cname="";

//   Update Product code
  if(isset($_POST['sub']))
  {
    // echo $_SESSION['dummey'];

              $name=trim($_POST['s_name']); 
              $s_add=trim($_POST['s_add']);
              $s_type= trim($_POST['s_type']);
              $s_dec= trim($_POST['s_desc']);
              // $stock= trim($_POST['stock']);
              // $allegery_info=trim($_POST['allergy_info']);

            $sql = 'UPDATE "SHOP" SET SHOP_NAME= :s_name, SHOP_ADDRESS= :shop_add, SHOP_TYPE= :s_type, SHOP_DESCRIPTION= :s_dec WHERE USER_ID= :id ';

            $stid = oci_parse($connection, $sql);
            oci_bind_by_name($stid, ':id', $_SESSION['dummey']);

            oci_bind_by_name($stid, ':s_name', $name);
            oci_bind_by_name($stid ,':shop_add', $s_add);
            oci_bind_by_name($stid ,':s_type',$s_type);
            oci_bind_by_name($stid ,':s_dec', $s_dec);
            
           //oci_bind_by_name($stid ,':images',$prev);
            
       
            
            $result = oci_execute($stid);
            
            if($result){
              echo "you have modified";
                // header('location:traderdashboard.php?cat=Productlist');
            }
          }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="addss.css">
    <title>Document</title>
</head>

<?php

if(isset($_GET['id']) && isset($_GET['action'])){
  $id=$_GET['id'];
  $_SESSION['dummey']=$id;

}
      
        $sql = 'SELECT * FROM "SHOP" WHERE USER_ID = :id';

        $database_connect = oci_parse($connection,$sql);
        oci_bind_by_name($database_connect, ':id', $id);
        oci_execute($database_connect);
        $row = oci_fetch_array($database_connect, OCI_ASSOC);

?>

<body >
    
<div class="all">

            <form method ="POST" >
 

            <label>Shop Name</label>
            <input type="text" name ="s_name" value="<?php echo $row['SHOP_NAME'] ;?>">
            <p class="error password-error">
            <?php echo $Product_name_error;?>
            </p>

            <label>Shop_Address</label>
            <input type="text" name ="s_add" value="<?php echo $row['SHOP_ADDRESS'] ;?>">
            <p class="error password-error">
            <?php echo $product_des_error?>
            </p>

            <label>Shop Type</label>
            <input type="text" name ="s_type"   value="<?php echo $row['SHOP_TYPE'];  ?>">
            <p class="error password-error">
            <?php echo $product_price_error ;?>
            </p>

            <label>Shop Description</label>
            <input type="text"name="s_desc"   value="<?php echo $row['SHOP_DESCRIPTION']; ?>"> 
            <p class="error password-error">
            <?php echo $quantity_error;?>
            </p>

            <input type="submit" name="sub" value="UPDATE" class="sub" >
            <form>
    
</div>    
</body>

</html>
