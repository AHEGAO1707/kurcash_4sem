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


$pass = '';
$result = '';
$id = '';



if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
if (isset($_GET['nowPass'])) {
    $pass = $_GET['nowPass'];
}

$sql = $conn -> query("SELECT * FROM users_table WHERE user_id = '$id' AND password = '$pass'");

$data = $sql -> fetch_assoc();

if ($data) {
    $result = true;
    $pass = $data['password'];

} else {
    $result = false;
}

echo json_encode(array('pass' => $pass, 'result' => $result));

mysqli_close($conn);
?>
