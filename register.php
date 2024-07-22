<?php
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
    $nama = $_POST['signupName'];
    $email = $_POST['signupEmail'];
    $password = $_POST['signupPassword'];
    $confirmPassword = $_POST['signupConfirmPassword'];

    // Validasi password minimal 8 karakter
    if (strlen($password) < 8) {
        echo "<script>alert('Password harus minimal 8 karakter'); window.location.href = 'register.html';</script>";
        exit();
    }

    // Validasi password dan confirm password harus sama
    if ($password !== $confirmPassword) {
        echo "<script>alert('Password dan Confirm Password harus sama'); window.location.href = 'register.html';</script>";
        exit();
    }

    // Validasi email harus menggunakan @gmail.com
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match('/@gmail.com$/', $email)) {
        echo "<script>alert('Email harus menggunakan domain @gmail.com'); window.location.href = 'register.html';</script>";
        exit();
    }

    // Hash password sebelum disimpan ke database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert data ke database
    $sql = "INSERT INTO user (nama, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nama, $email, $hashed_password);

    if ($stmt->execute()) {
      // Redirect ke halaman login jika registrasi berhasil
      header("Location: login.html");
      exit();
    } else {
      echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>
