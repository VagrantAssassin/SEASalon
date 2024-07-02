<?php

// Koneksi ke database
$conn = mysqli_connect("localhost","root","","seasalonver2");

// Validasi data input
$userid = trim($_POST["user_id"]);
$nama = trim($_POST["full_name"]);
$email = trim($_POST["email"]);
$hp = trim($_POST["phone_number"]);
$password = trim($_POST["password"]);
$role = trim($_POST["role"]);

// Validasi user ID
if (empty($userid)) {
  echo "<p>User ID tidak boleh kosong.</p>";
  exit;
}

// Periksa apakah user ID sudah terdaftar
$sql_check_user_id = "SELECT * FROM member WHERE member_id = ?";
$stmt_check_user_id = $conn->prepare($sql_check_user_id);
$stmt_check_user_id->bind_param("s", $userid);
$stmt_check_user_id->execute();
$result_check_user_id = $stmt_check_user_id->get_result();

if ($result_check_user_id->num_rows > 0) {
  echo "<p>User ID sudah terdaftar.</p>";
  exit;
}

// Validasi email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  echo "<p>Email tidak valid.</p>";
  exit;
}

// SQL untuk memasukkan member baru
$sql = "INSERT INTO member (member_id, nama, email, hp, password, role) VALUES ('$userid', '$nama', '$email', '$hp', '$password', '$role')";

// Jalankan query SQL
if (mysqli_query($conn, $sql)) {
  echo "member berhasil ditambahkan!";
}

