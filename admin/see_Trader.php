<?php
        session_start();

include "adminHeader.php";
include "admin_sidebar.php";
    include("../connection.php");

                $trader_data='trader';
                $sql = 'SELECT * FROM "USER" WHERE USER_ROLE = :trader';
                $extract = oci_parse($connection,$sql);
                oci_bind_by_name($extract , ':trader',$trader_data);
                oci_execute($extract);
                        
                echo "<div class='t'>";
                    echo "<table cellpadding='15' cellspacing='2' border='0'>";
                    
                    echo "<tr id='heading'>
                    <td>User Id</td>
                    <td>Role</td>
                    <td>First Name </td>
                    <td>Last Name </td>
                    <td>Email</td>
                    <td>Phone_No</td>
                    <td>Gender</td>
                    <td>Age</td>
                    <td>Status</td>
                    <td>Trader_Catogery</td> 
                    <td>Accepet</td> 
                    <td>Reject</td> 
                    
                    </tr>"; 

                    while($row = oci_fetch_array($extract, OCI_ASSOC))
                    {
                            $id = $row['USER_ID'];
                        
                            echo "<tr>";
                                    echo "<td>".$row['USER_ID']."</td>
                                    <td>".$row['USER_ROLE']."</td>
                                    <td>".$row['FIRST_NAME']."</td>
                                    <td>".$row['LAST_NAME']."</td>
                                    <td>".$row['EMAIL']."</td>
                                    <td>".$row['PHONE_NO']."</td>
                                    <td>".$row['GENDER']."</td>";
                                    
                                    echo "<td>".$row['AGE']."</td>";

                                    if(!empty($row['STATUS']))
                                    {   
                                        echo "<td>".$row['STATUS']."</td>";
                                    }
                                    else
                                    { $err="-----";

                                        echo "<td>".$err."</td>";
                                    }
                                    
                                    if(!empty($row['TRADER_CATEGORY']))
                                    {   
                                        echo "<td>".$row['TRADER_CATEGORY']."</td>";
                                    }
                                    else
                                    { $err="-----";
                                        echo "<td>".$err."</td>";
                                    }
                                echo "<div class='diwash'>";
                                        echo "<td><a href='Trader_approve.php?cat=EditProduct&id=$id&action=approve' id=''>Approve</a> </td>";
                                        echo "<td><a href='admindelete.php?&id=$id&action=delete' id='' >Reject</a></td>";
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
    <link rel="stylesheet" href="admindashboard.css"></link>
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