<?php
  session_start();
  include("../connection.php");
  if(isset($_POST['placeorder']))
{

  // echo  $_SESSION['ID'];
  // include("collectionslot.php");
  // $_SESSION[''];
    $sql = 'SELECT * FROM "CART" WHERE USER_ID= :id';
    $datbases = oci_parse($connection, $sql);
    oci_bind_by_name($datbases, ':id', $_SESSION['ID']);
    if(oci_execute($datbases))
    {
    while ($row = oci_fetch_array($datbases, OCI_ASSOC)) {
        $c_id = $row['CART_ID'];
    }
    header("location:collectionslot.php");

  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="addcartp.css"></link>
</head>
<body>
<div class="order-container">

<form method ="post" >
          <table>
            <!-- table heading -->

            <tr>
            <th>Product Image</th>
              <th>Product Name</th>
              <th>Quantity</th>
              <th> Price</th>
              <th>Total Price</th>
              <th>Action</th>
            </tr>

           
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

              unset($_SESSION['cart_id']);
              $_SESSION['cart_id'] = $cid;
              // echo $totalprice;

              // echo $cid;
              // $quantity = $row['CART_ITEMS'];
            // echo $quantity;
              // query for product table
            }
              $sql = 'SELECT * FROM "CART_PRODUCT" WHERE CART_ID = :cart_id';
              $qu = oci_parse($connection, $sql);
              oci_bind_by_name($qu, ":cart_id", $cid);
              oci_execute($qu);
              while ($row = oci_fetch_array($qu, OCI_ASSOC)) {
              $pid = $row['PRODUCT_ID'];
              $quantity = $row['NUMBER_OF_PRODUCT'];
              
              $sqlpr = 'SELECT * FROM "PRODUCT" WHERE PRODUCT_ID = :p_id';
              $stmt = oci_parse($connection, $sqlpr);
              oci_bind_by_name($stmt, ":p_id", $pid);
              oci_execute($stmt);
              while ($data = oci_fetch_array($stmt, OCI_ASSOC)) {
                // $disc=$data['DISCOUNT_ID'];

                if(empty($data['DISCOUNT_ID']))
                {
                $productprice =  $quantity * $data['PRICE'];
                $totalprice += $quantity * $data['PRICE'];
                $total_item=$total_item+1;
                $productname = $data['PRODUCT_NAME'];
                
                $productname = $data['PRODUCT_NAME'];
                }
                else
                {
                  $querry ='SELECT  * FROM "DISCOUNT"  WHERE DISCOUNT_ID= :d_id';
                  $insert = oci_parse($connection,$querry);
                  oci_bind_by_name($insert, ':d_id', $data['DISCOUNT_ID']);
                  // $tr = oci_execute($insert);
                  oci_execute($insert);
                    $row = oci_fetch_array($insert, OCI_ASSOC);
                    $descper= $row['DISCOUNT_PERC'];

                    $productprice =  $quantity * $data['PRICE']-$data['PRICE']*($descper/100);
                    $totalprice += $quantity * $data['PRICE']-$data['PRICE']*($descper/100);
                    $total_item=$total_item+1;
                    $productname = $data['PRODUCT_NAME'];
                    $productname = $data['PRODUCT_NAME'];
                }

                // $sql = 'SELECT DISCOUNT_PERC FROM "DISCOUNT" WHERE DISCOUNT_ID = :disc_id';
                // $stmt = oci_parse($connection, $sql);
                // oci_bind_by_name($stmt, ":disc_id", $data['DISCOUNT_ID']);
                // oci_execute($stmt);
                // $rows = oci_fetch_array($stmt, OCI_ASSOC);
                // $disc = (int)$rows['DISCOUNT_PERC'];
                // $productprice =  $quantity * $data['PRICE']-$data['PRICE']*($disc)/100;
                echo "
                  <tr>
                  <td class='img'>";
                echo "<img src=\"../dbimage/product/" . $data['PRODUCT_IMAGE'] . "\" alt='$productname' /> ";
                echo "</td>
                  <td>" . $data['PRODUCT_NAME'] . "</td>
                  <td>" . $quantity . "</td>
                  <td>&#163; " . $data['PRICE'] . "</td>
                  <td>&#163; " .$productprice."</td>";
                  echo "<td id='del'> <a href='deletemycart.php?&id=$pid&action=delete' id='delete'>Remove</a></td>";
                 echo "</tr>";
              }
            }
            ?>

          </table>

          </div>
        <div class="order-summary">
          <h3>Order Summary</h3>
          <hr>
          <div class="total-items">
            <h6>Total Item</h6>
            <h6><?php echo $total_item;?></h6>
          </div>
          
          <div class="total-items">
            <h6>Total Payment</h6>
            <h6>
              <b>&#163;
                <?php
                unset($_SESSION['totalprice']);
                $_SESSION['totalprice'] = $totalprice;
                echo $totalprice;
                ?>
              </b>
            </h6>
          </div>
        </div>
        <div class="place-btn">
          <input type="submit" name="placeorder" value="Place Order" id="sub"/>
        </div>

        </div>

</form>    
</body>
</html>