<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Kecamatan - Acara 8</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #e0e7ff, #f3f4f6);
      margin: 0;
      text-align: center;
      color: #1e293b;
    }

    .container {
      width: 90%;
      max-width: 1000px;
      margin: 30px auto;
      background: #ffffff;
      padding: 20px 30px;
      border-radius: 15px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    }

    h1 {
      color: #1e3a8a;
    }

    a {
      display: inline-block;
      background-color: #4f46e5;
      color: white;
      text-decoration: none;
      padding: 10px 20px;
      border-radius: 10px;
      font-weight: 600;
      transition: 0.3s ease;
      margin-bottom: 20px;
    }

    a:hover {
      background-color: #3730a3;
      transform: translateY(-2px);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 15px;
    }

    th, td {
      border: 1px solid #cbd5e1;
      padding: 10px;
      text-align: center;
    }

    th {
      background-color: #4f46e5;
      color: #fff;
      font-weight: 600;
    }

    tr:nth-child(even) {
      background-color: #f1f5f9;
    }

    tr:hover {
      background-color: #e0e7ff;
      transition: 0.2s;
    }
  </style>
</head>
<body>

  <div class="container">
    <h1>Data Kecamatan</h1>

    <a href="input/index.html">+ Tambah Data</a>
    <a href="peta.php">🌍 Lihat Peta</a>

    <?php
    // Koneksi ke database
    $conn = new mysqli("localhost", "root", "", "acara_8");
    if ($conn->connect_error) {
      die("Koneksi gagal: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM data_kecamatan";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      echo "<table>
        <tr>
          <th>ID</th>
          <th>Kecamatan</th>
          <th>Longitude</th>
          <th>Latitude</th>
          <th>Luas</th>
          <th>Jumlah Penduduk</th>
          <th colspan='2'>Aksi</th>
        </tr>";

      while ($row = $result->fetch_assoc()) {
        echo "<tr>
          <td>{$row['id']}</td>
          <td>{$row['kecamatan']}</td>
          <td>{$row['longitude']}</td>
          <td>{$row['latitude']}</td>
          <td>{$row['luas']}</td>
          <td>{$row['jumlah_penduduk']}</td>
          <td><a href='delete.php?id={$row['id']}'>Hapus</a></td>
          <td><a href='edit/index.php?id={$row['id']}'>Edit</a></td>
        </tr>";
      }
      echo "</table>";
    } else {
      echo "<p>Tidak ada data ditemukan.</p>";
    }

    $conn->close();
    ?>
  </div>
</body>
</html>
