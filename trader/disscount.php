<?php
if(isset($_POST['submit']))
{

  $discount_id=$_POST['selecollection'];
  $u_id=22;
  echo "the daya is ".$discount_id;
//   unset($_SESSION['collection_id']);
//   $_SESSION['collection_id']=$data;
//   echo $data;
//   header("location:invoice.php");
// header("location:discount.php?&id=$u_id");
        include("../connection.php");
        $querry ='UPDATE  "DISCOUNT" SET USER_ID=:id  WHERE DISCOUNT_ID= :d_id';
        $insert = oci_parse($connection,$querry);
        oci_bind_by_name($insert, ':d_id', $discount_id);
        oci_bind_by_name($insert, ':id', $u_id);
        // $tr = oci_execute($insert);
        if(oci_execute($insert))
        { 
              $sql = 'SELECT * FROM "SHOP" WHERE USER_ID=:u_id';
              $stmts = oci_parse($connection, $sql);
              oci_bind_by_name($stmts, ":u_id",$u_id);
              oci_execute($stmts);
              while ($row = oci_fetch_array($stmts, OCI_ASSOC)) {
              
                  $id=$row['SHOP_ID'];
                  echo $id;
              }

              $querry ='UPDATE  "PRODUCT" SET 	DISCOUNT_ID=:d_id  WHERE SHOP_ID= :s_id';
              $insert = oci_parse($connection,$querry);
              oci_bind_by_name($insert, ':d_id', $discount_id);
              oci_bind_by_name($insert, ':s_id', $id);
              // $tr = oci_execute($insert);
              if (oci_execute($insert))
              {
                echo " success";
              }
        }
}
if(isset($_POST['submit1']))
{
  $discount_id="";
  $u_id="22";
  include("../connection.php");
  $querry ='DELETE FROM  "DISCOUNT" SET USER_ID=:id  WHERE DISCOUNT_ID= :d_id';
  $insert = oci_parse($connection,$querry);
  oci_bind_by_name($insert, ':d_id', $discount_id);
  oci_bind_by_name($insert, ':id', $u_id);
  // $tr = oci_execute($insert);
  oci_execute($insert);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  <p>hello world</p>
    <form method="POST">
                    <select name="selecollection" id="selectbox">
                    <option value="">Select Discount accusation</option>
                    <?php
                    include("../connection.php");
                    // $status = 'active';
                    $sql = 'SELECT * FROM "DISCOUNT"';
                    $stid = oci_parse($connection, $sql);
                    // oci_bind_by_name($stid, ":status", $status);
                    oci_execute($stid);
                    while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
                      echo "<option value=" . $row['DISCOUNT_ID'] . ">" . $row['DISCOUNT_PERC']."%". " (" . $row['DISCOUNT_OCCASION'] . ")</option>";
                    }
                    ?>
                  </select>
                  <input type="Submit" name="submit" value="Apply">
                  <input type="Submit" name="submit1" value="Delet discount">

    <form>             
</body>
</html>
