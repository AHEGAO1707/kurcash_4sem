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

$sql = $conn -> query("SELECT * FROM feedback_table ORDER BY feedback_id DESC LIMIT 5");

if ($sql) {
    $data = array();
    while ($row = $sql -> fetch_assoc()){
        array_push($data,$row);
    }
} else {
    $result = false;
}

echo json_encode(array('data' => $data));

mysqli_close($conn);
?>
