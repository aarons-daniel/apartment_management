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
    <title>Details</title>
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
            padding-left: 380px;
            padding-right: 340px;
        }
    </style>
</head>

<body>
    <h2>Details</h2>
    <div class="table-wrapper">
        <table class="table table-hover table-dark">
            <thead>
                <tr>
                    <th scope="col" style="width: 250px !important">Room No</th>
                    <th scope="col" style="width: 250px !important">Type</th>
                    <th scope="col" style="width: 250px !important">Owner ID</th>
                    <th scope="col" style="width: 250px !important">Rent</th>
                    <th scope="col" style="width: 250px !important">Vacancy</th>
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

                $sql = "SELECT * FROM `apartment`.`flat` NATURAL JOIN `apartment`.`owner` ORDER BY room_no ;";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        if (strcmp($row['available'], "T") == 0) {
                            $v = "Vacant";
                        } else {
                            $v = "Occupied";
                        }
                        echo "<tr>";
                        echo "<td>" . $row["room_no"] . "</td>";
                        echo "<td>" . $row["type"] . "</td>";
                        echo "<td>" . $row["oid"] . "</td>";
                        echo "<td>" . $row["rent"] . "</td>";
                        echo "<td>" . $v . "</td>";
                        echo "</tr>";
                    }
                }
                $conn->close();
                ?>
</body>

</html>