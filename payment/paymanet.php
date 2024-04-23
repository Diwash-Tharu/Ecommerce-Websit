<?php
session_start();
include("../connection.php");
            $sql = 'SELECT * FROM "CART" WHERE USER_ID = :u_id';
            $stmts = oci_parse($connection, $sql);
            oci_bind_by_name($stmts, ":u_id",  $_SESSION['ID']);
            oci_execute($stmts);
            while ($row = oci_fetch_array($stmts, OCI_ASSOC)) {
              $cid = $row['CART_ID'];

              // unset($_SESSION['cart_id']);
              $_SESSION['cart_id'] = $cid;
            }

include("../connection.php");
include('configuration.php');

if (isset($_GET['PayerID'])) {
    // $payment_detail = "completed";

    // $status = "completed";
    // $updatesql = "UPDATE ORDER_I SET STATUS = :ustatus WHERE ORDER_ID = :order_id";
    // $sitd = oci_parse($connection, $updatesql);
    // oci_bind_by_name($sitd, ":order_id", $_SESSION['order_id']);
    // oci_bind_by_name($sitd, ":ustatus", $status);
    // oci_execute($sitd);

    //           $sql = 'SELECT * FROM "CART" WHERE CART_ID = :cart_id';
    //           $qu = oci_parse($connection, $sql);
    //           oci_bind_by_name($qu, ":cart_id", $_SESSION['cart_id']);
    //           oci_execute($qu);
    //           while ($rows = oci_fetch_array($qu, OCI_ASSOC)) {
    //   {
    //     $sql = 'INSERT INTO "ORDER_PRODUCT" (PRODUCT_ID,NUM_OF_PROD) VALUES (:P_id,:total_p)';
    //     $stmts = oci_parse($connection, $sql);
    //     oci_bind_by_name($stmts, ":p_id", $rows['PRODUCT_ID']);
    //     oci_bind_by_name($stmts, ":total_p",$rows['NUMBER_OF_PRODUCT']);
    //     oci_execute($stmts);
    //   }
    // }

    $sql = 'INSERT INTO "ORDER" (ORDER_QUANTITY,TOTAL_AMOUNT,CART_ID,COLLECTION_ID) VALUES (:o_qunaty,:total_amt,:c_id,:col_id)';
    $stmt = oci_parse($connection, $sql);
    oci_bind_by_name($stmt, ":o_qunaty", $_SESSION['total_product']);
    // oci_bind_by_name($stmt, ":o_qunaty", $d1);

    oci_bind_by_name($stmt, ":total_amt", $_SESSION['alltotal']);
    // oci_bind_by_name($stmt, ":total_amt", $odi);

    oci_bind_by_name($stmt, ":c_id", $_SESSION['cart_id']);
    // oci_bind_by_name($stmt, ":c_id", $d);

    oci_bind_by_name($stmt, ":col_id", $_SESSION['collection_id']);
    // oci_bind_by_name($stmt, ":col_id", $cid);
    if (oci_execute($stmt))
    {
                  $sql = 'SELECT * FROM "ORDER" WHERE CART_ID = :cart_id';
                  $qu = oci_parse($connection, $sql);
                  oci_bind_by_name($qu, ":cart_id", $cid);
                  oci_execute($qu);
                  while ($row = oci_fetch_array($qu, OCI_ASSOC)) {
                  $or_id=$row['ORDER_ID'];
                  }

                  $sql = 'SELECT * FROM "CART_PRODUCT" WHERE CART_ID = :cart_id';
                  $qu = oci_parse($connection, $sql);
                  oci_bind_by_name($qu, ":cart_id", $_SESSION['cart_id']);
                  oci_execute($qu);
                  while ($rows = oci_fetch_array($qu, OCI_ASSOC)) {
                  {
                    
                  $sql = 'INSERT INTO "ORDER_PRODUCT" (ORDER_ID,PRODUCT_ID,NO_OF_PROD) VALUES (:O_id,:P_id,:total_p)';
                  $stmts = oci_parse($connection, $sql);
                  oci_bind_by_name($stmts, ":O_id", $or_id);
                  oci_bind_by_name($stmts, ":p_id", $rows['PRODUCT_ID']);
                  oci_bind_by_name($stmts, ":total_p",$rows['NUMBER_OF_PRODUCT']);
                  oci_execute($stmts);
                  }
                  }
                  $sql = 'INSERT INTO "PAYMENT" (PAY_METHOD,PAY_AMOUNT,USER_ID,ORDER_ID) VALUES (:O_id,:total,:u_id,:o_id)';
                  $stmts = oci_parse($connection, $sql);
                  $method="paypal";
                  oci_bind_by_name($stmts, ":O_id", $method);
                  oci_bind_by_name($stmts, ":total", $_SESSION['alltotal']);
                  oci_bind_by_name($stmts, ":u_id",$_SESSION['ID']);
                  oci_bind_by_name($stmts, ":o_id",$or_id);
                  // oci_bind_by_name($stmts, ":total_p",$rows['NUMBER_OF_PRODUCT']);

                  oci_execute($stmts);
                  }
                  
        $sql = 'SELECT * FROM "CART_PRODUCT" WHERE CART_ID = :cart_id';
              $qu = oci_parse($connection, $sql);
              oci_bind_by_name($qu, ":cart_id", $cid);
              oci_execute($qu);
              while ($row = oci_fetch_array($qu, OCI_ASSOC)) {
            $remaning_item=0;
              $pid = $row['PRODUCT_ID'];
              $quantity = $row['NUMBER_OF_PRODUCT'];
             
            //   $remaning_item=$quantity-$_SESSION['total_product'];

            $sql = 'SELECT * FROM "PRODUCT" WHERE PRODUCT_ID= :u_id';
            $stmts = oci_parse($connection, $sql);
            oci_bind_by_name($stmts, ":u_id",$pid);
            oci_execute($stmts);
            while ($row = oci_fetch_array($stmts, OCI_ASSOC)) {
                $quan=$row['QUANTITY'];
            //   $cid = $row['CART_ID'];

            //   unset($_SESSION['cart_id']);
            //   $_SESSION['cart_id'] = $cid;
            
            // $remaning_item= $quan-$quantity;

            //   if($remaning_item==0)
            //   {
            //     $stoke="no";
            //     $sql = 'UPDATE  "PRODUCT" SET  STOCK_CHECK=:stoke WHERE PRODUCT_ID= :id';
            //     $uppdate = oci_parse($connection,$sql);
            //     oci_bind_by_name($uppdate,':stoke',  $stoke);
            //     oci_bind_by_name($uppdate,':id',  $pid);
            //     oci_execute($uppdate);

            //   }
            //   else
            //   {
            //         $sql = 'UPDATE  "PRODUCT" SET  QUANTITY= :re_item WHERE PRODUCT_ID= :id';
            //         $upp = oci_parse($connection,$sql);
            //         oci_bind_by_name($upp,':re_item',  $remaning_item);
            //         oci_bind_by_name($upp,':id',  $pid);
            //         oci_execute($upp);
                    
                // }
                // $sql = 'DELETE  FROM  "CART_PRODUCT" WHERE CART_ID = :cid';
        
                // $stid = oci_parse($connection,$sql);
        
                // oci_bind_by_name($stid,':cid', $_SESSION['cart_id']);
        
                // if(oci_execute($stid)){
                    
                // }
                // header('location:http://localhost/project/chz/home1.php');
            }
            }
          }
        // header('location:http://localhost/project/chz/home1.php');

        
      // }

    else
    {
      // echo "<script>alert('Your Payment is Failed Please try again')</script>";
    }
    
//     echo "<script>alert('Payment has been Successfull')</script>";
// } else {
//     echo "<script>alert('Your Payment is Failed Please try again')</script>";
// }