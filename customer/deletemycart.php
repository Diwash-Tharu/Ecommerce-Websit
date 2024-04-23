<?php
  include('../connection.php');

    if(isset($_GET['id']) && isset($_GET['action'])){
        $delid = $_GET['id'];

        $sql = 'DELETE  FROM  "CART_PRODUCT" WHERE PRODUCT_ID = :pid';
        
        $stid = oci_parse($connection,$sql);

        oci_bind_by_name($stid,':pid', $delid);

        if(oci_execute($stid)){
            header("location:mycart.php");
        }
    }
?>