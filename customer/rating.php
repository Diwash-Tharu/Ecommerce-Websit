<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    <link rel="stylesheet" href="rat.css">
</head>
<body>
<div class="container">
    <div class="row">
 
<form action="" method="post">
 
    <div>
        <h3>Poduct Rating System</h3>
    </div>
 
    <div class="text">
         <label>Description</label>

         <textarea id="w3review" name="name" rows="4" cols="50"></textarea>
        <!-- <input type="text" name="name"> -->

    </div>

         <div class="rateyo" id= "rating"
         data-rateyo-rating="4"
         data-rateyo-num-stars="5"
         data-rateyo-score="3">
         </div>
 
    <span class='result'>0</span>
    <input type="hidden" name="rating" id="rev">
 
    </div>
 
    <div><input type="submit" name="add" value="Review"></div>
 
</form>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
 
<script>
 
 
    $(function () {
        $(".rateyo").rateYo().on("rateyo.change", function (e, data) {
            var rating = data.rating;
            $(this).parent().find('.score').text('score :'+ $(this).attr('data-rateyo-score'));
            $(this).parent().find('.result').text('rating :'+ rating);
            $(this).parent().find('input[name=rating]').val(rating); //add rating value to input field
        });
    });
 
</script>
</body>
 
</html>
<?php
// require 'db_connection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    
    // $name = $_POST["name"];
    // $rating = $_POST["rating"];
    $id=26;
    $p_id=9241;
    include("../connection.php");
    $sql = 'INSERT INTO "REVIEW" (REVIEW_SCORE,RE_FEEDBACK,USER_ID,PRODUCT_ID) VALUES (:score,:feed,:id,:pid)';
    $stid1 = oci_parse($connection,$sql);
    oci_bind_by_name($stid1,':score' ,$_POST['rating']);
    oci_bind_by_name($stid1,':feed' ,$_POST["name"]);
    oci_bind_by_name($stid1,':id' ,$id);
    oci_bind_by_name($stid1,':pid' ,$p_id);

    oci_execute($stid1);
}
?>