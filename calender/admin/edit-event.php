<?php
require_once "../db.php";





$title = $_POST['title'];
$start = $_POST['start'];
$end = $_POST['end'];


$sqlQuery = "SELECT Id FROM tbl_events where title='$title' ORDER BY Id";

    $result = mysqli_query($conn, $sqlQuery);
  
    while ($row = mysqli_fetch_assoc($result)) {
       $rowid = $row['Id'];
    }







$sqlUpdate = "UPDATE tbl_events SET title='" . $title . "',start='" . $start . "',end='" . $end . "' WHERE id=" . $rowid;
mysqli_query($conn, $sqlUpdate);


?>