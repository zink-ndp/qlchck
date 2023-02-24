
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$sql = "select nv_id, nv_hoten, nv_email, nv_vaitro from nhan_vien where nv_tendangnhap = '".$_POST["usname"]."' and nv_matkhau = '".$_POST["pass"]."'";

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
  $_SESSION["name"] = "nv_hoten";
  $_SESSION["fullname"] = $row['nv_email'];
  $_SESSION["id"] = $row['nv_id'];
  $_SESSION["role"] = $row['nv_vaitro'];
  
  if ($_SESSION["role"] == 0){
    header('Location: dashboard.php');
  } else {
    header('Location: create_bill.php');
  }

  
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
  //Tro ve trang dang nhap sau 3 giay
  header('Refresh: 4;url=sign-in.php');

}

$conn->close();
?>
