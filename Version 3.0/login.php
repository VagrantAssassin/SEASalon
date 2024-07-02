<?php

session_start();

// Validasi data login
$user_id = trim($_POST["user_id"]);
$password = trim($_POST["password"]);

// Koneksi ke database
$conn = mysqli_connect("localhost","root","","seasalonver2");

// Validasi user ID dan password
$sql_login = "SELECT * FROM member WHERE member_id = ? AND password = ?";
$stmt_login = $conn->prepare($sql_login);
$stmt_login->bind_param("ss", $user_id, $password);
$stmt_login->execute();
$result_login = $stmt_login->get_result();

if ($result_login->num_rows > 0) {
  // Login berhasil
  $_SESSION['user_id'] = $user_id;

  // Alihkan ke dashboard.html
  header("Location: dashboard.html");
  exit;
} else {
  // Login gagal
  echo "<p>Login gagal. User ID atau password salah.</p>";
}

$conn->close();

?>