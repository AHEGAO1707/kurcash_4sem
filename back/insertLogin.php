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

$sql = $conn->query("INSERT INTO logins_table(user_logged_id) VALUES ('$id')");

mysqli_close($conn);
?>
