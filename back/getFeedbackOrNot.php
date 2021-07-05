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
$id = '';
$result = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$sql = $conn -> query("SELECT * FROM feedback_table WHERE feedback_owner_id = '$id'");

$data = $sql -> fetch_assoc();


if ($data) {
    $result = false;
} else {
    $result = true;
}

echo json_encode(array('result' => $result));

mysqli_close($conn);
?>
