<?php
session_start();
if(isset($_POST['sub']))
{
  $data=$_POST['selecollection'];
  unset($_SESSION['collection_id']);
  $_SESSION['collection_id']=$data;
  echo $data;
  header("location:invoice.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Responsive Hamburger Navigation Bar with Bootstrap</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
  <link rel="stylesheet" href="collectionslot.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/css/bootstrap-responsive.css">
</head>
<body>

<form  method ="POST">
<!-- <input type="text" name="name" placeholder="name"> -->
  <!-- banner -->
  <div id="page-header" class="cart-header">
    <h2>COLLECTION SLOT</h2>
  </div> 
  collectionslot
  <div class="container-fluid px-0 px-sm-4 mx-auto">
    <div class="row justify-content-center mx-0">
      <div class="col-lg-10">
        <div class="card border-0">
            <div class="card-header bg-dark">
              <div class="mx-0 mb-0 row justify-content-sm-center justify-content-start px-1">
          
              <select name="selecollection" id="selectbox">
                    <option value="">Select Collection Slot</option>
                    <?php
                    include("../connection.php");
                    // $status = 'active';
                    $sql = 'SELECT * FROM "COLLECTION_SLOT" WHERE SLOT_DATA >=0';
                    $stid = oci_parse($connection, $sql);
                    // oci_bind_by_name($stid, ":status", $status);
                    oci_execute($stid);
                    while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
                      echo "<option value=" . $row['COLLECTION_ID'] . ">" . $row['C_TIME'] . " (" . $row['C_DATE'] . ")</option>";
                    }
                    ?>
                  </select>
              </div>
            </div>
              
          </div>
      
        </div>
      </div>
    </div>
  </div>
  <!-- proceed to pay -->
  <div class="col-md-12 my-3 px-5 text-center">
    <input type="submit" class="btn btn-dark" value="GET INVOICE" name ="sub">
  </div>
  </form>
  
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.js"></script>

</body>
</html>
