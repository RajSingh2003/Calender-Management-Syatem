<?php
require_once "../db.php";



date_default_timezone_set('Asia/Kolkata');
$timestamp = date("Y-m-d H:i:s");





$title = isset($_POST['eventtitle1']) ? $_POST['eventtitle1'] : "";
$date = isset($_POST['date']) ? $_POST['date'] : "";


$sqlInsert = "INSERT INTO tbl_events (title,start) VALUES ('".$title."','".$date."')";

$result = mysqli_query($conn, $sqlInsert);

if($result)
{
    echo json_encode($result);
}
?>