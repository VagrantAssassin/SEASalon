<?php

// Koneksi ke database
$conn = mysqli_connect("localhost","root","","seasalonver2");

// Validasi data input
$nama = trim($_POST["nama"]);
$service = $_POST["service"];
$hp = trim($_POST["hp"]);
$tanggal = trim($_POST["tanggal"]);

// Validasi waktu reservasi
$waktu_valid = strtotime($tanggal) >= strtotime('09:00:00') &&
              strtotime($tanggal) <= strtotime('20:00:00');

if (!$nama || !$hp || !$service || !$waktu_valid) {
  echo "<p>Data tidak valid. Silahkan periksa kembali.</p>";
  exit;
}

// Simpan data reservasi ke database
$sql = "INSERT INTO reservations (nama, service, hp, tanggal) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $nama, $service, $hp, $tanggal);

if ($stmt->execute()) {
  echo "<p>Reservasi berhasil dibuat!</p>";
}

$stmt->close();
$conn->close();