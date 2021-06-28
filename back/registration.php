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

$name = '';
$surname = '';
$email = '';
$pass = '';
$result = '';

if (isset($_GET['name'])) {
    $name = $_GET['name'];
}
if (isset($_GET['surname'])) {
    $surname = $_GET['surname'];
}
if (isset($_GET['email'])) {
    $email = $_GET['email'];
}
if (isset($_GET['pass'])) {
    $pass = $_GET['pass'];
}

    $sql = $conn->query("INSERT INTO users_table(name, surname, email, password) VALUES ('$name', '$surname', '$email', '$pass')");

if ($sql) {
    $result = true;
} else {
    $result = false;
}

echo json_encode(array('name' => $name, 'surname' => $surname, 'pass' => $pass, 'email' => $email, 'result' => $result));

mysqli_close($conn);
?>
