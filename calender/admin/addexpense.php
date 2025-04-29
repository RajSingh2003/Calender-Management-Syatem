<?php
require_once "../db.php";



date_default_timezone_set('Asia/Kolkata');
$timestamp = date("Y-m-d H:i:s");





$title = isset($_POST['expense']) ? $_POST['expense'] : "";
$date = isset($_POST['date5']) ? $_POST['date5'] : "";


$sqlInsert = "INSERT INTO tbl_events (title,start) VALUES ('".$title."','".$date."')";

$result = mysqli_query($conn, $sqlInsert);

if($result)
{
    echo json_encode($result);
}
?>