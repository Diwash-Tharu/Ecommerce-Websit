

<div class="sidebar" id="mySidebar">
    <div class="side-header">
    <img src="../dbimage/Logo2.png" width="120" height="90" alt="wesite logo">
        <h5 style="margin-top:10px;">Hello, <?php echo $_SESSION['username']; ?></h5>
    </div>

    <hr style="border:1px solid; background-color:#8a7b6d; border-color:#3B3131;">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    <a href="traderdashboard.php"><i class="fa fa-home"></i> Dashboard</a>
    <!-- <input type="submit" name="submit" value="add shop" onclick="showCategory()"> <i class="fa fa-users"> -->
    <a href="addshop.php"><i class="fa fa-users"></i> Add Shop</a>
    <a href="addproduct.php" onclick="showCategory()"><i class="fa fa-th-large"></i> Add Product</a>
    <a href="display.php" onclick="showSizes()"><i class="fa fa-th"></i> update & delete Product</a>
    <a href="" onclick="showProductSizes()"><i class="fa fa-th-list"></i>Edit Profile</a>
    <a href="u_d_Shop.php"   onclick="showProductItems()" ><i class="fa fa-th"> Edit shop</i></a>
    <a href="#orders" onclick="showOrders()"><i class="fa fa-list"></i>Disscount</a>

</div>

<div id="main">
    <button class="openbtn" onclick="openNav()"><i class="fa fa-home"></i></button>
</div>