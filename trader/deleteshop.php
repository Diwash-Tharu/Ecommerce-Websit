<?php
  include('../connection.php');

    if(isset($_GET['id']) && isset($_GET['action'])){
        $delid = $_GET['id'];

        $sql = 'DELETE  FROM  "SHOP" WHERE USER_ID = :pid';
        
        $stid = oci_parse($connection,$sql);

        oci_bind_by_name($stid,':pid', $delid);

        if(oci_execute($stid)){
            header("location:display.php");
        }
    }
?>