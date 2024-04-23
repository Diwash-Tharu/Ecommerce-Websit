<?php include("header.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body>

<?php ($_SESSION['cart']) ?>
    <div class="container" mt-5>
        <div class="row">
            <div class="col-lg-3">
                <form action="manage_cart.php" method="POST">
                    <div class="card">
                        <img src="ProductImages/Dairy/Butter.jpeg" class="card-img-top">
                        <div class="card-body text-center">
                            <h5 class="card-title">Butter</h5>
                            <p class="card-text">Price: $4</p>
                            <button type="submit" name="Add_To_Cart" class="btn btn-info">Add to Cart</button>
                            <input type="hidden" name="Item_Name" value="dairy1">
                            <input type="hidden" name="Price" value="4">
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-lg-3">
                <form action="manage_cart.php" method="POST">
                    <div class="card">
                        <img src="ProductImages/Dairy/Cheese.jpeg" class="card-img-top">
                        <div class="card-body text-center">
                            <h5 class="card-title">Cheese</h5>
                            <p class="card-text">Price: $10</p>
                            <button type="submit" name="Add_To_Cart" class="btn btn-info">Add to Cart</button>
                            <input type="hidden" name="Item_Name" value="dairy2">
                            <input type="hidden" name="Price" value="10">
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-lg-3">
                <form action="manage_cart.php" method="POST">
                    <div class="card">
                        <img src="ProductImages/Dairy/Milk.jpeg" class="card-img-top">
                        <div class="card-body text-center">
                            <h5 class="card-title">Milk</h5>
                            <p class="card-text">Price: $5</p>
                            <button type="submit" name="Add_To_Cart" class="btn btn-info">Add to Cart</button>
                            <input type="hidden" name="Item_Name" value="dairy3">
                            <input type="hidden" name="Price" value="5">
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-lg-3">
                <form action="manage_cart.php" method="POST">
                    <div class="card">
                        <img src="ProductImages/Dairy/Icecream.jpeg" class="card-img-top">
                        <div class="card-body text-center">
                            <h5 class="card-title">IceCream</h5>
                            <p class="card-text">Price: $6</p>
                            <button type="submit" name="Add_To_Cart" class="btn btn-info">Add to Cart</button>
                            <input type="hidden" name="Item_Name" value="dairy6">
                            <input type="hidden" name="Price" value="5">
                        </div>
                    </div>
                </form>
            </div>

    </div>
</div>
</body>
</html>