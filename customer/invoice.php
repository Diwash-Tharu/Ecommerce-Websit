<?php
session_start();
include("../connection.php");
            $sql = 'SELECT * FROM "CART" WHERE USER_ID = :u_id';
            $stmts = oci_parse($connection, $sql);
            oci_bind_by_name($stmts, ":u_id",  $_SESSION['ID']);
            oci_execute($stmts);
            while ($row = oci_fetch_array($stmts, OCI_ASSOC)) {
              $cid = $row['CART_ID'];

              unset($_SESSION['cart_id']);
              $_SESSION['cart_id'] = $cid;}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>

<div class="card">
  <div class="card-body">
    <div class="container mb-5 mt-3">
      <div class="row d-flex align-items-baseline">
        <div class="col-xl-9">
          <p style="color: #7e8d9f;font-size: 20px;">Invoice >> <strong>ID: #123-123</strong></p>
        </div>
        <div class="col-xl-3 float-end">
          
        </div>
        <hr>
      </div>

      <div class="container">
        <div class="col-md-12">
          <div class="text-center">
            <i class="fab fa-mdb fa-4x ms-0" style="color:#5d9fc5 ;"></i>
            <p class="pt-0">Cleck Shop Zone</p>
          </div>

        </div>


        <div class="row">
          <div class="col-xl-8">
            <ul class="list-unstyled">
              <li class="text-muted">To: <span style="color:#5d9fc5 ;"> <?php echo $_SESSION['username'];?></span></li>
              <li class="text-muted"><?echo $_SESSION['address'];?></li>
              <li class="text-muted">Kathmandu, Nepal</li>
              <li class="text-muted"><i class="fas fa-phone"></i> 123-456-789</li>
            </ul>
          </div>
          <div class="col-xl-4">
            <p class="text-muted">Invoice</p>
            <ul class="list-unstyled">
              <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                  class="fw-bold">ID:</span><?php  echo $_SESSION['cart_id'];?></li>
              <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                  class="fw-bold">Creation Date: </span><?php echo date("Y-m-d") ?></li>
              <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                  class="me-1 fw-bold">Status:</span><span class="badge bg-warning text-black fw-bold">
                  Unpaid</span></li>
            </ul>
          </div>
        </div>

        <div class="row my-2 mx-1 justify-content-center">
          <table class="table table-striped table-borderless">
            <thead style="background-color:#84B0CA ;" class="text-white">
              <tr>
                <th scope="col">#</th>
              <th>Product Name</th>
              <th>qunatity</th>
              <th>per unit price</th>
              <th>&#163; Amount</th>
            </tr>
              </tr>
            </thead>
            <tbody>
           <?php
            include("../connection.php");
            $total_item=0;
            $productprice = 0;
            $totalprice = 0;
            // echo  $_SESSION['ID'];

            $sql = 'SELECT * FROM "CART" WHERE USER_ID = :u_id';
            $stmts = oci_parse($connection, $sql);
            oci_bind_by_name($stmts, ":u_id",  $_SESSION['ID']);
            oci_execute($stmts);
            while ($row = oci_fetch_array($stmts, OCI_ASSOC)) {
              $cid = $row['CART_ID'];
              // echo $cid;
              // $quantity = $row['CART_ITEMS'];
              
            
            }
            // echo $quantity;
              // query for product table
              
              $sql = 'SELECT * FROM "CART_PRODUCT" WHERE CART_ID = :cart_id';
              $qu = oci_parse($connection, $sql);
              oci_bind_by_name($qu, ":cart_id", $cid);
              oci_execute($qu);
              while ($row = oci_fetch_array($qu, OCI_ASSOC)) {
              $pid = $row['PRODUCT_ID'];
              $quantity = $row['NUMBER_OF_PRODUCT'];
              
              $sqlpr = 'SELECT * FROM "PRODUCT" WHERE PRODUCT_ID = :pid';
              $stmt = oci_parse($connection, $sqlpr);
              oci_bind_by_name($stmt, ":pid", $pid);
              oci_execute($stmt);
              while ($tbc = oci_fetch_array($stmt, OCI_ASSOC)) {

                $per_price=$tbc['PRICE'];
                $productprice =  $quantity * $tbc['PRICE'];
                $totalprice += $quantity * $tbc['PRICE'];
                $total_item=$total_item+1;
                $productname = $tbc['PRODUCT_NAME'];

                echo "<tr>";
                echo "<td>".$total_item."</td> 
                <td>" . $tbc['PRODUCT_NAME'] . "</td>
                  <td>" . $quantity . "</td>
                  <td>&#163; " .   $per_price . "</td>
                  <td>&#163; " . $productprice . "</td>
                  </tr>
                  ";
              }
            }
            unset($_SESSION['total_product']);
            $_SESSION['total_product']=$total_item;
            ?>
            </tbody>

          </table>
        </div>
        <div class="row">
          <div class="col-xl-8">
            <p class="ms-3">Add additional notes and payment information</p>

            </div>
          <div class="col-xl-3">
            <ul class="list-unstyled">
              <li class="text-muted ms-3"><span class="text-black me-4">SubTotal</span>&#163;  <?php
              
            echo number_format($totalprice,2);
            ?></li>
              <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Tax(15%)</span>&#163; <?php
              $total=$totalprice;
              $tax=$totalprice*0.15;
              echo number_format($tax,2);
              ?></li>
            </ul>
            <p class="text-black float-start"><span class="text-black me-3"> Total Amount</span><span
                style="font-size: 25px;">&#163; 
                <?php
                $total=$totalprice+$tax;
                echo  number_format($total,2);
                unset($_SESSION['alltotal']);
                $_SESSION['alltotal']=number_format($total,2);
                ?>
                </span></p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-xl-10">
            <p>Thank you for your purchase</p>
          </div>

            <div class="row justify-content-end">
            <div class="col-4 c-warning">
                <?php include("../payment/configuration.php") ?>
                <form action="<?php echo PAYPAL_URL; ?>" method='post'>
                            <div class="place-btn">
                                <input type="hidden" name="business" value="<?php echo PAYPAL_ID; ?>">
                                <input type="hidden" name="amount" value="<?php echo $_SESSION['alltotal']; ?>">
                                <input type="hidden" name="currency_code" value="<?php echo PAYPAL_CURRENCY; ?>">
                                <!-- Specify a Buy Now button. -->
                                <input type="hidden" name="cmd" value="_xclick">
                                <!-- Specify URLs -->
                                <input type="hidden" name="return" value="<?php echo PAYPAL_RETURN_URL; ?>">
                                <input type="hidden" name="cancel_return" value="<?php echo PAYPAL_CANCEL_URL; ?>">

                                <input type="submit" class="btn btn-outline-success" name="submit" value="Payment By Paypal" />
                            </div>
                </form>
            </div>
            </div>

            <!-- <?php
            
                        // $querry ='INSERT INTO "ORDER" (O_DATE,ORDER_QUANTITY,TOTAL_AMOUNT,CART_ID,COLLECTION_ID) VALUES(:oder_date,:quantity,:total_amount,:cart_id,:collection_id)';
                        // $stid = oci_parse($connection,$querry);
                        // oci_bind_by_name($stid, ':oder_date', $name);
                        // oci_bind_by_name($stid, ':quantity', $Cadds);
                        // oci_bind_by_name($stid, ':total_amount', $Cshop_ty);
                        // oci_bind_by_name($stid, ':cart_id', $Cshop_des);
                        // oci_bind_by_name($stid, ':collection_id',$trader_id);
                        
                        // if(oci_execute($stid)){
                        
                        //     echo "you are login";

                        //     $pid;

                        //     $sql = 'SELECT * FROM "ORDER" WHERE USER_ID = :u_id';
                        //     $stmts = oci_parse($connection, $sql);
                        //     oci_bind_by_name($stmts, ":u_id",  $_SESSION['ID']);
                        //     oci_execute($stmts);
                        //     while ($row = oci_fetch_array($stmts, OCI_ASSOC)) {
                        //       $cid = $row['CART_ID'];


                        //     $querry ='INSERT INTO "ORDER" (O_DATE,COLLECTION_ID) VALUES(:oder_date,:quantity)';
                        //     $conn = oci_parse($connection,$querry);
    
                        //     oci_bind_by_name($conn, ':oder_date', $name);
                        //     oci_bind_by_name($conn, ':quantity', $pid);
                        //     oci_execute($conn);

                        //     }
                        // }
            ?> -->
    </body>

            
</html>