<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to MySQL database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "admin_dashboard";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Retrieve data from form
        $first_name = $_POST['first_name']; //
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];

        // Prepare SQL INSERT statement
        $sql = "INSERT INTO user_data (first_name, last_name, email, gender) VALUES ( :first_name, :last_name, :email, :gender)";

        // Prepare and execute SQL statement
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

    // Close database connection
    $conn = null;
} else {
    //echo "ไม่ได้รับข้อมูลจากฟอร์ม";
}
//echo $_POST['first_name'];
