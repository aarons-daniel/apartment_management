<?php
session_start();
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
    $id = "manager";
    $pwd = "manager";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ((strcmp($_POST['mid'], $id) == 0) && (strcmp($_POST['mpwd'], $pwd) == 0)) {
            $_SESSION['admin'] = "login";
            header("Location:manager_menu.php");
        }
    }
    ?>
    <div class="main">
        <img src="../images/home.jpg" alt="apartment">
        <!-- <div class="overlay"></div>
        <div class="navbar">
            <div class="logo" style="color:white">SUNSET SQUARE</div>
            <ul>
                <li><a href="../index.php">HOME</a></li>
                <li><a href="about.php">ABOUT US</a></li>
                <li><a href="#">LOGIN</a></li>
                <li><a href="contact_us.php">CONTACT US</a></li>
            </ul>
        </div> -->
        <div class="heading">
            <div class="container">
                <h1>Login Form</h1>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-item">
                        <span class="material-icons-outlined"> account_circle </span>
                        <input type="text" name="mid" placeholder="Enter your id" />
                    </div>
                    <div class="form-item">
                        <span class="material-icons-outlined"> lock </span>
                        <input type="password" name="mpwd" placeholder="Enter your password" />
                    </div>
                    <button type="submit">LOGIN</button>
                </form>
            </div>
        </div>
    </div>
</body>