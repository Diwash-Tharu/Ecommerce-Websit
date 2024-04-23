<?php
session_start();

    include("../connection.php");

          $id=27;
    
        //   $id=$_SESSION['ID'];
          $data ='SELECT  *FROM "CART" WHERE USER_ID=:u_id' ;
          $extract = oci_parse($connection,$data);
          oci_bind_by_name($extract , ':u_id',$id);   
          oci_execute($extract);
          $rows = oci_fetch_array($extract, OCI_ASSOC);
          $ca_id= $rows['CART_ID'];


          $data ='SELECT  * FROM "ORDER" WHERE CART_ID=:o_id' ;
          $ext = oci_parse($connection,$data);
          oci_bind_by_name($ext , ':o_id',$ca_id);   
          oci_execute($ext);
        //   $row = oci_fetch_array($ext, OCI_ASSOC);
          

            echo "<div class='t'>";
                    echo "<table cellpadding='15' cellspacing='2' border='0'>";
                    
                    echo "<tr id='heading'>
                    <td>Order id</td>
                    <td>Order Date</td>
                    <td>Order Quantitiy</td>
                    <td>Total Amount</td>
                    <td>Invoice No</td>
                    <td>Cart Id</td>
                    <td>Collection Sold Id</td>
                    <td>View Product</td>

                    
                    
                    </tr>"; 

                    while($row = oci_fetch_array($ext, OCI_ASSOC))
                    {
                            $id = $row['ORDER_ID'];
                        
                            echo "<tr>";
                                    echo "<td>".$row['ORDER_ID']."</td>
                                    <td>".$row['O_DATE']."</td>
                                    <td>".$row['ORDER_QUANTITY']."</td>
                                    <td>".$row['TOTAL_AMOUNT']."</td>
                                    <td>".$row['INVOICE_NO']."</td>
                                    <td>".$row['CART_ID']."</td>
                                    <td>".$row['COLLECTION_ID']."</td>";
                                    
                                   
                                echo "<div class='diwash'>";
                                        echo "<td><a href='See_order_product.php?cat=EditProduct&id=$id&action=view shop' id=''>View Product</a></td>";
                                        // echo "<td><a href='admindelete.php?&id=$id&action=delete' id='' >Reject</a></td>";
                                echo "</div>";
                            echo "</tr>";
                        }  
                      echo "</table>";  
                    echo "</div>";
                    
                  
                
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="widtd=device-widtd, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../admin/admindashboard.css"></link>
    <title>View Trader</title>
</head>
<body>
    <script type="text/javascript" src="ajaxWork.js"></script>    
    <script type="text/javascript" src="script.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>