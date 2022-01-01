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
    <title>Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <style>
        html,
        body {
            height: 100%;
            padding: 0;
            margin: 0;
        }

        #div1,
        #div2,
        #div3,
        #div4 {
            width: 50%;
            height: 50%;
            float: left;
            background-color: transparent;
            font-size: 30px;
        }

        #div1 {
            background: #DDD;
        }

        #div2 {
            background: #AAA;
        }

        #div3 {
            background: #777;
        }

        #div4 {
            background: #444;
        }

        img {
            width: 150px;
            border-radius: 50%;
        }

        .button {
            right: 0;
            position: fixed;
            z-index: 2;
        }
    </style>
</head>

<body>
    <div class="button">
        <a href="logout_manager.php"><button type="button" class="btn btn-primary">LOGOUT</button></a>
    </div>
    <div id="div1">
        <a href="display_details.php" target="_blank"><img src="../images/room.png" alt="room"></a>
        <p>Display Details</p>
    </div>
    <div id="div2">
        <a href="tenant_manager.php" target="_blank"><img src="../images/user.png" alt="user"></a>
        <p>Search Tenants</p>
    </div>
    <div id="div3">
        <a href="owner_manager.php" target="_blank"><img src="../images/owner.png" alt="owner"></a>
        <p>Search Owners</p>
    </div>
    <div id="div4">
        <a href="booking_manager.php" target="_blank"><img src="../images/booking.png" alt="booking"></a>
        <p>Bookings</p>
    </div>
</body>

</html>