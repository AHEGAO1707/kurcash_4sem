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

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$sql = $conn -> query("UPDATE tasks_table SET card_status_id = 1 WHERE task_id = '$id'");

mysqli_close($conn);
?>
