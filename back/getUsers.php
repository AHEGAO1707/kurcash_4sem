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

$result = '';


$sql = $conn -> query("SELECT * FROM users_table");

if ($sql) {
    $result = true;
    $data = array();
    while ($row = $sql -> fetch_assoc()){
        array_push($data,$row);
    }
} else {
    $result = false;
}

echo json_encode(array('data' => $data, 'result' => $result));

mysqli_close($conn);
?>
