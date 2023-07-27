<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'robot_db';

$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$distance = $_POST['distance'];
$direction = $_POST['direction'];

$sql = "INSERT INTO path (distance, direction) VALUES ('$distance', '$direction')";

if (mysqli_query($conn, $sql)) {
    $sql = "SELECT * FROM path ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

$paths = array();
while ($row = mysqli_fetch_assoc($result)) {
  $paths[] = $row;
}

header("Location: index.html?paths=" . urlencode(json_encode($paths)));
exit();
} else {
  echo "حدث خطأ: " . mysqli_error($conn);
}

mysqli_close($conn);
?>