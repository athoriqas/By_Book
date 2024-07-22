<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uploadDir = 'C:/New folder/htdocs/byBook/assets/';
    $file = $_FILES['cover'];
    
    if ($file['error'] === UPLOAD_ERR_OK) {
        $fileName = basename($file['name']);
        $targetFile = $uploadDir . $fileName;

        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            $bookId = $_POST['id'];
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "by_book";
            
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $stmt = $conn->prepare("UPDATE buku SET cover = ? WHERE id = ?");
            $stmt->bind_param("si", $fileName, $bookId);

            if ($stmt->execute()) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to update database.']);
            }

            $stmt->close();
            $conn->close();
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to move uploaded file.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'File upload error.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
