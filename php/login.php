<?php
session_start();
$tid = "";
$tpwd = "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign In</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="../css/login.css" />
</head>

<body>
    <?php
    $flag = true;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["tid"])) {
            $flag = false;
        } else {
            $tid = $_POST["tid"];
        }
        if (empty($_POST["tpwd"])) {
            $flag = false;
        } else {
            $tpwd = $_POST["tpwd"];
        }
        $server = "localhost";
        $username = "root";
        $password = "";

        $conn = mysqli_connect($server, $username, $password);

        if (!$conn) {
            die("Connection to this database failed due to" . mysqli_connect_error());
        }

        $sql = "SELECT * FROM `apartment`.`tenant` WHERE tid ='$tid' AND tpwd ='$tpwd'";
        $result = $conn->query($sql);
        // echo $result->num_rows;
        if ($result != false && $result->num_rows > 0) {
            $_SESSION["tid"] = $tid;
            header("Location:user_menu.php");
        } else {
            echo "<script>alert('Incorrect user id or password');</script>";
        }
        $conn->close();
    }
    ?>
    <div class="main">
        <img src="../images/home.jpg" alt="apartment">
        <div class="overlay"></div>
        <div class="navbar">
            <div class="logo">SUNSET SQUARE</div>
            <ul>
                <li><a href="../index.php">HOME</a></li>
                <li><a href="about.php">ABOUT US</a></li>
                <li><a href="#">LOGIN</a></li>
                <li><a href="contact_us.php">CONTACT US</a></li>
            </ul>
        </div>
        <div class="heading">
            <div class="container">
                <h1>Login Form</h1>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-item">
                        <span class="material-icons-outlined"> account_circle </span>
                        <input type="text" name="tid" placeholder="Enter your id" />
                    </div>
                    <div class="form-item">
                        <span class="material-icons-outlined"> lock </span>
                        <input type="password" name="tpwd" placeholder="Enter your password" />
                    </div>
                    <button type="submit">LOGIN</button>
                    <a href="create.php">New User?</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>