<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="home1dassboar.css" />
    
    <title>Document</title>
</head>

<body>
    
        <?php

        include('nav.php');
        include("connection.php")
        ?>
    <div class="slideshow-container">

        <div class="mySlides fade">
            <!-- <div class="numbertext">1 / 3</div> -->
            <img src="dbimage/top-view-assortment-vegetables.jpg" width="100%" height="600px">
            <!-- <div class="text">Caption Text</div> -->
        </div>

        <div class="mySlides fade">
            <!-- <div class="numbertext">2 / 3</div> -->
            <img src="dbimage/top-view-fried-chicken-with-green-onion-sauce.jpg" width="100%" height="600px">
            <!-- <div class="text">Caption Two</div> -->
        </div>

        <div class="mySlides fade">
            <!-- <div class="numbertext">3 / 3</div> -->
            <img src="dbimage/ingredients-making-goulash-stew-stew-gyuvech-top-view-raw-beef-meat-herbs-spices-paprika-vegetables-black-wooden-table.jpg" width="100%" height="600px">
            <!-- <div class="text">Caption Three</div> -->
        </div>

    </div>
    <br>

    <div style="text-align:center" class="but">
        <div class="s">
        <span class="dot"></span>
        <span class="dot"></span>
        <span class="dot"></span>
        </div>
        <button class="button button2">PRODUCT</button>
        <button class="button button2">TRADER</button>
        <p><label for="review">Brief of our website:</label></p>
    </div>

    <script>
    let slideIndex = 0;
    showSlides();

    function showSlides() {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        let dots = document.getElementsByClassName("dot");
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > slides.length) {
            slideIndex = 1
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
        setTimeout(showSlides, 1300); // Change image every 2 seconds
    } 
     
    </script>
    <div class="nav">

        <ul>
            <h4>Search By Category</h4>
            <li><a href="#home">Home</a></li>
            <li><a href="#news">News</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a href="#about">About</a></li>
        </ul>

        <div>
            <img src="./dbimage/sale image1.jpg" class="image1"alt="Description of the image" width="500" height="200">
            <img src="./dbimage/sale image 2.jpg" class="image2" alt="Description of the image" width="500" height="200">
        </div>

        <textarea id="w3review" name="w3review" rows="10" cols="150">
          there u can write any thind
            </textarea>
    </div>



    <div id="div">
        OUR Trader
    </div>


    <div class="shopitems">
        <?php
                    
              
                    $trader_data='trader';
                    $sql = 'SELECT * FROM "USER" WHERE 	USER_ROLE=:trader ';
                    $trader = oci_parse($connection,$sql);
                    oci_bind_by_name($trader , ':trader',$trader_data);
                    oci_execute($trader);
                    
                while($rows = oci_fetch_array($trader, OCI_ASSOC)){
                    // $pid = $row['PRODUCT_ID'];
                    // $img_name=$row['PRODUCT_NAME'];
                    // echo "<a href='display_selected_prd.php?s_name=$img_name&s_id=$pid' class='single'>";
                        echo "<div class='card_info'>";
                            echo "<img src=\"dbimage/".$rows['IMAGE']."\" alt=".$rows['TRADER_CATEGORY']." >";
                            echo "<div class='card-info'>";
                                echo "<div class='card-details'>";
                                echo "<div class='logo'>";
                                echo "<img src=\"dbimage/".$rows['TRADER_LOGO']."\" alt=".$rows['TRADER_CATEGORY']." >";
                                echo "</div>";
                                    // echo "<label>P_ID :  ".$row['PRODUCT_ID']."</label>";
                                    echo "<label>Name: ".substr($rows['TRADER_CATEGORY'],0,25)."</label>";
                                    // echo "<label>Price:  <span> &pound; ".$row['PRICE'] ."<span></label>";
                                echo "</div>";
                            echo "</div>"; 
                            // echo "<div class='btns'>";
                            //     // echo "<a href='update.php?cat=EditProduct&id=$pid&action=edit' id='edit' ><i class='fa fa-shopping-cart' style='font-size:36px'></i></a>";
                            //     // echo "<a href='deleteP.php?&id=$pid&action=delete' id='delete' >Wish List</a>";
                            // echo "</div>";
                        echo "</div>";
                        // echo "</a>";
                    }
        ?>

    </div>


    <div id="div">
        Product
    </div>


    <div class="shopitems">
        <?php
                    
                include("connection.php");

                    $sql = 'SELECT * FROM "PRODUCT" ';
                    $stid1 = oci_parse($connection,$sql);
                    oci_execute($stid1);
                    
                while($row = oci_fetch_array($stid1, OCI_ASSOC)){
                    $pid = $row['PRODUCT_ID'];
                    $img_name=$row['PRODUCT_NAME'];
                    echo "<a href='display_selected_prd.php?s_name=$img_name&s_id=$pid' class='single'>";
                        echo "<div class='card_info'>";
                            echo "<img src=\"dbimage/product/".$row['PRODUCT_IMAGE']."\" alt=".$row['PRODUCT_NAME']." >";
                            echo "<div class='card-info'>";
                                echo "<div class='card-details'>";
                                    // echo "<label>P_ID :  ".$row['PRODUCT_ID']."</label>";
                                    echo "<label>Name:  ".substr($row['PRODUCT_NAME'],0,25)."</label>";
                                    echo "<label>Price:  <span> &pound; ".$row['PRICE'] ."<span></label>";
                                echo "</div>";
                            echo "</div>"; 
                            // echo "<div class='btns'>";
                            //     // echo "<a href='update.php?cat=EditProduct&id=$pid&action=edit' id='edit' ><i class='fa fa-shopping-cart' style='font-size:36px'></i></a>";
                            //     // echo "<a href='deleteP.php?&id=$pid&action=delete' id='delete' >Wish List</a>";
                            // echo "</div>";
                        echo "</div>";
                        echo "</a>";
                    }
        ?>

    </div>

    <?php
    echo "<div id='div'>";
        echo "DISCOUNT ITEM";
    echo "</div>";
    ?>
