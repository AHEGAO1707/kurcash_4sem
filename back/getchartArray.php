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

$sql = $conn -> query("SELECT tasks_types.description names1, COUNT(card_status_id) count1 FROM tasks_table JOIN tasks_types ON card_status_id = type_id GROUP BY card_status_id");

$data = array();
while ($row = $sql -> fetch_assoc()) {
    array_push($data, $row);
}

$result['chart'] = $data;
echo json_encode($result);

mysqli_close($conn);
?>
