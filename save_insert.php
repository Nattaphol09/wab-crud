<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // เชื่อมต่อกับฐานข้อมูล MySQL
    $servername = "localhost";
    $username = "nattaphol09";
    $password = "park1234";
    $dbname = "admin_dashboard";
    $conn = null;

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // ดึงข้อมูลจากแบบฟอร์ม <from>
        $first_name = $_POST['first_name']; //
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];

        // Prepare SQL INSERT statement
        $sql = "INSERT INTO user_data (first_name, last_name, email, gender) VALUES ( :first_name, :last_name, :email, :gender)";

        // Prepare and execute SQL statement ใช้ bindParam นำค่าที่ได้เเทนที่ค่าตัวแปร
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':gender', $gender);
        $stmt->execute();

        header("Location: index.php");
        exit;
        echo "บันทึกข้อมูลสำเร็จ";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    
    
} else {
    echo "ไม่ได้รับข้อมูลจากฟอร์ม";
}
//echo $_POST['first_name'];