<div class="shopitems">
        <?php
                 
                 
                include("connection.php");

                    $sql = 'SELECT * FROM "PRODUCT" WHERE  DISCOUNT_ID IS NOT NULL ';
                    $stid1 = oci_parse($connection,$sql);
                    oci_execute($stid1);
                    
                    
                while($row = oci_fetch_array($stid1, OCI_ASSOC)){
                $pid = $row['PRODUCT_ID'];
                // $pid = 9242;
               
                    $img_name=$row['PRODUCT_NAME'];
                    echo "<a href='display_selected_prd.php?s_name=$img_name&s_id=$pid' class='single' id='dec'>";
                     
                    echo "<div class='card_info'>";
                    if(!empty($row['DISCOUNT_ID']))
                    {

                        $messg="OFFER";
                        echo "<label><span id ='message'>".$messg."</span></label>";
                    }  
                            echo "<img src=\"dbimage/product/".$row['PRODUCT_IMAGE']."\" alt=".$row['PRODUCT_NAME']." >";
                            
                            
                            echo "<div class='card-info'>";
                            
                                echo "<div class='card-details'>";
                                    // echo "<label>P_ID :  ".$row['PRODUCT_ID']."</label>";
                                    echo "<label>Name:  ".substr($row['PRODUCT_NAME'],0,25)."</label>";
    
                                    if (!empty($row['DISCOUNT_ID'])) 
                                    {
                                        $sql = 'SELECT DISCOUNT_PERC FROM "DISCOUNT" WHERE DISCOUNT_ID = :disc_id';
                                        $stmt = oci_parse($connection, $sql);
                                        oci_bind_by_name($stmt, ":disc_id", $row['DISCOUNT_ID']);
                                        oci_execute($stmt);
                                        $rows = oci_fetch_array($stmt, OCI_ASSOC);
                                        $discount = (int)$rows['DISCOUNT_PERC'];
                                        $total_price =$row['PRICE'] - $row['PRICE'] * ($discount / 100);
                                        echo "<span class='set'>&pound; <s id='cu'> " . $row['PRICE'] . " </s></span>";
                                        echo "<span id= 'perc'"> $discount."%"."</span>";
                                        echo "<span class='dis'>&pound; " . $total_price. "</span>";
                                      } else {
                                        echo "<span class='amount'>&pound; " . $row['PRICE'] . "</span>";
                                      }
                                      
                                    // echo "<label>Price:  <span> &pound; ".$row['PRICE'] ."<span></label>";
                                      
                                  
                                echo "</div>";
                            echo "</div>"; 
                            // echo "<div class='btns'>";
                            //     // echo "<a href='update.php?cat=EditProduct&id=$pid&action=edit' id='edit' ><i class='fa fa-shopping-cart' style='font-size:36px'></i></a>";
                            //     // echo "<a href='deleteP.php?&id=$pid&action=delete' id='delete' >Wish List</a>";
                            // echo "</div>";
                        echo "</div>";
                        echo "</a>";
                    }
        ?>
    
    </div>

