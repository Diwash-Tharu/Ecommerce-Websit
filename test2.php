<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home1dassbo.css">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
<?php

 $discount_id=11000;
 $u_id=22;
//  echo "the daya is ".$discount_id;
 include('connection.php');
//   unset($_SESSION['collection_id']);
//   $_SESSION['collection_id']=$data;
//   echo $data;
//   header("location:invoice.php");
// header("location:discount.php?&id=$u_id");

    //    include("../connection.php");
    //    $querry ='UPDATE  "DISCOUNT" SET USER_ID=:id  WHERE DISCOUNT_ID= :d_id';
    //    $insert = oci_parse($connection,$querry);
    //    oci_bind_by_name($insert, ':d_id', $discount_id);
    //    oci_bind_by_name($insert, ':id', $u_id);
    //    // $tr = oci_execute($insert);
    //    if (oci_execute($insert))
    //    {
    //        echo "success";
    //    }

    // for some time olney
       
    //    $sql = 'SELECT * FROM "SHOP" WHERE USER_ID=:u_id';
    //    $stmts = oci_parse($connection, $sql);
    //    oci_bind_by_name($stmts, ":u_id",$u_id);
    //    oci_execute($stmts);
    //    while ($row = oci_fetch_array($stmts, OCI_ASSOC)) {
       
    //        $id=$row['SHOP_ID'];
    //        echo $id;
    //    }

    //    $querry ='UPDATE  "PRODUCT" SET 	DISCOUNT_ID=:d_id  WHERE SHOP_ID= :s_id';
    //       $insert = oci_parse($connection,$querry);
    //       oci_bind_by_name($insert, ':d_id', $discount_id);
    //       oci_bind_by_name($insert, ':s_id', $id);
    //       // $tr = oci_execute($insert);
    //       if (oci_execute($insert))
    //     {
    //         echo "success";
    //     }
    //     ?>
    <div class="more">
    <?php
                
            include("connection.php");

                $sql = 'SELECT * FROM "PRODUCT" ';
                $stid1 = oci_parse($connection,$sql);
                oci_execute($stid1);
                
            while($row = oci_fetch_array($stid1, OCI_ASSOC)){
            $pid = $row['PRODUCT_ID'];
            // $pid = 9242;
           
                $img_name=$row['PRODUCT_NAME'];
                echo "<a href='display_selected_prd.php?s_name=$img_name&s_id=$pid' class='single' id='dec'>";
                 
                echo "<div class='card_info'>";
                if(!empty($row['DISCOUNT_ID']))
                {
                    $messg="OFFER";
                    echo "<label><span id ='message'>".$messg."</span></label>";
                }  
                        echo "<img src=\"dbimage/product/".$row['PRODUCT_IMAGE']."\" alt=".$row['PRODUCT_NAME']." >";
                        
                        
                        echo "<div class='card-info'>";
                        
                            echo "<div class='card-details'>";
                                // echo "<label>P_ID :  ".$row['PRODUCT_ID']."</label>";
                                echo "<label>Name:  ".substr($row['PRODUCT_NAME'],0,25)."</label>";

                                if (!empty($row['DISCOUNT_ID'])) 
                                {
                                    $sql = 'SELECT DISCOUNT_PERC FROM "DISCOUNT" WHERE DISCOUNT_ID = :disc_id';
                                    $stmt = oci_parse($connection, $sql);
                                    oci_bind_by_name($stmt, ":disc_id", $row['DISCOUNT_ID']);
                                    oci_execute($stmt);
                                    $rows = oci_fetch_array($stmt, OCI_ASSOC);
                                    $discount = (int)$rows['DISCOUNT_PERC'];
                                    $total_price =$row['PRICE'] - $row['PRICE'] * ($discount / 100);
                                    echo "<span class='set'>&pound; <s id='cu'> " . $row['PRICE'] . " </s></span>";
                                    echo "<span class='dis'>&pound; " . $row['PRICE']. "</span>";
                                  } else {
                                    echo "<span class='amount'>&pound; " . $row['PRICE'] . "</span>";
                                  }
                                  
                                // echo "<label>Price:  <span> &pound; ".$row['PRICE'] ."<span></label>";
                                  
                              
                            echo "</div>";
                        echo "</div>"; 
                        // echo "<div class='btns'>";
                        //     // echo "<a href='update.php?cat=EditProduct&id=$pid&action=edit' id='edit' ><i class='fa fa-shopping-cart' style='font-size:36px'></i></a>";
                        //     // echo "<a href='deleteP.php?&id=$pid&action=delete' id='delete' >Wish List</a>";
                        // echo "</div>";
                    echo "</div>";
                    echo "</a>";
                }
    ?>

</div>


        


        <!-- //   $data="";
        //   $querry ='UPDATE  "PRODUCT" SET 	DISCOUNT_ID=:d_id  WHERE SHOP_ID= :s_id';
        //   $insert = oci_parse($connection,$querry);
        //   oci_bind_by_name($insert, ':d_id', $data);
        //   oci_bind_by_name($insert, ':s_id', $id);
        //   // $tr = oci_execute($insert);
        //   if (oci_execute($insert))
        //   {
        //       echo "success";
        //   }

    ?> -->