<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="displayProsd.css"></link>
    <link rel="stylesheet" href="../dashboarde.css"></link>
    <title>Document</title>

</head>
<body>


    
<?php
session_start();
            include "adminHeader.php";
            include "admin_sidebar.php";
            include('../connection.php');
           
        //     include "./config/dbconnect.php";
        echo "<div class ='text_name'>";
        // echo "Welcome mr ".$_SESSION['username'];
        echo "</div>"
        // ?>
<div class="shopitems">
            <?php
                    $sql = 'SELECT * FROM "PRODUCT" ';
                    $stid1 = oci_parse($connection,$sql);
                    // oci_bind_by_name($stid,':id',;
                // }
                
    
                oci_execute($stid1);
                
                echo "<div class=all>";
                while($row = oci_fetch_array($stid1, OCI_ASSOC)){
                    $pid = $row['PRODUCT_ID'];
                    // $s_id = 9008;
                    
                    // $sql1 = 'SELECT * FROM "PRODUCT" WHERE PRODUCT_ID = :s_id ';
                    //         $stid1 = oci_parse($connection,$sql1);
                    //         oci_bind_by_name($stid1 , ':s_id', $s_id);

                    //         // oci_define_by_name($stid1 , 'SHOPNAME', $shopname);
                    //         oci_execute($stid1);
                            
                    //         // echo $shopname;

              

             //echo "<img src=\"../dbimage/product/".$row['PRODUCT_IMAGE']."\" alt=".$row['PRODUCT_NAME']." >";
                    // if(oci_fetch($stid1))
                    // {


                        echo "<div class='card_info'>";
                        echo "<div class= 'img'> ";
                        echo "<img src=\"../dbimage/product/".$row['PRODUCT_IMAGE']."\" alt=".$row['PRODUCT_NAME']." >";
                        echo "</div>" ;   
                        echo "<div class='card-info'>";
                                echo "<div class='card-details'>";
                                    echo "<label>P_ID :  ".$row['PRODUCT_ID']."</label>";
                                    echo "<label>Name:  ".substr($row['PRODUCT_NAME'],0,25)."</label>";
                                    
                                    // echo "<label>Shop Name:  ". substr($shopname,0,25)."</label>";

                                    echo "<label>Price:  <span> &pound; ".$row['PRICE'] ."<span></label>";
                                echo "</div>";
                                
                                // echo "<div class='image'>";
                                //     echo "<img src=\"../db/uploads/products/".$row['PRODUCT_IMAGE']."\" alt=".$row['PRODUCT_NAME']." >";
                                // echo "</div>";
                            // echo "</div>"; 
                

        
                            echo "<div class='btns'>";
                                echo "<a href='update.php?cat=EditProduct&id=$pid&action=edit' id='edit'>Update</a>";
                                echo "<a href='deleteP.php?&id=$pid&action=delete' id='delete' >Delete</a>";
                            echo "</div>";
                    
                            echo "</div>";
                            echo "</div>";
                        
                            

                    }
                echo "</div>";

                //}


            ?>
        </div>


        <script type="text/javascript" src="ajaxWork.js"></script>    
    <script type="text/javascript" src="script.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>