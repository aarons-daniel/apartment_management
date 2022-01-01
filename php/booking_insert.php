<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location:manager_login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Booking</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="../css/search.css" />
</head>

<body>
    <?php
    $bidErr = $tidErr = $room_noErr = $bdateErr =  "";
    $bid = $tid = $room_no = $bdate =  "";
    $flag = true;
    $server = "localhost";
    $username = "root";
    $password = "";

    $conn = mysqli_connect($server, $username, $password);

    if (!$conn) {
        die("Connection to this database failed due to" . mysqli_connect_error());
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["bid"])) {
            $bidErr = "Booking id is required";
            $flag = false;
        } else {
            $bid = test_input($_POST["bid"]);
            if (!is_numeric($bid)) {
                $bidErr = "Booking id should be numeric";
                $flag = false;
            } else {
                $sql = "SELECT * FROM `apartment`.`booking` WHERE bid = $bid";
                $result = $conn->query($sql);
                if ($result->num_rows != 0) {
                    $bidErr = "Booking id = $bid already exists";
                    $flag = false;
                }
            }
        }
        if (empty($_POST["tid"])) {
            $tidErr = "Tenant id is required";
            $flag = false;
        } else {
            $tid = test_input($_POST["tid"]);
            if (!is_numeric($tid)) {
                $tidErr = "Tenant id should be numeric";
                $flag = false;
            } else {
                $sql = "SELECT * FROM `apartment`.`tenant` WHERE tid = '$tid'";
                $result = $conn->query($sql);
                if ($result->num_rows == 0) {
                    $tidErr = "Tenant id = $tid does not exist";
                    $flag = false;
                }
            }
        }
        if (empty($_POST["room_no"])) {
            $room_noErr = "Room No. is required";
            $flag = false;
        } else {
            $room_no = test_input($_POST["room_no"]);
            if (!is_numeric($room_no)) {
                $room_noErr = "Room No. should be numeric";
                $flag = false;
            } else {
                $sql = "SELECT * FROM `apartment`.`flat` WHERE room_no = '$room_no'";
                $result = $conn->query($sql);
                if ($result->num_rows == 0) {
                    $room_noErr = "Room No. = $room_no does not exist";
                    $flag = false;
                } else {
                    $row = $result->fetch_assoc();
                    if (strcmp($row['available'], "F") == 0) {
                        $room_noErr = "Room $room_no is not Vacant";
                        $flag = false;
                    }
                }
            }
        }
        if (empty($_POST["bdate"])) {
            $bdateErr = "Booking date is required";
            $flag = false;
        } else {
            $bdate = test_input($_POST["bdate"]);
            if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $bdate)) {
            } else {
                $bdateErr = "Incorrect Format(yyyy-mm-dd)";
                $flag = false;
            }
        }

        if ($flag) {
            //Connect to db
            $sql = "INSERT INTO `apartment`.`booking` (`bid`, `tid`, `bdate`, `room_no`) VALUES ('$bid', '$tid', '$bdate', '$room_no');";

            if ($conn->query($sql) === true) {
                echo "<script type='text/javascript'> alert('Successfully Inserted');window.location.href='booking_display.php';</script>";
            } else {
                echo "Error $sql <br> $conn->error";
            }
        }
    }
    $conn->close();

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>
    <div class="background">
        <div class="container">
            <h1>New Booking</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-item">
                    <span class="material-icons-outlined">receipt</span>
                    <input type="text" name="bid" placeholder="Enter booking id" value="<?php echo $bid; ?>" style=" color: yellow; " />
                    <span class="error" style=" color:red;background:transparent;font-weight:bolder;font-size:small">*<?php echo $bidErr ?></span>
                </div>
                <div class="form-item">
                    <span class="material-icons-outlined">account_circle</span>
                    <input type="text" name="tid" placeholder="Enter tenant id" value="<?php echo $tid; ?>" style=" color: yellow; " />
                    <span class="error" style=" color:red;background:transparent;font-weight:bolder;font-size:small">*<?php echo $tidErr ?></span>
                </div>
                <div class="form-item">
                    <span class="material-icons-outlined">today</span>
                    <input type="date" name="bdate" placeholder="Enter booking date" value="<?php echo $bdate; ?>" style=" color: yellow; " />
                    <span class="error" style=" color:red;background:transparent;font-weight:bolder;font-size:small">*<?php echo $bdateErr ?></span>
                </div>
                <div class="form-item">
                    <span class="material-icons-outlined">room</span>
                    <input type="text" name="room_no" placeholder="Enter room_no" value="<?php echo $room_no; ?>" style=" color: yellow " />
                    <span class="error" style=" color:red;background:transparent;font-weight:bolder;font-size:small">*<?php echo $room_noErr ?></span>
                </div>
                <button type="submit">CONFIRM</button>
            </form>
        </div>
    </div>
</body>

</html>