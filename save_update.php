<?php
// ตรวจสอบว่ามีการส่งแบบฟอร์มหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // เชื่อมต่อกับฐานข้อมูล MySQL
    $servername = "localhost";
    $username = "nattaphol09";
    $password = "park1234";
    $dbname = "admin_dashboard";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // ดึงข้อมูลจากแบบฟอร์ม <from>
        $id = $_POST['id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];

        // Prepare SQL UPDATE statement
        $sql = "UPDATE user_data
                SET first_name = :first_name,
                    last_name = :last_name,
                    email = :email,
                    gender = :gender,
                    id = :id
                WHERE id = :id";

        // Prepare and execute SQL statement ใช้ bindParam นำค่าที่ได้เเทนที่ค่าตัวแปร
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':gender', $gender);
        $stmt->execute();

        

        
        header("Location: index.php");
            exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
} else {
    echo "ไม่ได้รับข้อมูลจากฟอร์ม";
    // If the form is not submitted, do nothing or handle the case accordingly
}
?>
