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
$total_current_tasks = '';

$sql = $conn -> query("SELECT COUNT(*) FROM tasks_table");

$data = $sql -> fetch_assoc();

$total_current_tasks = $data['COUNT(*)'];

echo json_encode(array('data' => $total_current_tasks));

mysqli_close($conn);
?>
