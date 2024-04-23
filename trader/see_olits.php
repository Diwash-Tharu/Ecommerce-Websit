<?php
include('../connection.php');
if(isset($_GET['id'])){

        // $delid = $_GET['id'];
        $delid = 4000;
       echo  "<div class='more'>";
        $sql = 'SELECT * FROM  "ORDER_PRODUCT" WHERE ORDER_ID = :pid';
        
        $stid1 = oci_parse($connection,$sql);

        oci_bind_by_name($stid1,':pid', $delid);

        oci_execute($stid1);
        while($rows = oci_fetch_array($stid1, OCI_ASSOC)){
            // echo $rows['PRODUCT_ID'];
            
            $sql = 'SELECT * FROM "PRODUCT" WHERE PRODUCT_ID=:pid';
            $stid = oci_parse($connection,$sql);
            oci_bind_by_name($stid,':pid', $rows['PRODUCT_ID']);
            oci_execute($stid);
            while($row = oci_fetch_array($stid, OCI_ASSOC)){

                // echo "<a href='display_selected_prd.php?s_name=$img_name&s_id=$pid' class='single'>";
            echo "<div class='card_info'>";
                echo "<img src=\"../dbimage/product/".$row['PRODUCT_IMAGE']."\" alt=".$row['PRODUCT_NAME']." >";
                echo "<div class='card-info'>";
                    echo "<div class='card-details'>";
                        // echo "<label>P_ID :  ".$row['PRODUCT_ID']."</label>";
                        echo "<label>Name:  ".substr($row['PRODUCT_NAME'],0,25)."</label>";
                        echo "<label>Number Of Product:  <span> ; ".$rows['NO_OF_PROD'] ."<span></label>";
                    echo "</div>";
                echo "</div>"; 
               
            echo "</div>";
            echo "</a>";
            }
        }
        echo "</div>";
    }
            
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../home1dassbo.css">
    <title>Document</title>
</head>
<body>
    

</body>
</html>