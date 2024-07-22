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
    $email = $_POST['loginEmail'];
    $password = $_POST['loginPassword'];

    // Ambil password dari database berdasarkan email
    $sql = "SELECT id, nama, email, password FROM user WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $stored_password = $row['password'];

        // Verifikasi password
        if (password_verify($password, $stored_password)) {
            // Password benar, arahkan ke halaman index.html atau halaman lain yang sesuai
            $_SESSION['nama'] = $row['nama']; // Simpan nama pengguna ke session jika diperlukan
            header("Location: user.php");
            exit();
        } else {
            // Password salah, berikan notifikasi
            echo "<script>alert('Password salah'); window.location.href = 'login.html';</script>";
        }
    } else {
        // Email tidak ditemukan
        echo "<script>alert('Email tidak ditemukan'); window.location.href = 'login.html';</script>";
    }

    $stmt->close();
}

$conn->close();
?>
