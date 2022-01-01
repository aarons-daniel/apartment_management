<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign Up</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="../css/login.css" />
</head>

<body>
    <?php
    $tnameErr = $tmailErr = $tphoneErr = $tssnErr = $tpwdErr = "";
    $tname = $tmail = $tphone = $tssn = $tpwd = "";
    $flag = true;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["tname"])) {
            $tnameErr = "Name is required";
            $flag = false;
        } else {
            $tname = test_input($_POST["tname"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/", $tname)) {
                $tnameErr = "Only letters and white space allowed.";
                $flag = false;
            }
        }
        if (empty($_POST["tphone"])) {
            $tphoneErr = "Phone no is required";
            $flag = false;
        } else {
            $tphone = test_input($_POST["tphone"]);
            if (!is_numeric($tphone)) {
                $tphoneErr = "Phone no. should be numbers";
                $flag = false;
            } else if (strlen($tphone) != 10) {
                $tphoneErr = "Phone no. should be 10 digits";
                $flag = false;
            }
        }
        if (empty($_POST["tmail"])) {
            $tmailErr = "Email is required";
            $flag = false;
        } else {
            $tmail = test_input($_POST["tmail"]);
            if (!filter_var($tmail, FILTER_VALIDATE_EMAIL)) {
                $tmailErr = "Invalid email format";
                $flag = false;
            }
        }
        if (empty($_POST["tssn"])) {
            $tssnErr = "Aadhar no. is required";
            $flag = false;
        } else {
            $tssn = test_input($_POST["tssn"]);
            if (!is_numeric($tssn)) {
                $tssnErr = "Aadhar no. should be numbers";
                $flag = false;
            } else if (strlen($tssn) != 12) {
                $tssnErr = "Aadhar no. should be 12 digits";
                $flag = false;
            }
        }
        if (empty($_POST["tpwd"])) {
            $tpwdErr = "Password is required";
            $flag = false;
        } else {
            $tpwd = test_input($_POST["tpwd"]);
            if (strlen($tpwd) > 10) {
                $tpwdErr = "Password should not be greater than 10 characters";
                $flag = false;
                $tpwd = "";
            }
        }
        if ($flag) {
            //Connect to db
            $server = "localhost";
            $username = "root";
            $password = "";

            $conn = mysqli_connect($server, $username, $password);

            if (!$conn) {
                die("Connection to this database failed due to" . mysqli_connect_error());
            }

            $sql = "INSERT INTO `apartment`.`tenant` (`tname`, `tphone`, `tmail`, `tssn`, `tpwd`) VALUES ('$tname', '$tphone', '$tmail', '$tssn', '$tpwd');";

            if ($conn->query($sql) === true) {
                echo "Successfully Inserted" . "<br>";
                $sql = "SELECT * FROM `apartment`.`tenant` WHERE tssn = '$tssn'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $msg = "Your id is : " . $row["tid"];
                    }
                    echo "<script type='text/javascript'> alert('$msg');window.location.href='login.php';</script>";
                }
            } else {
                echo "Error $sql <br> $conn->error";
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
    <div class="main">
        <img src="../images/home.jpg" alt="apartment">
        <div class="overlay"></div>
        <div class="navbar">
            <div class="logo">LOGO</div>
            <ul>
            </ul>
        </div>
        <div class="heading">
            <div class="container">
                <h1>New User</h1>
                <p><span class="error" style="color:red;background:transparent;font-weight:bolder;font-size:large">* required field</span></p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-item">
                        <span class="material-icons-outlined"> account_circle </span>
                        <input type="text" name="tname" placeholder="Enter your name" value="<?php echo $tname; ?>" />
                        <span class="error" style=" color:red;background:transparent;font-weight:bolder;font-size:small">*<?php echo $tnameErr ?></span>
                    </div>
                    <div class="form-item">
                        <span class="material-icons-outlined">phone</span>
                        <input type="text" name="tphone" placeholder="Enter your phone no" value="<?php echo $tphone; ?>" />
                        <span class="error" style=" color:red;background:transparent;font-weight:bolder;font-size:small">*<?php echo $tphoneErr ?></span>
                    </div>
                    <div class="form-item">
                        <span class="material-icons-outlined">email</span>
                        <input type="email" name="tmail" placeholder="Enter your email" value="<?php echo $tmail; ?>" />
                        <span class="error" style=" color:red;background:transparent;font-weight:bolder;font-size:small">*<?php echo $tmailErr ?></span>
                    </div>
                    <div class="form-item">
                        <span class="material-icons-outlined">security</span>
                        <input type="text" name="tssn" placeholder="Enter your Aadhaar number" value="<?php echo $tssn; ?>" />
                        <span class="error" style=" color:red;background:transparent;font-weight:bolder;font-size:small">*<?php echo $tssnErr ?></span>
                    </div>
                    <div class="form-item">
                        <span class="material-icons-outlined"> lock </span>
                        <input type="password" name="tpwd" placeholder="Enter your password" value="<?php echo $tpwd; ?>" />
                        <span class="error" style=" color:red;background:transparent;font-weight:bolder;font-size:small">*<?php echo $tpwdErr ?></span>
                    </div>
                    <button type="submit">LOGIN</button>
                    <a href="login.php">USER LOGIN</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>