<?php
// Check if the form is submitted
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

        // Prepare and execute SQL statement ใช้ bindParam เเทนที่ค่าตัวแปร
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
    // If the form is not submitted, do nothing or handle the case accordingly
}
?>
