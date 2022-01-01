<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Us</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="../css/login.css" />
</head>

<body>
    <?php
    $nameErr = $emailErr = $phoneErr = $textErr = "";
    $name = $email = $phone = $text = "";
    $flag = true;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
            $flag = false;
        } else {
            $name = test_input($_POST["name"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/", $tname)) {
                $nameErr = "Only letters and white space allowed.";
                $flag = false;
            }
        }
        if (empty($_POST["phone"])) {
            $phoneErr = "Phone no is required";
            $flag = false;
        } else {
            $phone = test_input($_POST["phone"]);
            if (!is_numeric($phone)) {
                $phoneErr = "Phone no. should be numbers";
                $flag = false;
            } else if (strlen($phone) != 10) {
                $phoneErr = "Phone no. should be 10 digits";
                $flag = false;
            }
        }
        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
            $flag = false;
        } else {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
                $flag = false;
            }
        }
        if (empty($_POST['text'])) {
            $textErr = "Message cannot be empty";
            $flag = false;
        } else {
            $text = $_POST['text'];
        }

        if ($flag) {
            $server = "localhost";
            $username = "root";
            $password = "";

            $conn = mysqli_connect($server, $username, $password);

            if (!$conn) {
                die("Connection to this database failed due to" . mysqli_connect_error());
            }

            $sql = "INSERT INTO `apartment`.`contact_us` (`name`, `phone`, `email`, `text`) VALUES ('$name', '$phone', '$email', '$text')";

            if ($conn->query($sql) === true) {
                echo "<script type='text/javascript'> alert('Successfully Inserted');</script>";
            } else {
                echo "<script type='text/javascript'> alert('Could not send you message');</script>";
            }
            $conn->close();
        }
    }
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>
    <div class="main" style="padding:0;margin:0">
        <img src="../images/home.jpg" alt="apartment" />
        <div class="overlay"></div>
        <div class="navbar">
            <div class="logo">SUNSET SQUARE</div>
            <ul>
                <li><a href="../index.php">HOME</a></li>
                <li><a href="about.php">ABOUT US</a></li>
                <li><a href="login.php">LOGIN</a></li>
                <li><a href="#">CONTACT US</a></li>
            </ul>
        </div>
        <div class="heading">
            <div class="container">
                <h1>Contact Form</h1>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-item">
                        <span class="material-icons-outlined"> account_circle </span>
                        <input type="text" name="name" placeholder="Enter your name" value="<?php echo $name; ?>" />
                        <span class="error" style=" color:red;background:transparent;font-weight:bolder;font-size:small">*<?php echo $nameErr ?></span>
                    </div>
                    <div class="form-item">
                        <span class="material-icons-outlined">phone</span>
                        <input type="text" name="phone" placeholder="Enter your phone no" value="<?php echo $phone; ?>" />
                        <span class="error" style=" color:red;background:transparent;font-weight:bolder;font-size:small">*<?php echo $phoneErr ?></span>
                    </div>
                    <div class="form-item">
                        <span class="material-icons-outlined">email</span>
                        <input type="email" name="email" placeholder="Enter your email" value="<?php echo $email; ?>" />
                        <span class="error" style=" color:red;background:transparent;font-weight:bolder;font-size:small">*<?php echo $emailErr ?></span>
                    </div>
                    <div class="form-item">
                        <span class="material-icons-outlined">sms</span>
                        <textarea name="text" rows="4" cols="50"></textarea>
                        <span class=" error" style=" color:red;background:transparent;font-weight:bolder;font-size:small">*<?php echo $textErr ?></span>
                    </div>
                    <button type="submit">SUBMIT</button>
                </form>
            </div>
        </div>
    </div>
</body>

<style>
    .heading {
        margin: 3em 0;
    }
</style>

</html>