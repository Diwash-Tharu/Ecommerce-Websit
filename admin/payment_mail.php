<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html> -->
<?php
include("../connection.php");
if(isset($_GET['id']) && ($_GET['tot']) && ($_GET['uid']))
{
    $p_id= $_GET['id'];
    $total= $_GET['tot'];
    $email=$_GET['uid'];
    
    $to_email=$email ;
    $subject="payment confrom";
    $message="you have get the padi ".$total;
    include("../mail.php");
    $message="Padi";
    $sql = 'UPDATE  "ORDER_PRODUCT" SET  STATUS= :mess WHERE PRODUCT_ID= :P_id';
    $upp = oci_parse($connection,$sql);
    oci_bind_by_name($upp,':mess',  $message);
    oci_bind_by_name($upp,':P_id',  $p_id);
    oci_execute($upp);
    header('location:distirbutamount.php');
}

?>