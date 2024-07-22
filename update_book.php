<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $judul = $_POST['title'];
    $penulis = $_POST['author'];
    $harga = $_POST['price'];
    $deskripsi = $_POST['description'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "by_book";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("UPDATE buku SET judul = ?, penulis = ?, harga = ?, deskripsi = ? WHERE id = ?");
    $stmt->bind_param("ssisi", $judul, $penulis, $harga, $deskripsi, $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update book.']);
    }

    $stmt->close();
    $conn->close();
}
?>
