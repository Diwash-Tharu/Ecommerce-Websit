<?php
  include('../connection.php');

  if(isset($_GET['id']) && isset($_GET['action'])){
    $delid = $_GET['id'];
    echo $delid;
    // $sql = 'SELECT *FROM "USER" WHERE USER_ID = :pid';
    // $conn = oci_parse($connection,$sql);
    // oci_bind_by_name($conn,':pid', $delid);
    // $exuc=oci_execute($stid);

    $stat='approve';
    $sql = 'UPDATE  "USER" SET  STATUS= :sta WHERE USER_ID = :id';
    $upp = oci_parse($connection,$sql);
    oci_bind_by_name($upp,':sta',  $stat);
    oci_bind_by_name($upp,':id',  $delid);
    if(oci_execute($upp))
    {
        header('Location:approve.php');
    }
}
?>