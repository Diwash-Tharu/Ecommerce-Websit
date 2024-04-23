<?php
session_start();
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

<form>
          <table>
            <!-- table heading -->

            <tr>
            <th>Order ID</th>
            <th>Order Date</th>
              <th>Order Quantity</th>
              <th>Total Amount</th>
              <th>Invoice Number</th>
              <th>Cart Id</th>
              <th>Collection_Id</th>


           
            </tr>

           
            <?php
            include("../connection.php");
         
            // echo $_SESSION['ID'];
      




            // $data=21;
            $sql = 'SELECT * FROM "CART" WHERE USER_ID = :u_id';
            $qu = oci_parse($connection, $sql);
            oci_bind_by_name($qu, ":u_id", $_SESSION['ID']);
            oci_execute($qu);
            while ($row = oci_fetch_array($qu, OCI_ASSOC)) {
            $cart_id=$row['CART_ID'];
        }

        echo $cart_id;

            $sql = 'SELECT * FROM "ORDER" WHERE CART_ID = :u_id';
            $stmts = oci_parse($connection, $sql);
            oci_bind_by_name($stmts, ":u_id", $cart_id);
            oci_execute($stmts);
            while ($data = oci_fetch_array($stmts, OCI_ASSOC)) {
            //   $cid = $row['CART_ID'];
                echo "<tr>";
                echo  "<td>" . $data['ORDER_ID'] . "</td>";
                echo  "<td>".$data['O_DATE']. "</td>";
                echo  "<td>" . $data['ORDER_QUANTITY'] . "</td>";
                echo  "<td>" . $data['TOTAL_AMOUNT'] . "</td>";
                echo  "<td>" . $data['INVOICE_NO'] . "</td>";
                echo  "<td>" . $data['CART_ID'] . "</td>";
                echo  "<td>" . $data['COLLECTION_ID'] . "</td>";
                 echo "</tr>";
              }
            
            ?>

          </table>

        </form> 
</div>   
</body>
</html>