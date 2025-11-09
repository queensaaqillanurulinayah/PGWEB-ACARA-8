<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peta Data Kecamatan</title>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f3f4f6;
            margin: 0;
            color: #1e293b;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            color: #1e3a8a;
        }

        .map-container {
            width: 95%;
            max-width: 1300px;
            height: 600px;
            margin: 30px auto;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        #map {
            width: 100%;
            height: 100%;
        }

        a.back-link {
            display: inline-block;
            background-color: #6366f1;
            color: white;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 8px;
            font-weight: 600;
            transition: 0.3s;
            margin-left: 110px;
        }

        a.back-link:hover {
            background-color: #4338ca;
        }

        .leaflet-tooltip {
            font-weight: 600;
            color: #111827;
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid #94a3b8;
            border-radius: 6px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>

<h1>Peta Persebaran Kecamatan</h1>
<a href="index.php" class="back-link">⬅ Kembali ke Tabel</a>

<div class="map-container">
    <div id="map"></div>
</div>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "acara_8";

$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "SELECT * FROM data_kecamatan";
$result = $conn->query($sql);

// Ambil data dari database
$locations = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $locations[] = [
            'kecamatan' => $row['kecamatan'],
            'latitude' => $row['latitude'],
            'longitude' => $row['longitude'],
            'luas' => $row['luas'],
            'jumlah_penduduk' => $row['jumlah_penduduk']
        ];
    }
}
$conn->close();
?>

<script>
    // Inisialisasi peta (pusat di Yogyakarta)
    var map = L.map('map').setView([-7.7956, 110.3695], 11);

    // === Basemap Layers ===
    var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    });

    var satellite = L.tileLayer('https://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
        attribution: '© Google Satellite'
    });

    var topo = L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenTopoMap contributors'
    });

    var dark = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
        attribution: '© CartoDB'
    });

    // Tambahkan basemap default
    osm.addTo(map);

    // === Data Marker dari PHP ===
    var data = <?php echo json_encode($locations); ?>;
    var markers = L.layerGroup(); // Untuk menampung semua marker

    data.forEach(function(item) {
        if (item.latitude && item.longitude) {
            // Buat marker
            var marker = L.marker([item.latitude, item.longitude])
                .bindPopup(
                    `<b>${item.kecamatan}</b><br>` +
                    `Latitude: ${item.latitude}<br>` +
                    `Longitude: ${item.longitude}<br>` +
                    `Luas: ${item.luas} km²<br>` +
                    `Jumlah Penduduk: ${item.jumlah_penduduk}`
                )
                .bindTooltip(`${item.kecamatan}`, { permanent: false, direction: "top" }); // Tooltip muncul saat hover

            marker.addTo(markers);
        }
    });

    markers.addTo(map);

    // === Control Layer (untuk ganti basemap) ===
    var baseMaps = {
        "OpenStreetMap": osm,
        "Google Satellite": satellite,
        "OpenTopoMap": topo,
        "Dark Mode": dark
    };

    var overlayMaps = {
        "Titik Kecamatan": markers
    };

    L.control.layers(baseMaps, overlayMaps, { collapsed: false }).addTo(map);
</script>

</body>
</html>
