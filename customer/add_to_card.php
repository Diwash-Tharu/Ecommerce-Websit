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

    // if(!empty($_SESSION['ID']))
    // {
    session_start();
    include("../connection.php");
    if(isset($_GET['id']) || ($_GET['num'])){

    $p_id= $_GET['id'];
    $quantity= $_GET['num'];

    $num= (int)$quantity;
    $u_id= $_SESSION['ID']; 
    // $u_id= 2; 
    // $u_id= 1; 
    // echo $u_id;
    // echo $num;
    // echo $id;


                    $sql='SELECT *FROM "CART" WHERE USER_ID= :u_id';
                    $stid1 = oci_parse($connection,$sql);
                    // oci_bind_by_name($stid1,':ps_id' ,$_GET['s_id']);
                    oci_bind_by_name($stid1,':u_id' ,$u_id);
                    oci_execute($stid1);
                    while($row = oci_fetch_array($stid1,OCI_ASSOC)){
                        $c_id=$row['CART_ID'];
                    }
                    
                    if(empty($c_id))
                    {
                        $querry ='INSERT INTO "CART" (USER_ID) VALUES(:u_id)';
                        $stids = oci_parse($connection,$querry);
                        oci_bind_by_name($stids, ':u_id', $u_id);
                        // oci_bind_by_name($stids, ':w_id', $Cshop_ty);  
                        oci_execute($stids);    

                        $sql='SELECT *FROM "CART" WHERE USER_ID= :ps_id';
                        $stid1 = oci_parse($connection,$sql);
                        // oci_bind_by_name($stid1,':ps_id' ,$_GET['s_id']);
                        oci_bind_by_name($stid1,':ps_id' ,$u_id);
                        oci_execute($stid1);
                        while($row = oci_fetch_array($stid1,OCI_ASSOC)){
                            $cart_id=$row['CART_ID'];
                        }
                        $querry ='INSERT INTO "CART_PRODUCT" (CART_ID,PRODUCT_ID,NUMBER_OF_PRODUCT) VALUES(:c_id,:p_id,:c_item)';
                        $sti = oci_parse($connection,$querry);
                        
                        oci_bind_by_name($sti, ':c_id', $cart_id);
                        oci_bind_by_name($sti, ':p_id',$p_id);
                        oci_bind_by_name($sti, ':c_item', $num);
                        // oci_bind_by_name($stid, ':shop_type', $Cshop_ty);          
                        if(oci_execute($sti))
                        // oci_execute($sti);
                        {
                            // echo '<script>alert("Product is added")</script>';
                            // exit();

                            // echo "<script>alert('Product is added');
                            // document.location.href='http://localhost/project/chz/display_selected_prd.php?s_id=$id';</script>";



                            // echo "cart is added";
                            // header("location:../display_selected_prd.php?s_id=$id");
                        }
                    }


                    else
                    {
                        $sql_query = 'SELECT COUNT(*) AS NUMBER_OF_ROWS FROM "CART_PRODUCT" WHERE CART_ID=:c_id AND PRODUCT_ID=:p_id';
                        $data_qu = oci_parse($connection, $sql_query);
                        oci_bind_by_name($data_qu, ':c_id', $c_id);
                        oci_bind_by_name($data_qu, ':p_id', $p_id);
                        oci_define_by_name($data_qu, 'NUMBER_OF_ROWS', $number_of_rows);
                        oci_execute($data_qu);
                        oci_fetch($data_qu);

                        echo $number_of_rows;

                        if( $number_of_rows>=1)
                        {
                          
                            echo "<script>alert('Product is added');
                        document.location.href='../display_selected_prd.php?s_id=$p_id';</script>";
                        }
                        else
                        {

                            $querry ='INSERT INTO "CART_PRODUCT" (CART_ID,PRODUCT_ID,NUMBER_OF_PRODUCT) VALUES(:c_id,:p_id,:c_item)';
                            $sti = oci_parse($connection,$querry);
                            oci_bind_by_name($sti, ':c_id', $c_id);
                            oci_bind_by_name($sti, ':p_id', $p_id);
                            oci_bind_by_name($sti, ':c_item', $num);
                                
                            if(oci_execute($sti))
                            {

                                    

                             echo "<script>alert('Product is added');
                                document.location.href='../display_selected_prd.php?s_id=$p_id';</script>";
                            }
                        
                    }
                }
                    
        }
// }
// else
// {
//  header("location:../login.php");
// }
    ?>
</body>
</html>