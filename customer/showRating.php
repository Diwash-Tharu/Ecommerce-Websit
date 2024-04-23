<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="strr.css">
</head>

<body>
  <?php include '../connection.php';
  ?>
  <div class="container-xl df">
    <div class="row">
    <div class="col-md-12">
      <h2>Products</h2>
      <div class="carousel slide">
        <div class="carousel-inner">
          <div class="item carousel-item active">
            <!-- <div class="row"> -->
            <?php
            $sql = 'SELECT * FROM "REVIEW"';
            $stid1 = oci_parse($connection, $sql);
            // oci_bind_by_name($stid1,':ps_id' ,$_GET['s_id']);
            // oci_bind_by_name($stid1,':u_id' ,$u_id);
            oci_execute($stid1);
            while ($row = oci_fetch_array($stid1, OCI_ASSOC))
            // $result=mysqli_query($conn , $query);
            // while ($row = mysqli_fetch_array($result,MYSQLI_BOTH)) 
            {
            ?>
              <div class="col-sm-3 mt-3">
                <div class="thumb-wrapper">
                  <div class="img-box">
                    <!-- <img src="nikon.jpg" class="img-fluid" alt="Nikon"> -->
                  </div>
                  <div class="thumb-content">
                    <h4><?php echo $row['RE_FEEDBACK']; ?></h4>
                    <div class="star-rating">
                      <ul class="list-inline">
                        <?php
                        $start = 1;
                        while ($start <= 5) {
                          if ($row['REVIEW_SCORE'] < $start) {
                        ?>
                            <li class="list-inline-item"><i class="fa fa-star-o"></i></li>
                          <?php
                          } else {
                          ?>
                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                        <?php
                          }
                          $start++;
                        }
                        ?>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            <?php
            }
            ?>
          <!-- </div> -->
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
</body>

</html>