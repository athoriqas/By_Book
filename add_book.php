<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['title'];
    $penulis = $_POST['author'];
    $harga = $_POST['price'];
    $deskripsi = $_POST['description'];
    $cover = ''; // Default empty cover

    // Jika ada file cover
    if (isset($_FILES['cover']) && $_FILES['cover']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'C:/New folder/htdocs/byBook/assets/';
        $fileName = basename($_FILES['cover']['name']);
        $targetFile = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['cover']['tmp_name'], $targetFile)) {
            $cover = $fileName;
        }
    }

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "by_book";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO buku (judul, penulis, harga, deskripsi, cover) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiss", $judul, $penulis, $harga, $deskripsi, $cover);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add book.']);
    }

    $stmt->close();
    $conn->close();
}
?>
