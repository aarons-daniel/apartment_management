<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="../css/profile.css" />
</head>

<body>
    <?php
    $oid = $_SESSION["oid"];
    $server = "localhost";
    $username = "root";
    $password = "";

    $conn = mysqli_connect($server, $username, $password);

    if (!$conn) {
        die("Connection to this database failed due to" . mysqli_connect_error());
    }
    $sql = "SELECT * FROM `apartment`.`owner` WHERE oid=$oid";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $oname = $row['oname'];
    $ossn = $row['ossn'];
    $ophone = $row['ophone'];
    $omail = $row['omail'];
    $conn->close();
    ?>
    <div class="background">
        <div class="container">
            <h1>Profile</h1>
            <div class="block">
                <div class="form-item">
                    <span class="material-icons-outlined"> account_circle </span>
                    <p><?php echo $oid ?></p>
                </div>
                <div class="form-item">
                    <span class="material-icons-outlined"> person </span>
                    <p><?php echo $oname ?></p>
                </div>
                <div class="form-item">
                    <span class="material-icons-outlined"> phone </span>
                    <p><?php echo $ophone ?></p>
                </div>
                <div class="form-item">
                    <span class="material-icons-outlined"> email </span>
                    <p><?php echo $omail ?></p>
                </div>
                <div class="form-item">
                    <span class="material-icons-outlined"> security </span>
                    <p><?php echo $ossn ?></p>
                </div>
            </div>
            </form>
        </div>
    </div>
</body>

</html>