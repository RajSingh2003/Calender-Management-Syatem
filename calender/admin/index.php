<?php
require_once "../db.php";
session_start();
date_default_timezone_set('Asia/Kolkata');
$user = unserialize($_SESSION["username"]);
if (isset ($_SESSION["username"])) {
    if ($user == null) {
        session_destroy();
        header("Location:../index.php");
    }
} else {
    session_destroy();
    header("Location:../index.php");
}
?>





<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="fullcalendar/fullcalendar.min.css" />
    <script src="fullcalendar/lib/jquery.min.js"></script>
    <script src="fullcalendar/lib/moment.min.js"></script>
    <script src="fullcalendar/fullcalendar.min.js"></script>
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
        crossorigin="anonymous"></script>
    <style>
        body {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            font-family: "Lucida Grande", Helvetica, Arial, Verdana, sans-serif;
        }

        #calendar {
            width: 700px;
            margin: 0 auto;
        }

        .response {
            height: 60px;
        }

        .success {
            background: #cdf3cd;
            padding: 10px 60px;
            border: #c3e6c3 1px solid;
            display: inline-block;
        }

        .logoutLblPos {

            position: fixed;
            right: 55px;
            font-size: 20px;
        }

        .background {
            /* Background pattern from Toptal Subtle Patterns */
            background-image: url("../images/b2.jpg");
            height: 400px;
            width: 100%;
        }

        .btn-group {
            font-size: 15px;
        }

        .notification {
            background-color: green;
            color: white;
            text-decoration: none;
            padding: 15px 26px;
            position: relative;
            display: inline-block;
            border-radius: 2px;
        }

        .notification:hover {
            background: orange;
        }

        .notification .badge {
            position: absolute;
            top: -10px;
            right: -10px;
            padding: 5px 10px;
            border-radius: 50%;
            background: white;
            color: black;
        }
    </style>
</head>
<form method="post" id="frm" action="../logout.php">
    <?php
    $date = date('Y-m-d');


    $nextdate = date('Y-m-d', strtotime('+1 day', strtotime($date)));

    $check = "SELECT start FROM tbl_events order by start";

    $result = mysqli_query($conn, $check);

    while ($row = mysqli_fetch_assoc($result)) {
        $rowid = $row['start'];

        // if($nextdate == $rowid)
        // {
        //     echo "<script>alert('date match');</script>";
        // }else{
        //     echo "<script>alert('date not match');</script>";
        // }
    
    }







    $count = "SELECT count(start) as count FROM tbl_events where start = '$nextdate' order by start";

    $result1 = mysqli_query($conn, $count);

    while ($row1 = mysqli_fetch_assoc($result1)) {
        $rowcount = $row1['count'];

    }
    ?>
    <div class="form-group">

        <label class="logoutLblPos">

            <input type="submit" style="background-color: #04AA6D;color:white;" class="form-control" name="logout"
                value="Logout">
        </label>
        <a href="checkreminder.php" class="notification" data-bs-toggle="modal" data-bs-target="#staticBackdropnotify"
            id="notify">
            <span>Inbox</span>
            <span class="badge">
                <?php echo $rowcount ?>
            </span>
        </a>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdropnotify" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropnotify">You Have <?php echo $rowcount  ?> Reminders</h1>

                </div>
                <div class="modal-body">
                    <p>
                        <?php

                        $count = "SELECT * FROM tbl_events where start = '$nextdate' order by start";

                        $result1 = mysqli_query($conn, $count);

                        while ($row1 = mysqli_fetch_assoc($result1)) {
                            $rowtitle = $row1['title'];
                        }

echo $rowtitle;
                        
                        ?>

                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>











    <body class="background">
        <h2 style="color:#85929E;">Calendar Event Management</h2>

        <div class="response"></div>
        <div class="btn-group">
            <input type="button" id="event" data-bs-toggle="modal" data-bs-target="#staticBackdrop" value="Create Event"
                name="event" class="form-control" style="background-color: #04AA6D;color:white;">
            <input type="button" id="event" data-bs-toggle="modal" data-bs-target="#staticBackdrop1"
                value="Set Other Event" name="event" class="form-control"
                style="background-color: #04AA6D;color:white;">
            <input type="button" id="event" data-bs-toggle="modal" data-bs-target="#staticBackdrop2" value="Set routine"
                name="event" class="form-control" style="background-color: #04AA6D;color:white;">
            <!-- <input type="button" id="event" data-bs-toggle="modal" data-bs-target="#staticBackdrop1" value="Set Other Event"
                name="event" class="form-control" style="background-color: #04AA6D;color:white;"> -->
            <input type="button" id="event" data-bs-toggle="modal" data-bs-target="#staticBackdrop3"
                value="Set daily expense" name="event" class="form-control"
                style="background-color: #04AA6D;color:white;">
            <!-- <input type="button" value="Create Event" name="event" class="form-control"
            style="background-color: #04AA6D;color:white;">
        <input type="button" value="Create Event" name="event" class="form-control"
            style="background-color: #04AA6D;color:white;"> -->

        </div>

        <!-- Button trigger modal -->
        <br><br>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Event</h1>

                    </div>
                    <div class="modal-body">
                        Event title <input type="text" id="eventtitle" name="eventtitle">
                        Start Date <input type="date" id="startdate" name="startdate">
                        End Date <input type="date" id="enddate" name="enddate">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="saveevent" class="btn btn-primary">save</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Event</h1>

                    </div>
                    <div class="modal-body">
                        Event title <input type="text" id="eventtitle1" name="eventtitle1">
                        Date <input type="date" id="date" name="date">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="saveotherevent" class="btn btn-primary">save</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabe2">Event</h1>

                    </div>
                    <div class="modal-body">
                 
                        Set routine<textarea id="routinetitle1" name="routinetitle1" rows="2" cols="30"></textarea>
                        Date <input type="date" id="date2" name="date">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="saveotherevent2" class="btn btn-primary">save</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabe3">Daily Expense</h1>

                    </div>
                    <div class="modal-body">
                        enter expense<textarea id="expense" name="expense" rows="2" cols="30"></textarea>
                        Date <input type="date" id="date5" name="date">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="savedailyexpense" class="btn btn-primary">save</button>
                    </div>
                </div>
            </div>
        </div>
        <div id='calendar'>

        </div>

