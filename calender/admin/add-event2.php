<?php
require_once "../db.php";



date_default_timezone_set('Asia/Kolkata');
$timestamp = date("Y-m-d H:i:s");

$routinetitle = isset($_POST['routinetitle1']) ? $_POST['routinetitle1'] : "";

$date = isset($_POST['date2']) ? $_POST['date2'] : "";


$sqlInsert = "INSERT INTO tbl_events (title,start) VALUES ('".$routinetitle."','".$date."')";

$result = mysqli_query($conn, $sqlInsert);

if($result)
{
    echo json_encode($result);
}
?>