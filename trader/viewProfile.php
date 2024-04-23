<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/vie.css">
    <title>View Profil</title>
</head>
<body>
    <?php
    include("../connection.php");
        //$id=$_SESSION['ID'];
        $ids=0;
        $sql = 'SELECT * FROM "USER" WHERE USER_ID= :user_id';
        $stid2 = oci_parse($connection,$sql);
        oci_bind_by_name($stid2 , ':user_id',$ids);
        oci_execute($stid2);
        
            while($row = oci_fetch_array($stid2, OCI_ASSOC)){
                $ids = $row['USER_ID'];

                    echo "<div class='user_info'>";
                    // echo "<img src=\"dbimage/product/".$row['PRODUCT_IMAGE']."\" alt=".$row['PRODUCT_NAME']." >";
                        echo "<div class='user-detail'>";
                            echo "<div class='user-data'>";
                                echo "<label>User_id :  ".$row['USER_ID']."</label>";
                                //echo "<label>User Name :  ". $_SESSION['username']."</label>";
                                echo "<label>User :  ".$row['ADDRESS']."</label>";
                                echo "<label>User :  ".$row['EMAIL']."</label>";
                                echo "<label>User :  ".$row['PHONE_NO']."</label>";
                                echo "<label>User :  ".$row['AGE']."</label>";
                                echo "<label>User :  ".$row['STATUS']."</label>";
                                if(empty($row['TRADER_CATEGORY']))
                                {
                                    
                                    echo "<label> no data </label>";
                                }
                                else
                                {
                                    echo "<label>User :  ".$row['TRADER_CATEGORY']."</label>";
                                }
                            echo "</div>";
                        echo "</div>"; 

                            echo "<div class='btns'>";
                                echo "<a href='update.php?cat=EditProduct&id=$ids&action=edit' id='edit' >UPDATE</a>";
                                echo "<a href='deleteP.php?&id=$ids&action=delete' id='delete' >CANECL</a>";
                            echo "</div>";
                    echo "</div>" ;
        }
    ?>
</body>
</html>