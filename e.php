<?php
session_start();
$conn = new mysqli("localhost", "root", "", "nama_database_kamu");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verifikasi password terenkripsi
        if (password_verify($password, $user['password'])) {
            $_SESSION['loggedInUser'] = $username;
            header("Location: dashboard.php");
        } else {
            echo "Password salah!";
        }
    } else {
        echo "Username tidak ditemukan!";
    }
}
?>