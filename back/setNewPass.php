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
if (isset($_GET['newPass'])) {
    $pass = $_GET['newPass'];
}

$sql = $conn -> query("UPDATE users_table SET password = '$pass' WHERE user_id = '$id'");

/*$data = $sql -> fetch_assoc();

if ($data) {
    $result = true;

} else {
    $result = false;
}

echo json_encode(array('result' => $result));*/

mysqli_close($conn);
?>

