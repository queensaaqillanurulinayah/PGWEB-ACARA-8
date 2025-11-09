<!DOCTYPE html> 
<html> 

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Data Kecamatan</title>
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #74ABE2, #c3c9ffff);
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: flex-start;
        min-height: 100vh;
    }

    .container {
        background-color: #fff;
        width: 90%;
        max-width: 500px;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        margin-top: 50px;
        animation: fadeIn 0.6s ease;
    }

    h2 {
        text-align: center;
        color: #333;
        margin-bottom: 25px;
        letter-spacing: 1px;
    }

    label {
        font-weight: 600;
        color: #333;
        margin-top: 10px;
        display: block;
    }

    input[type="text"] {
        width: 100%;
        padding: 10px;
        margin-top: 6px;
        border: 1px solid #ccc;
        border-radius: 8px;
        transition: 0.3s;
        outline: none;
    }

    input[type="text"]:focus {
        border-color: #ccd1ffff;
        box-shadow: 0 0 5px rgba(189, 196, 255, 0.4);
    }

    input[type="submit"] {
        background-color: #434984ff;
        color: white;
        border: none;
        padding: 12px;
        width: 100%;
        border-radius: 10px;
        font-size: 16px;
        cursor: pointer;
        margin-top: 20px;
        transition: background 0.3s ease;
    }

    input[type="submit"]:hover {
        background-color: #3943a5;
    }

    #informasi {
        text-align: center;
        margin-top: 15px;
        color: red;
        font-weight: 500;
    }

    @keyframes fadeIn {
        from {opacity: 0; transform: translateY(-10px);}
        to {opacity: 1; transform: translateY(0);}
    }
</style>
</head>

<body> 
    <div class="container">
<h2>Form Edit</h2> 
<?php 
    // Sesuaikan dengan setting MySQL 
    $servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $dbname = "acara_8"; 
 
    // Create connection 
    $conn = new mysqli($servername, $username, $password, $dbname); 
 
    // Check connection 
    if ($conn->connect_error) { 
        die("Connection failed: " . $conn->connect_error); 
    } 
     
    $id = $_GET['id'];
    $sql = "SELECT * FROM data_kecamatan  WHERE id = $id"; 
    $result = $conn->query($sql); 
     
    if ($result->num_rows > 0) { 
        echo "<form action='edit.php' onsubmit='return validateForm()' method='post'>"; 
        while($row = $result->fetch_assoc()) { 
            echo "<input type='hidden' name='id' value='".$row['id']."'><br>"; 
            echo "<label for='kecamatan'>Kecamatan:</label><br>"; 
            echo "<input type='text' id='kec' name='kecamatan' value='".$row['kecamatan']."'><br>"; 
            echo "<label for='kecamatan'>Longitude:</label><br>"; 
            echo "<input type='text' id='long' name='longitude' value='".$row['longitude']."'><br>"; 
            echo "<label for='kecamatan'>Latitude:</label><br>"; 
            echo "<input type='text' id='lat' name='latitude' value='".$row['latitude']."'><br>"; 
            echo "<label for='luas'>Luas:</label><br>"; 
            echo "<input type='text' id='luas' name='luas' value='".$row['luas']."'><br>"; 
            echo "<label for='jumlah_penduduk'>Jumlah Penduduk:</label><br>"; 
            echo "<input type='text' id='jml_pddk' name='jumlah_penduduk'value='".$row['jumlah_penduduk']."'><br><br>"; 
        } 
        echo "<input type='submit' value='Submit'>";     
        echo "</form>";  
    }    
?> 
 
<p id="informasi"></p> 
 
<script> 
    function validateForm() { 
         
        let luas = document.getElementById("luas").value; 
        let text=""; 
        if (isNaN(luas) || luas < 1) { 
        text = "Data luas harus angka dan tidak boleh bernilai negatif"; 
        // stop the form submission 
        event.preventDefault(); 
        }  
         
        document.getElementById("informasi").innerHTML = text; 
    } 
</script> 
</body> 
</html> 