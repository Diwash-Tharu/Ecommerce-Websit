<?php
session_start();
include "adminHeader.php";
include "admin_sidebar.php";
    include("../connection.php");
//  echo "<div class='b'>";
    $sql = 'SELECT * FROM "PRODUCT_CATEGORY" ';
    $stid1 = oci_parse($connection,$sql);
    
    oci_execute($stid1);
    echo "<div class='b'>";
    while($row = oci_fetch_array($stid1, OCI_ASSOC)){
        $pid = $row['CATEGORY_TYPE'];
        
        echo "<form action='' method='POST'>";
        echo"<input type='hidden' name='product_id' value='$pid'>"; 
        echo"<input type='submit' name='sub1' value='$pid'>"; 
       echo"  </form>";
       
    }
    echo "</div>";
    ?>

<?php
     include("../connection.php");
     
     
    
    if(isset($_POST['sub1']))
    {
        // if($_POST['sub']==)
        $data=$_POST['product_id'];
        //  $data;


                $sql = 'SELECT * FROM "PRODUCT_CATEGORY" WHERE CATEGORY_TYPE= :trader';
                $stid1 = oci_parse($connection,$sql);
                oci_bind_by_name($stid1 , ':trader',$data);
                oci_execute($stid1);
                while($row = oci_fetch_array($stid1, OCI_ASSOC)){
                    $pid = $row['PRODUCT_CATEGORY_ID'];
                }

                // echo $pid;
                

               echo "<div class='more'>";
                $sql = 'SELECT * FROM "PRODUCT" WHERE PRODUCT_CATEGORY_ID= :product';
                $stid2 = oci_parse($connection,$sql);
                oci_bind_by_name($stid2 , ':product',$pid);
                oci_execute($stid2);
                        
                // echo "<div class='t'>";
                //     echo "<table cellpadding='15' cellspacing='2' border='0' class=''>";
                //     echo "<th>Product Id</th>
                //     <th>PRICE</th>
                //     <th>QUANTITY</th>
                //     <th>STOCK_CHECK</th>
                //     <th>SHOP_ID</th>
                //     <th>PRODUCT_IMAGE</th>"; 

                    while($row = oci_fetch_array($stid2, OCI_ASSOC))
                    {



                        // $pid = $row['PRODUCT_ID'];
                        // echo "<a href='display_selected_prd.php?s_name=$img_name&s_id=$pid' class='single'>";
                            echo "<div class='card_info'>";
                            echo "<img src=\"../dbimage/product/".$row['PRODUCT_IMAGE']."\" alt=".$row['PRODUCT_NAME']." >";
                                echo "<div class='card-info'>";
                                    echo "<div class='card-details'>";
                                        // echo "<label>P_ID :  ".$row['PRODUCT_ID']."</label>";
                                        echo "<label>Name:  ".substr($row['PRODUCT_NAME'],0,25)."</label>";
                                        echo "<label>Price:  <span> &pound; ".$row['PRICE'] ."<span></label>";
                                    echo "</div>";
                                echo "</div>"; 
    
                                // echo "<div class='btns'>";
                                //     // echo "<a href='update.php?cat=EditProduct&id=$pid&action=edit' id='edit' ><i class='fa fa-shopping-cart' style='font-size:36px'></i></a>";
                                //     // echo "<a href='deleteP.php?&id=$pid&action=delete' id='delete' >Wish List</a>";
                                // echo "</div>";
                        
                            echo "</div>";



                            // $id = $row['PRODUCT_ID'];
                        
                            // echo "<tr>";
                            
                            //         echo "<td>".$row['PRODUCT_ID']."</td>
                            //         <td>".$row['PRICE']."</td>
                            //         <td>".$row['QUANTITY']."</td>
                            //         <td>".$row['STOCK_CHECK']."</td>
                            //         <td>".$row['SHOP_ID']."</td>"; 
                            //         echo "<td>"."<img src=\"../dbimage/product/".$row['PRODUCT_IMAGE']."\"  width='100 'height='100' >" ."</td>" ; 
                                    
                            //         echo "<tr>";
                    }
                    // echo "</table>";
                    echo "</div>";
                }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="admindashboard.css"></link>
    <link rel="stylesheet" href="../home1dassb.css"></link>

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