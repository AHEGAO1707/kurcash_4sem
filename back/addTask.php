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
$title = '';
$description = '';


if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
if (isset($_GET['title'])) {
    $title = $_GET['title'];
}
if (isset($_GET['description'])) {
    $description = $_GET['description'];
}

$sql = $conn -> query("INSERT INTO tasks_table (title, description, task_owner_id, card_status_id) VALUES ('$title', '$description', '$id', 1)");

mysqli_close($conn);
?>
