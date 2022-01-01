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
  <title>Search Owner</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet" />
  <link rel="stylesheet" href="../css/search.css" />
</head>

<body>
  <div class="background">
    <div class="container">
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-item">
          <span class="material-icons-outlined"> room </span>
          <input type="text" name="room_no" placeholder="Enter room no" style=" color: rgb(30, 255, 0); " />
        </div>
        <button type="submit">Submit</button>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $room_no = $_POST["room_no"];
          if (!empty($_POST["room_no"])) {
            $server = "localhost";
            $username = "root";
            $password = "";

            $conn = mysqli_connect($server, $username, $password);

            if (!$conn) {
              die("Connection to this database failed due to" . mysqli_connect_error());
            }
            $sql = "SELECT * From `apartment`.`owner` WHERE room_no ='$room_no'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              $oname = $row['oname'];
              $omail = $row['omail'];
              $ophone = $row['ophone'];
              echo '<div class="form-item">
              <span class="material-icons-outlined" > account_circle </span><p style=" color:yellow; ">' . $oname
                . ' </p></div>';
              echo '<div class="form-item">
                      <span class="material-icons-outlined">phone</span><p style=" color: yellow; ">' . $ophone . '</p>
                  </div>';
              echo '<div class="form-item">
                  <span class="material-icons-outlined">email</span><p style=" color: yellow">' . $omail . '</p>
              </div>';
            } else {
              echo '<div class="form-item">
                 <p style=" color: red; ">Room does not exist</p>
              </div>';
            }
          } else {
            echo '<div class="form-item">
               <p style=" color: red; ">Please enter a room no</p>
            </div>';
          }
        }

        ?>
      </form>
    </div>
  </div>
</body>

</html>