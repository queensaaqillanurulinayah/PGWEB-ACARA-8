<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "acara_8";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

$kecamatan = $_POST['kecamatan'];
$longitude = $_POST['longitude'];
$latitude = $_POST['latitude'];
$luas = $_POST['luas'];
$jumlah_penduduk = $_POST['jumlah_penduduk'];

$sql = "INSERT INTO data_kecamatan (kecamatan, longitude, latitude, luas, jumlah_penduduk)
        VALUES ('$kecamatan', '$longitude', '$latitude', '$luas', '$jumlah_penduduk')";

if ($conn->query($sql) === TRUE) {
  echo "<script>alert('Data berhasil disimpan!'); window.location.href='../index.php';</script>";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
