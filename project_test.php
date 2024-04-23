<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <form method="POST">
        <input type="date" name="bod" class="da">
        <input type="submit" name="date" class="s" value="Submit"> 
    </form>
    
</body>
</html>

<?php
    if(isset($_POST['date']))
    {
        $date=$_POST['bod'];

        // echo $date=($date,"y");
        $prevous = date('Y', strtotime($date));
        // echo $year;

        $year = date("Y");

        $sub=$year-$prevous;

        echo "current year is".$sub; 
        // $prevous=$_POST('Y');
        // data("Y");

        // echo $prevous;
        // echo "my name is diwash";
        // echo "today is".data("Y");
        die();
        
    }
?>