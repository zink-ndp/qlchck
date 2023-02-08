
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlch_cakieng";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$sql = "select id, ad_name, username from admin_account where username = '".$_POST["usname"]."' and password = '".$_POST["pass"]."'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
 
  $row = $result->fetch_assoc();
  
  /*
  COOKIE
  $cookie_name = "user";
  $cookie_value = $row['email'] ;
  setcookie($cookie_name, $cookie_value, time() + (86400 / 24), "/");
  setcookie("fullname", $row['fullname'], time() + (86400 / 24), "/");
  setcookie("id", $row['id'], time() + (86400 / 24), "/");*/
  
  //SESSION
  session_start();
  $_SESSION["name"] = "user";
  $_SESSION["fullname"] = $row['username'];
  $_SESSION["id"] = $row['id'];
  
  header('Location: dashboard.php');
  
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
  //Tro ve trang dang nhap sau 3 giay
  header('Refresh: 2;url=sign-in.php');

}

$conn->close();
?>
