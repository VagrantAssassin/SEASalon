<?php

// Koneksi database
$conn = mysqli_connect("localhost","root","","seasalonver2");

// Data komentar
$nama = $_POST['nama']; // Ambil nama dari formulir
$rating = $_POST['rating']; // Ambil rating dari formulir
$komentar = $_POST['komentar']; // Ambil komentar dari formulir

// SQL untuk memasukkan komentar baru
$sql = "INSERT INTO komentar (nama, rating, komentar) VALUES ('$nama', '$rating', '$komentar')";

// Jalankan query SQL
if (mysqli_query($conn, $sql)) {
  echo "Komentar berhasil ditambahkan!";
}

?>