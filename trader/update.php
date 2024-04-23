
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

            $name=trim($_POST['name']); 
            $product_des=trim($_POST['product_des']);
            $Price= trim($_POST['Price']);
            $quantitys= trim($_POST['quantity']);
            $stock= trim($_POST['stock']);
            $allegery_info=trim($_POST['allergy_info']);

          $uid = $_SESSION['id'];


          $prev= $_POST['pimage'];
          $image = $_FILES["productimage"]["name"];
          $utype = $_FILES['productimage']['type'];
          $utmpname = $_FILES['productimage']['tmp_name'];
          $ulocation = "../dbimage/product/".$image;


          echo $prev;
          echo $image;
          

          if(!empty($image))
          {     
            
                if($utype=="image/jpeg" || $utype=="image/jpg" || $utype=="image/png" || $utype=="image/gif" || $utype=="image/webp")
                {
                $sql = 'UPDATE "PRODUCT" SET 	PRODUCT_NAME= :product_name,PRODUCT_DESCRIPTION = :shop_des, PRICE= :price, QUANTITY= :quantity,STOCK_CHECK= :stoke, ALLERGY_INFO= :allergy_info, PRODUCT_IMAGE= :images WHERE PRODUCT_ID= :upid ';

                $stid = oci_parse($connection, $sql);
        
                oci_bind_by_name($stid, ':upid', $uid);
                oci_bind_by_name($stid ,':product_name',$name);
                oci_bind_by_name($stid ,':shop_des',$product_des);
                oci_bind_by_name($stid ,':price',$Price);
                oci_bind_by_name($stid ,':quantity',$quantitys);
                oci_bind_by_name($stid ,':stoke',$stock);
                oci_bind_by_name($stid ,':allergy_info',$allegery_info);
                oci_bind_by_name($stid ,':images',$prev);
                oci_bind_by_name($stid ,':images',$image);


                if (unlink("../dbimage/product/" . $prev)) {
                    if (move_uploaded_file($utmpname, $ulocation)) {
                        if (oci_execute($stid)) {
                            // header('Location:traderdashboard.php?cat=Productlist');
                        }
                    }
                }
              }
              else{
                $image_err = "please please insert proper formate";
              }
          }
          else{
            $sql = 'UPDATE "PRODUCT" SET 	PRODUCT_NAME= :product_name,PRODUCT_DESCRIPTION = :shop_des, PRICE= :price, QUANTITY= :quantity,STOCK_CHECK= :stoke, ALLERGY_INFO= :allergy_info WHERE PRODUCT_ID= :upid ';

            $stid = oci_parse($connection, $sql);
            oci_bind_by_name($stid, ':upid', $uid);
            oci_bind_by_name($stid ,':product_name',$name);
            oci_bind_by_name($stid ,':shop_des',$product_des);
            oci_bind_by_name($stid ,':price',$Price);
            oci_bind_by_name($stid ,':quantity',$quantitys);
            oci_bind_by_name($stid ,':stoke',$stock);
            oci_bind_by_name($stid ,':allergy_info',$allegery_info);
           //oci_bind_by_name($stid ,':images',$prev);
            
       
            
            $result = oci_execute($stid);
            
            if($result){
                // header('location:traderdashboard.php?cat=Productlist');
            }
          } 
         
                       
  }
  unset($_SESSION['id']);   
  
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="adds.css">
    <title>Document</title>
</head>

<?php


      $_SESSION['id']=$_GET['id'];
       $id=$_GET['id'];
        $sql = 'SELECT * FROM "PRODUCT" WHERE PRODUCT_ID = :id';

        $database_connect = oci_parse($connection,$sql);
        oci_bind_by_name($database_connect, ':id', $id);
        oci_execute($database_connect);
        $row = oci_fetch_array($database_connect, OCI_ASSOC);

?>

<body >
    
<div class="all">
  

            <form method ="POST" action=""  enctype="multipart/form-data">
 

            <label>Product Name</label>
            <input type="text" name ="name" value="<?php echo $row['PRODUCT_NAME'] ;?>">
            <p class="error password-error">
            <?php echo $Product_name_error;?>
            </p>

            <label>Product Description</label>
            <input type="text" name ="product_des" value="<?php echo $row['PRODUCT_DESCRIPTION'] ;?>">
            <p class="error password-error">
            <?php echo $product_des_error?>
            </p>

            <label>Price</label>
            <input type="number" name ="Price"  min="1"  value="<?php echo $row['PRICE'];  ?>">
            <p class="error password-error">
            <?php echo $product_price_error ;?>
            </p>

            <label>Quantity</label>
            <input type="number"name="quantity"  min="1" max="100" value="<?php echo $row['QUANTITY']; ?>"> 
            <p class="error password-error">
            <?php echo $quantity_error;?>
            </p>

            <label>Available Stock</label>
            <input type="text" name ="stock"    value="<?php echo $row['STOCK_CHECK']; ?>">
            <p class="error password-error">
            <?php echo $stock_error;?>
            </p>

            <label>Allergy Info</label>
            <input type="text" name ="allergy_info" value="<?php echo $row['ALLERGY_INFO'];  ?>">
            <p class="error password-error">
            <?php echo $allegery_info_error;?>
            </p>


            <label>Product Image</label> 
            <input type="hidden" class='inputbox' name="pimage"   value="<?php echo $row['PRODUCT_IMAGE'];?>" >
            <input type="file" class='inputbox' name="productimage"   placeholder="UploadLogo" value="<?php echo $row['PRODUCT_IMAGE']; ?>" >
            <p class="error password-error">
            <?php echo $image_err;?>
            </p>

            <input type="submit" name="sub" value="UPDATE" class="sub" >
            <form>
    
</div>    
</body>

</html>
