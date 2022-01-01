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
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Profile</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet" />
  <link rel="stylesheet" href="../css/profile.css" />
</head>

<body>
  <?php
  $server = "localhost";
  $username = "root";
  $password = "";

  $conn = mysqli_connect($server, $username, $password);

  if (!$conn) {
    die("Connection to this database failed due to" . mysqli_connect_error());
  }
  $sql = "SELECT * FROM `apartment`.`tenant` WHERE tid=$tid";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $tname = $row['tname'];
  $tssn = $row['tssn'];
  $tphone = $row['tphone'];
  $tmail = $row['tmail'];
  $tpwd = $row['tpwd'];

  $n1 = $n2 = $n3 = "";
  $ar = str_split($tssn);
  for ($x = 0; $x < count($ar); $x++) {
    if ($x < 4) {
      $n1 = $n1 . $ar[$x];
    } else if ($x < 8) {
      $n2 = $n2 . $ar[$x];
    } else {
      $n3 = $n3 . $ar[$x];
    }
  }
  $tssn = $n1 . ' ' . $n2 . ' ' . $n3;

  $n1 = $n2 = $n3 = "";
  $ar = str_split($tphone);
  for ($x = 0; $x < count($ar); $x++) {
    if ($x < 3) {
      $n1 = $n1 . $ar[$x];
    } else if ($x < 6) {
      $n2 = $n2 . $ar[$x];
    } else {
      $n3 = $n3 . $ar[$x];
    }
  }
  $tphone = $n1 . ' ' . $n2 . ' ' . $n3;
  ?>
  <div class="background">
    <div class="container">
      <h1>Profile</h1>
      <div class="block">
        <div class="form-item">
          <span class="material-icons-outlined"> account_circle </span>
          <p><?php echo $tid ?></p>
        </div>
        <div class="form-item">
          <span class="material-icons-outlined"> person </span>
          <p><?php echo $tname ?></p>
        </div>
        <div class="form-item">
          <span class="material-icons-outlined"> phone </span>
          <p><?php echo $tphone ?></p>
        </div>
        <div class="form-item">
          <span class="material-icons-outlined"> email </span>
          <p><?php echo $tmail ?></p>
        </div>
        <div class="form-item">
          <span class="material-icons-outlined"> security </span>
          <p><?php echo $tssn ?></p>
        </div>
      </div>
      <!-- <form action='/* echo htmlspecialchars($_SERVER["PHP_SELF"]); */' method="post"> -->
      <!-- <label for="change">Change details?</label>
      <select id="change" name="change">
        <option value="tphone">Phone No</option>
        <option value="tmail">Email</option>
        <option value="tpwd">Password</option>
      </select>
      <input type="submit" name="submit" />
      <br> -->
      <?php
      // if (isset($_POST['submit'])) {
      //   $tpwdErr = "";
      //   if (!empty($_POST['change'])) {
      //     $selected = $_POST['change'];
      //     if (strcmp($selected, "tpwd") == 0) {
      //       echo '<input type="password" name="otpwd" placeholder="Enter your old password" /><br>';
      //       echo '<input type="password" name="ntpwd" placeholder="Enter your old password" />';
      //       echo '<span class="error" style=" color:red;background:transparent;font-weight:bolder;font-size:small"> ' . $tpwdErr . '</span>';
      //       echo '<br><input type="submit" name="confirm" value="confirm"/>';
      //     }
      //   }
      // }
      // if (isset($_POST['confirm'])) {
      //   if (strcmp($_POST['otpwd'], $tpwd) == 0) {
      //     $npwd = $_POST['ntpwd'];
      //     if (empty($npwd)) {
      //       $tpwdErr = "Password is required";
      //     } else {
      //       $tpwd = test_input($npwd);
      //       if (strlen($tpwd) > 10) {
      //         $tpwdErr = "Password should not be greater than 10 characters";
      //         $tpwd = "";
      //       } else {
      //         $sql = "UPDATE`apartment`.`tenant` SET tpwd=$npwd WHERE tid=$tid";
      //         $result = $conn->query($sql);
      //       }
      //     }
      //   } else {
      //     $tpwdErr = "Old Password is incorrect";
      //   }
      // }
      // //  else {
      // //   echo 'Please select the value.';
      // // }
      $conn->close();
      ?>
      </form>
    </div>
  </div>
</body>

</html>