<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "admin_dashboard";
$conn = null;

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id = $_GET['id'];

// ลบข้อมูล
$sql_delete = "DELETE FROM user_data WHERE id = $id";
$query_delete = $conn->prepare($sql_delete);
$query_delete->execute();

// อัปเดต id ที่มากกว่า id ที่ถูกลบ
$sql_update = "UPDATE user_data SET id = id - 1 WHERE id > $id";
$query_update = $conn->prepare($sql_update);
$query_update->execute();

// หา id ที่มากที่สุดในฐานข้อมูล
$sql_max_id = "SELECT MAX(id) AS max_id FROM user_data";
$query_max_id = $conn->prepare($sql_max_id);
$query_max_id->execute();
$result_max_id = $query_max_id->fetch(PDO::FETCH_ASSOC);
$max_id = $result_max_id['max_id'];

// อัปเดตค่า AUTO_INCREMENT
$new_auto_increment = $max_id + 1;
$sql_reset_auto_increment = "ALTER TABLE user_data AUTO_INCREMENT = $new_auto_increment";
$query_reset_auto_increment = $conn->prepare($sql_reset_auto_increment);
$query_reset_auto_increment->execute();

} catch (PDOException $e ) {
    echo "Error: " . $e->getMessage();
}


header("Location: index.php");
exit;

?>