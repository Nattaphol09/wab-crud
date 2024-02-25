<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "admin_dashboard";
$conn = null;
$countUsers = 0;
$countMale = 0;
$countFemale = 0;
$countOther = 0;
$sumMale = 0;
$sumFemale = 0;
$sumOther = 0;
$dataTable = null;


// สร้างการเชื่อมต่อกับฐานข้อมูล MySQL โดยใช้ PDO (PHP Data Objects)
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully!!";

} catch (PDOException $e) {
    echo "Connection failed" . $e->getMessage();
}

// สร้าง function นับข้อมูล Users ใน user_data
function countUsers($conn)
{
    $sql = "SELECT COUNT(*) as users FROM user_data";
    $query = $conn->prepare($sql);
    $query->execute();
    $fetch = $query->fetch();

    return $fetch['users'];
}

// สร้าง function นับข้อมูล Male ใน user_data
function countUsersMale($conn)
{
    $sql = "SELECT COUNT(*) as Male FROM user_data WHERE gender = 'Male'";
    $query = $conn->prepare($sql);
    $query->execute();
    $fetch = $query->fetch();

    return $fetch['Male'];
}

// สร้าง function นับข้อมูล Female ใน user_data
function countUsersFemale($conn)
{
    $sql = "SELECT COUNT(*) as Female FROM user_data WHERE gender = 'Female'";
    $query = $conn->prepare($sql);
    $query->execute();
    $fetch = $query->fetch();

    return $fetch['Female'];
}

// สร้าง function นับข้อมูลที่ไม่ใช้ Male,Female ใน user_data
function countOther($conn)
{
    $sql = "SELECT COUNT(*) as Other FROM user_data WHERE (gender IN ('Agender','Bigender','Non-binary','Polygender','Genderfluid','Genderqueer','Other')) ";
    $query = $conn->prepare($sql);
    $query->execute();
    $fetch = $query->fetch();

    return $fetch['Other'];
}

// สร้าง function ดึงข้อมูลใน user_data มาทำตาราง(Tables)
function dataTables($conn)
{
    $sql = "SELECT * FROM user_data";
    $query = $conn->prepare($sql);
    $query->execute();
    $fetch = $query->fetchAll();

    return $fetch;
}

// เรียกใช้ function
$countUsers = countUsers($conn);
$countMale = countUsersMale($conn);
$countFemale = countUsersFemale($conn);
$countOther = countOther($conn);
$dataTable = dataTables($conn);

// คำนวณหาค่า % 
$sumMale = ($countMale / $countUsers) * 100;
$sumFemale = ($countFemale / $countUsers) * 100;
$sumOther = ($countOther / $countUsers) * 100;

// สร้างข้อมูลในรูปแบบของ array 
$data = array(
    // "keys" => values,
    "Male" => $sumMale,
    "Female" => $sumFemale,
    "Other" => $sumOther,
);



// แปลงข้อมูลในรูปแบบ array เป็น JSON และส่งกลับไปยัง JavaScript
echo json_encode($data);
