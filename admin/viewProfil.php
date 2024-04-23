<!DOCTYPE html>
<html>
<head>
  <title>Admin</title>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
       <link rel="stylesheet" href="admindashboard.css"></link>
       <link rel="stylesheet" href="../css/vieewpro.css"></link>
       <!-- <link rel="stylesheet" href="add.css"></link> -->
  </head>
</head>
<body >
    
        <?php
           session_start();
             include ("adminHeader.php");
            include ("admin_sidebar.php");
            include("../connection.php");
         ?>
         <?php
               //$id=$_SESSION['ID'];
         $ids=0;
         $sql = 'SELECT * FROM "USER" WHERE USER_ID= :user_id';
         $stid2 = oci_parse($connection,$sql);
        oci_bind_by_name($stid2 , ':user_id',$ids);
        oci_execute($stid2);
        

       echo "<div class='texts'>";
       echo "<h3>view profile</h3>";
       echo "</div>";
            while($row = oci_fetch_array($stid2, OCI_ASSOC)){
                // $ids = $row['USER_ID']; -->
 
                    echo "<div class='user_info'>";
                   
                    // echo "<img src=\"dbimage/product/".$row['PRODUCT_IMAGE']."\" alt=".$row['PRODUCT_NAME']." >";
                        echo "<div class='user-detail'>";
                            echo "<div class='user-data'>";
                                echo "<label><p id='lab'>ID :</p> <p> ".$row['USER_ID']."</p></label>";
                                //echo "<label>User Name :  ". $_SESSION['username']."</label>";
                                echo "<label><p id='lab'>ADDRESS : </p> <p> ".$row['ADDRESS']."</p></label>";
                                echo "<label><p id='lab'>EMAIL : </p><p> ".$row['EMAIL']."</p></label>";
                                echo "<label><p id='lab'>PHONE NUMBER : </p><p> ".$row['PHONE_NO']."</p></label>";
                                echo "<label><p id='lab'>AGE : </p><p> ".$row['AGE']."</p></label>";
                                echo "<label><p id='lab'>STATUS : </p><p> ".$row['STATUS']."</p></label>";
                                if(empty($row['TRADER_CATEGORY']))
                                {
                                    
                                    echo "<label><p id='lab'> CATEGORY :</p><p> no data </p></label>";
                                }
                                else
                                {
                                    echo "<label><p id='lab'>CATEGORY :  ".$row['TRADER_CATEGORY']."</p></label>";
                                }
                             

                            echo "<div class='btnss'>";
                                echo "<a href='update.php?cat=EditProduct&id=$ids&action=edit' id='edits' >Upate Account</a>";
                                echo "<a href='deleteP.php?&id=$ids&action=delete' id='delete' >Delete Account</a>";
                            echo "</div>";
                    echo "</div>" ;
                echo "</div>";
            echo "</div>";
        }
        
        
        ?>
    
        


    <script type="text/javascript" src="ajaxWork.js"></script>    
    <script type="text/javascript" src="script.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>