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

$total_users = '';

$sql = $conn -> query("SELECT COUNT(*) FROM users_table");

$data = $sql -> fetch_assoc();

$total_users = $data['COUNT(*)'];

echo json_encode(array('data' => $total_users));

mysqli_close($conn);
?>
