
<div class="sidebar" id="mySidebar">
<div class="side-header">
    <img src="../dbimage/Logo2.png" width="120" height="100" alt="wesite logo"> 
    <h5 style="margin-top:10px;">Hello, <?php echo $_SESSION['username']; ?></h5>
</div>
<hr style="border:1px solid; background-color:#8a7b6d; border-color:#3B3131;">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    <a href="Admin_dashboard.php" ><i class="fa fa-home" ></i> Dashboard</a>
    <a href="update_profileSample.php" ><i class="fa fa-user"> Edit Profile</i></a>
    <!-- <input type="submit" name="submit" value="add shop" onclick="showCategory()"> <i class="fa fa-users"> -->
    <a  href="approve.php"><i class="fa fa-users"></i> Request</a>
    <a href="#category"   onclick="showCategory()" ><i class="fa fa-th-large"></i> View Report</a>
    <a href="videwall_trader.php"   onclick="showSizes()" ><i class="fa fa-th"></i> View Trader and accpet product</a>
    <a href="see_Trader.php"   onclick="showProductSizes()" ><i class="fa fa-th-list"></i> view & approve Trade</a>    
    <a href="adminS_C.php"   onclick="showProductItems()" ><i class="fa fa-th"></i> View User</a>
    
    <a href="#orders" onclick="showOrders()"><i class="fa fa-list"></i>Add Shop Request</a>
  
  <!---->
</div>
 
<div id="main">
    <button class="openbtn" onclick="openNav()"><i class="fa fa-home"></i></button>
</div>