</form>


</body>

</html>
<script>
    $(document).ready(function () {

        $('#saveevent').on('click', function () {
            var fd = new FormData();
            fd.append("eventtitle", $('#eventtitle').val());
            fd.append("startdate", $('#startdate').val());
            fd.append("enddate", $('#enddate').val());
            $.ajax({
                url: 'add-event.php',
                type: 'post',
                data: fd,
                dataType: 'json',
                cache: false,
                processData: false,
                contentType: false,
                beforeSend: function () {

                },
                success: function (response) {
                    if (response = 'true') {
                        alert('Event Saved Successfully');
                        location.reload('admin/index.php');
                    }
                }
            });


        });
        $('#saveotherevent').on('click', function () {
            var fd = new FormData();
            fd.append("eventtitle1", $('#eventtitle1').val());
            fd.append("date", $('#date').val());

            $.ajax({
                url: 'add-event1.php',
                type: 'post',
                data: fd,
                dataType: 'json',
                cache: false,
                processData: false,
                contentType: false,
                beforeSend: function () {

                },
                success: function (response) {
                    if (response = 'true') {
                        alert('Event Saved Successfully');
                        location.reload('admin/index.php');
                    }
                }
            });
        });
        $('#saveotherevent2').on('click', function () {
            var fd = new FormData();
            fd.append("routinetitle1", $('#routinetitle1').val()); 
          
            fd.append("date2", $('#date2').val());

            $.ajax({
                url: 'add-event2.php',
                type: 'post',
                data: fd,
                dataType: 'json',
                cache: false,
                processData: false,
                contentType: false,
                beforeSend: function () {

                },
                success: function (response) {
                    if (response = 'true') {
                        alert('routine Saved Successfully');
                        location.reload('admin/index.php');
                    }
                }
            });


        });
        $('#savedailyexpense').on('click', function () {
            var fd = new FormData();
            fd.append("expense", $('#expense').val());
            fd.append("date5", $('#date5').val());

            $.ajax({
                url: 'addexpense.php',
                type: 'post',
                data: fd,
                dataType: 'json',
                cache: false,
                processData: false,
                contentType: false,
                beforeSend: function () {

                },
                success: function (response) {
                    if (response = 'true') {
                        alert('expense Saved Successfully');
                        location.reload('admin/index.php');
                    }
                }
            });


        });


        var calendar = $('#calendar').fullCalendar({

            editable: true,
            events: "fetch-event.php",
            displayEventTime: true,

            eventRender: function (event, element, start, end, view) {

                if (event.allDay === 'true') {
                    event.allDay = true;

                } else {
                    event.allDay = false;

                }
            },
            selectable: true,
            selectHelper: true,
            // select: function (start, end, allDay) {
            //     // var title = prompt('Event Title:');

            //     if (title) {
            //         var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");

            //         var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");

            //         $.ajax({
            //             url: 'add-event.php',
            //             data: 'title=' + title + '&start=' + start + '&end=' + end,
            //             type: "POST",
            //             success: function (data) {
            //                 displayMessage("Added Successfully");
            //             }
            //         });
            //         calendar.fullCalendar('renderEvent', {
            //             title: title,
            //             start: start,
            //             end: end,
            //             allDay: allDay
            //         },
            //             true
            //         );
            //     }
            //     calendar.fullCalendar('unselect');
            // },

            editable: true,
            eventDrop: function (event, delta) {
                var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                $.ajax({
                    url: 'edit-event.php',
                    data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
                    type: "POST",
                    success: function (response) {
                        displayMessage("Updated Successfully");
                    }
                });
            },
            eventClick: function (event) {
                var deleteMsg = confirm("Do you really want to delete?");
                if (deleteMsg) {
                    $.ajax({
                        type: "POST",
                        url: "delete-event.php",
                        data: "&id=" + event.id,
                        success: function (response) {
                            if (parseInt(response) > 0) {
                                $('#calendar').fullCalendar('removeEvents', event.id);
                                displayMessage("Deleted Successfully");
                            }
                        }
                    });
                }
            }

        });
    });

    function displayMessage(message) {
        $(".response").html("<div class='success'>" + message + "</div>");
        setInterval(function () {
            $(".success").fadeOut();
        }, 1000);
    }
</script>