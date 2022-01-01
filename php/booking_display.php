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
    <title>Booking Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Pacifico&display=swap" rel="stylesheet">

    <style>
        h2 {
            text-align: center;
            font-size: 50px;
            margin: 30px;
            padding-bottom: 10px;
            /* font-family: 'Bangers', cursive; */
            font-family: 'Pacifico', cursive;
        }

        body {
            background-image: url("../images/table_bg.jpg");
        }

        .table-wrapper {
            padding-left: 340px;
            padding-right: 310px;
        }
    </style>
</head>

<body>
    <h2>Booking Details</h2>
    <div class="table-wrapper">
        <table class="table table-hover table-dark">
            <thead>
                <tr>
                    <th scope="col" style="width: 300px !important">Room No</th>
                    <th scope="col" style="width: 300px !important">Booking ID</th>
                    <th scope="col" style="width: 300px !important">Tenant ID</th>
                    <th scope="col" style="width: 300px !important">Booking Date</th>
                    <th scope="col" style="width: 300px !important">Type</th>
                    <th scope="col" style="width: 300px !important">Rent</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $server = "localhost";
                $username = "root";
                $password = "";

                $conn = mysqli_connect($server, $username, $password);

                if (!$conn) {
                    die("Connection to this database failed due to" . mysqli_connect_error());
                }

                $sql = "SELECT * FROM `apartment`.`booking` NATURAL JOIN `apartment`.`flat` ORDER BY bid ;";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["bid"] . "</td>";
                        echo "<td>" . $row["room_no"] . "</td>";
                        echo "<td>" . $row["tid"] . "</td>";
                        echo "<td>" . $row["bdate"] . "</td>";
                        echo "<td>" . $row["type"] . "</td>";
                        echo "<td>" . $row["rent"] . "</td>";
                        echo "</tr>";
                    }
                }
                $conn->close();
                ?>
</body>

</html>