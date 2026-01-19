<?php
header('Content-Type: application/json');

$conn = new mysqli("localhost", "root", "", "health_db");

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Connection failed: " . $conn->connect_error]));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $age = (int) $_POST['age'];
    $condition = trim($_POST['condition']);
    $doctor = trim($_POST['doctor']);

    if (empty($name) || empty($age) || empty($condition) || empty($doctor)) {
        echo json_encode(["success" => false, "message" => "All fields are required."]);
        exit();
    }

    // Use backticks (`) for column names to avoid SQL syntax errors
    $stmt = $conn->prepare("INSERT INTO patients (name, age, `condition`, doctor, created_at) VALUES (?, ?, ?, ?, NOW())");
    if (!$stmt) {
        echo json_encode(["success" => false, "message" => "SQL Prepare Error: " . $conn->error]);
        exit();
    }

    $stmt->bind_param("siss", $name, $age, $condition, $doctor);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Patient added successfully!"]);
    } else {
        echo json_encode(["success" => false, "message" => "SQL Execution Error: " . $stmt->error]);
    }

    $stmt->close();
}

$conn->close();
?>
