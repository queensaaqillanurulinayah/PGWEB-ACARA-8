<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acara 8</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        /* ---------- GLOBAL STYLE ---------- */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #e0e7ff, #f3f4f6);
            margin: 0;
            text-align: center;
            padding: 0;
            color: #1e293b
            
        }

        h1 {
            text-align: center;
            padding: 20px;
            margin-bottom: 10px;
            color: #1e3a8a;
        }

        .container {
            width: 90%;
            max-width: 900px;
            margin: 0 auto;
            background: #ffffff;
            padding: 20px 30px;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        }

        /* ---------- LINK / BUTTON ---------- */
        a {
            display: inline-block;
            background-color: #80bdffff;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 12px;
            font-weight: 600;
            box-shadow: 0 3px 5px rgba(255, 128, 191, 0.3);
            transition: all 0.3s ease;
            margin-bottom: 25px
        }

        a:hover {
            background-color: #3730a3;
            transform: translateY(-2px);
        }

        /* ---------- TABLE ---------- */
        table {
            width: 90%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 15px;
            margin: 0 auto;
        }

        th,
        td {
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

        /* ---------- FOOTER ---------- */
        footer {
            text-align: center;
            margin-top: 30px;
            font-size: 13px;
            color: #64748b;
        }
    </style>
</head>

<body>
    <?php
    // Sesuaikan dengan setting MySQL 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "acara_8";

    // Create connection 
    $conn = new mysqli($servername, $username, $password, $dbname);

    $sql = "SELECT * FROM data_kecamatan";
    $result = $conn->query($sql);

    echo "<h1>Data Kecamatan</h1>";

    echo "<a href='input/index.html' class='btn-input'>+ Tambah Data</a>";

    if ($result->num_rows > 0) {
        echo "<table border='1px'><tr>
  <th>id</th> 
  <th>Kecamatan</th> 
  <th>Longitude</th> 
  <th>Latitude</th>
  <th>Luas</th> 
  <th>Jumlah Penduduk</th>";

        // output data of each row 
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td align='center'>" .
                $row["id"] . "</td><td align='center'>" . $row["kecamatan"] . "</td><td align='center'>" .
                $row["longitude"] . "</td><td align='center'>" .
                $row["latitude"] . "</td><td align='center'>" .
                $row["luas"] . "</td><td align='center'>" .
                $row["jumlah_penduduk"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>


</body>

</html>