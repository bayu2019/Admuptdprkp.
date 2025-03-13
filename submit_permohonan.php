<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pemakaman";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Validate and sanitize input
$nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
$nik = filter_input(INPUT_POST, 'nik', FILTER_SANITIZE_STRING);
$alamat = filter_input(INPUT_POST, 'alamat', FILTER_SANITIZE_STRING);
$telepon = filter_input(INPUT_POST, 'telepon', FILTER_SANITIZE_STRING);
$tanggal = filter_input(INPUT_POST, 'tanggal', FILTER_SANITIZE_STRING);
$nomor = filter_input(INPUT_POST, 'nomor', FILTER_SANITIZE_STRING);

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO permohonan (nama, nik, alamat, telepon, tanggal, nomor) VALUES (?, ?, ?, ?, ?, ?)");
if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("ssssss", $nama, $nik, $alamat, $telepon, $tanggal, $nomor);

// Execute the statement
if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>