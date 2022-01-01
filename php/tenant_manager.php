<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location:manager_login.php");
}
$flag = true;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Search Tenant</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="../css/search.css" />
</head>

<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $tid = $_POST["tid"];

        if (empty($tid)) {
            $flag = false;
        } else {
            $server = "localhost";
            $username = "root";
            $password = "";

            $conn = mysqli_connect($server, $username, $password);

            if (!$conn) {
                die("Connection to this database failed due to" . mysqli_connect_error());
            }
            $sql = "SELECT * FROM `apartment`.`tenant` WHERE tid=$tid";
            $result = $conn->query($sql);
            if ($result->num_rows == 0) {
                $flag = false;
            } else {
                $_SESSION['tid'] = $tid;
                header("location:profile.php");
            }
        }
    }
    ?>
    <div class="background">
        <div class="container">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-item">
                    <span class="material-icons-outlined"> account_circle </span>
                    <input type="text" name="tid" placeholder="Enter tenant id" style=" color: rgb(30, 255, 0); " />
                </div>
                <button type="submit">SUBMIT</button>
                <?php
                if (!$flag) {
                    echo '<div class="form-item">
                <p style="font-size=30px;color:red">Please enter vaild id</p>
            </div>';
                }
                ?>
            </form>
        </div>
    </div>
</body>