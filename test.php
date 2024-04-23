<?php
include("connection.php");
$num=	11002;
$querry ='SELECT  DISCOUNT_PERC FROM "DISCOUNT"  WHERE DISCOUNT_ID= :d_id';
            $insert = oci_parse($connection,$querry);
            oci_bind_by_name($insert, ':d_id',$num);
            // $tr = oci_execute($insert);
           oci_execute($insert);
            $row = oci_fetch_array($insert, OCI_ASSOC);
            
                echo $row['DISCOUNT_PERC'];
?>