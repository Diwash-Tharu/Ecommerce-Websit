<?php
session_start();
include "adminHeader.php";
include "admin_sidebar.php";
    include("../connection.php");
            
            echo "<h3>Update or delete shop</h3>";

                $trader_data=$_SESSION['ID'];
                echo $trader_data;
                $sql = 'SELECT * FROM "SHOP" WHERE USER_ID = :trader';
                $extract = oci_parse($connection,$sql);
                oci_bind_by_name($extract , ':trader',$trader_data);
                oci_execute($extract);
                        
                echo "<div class='t'>";
                    echo "<table cellpadding='15' cellspacing='2' border='0'>";
                    
                    echo "<tr id='heading'>
                    <td>Shop_Name</td>
                    <td>Shop Address</td>
                    <td>Shop type</td>
                    <td>Shop_description</td>
                    <td>Update</td>
                    <td>Shop_Delete</td>
                    </tr>"; 

                    while($row = oci_fetch_array($extract, OCI_ASSOC))
                    {
                            $id = $row['USER_ID'];
                        
                            echo "<tr>";
                                    echo "<td>".$row['SHOP_NAME']."</td>
                                    <td>".$row['SHOP_ADDRESS']."</td>
                                    <td>".$row['SHOP_TYPE']."</td>
                                    <td>".$row['SHOP_DESCRIPTION']."</td>";
                                    
                                echo "<div class='d'>";
                                        echo "<td><a href='updateShop.php?cat=EditProduct&id=$id&action=update' id=''>Update</a> </td>";
                                        echo "<td><a href='admindelete.php?&id=$id&action=delete' id='' >DELETE</a></td>";
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
    <link rel="stylesheet" href="../dashboarde.css">
    <title>DELETE SHOP/Update</title>
</head>
<body>
    <script type="text/javascript" src="ajaxWork.js"></script>    
    <script type="text/javascript" src="script.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>