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
$feedback_type_id = '';
$description = '';


if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

if (isset($_GET['description'])) {
    $description = $_GET['description'];
}
if (isset($_GET['feedback_type_id'])) {
    $feedback_type_id = $_GET['feedback_type_id'];
}

$sql = $conn -> query("INSERT INTO feedback_table (description, 	feedback_owner_id, feedback_type_id) VALUES ('$description', '$id', '$feedback_type_id')");

mysqli_close($conn);
?>
