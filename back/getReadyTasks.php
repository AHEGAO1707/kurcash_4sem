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
$id = '';


if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$sql = $conn -> query("SELECT task_id, title, description FROM tasks_table WHERE task_owner_id = '$id' AND card_status_id = 3");

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