<?php
    echo "<div id='div'>";
        echo "Other Itemss";
    echo "</div>";
    ?>


<div class="more">
    <?php
            

                $sql = 'SELECT * FROM "PRODUCT" ORDER BY dbms_random.value ';
                $stid1 = oci_parse($connection,$sql);
                oci_execute($stid1);
                
            while($row = oci_fetch_array($stid1, OCI_ASSOC)){
            $pid = $row['PRODUCT_ID'];
            // $pid = 9242;
           
                $img_name=$row['PRODUCT_NAME'];
                echo "<a href='display_selected_prd.php?s_name=$img_name&s_id=$pid' class='single' id='dec'>";
                 
                echo "<div class='card_info'>";
                if(!empty($row['DISCOUNT_ID']))
                {
                    $messg="OFFER";
                    echo "<label><span id ='message'>".$messg."</span></label>";
                }  
                        echo "<img src=\"dbimage/product/".$row['PRODUCT_IMAGE']."\" alt=".$row['PRODUCT_NAME']." >";
                        
                        
                        echo "<div class='card-info'>";
                        
                            echo "<div class='card-details'>";
                                // echo "<label>P_ID :  ".$row['PRODUCT_ID']."</label>";
                                echo "<label>Name:  ".substr($row['PRODUCT_NAME'],0,25)."</label>";

                                if (!empty($row['DISCOUNT_ID'])) 
                                {
                                    $sql = 'SELECT DISCOUNT_PERC FROM "DISCOUNT" WHERE DISCOUNT_ID = :disc_id';
                                    $stmt = oci_parse($connection, $sql);
                                    oci_bind_by_name($stmt, ":disc_id", $row['DISCOUNT_ID']);
                                    oci_execute($stmt);
                                    $rows = oci_fetch_array($stmt, OCI_ASSOC);
                                    $discount = (int)$rows['DISCOUNT_PERC'];
                                    $total_price =$row['PRICE'] - $row['PRICE'] * ($discount / 100);
                                    echo "<span class='set'>&pound; <s id='cu'> " . $row['PRICE'] . " </s></span>";
                                    echo "<span id= 'perc'"> $discount."%"."</span>";
                                    echo "<span class='dis'>&pound; " . $total_price. "</span>";
                                } else {
                                    echo "<span class='amount'>&pound; " . $row['PRICE'] . "</span>";
                                }
                            echo "</div>";
                        echo "</div>"; 
                        // echo "<div class='btns'>";
                        //     // echo "<a href='update.php?cat=EditProduct&id=$pid&action=edit' id='edit' ><i class='fa fa-shopping-cart' style='font-size:36px'></i></a>";
                        //     // echo "<a href='deleteP.php?&id=$pid&action=delete' id='delete' >Wish List</a>";
                        // echo "</div>";
                    echo "</div>";
                    echo "</a>";
                }
    ?>

</div>
</body>

</html>
<?php
include('footer.php');
?>