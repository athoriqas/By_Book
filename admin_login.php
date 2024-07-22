<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "by_book";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['adminLoginEmail'];
    $password = $_POST['adminLoginPassword'];

    // Ambil password dari database berdasarkan email
    $sql = "SELECT id, email, password FROM admin WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $stored_password = $row['password'];

        // Verifikasi password
        if ($password === $stored_password) { // Ganti password_verify dengan perbandingan string
            // Password benar, arahkan ke halaman pageAdmin.html
            $_SESSION['admin'] = $row['id']; // Simpan ID admin ke session jika diperlukan
            header("Location: pageAdmin.html");
            exit();
        } else {
            // Password salah, berikan notifikasi
            echo "<script>alert('Password salah'); window.location.href = 'admin.html';</script>";
        }
    } else {
        // Email tidak ditemukan
        echo "<script>alert('Email tidak ditemukan'); window.location.href = 'admin.html';</script>";
    }

    $stmt->close();
}

$conn->close();
?>
