<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location:manager_login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Menu</title>
    <style>
        body {
            background-image: url("../images/booking_menu.jpg");
        }

        .split {
            height: 100%;
            width: 50%;
            position: fixed;
            z-index: 1;
            top: 0;
            overflow-x: hidden;
            padding-top: 20px;
        }

        .left {
            left: 0;
            /* background-color: red; */
            background-color: transparent;
        }

        /* Control the right side */
        .right {
            right: 0;
            /* background-color: blue; */
            background-color: transparent;
        }

        .centered {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .centered img {
            width: 150px;
            border-radius: 50%;
        }
    </style>
</head>

<body>
    <div class="split left">
        <div class="centered">
            <a href="booking_display.php"><img src="../images/booking.png" alt="Display Booking"></a>
            <h2>Display Booking Details</h2>
        </div>
    </div>

    <div class="split right">
        <div class="centered">
            <a href="booking_insert.php"><img src="../images/add_booking.png" alt="Add Booking"></a>
            <h2>Add a Booking</h2>
        </div>
    </div>
</body>

</html>