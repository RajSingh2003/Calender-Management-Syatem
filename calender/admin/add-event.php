<?php
require_once "../db.php";



date_default_timezone_set('Asia/Kolkata');
$timestamp = date("Y-m-d H:i:s");
$title = isset($_POST['eventtitle']) ? $_POST['eventtitle'] : "";
$start = isset($_POST['startdate']) ? $_POST['startdate'] : "";
$end = isset($_POST['enddate']) ? $_POST['enddate'] : "";

$sqlInsert = "INSERT INTO tbl_events (title,start,end) VALUES ('".$title."','".$start."','".$end ."')";

$result = mysqli_query($conn, $sqlInsert);

if($result)
{
    echo json_encode($result);
}
?>