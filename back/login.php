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

$email = '';
$pass = '';
$result = '';
$id = '';
$name = '';
$surname = '';



if (isset($_GET['email'])) {
    $email = $_GET['email'];
}
if (isset($_GET['pass'])) {
    $pass = $_GET['pass'];
}

$sql = $conn -> query("SELECT * FROM users_table WHERE email = '$email' AND password = '$pass'");

$data = $sql -> fetch_assoc();

if ($data) {
    $result = true;
    $id = $data['user_id'];
    $name = $data['name'];
    $surname = $data['surname'];
} else {
    $result = false;
}

echo json_encode(array('pass' => $pass, 'email' => $email, 'result' => $result, 'name' => $name, 'surname' => $surname, 'user_id' => $id));

mysqli_close($conn);
?>
