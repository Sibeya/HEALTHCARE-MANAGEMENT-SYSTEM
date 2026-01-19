<?php
$conn = new mysqli("localhost", "root", "", "health_db");

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Connection failed: " . $conn->connect_error]));
}

$sql = "SELECT * FROM patients ORDER BY created_at DESC";
$result = $conn->query($sql);

$patients = [];
while ($row = $result->fetch_assoc()) {
    $patients[] = $row;
}

echo json_encode($patients);

$conn->close();
?>
