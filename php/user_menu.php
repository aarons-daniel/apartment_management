<?php
session_start();
if (!isset($_SESSION['tid'])) {
    header("Location:login.php");
} else {
    $tid = $_SESSION['tid'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Page</title>
    <link rel="stylesheet" href="../css/user.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/user.css" />
</head>

<body>
    <div class="mycontainer">
        <div class="menu">
            <h1 style="font-size:50px">User Menu</h1><br><br>
            <div class="item">
                <p style="font-size:35px">Get List of Available Rooms</p>
                <a href="room.php" target="_blank"><img src="../images/room.png" alt="room"></a>
            </div>
            <br>
            <div class="item">
                <p style="font-size:35px">Search Owner</p>
                <a href="search_owner.php" target="_blank"><img src="../images/owner.png" alt="owner"></a>
            </div>
            <!-- <div class="item">
                <p>Feedback Form</p>
            </div> -->
        </div>
        <div class="profile">
            <a href="logout_user.php"><button type="button" class="btn btn-primary">LOGOUT</button></a>
            <br><br>
            <a href="profile.php" target="_blank"><img src="../images/user.png" alt="profile"></a>
            <p style="font-size:35px">Profile</p>
        </div>
    </div>
</body>

</html>