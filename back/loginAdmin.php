<?php
$servername = "localhost";
$database = "task_tracker";
$username = "root";
$password = "";
// Создаем соединение
$conn = mysqli_connect($servername, $username, $password, $database);
// Проверяем соединение
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//echo "Connected successfully";

$email = '';
$pass = '';
$result = '';



if (isset($_GET['email'])) {
    $email = $_GET['email'];
}
if (isset($_GET['pass'])) {
    $pass = $_GET['pass'];
}

$sql = $conn -> query("SELECT * FROM admin_table WHERE email = '$email' AND password = '$pass'");

if ($sql -> num_rows > 0) {
    $result = true;
} else {
    $result = false;
}

echo json_encode(array('result' => $result));

mysqli_close($conn);
?>
