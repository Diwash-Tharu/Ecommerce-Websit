<?php
session_start();
    if(isset($_POST['searchbtn'])){
        $search = $_POST['search_item'];

        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
    
    <nav class="navbar navbar-expand-lg bg- pb-3  px-5">
    <div class="container-fluid d-flex justify-content-between pt-3">
    <!-- logo     -->
    <a class="navbar-bran" href="home1.php"><img src="./dbimage/Logo2.png" alt="logo" style="height: 52px;" /></a>
        
        <form class="d-flex w-25" role="search" method='post' action='' >
            <input class="form-control  me-2  w-201" type="search" name='search_item' placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success bg-warning " name='searchbtn' type="submit" ><i class="fa fa-search" style="font-size:25px"></i></button>
        </form>

        <ul class="navbar-nav  my-2 my-lg-0 " style="--bs-scroll-height: 100px;">
        
        <?php
        if(empty($_SESSION['ID']))
        
        {
        echo   "<li class='nav-item dropdown'>";
        echo   "<a class='nav-link dropdown-toggle' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'>";
        echo        "Sign Up";
        echo    "</a>";
        echo    "<ul class='dropdown-menu '>";
        echo    "<li><a class='dropdown-item' href='registerCustomer.php'>Sigup as Customer</a></li>";
        echo    "<li><a class='dropdown-item' href='registerTrader.php'>Signup as Trader</a></li>";
        echo    "</ul>";
        echo    "</li>";
        }
        else
        {
        // echo    "<li class='nav-item'>";
        // echo    "<a class='nav-link' href='#'> Log Out</a>";
        // echo    "</li>";
        }
        ?>

            
            <li class="nav-item">
            <a class="nav-link" href="customer/mycart.php"> <i class="fa fa-shopping-cart m-20" style="font-size:30px; padding-block: 2px; "></i> Cart</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="customer/wishlist.php"><i class="fa fa-heart" style='font-size:30px;'></i> Wish List</a>
            </li>

              <!-- for profile -->

              <?php
            ini_set('error_reporting', 0);
            ini_set('display_errors', 0);
            if(empty($_SESSION['role']))
            {
                

                 echo "<li class='nav-item dropdown '>";
                echo   "<a class='nav-link' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'> <i class='fa fa-user' style='font-size:28px;'></i> </a>";
                echo    "<ul class='dropdown-menu bg-primary text-white  top-10 start-0 '>";
      
                echo    "<li><a class='dropdown-item bg-primary text-white' href='login.php'>log In</a></li>";
                echo    "</ul>";
                echo    "</li>";
            }
            if($_SESSION['role']=='customer')
                
            {
                echo "<li class='nav-item dropdown '>";
                echo   "<a class='nav-link' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'> <i class='fa fa-user' style='font-size:28px;'></i> </a>";
                echo    "<ul class='dropdown-menu top-10 start-0'>";
                echo    "<li><a class='dropdown-item' href='customer/customerProfile.php'>View Profile</a></li>";
                echo    "<li><a class='dropdown-item bg-danger text-white' href='logout.php'>log Out</a></li>";
                echo    "</ul>";
                echo    "</li>";
                }
                if($_SESSION['role']=='trader')
                { 
                    echo "<li class='nav-item dropdown '>";
                echo   "<a class='nav-link' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'> <i class='fa fa-user' style='font-size:28px;'></i> </a>";
                echo    "<ul class='dropdown-menu top-10 start-0'>";
                echo    "<li><a class='dropdown-item' href='trader/traderdashboard.php'>View Dashboard</a></li>";
                echo    "<li><a class='dropdown-item' href='logout.php'>log Out</a></li>";
                echo    "</ul>";
                echo    "</li>";
                }
                if($_SESSION['role']=='admin')
                {
                    echo "<li class='nav-item dropdown '>";
                echo   "<a class='nav-link' href='' role='button' data-bs-toggle='dropdown' aria-expanded='false'> <i class='fa fa-user' style='font-size:28px;'></i> </a>";
                echo    "<ul class='dropdown-menu top-10 start-0'>";
                echo    "<li><a class='dropdown-item' href='admin/Admin_dashboard.php'>View Dashboard</a></li>";
                echo    "<li><a class='dropdown-item' href='logout.php'>log Out</a></li>";
                echo    "</ul>";
                echo    "</li>";

                }
            
            ?>
           
        </ul>

    </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>
</html>