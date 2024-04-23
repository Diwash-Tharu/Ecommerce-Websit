

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admindashboard.css">
    <title>Document</title>
</head>
<body>
<?php
include('../connection.php');
$data ='SELECT  *FROM "PAYMENT"' ;
          $extract = oci_parse($connection,$data);
        //   oci_bind_by_name($extract , ':u_id',$id);   
          oci_execute($extract);
          while($rows = oci_fetch_array($extract, OCI_ASSOC))
          {
            $ca_id= $rows['ORDER_ID'];
            $qu ='SELECT  *FROM "ORDER"' ;
            $process = oci_parse($connection,$qu);
        //   oci_bind_by_name($extract , ':u_id',$id);   
            oci_execute($process);
            ini_set('error_reporting', 0);
            ini_set('display_errors', 0);
            while($row = oci_fetch_array($process, OCI_ASSOC))
          {
                $o_id=$row['ORDER_ID'];
                $process= 'SELECT  *FROM "ORDER_PRODUCT"' ;
                $dat = oci_parse($connection,$process);
                // oci_bind_by_name($data , ':u_id',$o_id);   
                oci_execute($dat);
                while($roll = oci_fetch_array($dat, OCI_ASSOC))
                {

                    $pid=$roll['PRODUCT_ID'];
                    $nop = $roll['NO_OF_PROD'];
                    // echo $pid. "\n";
                    // echo $nop ."\n";

                    $pro= 'SELECT  *FROM "PRODUCT" WHERE PRODUCT_ID=:p_id ' ;
                    $da = oci_parse($connection,$pro);
                    oci_bind_by_name($da , ':p_id',$pid);  
                    oci_execute($da);
                    while($exec = oci_fetch_array($da, OCI_ASSOC))
                    {
                        $sh_id= $exec['SHOP_ID'];

                    $proc= 'SELECT  *FROM "SHOP" WHERE SHOP_ID=:s_id ' ;
                    $tbc = oci_parse($connection,$proc);
                    oci_bind_by_name($tbc , ':s_id',$sh_id);  
                    oci_execute($tbc);
                    while($loo = oci_fetch_array($tbc, OCI_ASSOC))
                    {
                        $u_id= $loo['USER_ID'];
                    
                    $proce= 'SELECT  *FROM "USER" WHERE USER_ID=:u_id ' ;
                    $tbcs = oci_parse($connection,$proce);
                    oci_bind_by_name($tbcs , ':u_id',$u_id);  
                    oci_execute($tbcs);
                    while($lp = oci_fetch_array($tbcs, OCI_ASSOC))
                    {
                    $total=$exec['PRICE']*$roll['NO_OF_PROD'];
                    //    echo  $email=$lp['EMAIL'];
                    
                        echo "<div class='t'>";
                        echo "<table cellpadding='15' cellspacing='2' border='0'>";   
                        echo "<tr id='heading'>
                        <td>USER_ID</td>
                        <td>EAMIL</td>
                        <td>Order Quantitiy</td>
                        <td>Price</td>
                        <td>Total Amount</td>
                        <td>Status</td>
                        <td>PAY Status</td>
                        </tr>"; 

                        $uid=$lp['EMAIL'];
                                echo "<tr>";
                                        echo "<td>".$lp['USER_ID']."</td>
                                        <td>".$lp['EMAIL']."</td>
                                        <td>".$roll['NO_OF_PROD']."</td>
                                        <td> &pound; ".$exec['PRICE']."</td>
                                        <td> &pound; ". $total."</td>
                                        <td>". $roll['STATUS']."</td>";
                                        
                            
                                  
                                            echo "<td><a href='payment_mail.php?id=$pid&tot=$total&uid=$uid'>Transfer To</a></td>";
                                           
                                    echo "</div>";
                                echo "</tr>";
                            }  
                        echo "</table>";  
                        echo "</div>";
                        }
                    }
                }
                }
            
          }
        
        
?>
</body>
</html>