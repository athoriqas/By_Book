<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "by_book";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'];
$rating = $data['rating'];

$sql = "UPDATE buku SET rating = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ii', $rating, $id);

$response = [];
if ($stmt->execute()) {
    $response['success'] = true;
} else {
    $response['success'] = false;
}

$stmt->close();
$conn->close();

header('Content-Type: application/json');
echo json_encode($response);
?>
