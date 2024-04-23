<!DOCTYPE html>
<html>
<head>
  <title>Admin</title>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="./admindashboarda.css"></link>
       <!-- <link rel="stylesheet" href="add.css"></link> -->
  </head>
</head>
<body >
    
        <?php
        session_start();
             include "adminHeader.php";
            include "admin_sidebar.php";
           
        //     include "./config/dbconnect.php";
        // ?>

        <?php
        //   echo "<h3>Welcome </h3>";  echo $_SESSION['username']; "<h3>TO Trader dashboard </h3>";
        ?>
    <div id="main-content" class="container allContent-section py-4">
        <div class="row">
            <div class="col-sm-3">
                <div class="card">
                    <i class="fa fa-users  mb-2" style="font-size: 70px;"></i>
                    <h4 style="color:white;">Total Users</h4>
                    <h5 style="color:white;">
                    <?php
                    include("../connection.php");
                        $trader="trader";
                        $user="customer";
                        
                    $sql_query = 'SELECT COUNT(*) AS NUMBER_OF_ROWS FROM "USER" WHERE USER_ROLE=:trader';

                    $data_qu= oci_parse($connection, $sql_query);
                    oci_bind_by_name($data_qu, ':trader',$user);

                    oci_define_by_name($data_qu, 'NUMBER_OF_ROWS', $number_of_rows);

                    oci_execute($data_qu);

                    oci_fetch($data_qu);

                    echo $number_of_rows;
                    
                    ?></h5>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <i class="fa fa-th-large mb-2" style="font-size: 70px;"></i>
                    <h4 style="color:white;">Total Trader</h4>
                    <h5 style="color:white;">
                    <?php
                    $sql_query = 'SELECT COUNT(*) AS NUMBER_OF_ROWS FROM "USER" WHERE USER_ROLE=:trader';

                    $data_qu= oci_parse($connection, $sql_query);
                    oci_bind_by_name($data_qu, ':trader',$trader);

                    oci_define_by_name($data_qu, 'NUMBER_OF_ROWS', $number_of_rows);

                    oci_execute($data_qu);

                    oci_fetch($data_qu);

                    echo $number_of_rows;
                   ?>
                   </h5>
                </div>
            </div>
            <div class="col-sm-3">
            <div class="card">
                    <i class="fa fa-th mb-2" style="font-size: 70px;"></i>
                    <h4 style="color:white;">Total Products</h4>
                    <h5 style="color:white;">
                    <?php
                    
                        // $Pcat_id="QUANTITY";
                       $sum =  'SELECT * FROM "PRODUCT" ';

                        $data_qu = oci_parse($connection,$sum);
                    //    oci_bind_by_name($data_qu, ':id',$Pcat_id);
                    
                        oci_execute($data_qu);
                        $total_sum = 0;
                       // Fetch the results and add each number to the total sum
                        while ($row = oci_fetch_array($data_qu, OCI_ASSOC)) {
                            $total_sum += $row['QUANTITY'];
                        }
                        echo $total_sum;
                        ?>
                </h5>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <i class="fa fa-list mb-2" style="font-size: 70px;"></i>
                    <h4 style="color:white;">Total orders</h4>
                    <h5 style="color:white;">
                    <?php
                        $sql_query = 'SELECT COUNT(*) AS NUMBER_OF_ROWS FROM "ORDER" ';
                        $data_qu= oci_parse($connection, $sql_query);
                        // oci_bind_by_name($data_qu, ':trader',$trader);

                        oci_define_by_name($data_qu, 'NUMBER_OF_ROWS', $number_of_rows);

                        oci_execute($data_qu);

                        oci_fetch($data_qu);

                        echo $number_of_rows;
        ?>
        </h5>
                </div>
            </div>


            <div class="col-sm-3">
                <div class="card">
                    <i class="fa fa-money mb-2" style="font-size: 70px;"></i>
                    <h4 style="color:white;">Total Income</h4>
                    <h5 style="color:white;">
                    <?php
                       $sum =  'SELECT * FROM "PAYMENT" ';

                       $data_qu = oci_parse($connection,$sum);
                   //    oci_bind_by_name($data_qu, ':id',$Pcat_id);
                   
                       oci_execute($data_qu);
                       $total_sum = 0;
                      // Fetch the results and add each number to the total sum
                       while ($row = oci_fetch_array($data_qu, OCI_ASSOC)) {
                           $total_sum += $row['PAY_AMOUNT'];
                       }
                       echo"&pound; ". $total_sum;
        ?>
        </h5>
                </div>
            </div>

        </div>
        
    </div>
    <?php
    // include "trader/addproduct.php";
    ?>   

            
        <?php
            // if (isset($_GET['category']) && $_GET['category'] == "success") {
            //     echo '<script> alert("Category Successfully Added")</script>';
            // }else if (isset($_GET['category']) && $_GET['category'] == "error") {
            //     echo '<script> alert("Adding Unsuccess")</script>';
            // }
            // if (isset($_GET['size']) && $_GET['size'] == "success") {
            //     echo '<script> alert("Size Successfully Added")</script>';
            // }else if (isset($_GET['size']) && $_GET['size'] == "error") {
            //     echo '<script> alert("Adding Unsuccess")</script>';
            // }
            // if (isset($_GET['variation']) && $_GET['variation'] == "success") {
            //     echo '<script> alert("Variation Successfully Added")</script>';
            // }else if (isset($_GET['variation']) && $_GET['variation'] == "error") {
            //     echo '<script> alert("Adding Unsuccess")</script>';
            //}
        ?>


    <script type="text/javascript" src="ajaxWork.js"></script>    
    <script type="text/javascript" src="script.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>