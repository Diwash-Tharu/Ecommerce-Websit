<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="display_selected_prods.css"></link>
    <link rel="stylesheet" href="customer/rat.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Display Select Product</title>
</head>
<body class='all'>


<?php

include('connection.php');

if(isset($_POST['sub'])) 
{
    $num=$_POST['num'];
    $id=$_POST['val'];
    header("location:customer/add_to_card.php?num=$num&id=$id");
    // echo $num;
    // echo $id;
}

if(isset($_GET['s_id'])){

    $p_id=$_GET['s_id'];
    $sql='SELECT *FROM "PRODUCT" WHERE PRODUCT_ID= :ps_id';
    $stid = oci_parse($connection,$sql);
    oci_bind_by_name($stid,':ps_id' ,$_GET['s_id']);
    oci_execute($stid);
    while($row = oci_fetch_array($stid,OCI_ASSOC)){
        $shop_id=$row['SHOP_ID'];
        
        if(!empty($row['DISCOUNT_ID']))
        {
            $querry ='SELECT  DISCOUNT_PERC FROM "DISCOUNT"  WHERE DISCOUNT_ID= :d_id';
            $insert = oci_parse($connection,$querry);
            oci_bind_by_name($insert, ':d_id', $row['DISCOUNT_ID']);
            // $tr = oci_execute($insert);
           oci_execute($insert);
        $row = oci_fetch_array($insert, OCI_ASSOC);
            
               $descper= $row['DISCOUNT_PERC'];
        
        }
    }

    $sql='SELECT *FROM "SHOP" WHERE SHOP_ID= :s_id';
        $data_base = oci_parse($connection,$sql);
        oci_bind_by_name($data_base,':s_id' ,$shop_id);
        oci_execute($data_base);
        while($row = oci_fetch_array($data_base,OCI_ASSOC)){
            $shop_name= $row['SHOP_NAME'];
        }
        // echo $shop_name;

    $sql='SELECT *FROM "PRODUCT" WHERE PRODUCT_ID= :ps_id';
    $stid = oci_parse($connection,$sql);
    oci_bind_by_name($stid,':ps_id' ,$_GET['s_id']);
    oci_execute($stid);
    while($row = oci_fetch_array($stid,OCI_ASSOC)){
        $shop_id=$row['SHOP_ID'];
        $nums=$row['QUANTITY'];
        // $dis=$roe['DISCOUNT_ID'];


    
        echo "<div class='card_info'>";
          
            echo "<div class='images'>";
              echo "<img src=\"dbimage/product/".$row['PRODUCT_IMAGE']."\" alt=".$row['PRODUCT_NAME']." >";
            echo "</div>";
            echo "<div class='card-infos'>";
                    echo "<div class='card-details'>";
                        echo "<label id='s_name'>Shop Name :<span id='shop_name'>". $shop_name."</span></label>";
                        echo "<div class='name'>";
                            echo "<label>Product Name: ".substr($row['PRODUCT_NAME'],0,25)."</label>";
                        echo "</div>";
                        echo "<div class='ell'>";
                        
                            echo "<div class='dec'>"; 
                                echo"<label id='allergy'>Product Description: </label>";
                                echo "<p>".$row['PRODUCT_DESCRIPTION']."</p>";
                            echo "</div>";
        
                            echo "<div class='dec'>"; 
                                echo "<label id='allergy' >Allergy Information: </label>";
                                echo "<p>".$row['ALLERGY_INFO']."</p>";
                            echo"</div>";

                        echo"</div>";

                    // echo "<div class='prod_de'>";
                    // echo"<lable>Product Description<label>";
                    // echo $row['PRODUCT_DESCRIPTION'];
                    

                    echo "<div class='price'>";
                    if(empty($row['DISCOUNT_ID']))
                    {
                        echo "<label> Before Price:  <span> &pound; ".$row['PRICE'] ."<span>&emsp; &emsp;</label>";
                    }
                    else
                    {
                        echo "<label> Before Price:  <span> &pound;<s> ".$row['PRICE'] ."</s><span>&emsp; &emsp;</label>";
                        echo "<label> &emsp; Now Price  <span> &pound; ".$row['PRICE']-$row['PRICE']*($descper/100 )."<span></label>";
                    }
                    echo "</div>";

                    echo "<div class='price'>";
                        echo "<label>Stock level:  <span> ".$row['QUANTITY'] ."<span></label>";
                    echo "</div>";

                    echo"</div>";
                    // echo "<input type='number'  min= '1' max='5' >";  
                    echo"<form method='POST'> " ;
                        echo "<div class='d-flex'>";
                            echo "<button onclick='sub()'>-</button>";
                        
                            echo "<input type='number'  min= '1' max='$nums' value='1'  id='myNumber' name='num'>";  
                    
                            echo "<button onclick='add()'>+</button>"; 
                            echo" <div class='nav-item m-100px mx-5 '>";
                                echo "<a href='customer/wishlist.php?cat=EditProduct&id=$p_id&action=edit' class='nav-link'><i class='fa fa-heart' style='font-size:40px; color:blue; cursor: pointer;'></i></a>
                            </div>";
                        echo "</div>";
                        echo "<input type='hidden' name='val' value='$p_id' id='buy'>";

                        echo "<div class='buttonss' r-10>";
                            // $sql = 'SELECT * FROM "PRODUCT" WHERE PRODUCT_ID= :p_id';
                            // $stmts = oci_parse($connection, $sql);
                            // oci_bind_by_name($stmts, ":p_id",$p_id);
                            // oci_execute($stmts);
                            // while ($num = oci_fetch_array($stmts, OCI_ASSOC)) {
                            //     $quantity=$num['QUANTITY'];
                            // }
                            if($nums==0)
                            {
                                echo "<input type='submit' name='' value='Out Of Stuck' id='buy'>"; 
                            }
                            else
                            {
                                // echo "<a href='customer/add_to_card.php?num=$num&id=$p_id' id='add_c'>ADD to Cart </a>";
                            echo "<input type='submit' name='sub1' value='BuY now' id='buy'>"; 
                            echo "<input type='submit' name='sub' value='Add to card' id='add_c'>"; 
                            }
                        echo "</div>";
                    echo"</form>" ;
                echo "</div>";
            echo "</div>";
            // echo "</div>";


                              

            include("customer/rating.php");
            // include("customer/showRating.php");

            
            echo "<div class='more'>";
            include("connection.php");
            


            $sql = 'SELECT * FROM "PRODUCT" WHERE ROWNUM <=10';
            $stid1 = oci_parse($connection,$sql);
            oci_execute($stid1);
            
            while($row = oci_fetch_array($stid1, OCI_ASSOC)){
            $pid = $row['PRODUCT_ID'];

                echo "<div class='card_infomaa'>";

                if(!empty($row['DISCOUNT_ID']))
                {
                    $messg="OFFER";
                    echo "<label><span id ='message'>".$messg."</span></label>";
                } 
                echo "<a href='display_selected_prd.php?s_name=&s_id=$pid' class='single'>";
                 
               
                echo "<img src=\"dbimage/product/".$row['PRODUCT_IMAGE']."\" alt=".$row['PRODUCT_NAME']."  id ='img'>";
                    echo "<div class='card-infoma'>";
                        echo "<div class='card-dett'>";
                            echo "<label>P_ID :  ".$row['PRODUCT_ID']."</label>";
                            echo "<label>Name:  ".substr($row['PRODUCT_NAME'],0,25)."</label>";
                            // echo "<label>Price:  <span> &pound; ".$row['PRICE'] ."<span></label>";
                        echo "</div>";
                    echo "</div>"; 

                    // echo "<div class='btns'>";
                    //     // echo "<a href='update.php?cat=EditProduct&id=$pid&action=edit' id='edit' ><i class='fa fa-shopping-cart' style='font-size:36px'></i></a>";
                    //     // echo "<a href='deleteP.php?&id=$pid&action=delete' id='delete' >Wish List</a>";
                    // echo "</div>";
            echo "</a>";
                echo "</div>";
            }    
         
             echo "</div>";
            

    }     
    }   
else
{
   
}
?> 

<script>
function add() {
  const num = document.getElementById("myNumber").stepUp(1);
  event.preventDefault();
}
function sub() {
  document.getElementById("myNumber").stepDown();
  event.preventDefault();
}
</script>
</body>
</html>