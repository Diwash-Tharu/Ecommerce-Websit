<?php
    session_start();
    include("../connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body class="bg-light">

    <div class="container bg-dark text-light p-3 rounded my-4">
        <div class="d-flex alig-items-center justify-content-between px-3">
            <h2>
                <a href="index.php" class="text-white text-decoration-none">
                    <i class="bi bi-bar-chart-fill"></i> Product Store
                </a>
            </h2>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addproduct">
                <i class="bi bi-plus-lg"></i> Add Product
            </button>
        </div>
    </div>

    <div class="container mt-5 p-0">
        <table class="table table-hover text-center">
            <thead class="bg-dark text-light">
                <tr>
                    <th width="10%" scope="col" class="">Sr. No.</th>
                    <th width="15%" scope="col">Image</th>
                    <th width="10%" scope="col">Name</th>
                    <th width="10%" scope="col">Price</th>
                    <th width="35%" scope="col">Description</th>
                    <th width="20%" scope="col" class="rounded-end">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <?php 
                $trader_data=$_SESSION['ID'];
                echo $trader_data;
                $sql = 'SELECT * FROM "WISHLIST" WHERE USER_ID = :trader';
                $extract = oci_parse($connection,$sql);
                oci_bind_by_name($extract , ':trader',$trader_data);
                oci_execute($extract);
                while($wilst = oci_fetch_array($extract, OCI_ASSOC))
                {
                        $wis_id=$wilst['WISHLIST_ID'];
                
                    $sql = 'SELECT * FROM "WISHLIST_PRODUCT" WHERE WISHLIST_ID= :wish_list';
                    $extract = oci_parse($connection,$sql);
                    oci_bind_by_name($extract , ':wish_list',$wis_id);
                    oci_execute($extract);
                    while($wilst_pr = oci_fetch_array($extract, OCI_ASSOC))
                    {
                        $prod_id=$wilst_pr['PRODUCT_ID'];

                        $sql = 'SELECT * FROM "PRODUCT" WHERE PRODUCT_ID= :prd_id';
                         $extract = oci_parse($connection,$sql);
                        oci_bind_by_name($extract , ':prd_id',$prod_id);
                        oci_execute($extract);
                        while($all = oci_fetch_array($extract, OCI_ASSOC)){
                    $i=1;        
                    echo    "<tr class='align-middle'>";
                    echo    "<th scope='row'>$i</th>";
                    // echo    "<td>".$all['W_CREATED_DATE']."</td>";\
                   echo "<td class='img'>";
                    echo "<img src=\"../dbimage/product/" . $all['PRODUCT_IMAGE'] . "\" alt='' / class='img-thumbnail'> ";
                    echo "</td>";
                    echo    "<td>".$all['PRODUCT_NAME']."</td>";
                    echo    "<td>".$all['PRICE']."</td>";
                    echo    "<td>".$all['PRODUCT_DESCRIPTION']."</td>";
                    echo    "<td>";
                    echo   "<button><a href='add_to_card.php?&id=$prod_id&action=delete' id='delete'&wid=$wis_id>Add To Card</a></button>";
                    echo   "<button><a href='deletemywish.php?&id=$prod_id&action=delete' id='delete'>Remove</a></button>";
                    echo   "</td>";
                    echo    "</tr>";
                    $i++;
                    
                }
            }
        }
                    

                ?>
            </tbody>
        </table>
    </div>


    <div class="modal fade" id="addproduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="crud.php" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Product</h5>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <span class="input-group-text">Name</span>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Price</span>
                    <input type="number" class="form-control" name="price" min="1" required>
                </div>
                <div class="input-group">
                    <span class="input-group-text">Description</span>
                    <textarea class="form-control" name="desc" required></textarea>
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text">Image</label>
                    <input type="file" class="form-control" name="image" accept=".jpg,.png,.svg" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success" name="addproduct">Add</button>
            </div>
            </div>
            </form>
        </div>
</div>
    
</body>
</html>