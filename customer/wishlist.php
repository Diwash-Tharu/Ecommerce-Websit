<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    session_start();
  
    include("../connection.php");
    $p_id= $_GET['id'];
   
    $u_id= $_SESSION['ID'];
                $sql='SELECT *FROM "WISHLIST" WHERE USER_ID= :u_id';
                $stid1 = oci_parse($connection,$sql);
                // oci_bind_by_name($stid1,':ps_id' ,$_GET['s_id']);
                oci_bind_by_name($stid1,':u_id' ,$u_id);
                oci_execute($stid1);
                while($row = oci_fetch_array($stid1,OCI_ASSOC)){
                    $w_id=$row['WISHLIST_ID'];
                }
                if(empty($w_id))
                {
                    $querry ='INSERT INTO "WISHLIST" (USER_ID) VALUES(:u_id)';
                    $process = oci_parse($connection,$querry);
                    
                    oci_bind_by_name($process, ':u_id', $u_id);
                    oci_execute($process);    

                    $sql='SELECT *FROM "WISHLIST" WHERE USER_ID= :u_id';
                    $stid1 = oci_parse($connection,$sql);
                    // oci_bind_by_name($stid1,':ps_id' ,$_GET['s_id']);
                    oci_bind_by_name($stid1,':u_id' ,$u_id);
                    oci_execute($stid1);
                    while($row = oci_fetch_array($stid1,OCI_ASSOC)){
                        $w_id=$row['WISHLIST_ID'];
                    }
                    $querry ='INSERT INTO "WISHLIST_PRODUCT" (WISHLIST_ID,PRODUCT_ID) VALUES(:w_id,:p_id)';
                    $insert = oci_parse($connection,$querry);
                    
                    oci_bind_by_name($insert, ':w_id', $w_id);
                    oci_bind_by_name($insert, ':p_id', $p_id);
                    oci_execute($insert);  
                }
                else
                {
                    $sql_query = 'SELECT COUNT(*) AS NUMBER_OF_ROWS FROM "WISHLIST_PRODUCT" WHERE WISHLIST_ID=:w_id AND PRODUCT_ID=:p_id';
                    $data_qu = oci_parse($connection, $sql_query);
                    oci_bind_by_name($data_qu, ':w_id', $w_id);
                    oci_bind_by_name($data_qu, ':p_id', $p_id);
                    oci_define_by_name($data_qu, 'NUMBER_OF_ROWS', $number_of_rows);
                    oci_execute($data_qu);
                    oci_fetch($data_qu);
                    echo $number_of_rows;
                    if( $number_of_rows>=1)
                    {
                        // echo "you have enterd the data before";
                        echo "<script>alert('This Project is already added');
                        document.location.href='display_selected_prd.php?s_id=$id';</script>";  
                    }
                    else
                    {
                        $querry ='INSERT INTO "WISHLIST_PRODUCT" (WISHLIST_ID,PRODUCT_ID) VALUES(:w_id,:p_id)';
                        $insert = oci_parse($connection,$querry);
                        
                        oci_bind_by_name($insert, ':w_id', $w_id);
                        oci_bind_by_name($insert, ':p_id', $p_id);
                        oci_execute($insert);  
                        "<script>alert('Product is added');
                        document.location.href='display_selected_prd.php?s_id=$id';</script>"; 

                    }
                    

                }
            
    ?>
</body>
</html>