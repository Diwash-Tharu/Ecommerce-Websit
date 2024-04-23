<?php
    include('../connection.php');

if(isset($_GET['id']) && isset($_GET['action'])){
    $Gid = $_GET['id'];

    $sql = 'DELETE FROM "USER" WHERE USER_ID = :pid';
    
    $det = oci_parse($connection,$sql);
    oci_bind_by_name($det,':pid', $Gid);
    $succ=oci_execute($det);

    $mail= $_SESSION['email'];
    $subject="Reject";
    $message="Sorry, you have been reject due to some region";

    include("../mail.php");

    if(oci_execute($det)){
        header('Location:approve.php');
    }

}
?>