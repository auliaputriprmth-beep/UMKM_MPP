<?php
// check_mysql.php
echo "<h2>Cek Port MySQL yang Aktif</h2>";

// Coba koneksi ke port yang umum digunakan
 $ports = [3306, 3307, 3308, 3309];
 $host = 'localhost';
 $username = 'root';
 $password = '';

foreach ($ports as $port) {
    try {
        $conn = new mysqli($host, $username, $password, '', $port);
        if (!$conn->connect_error) {
            echo "<p style='color:green'>✓ Koneksi berhasil ke port $port</p>";
            
            // Cek database yang ada
            $result = $conn->query("SHOW DATABASES");
            echo "<p>Database yang tersedia:</p><ul>";
            while ($row = $result->fetch_row()) {
                echo "<li>" . $row[0] . "</li>";
            }
            echo "</ul>";
            
            $conn->close();
        }
    } catch (Exception $e) {
        echo "<p style='color:red'>✗ Gagal koneksi ke port $port: " . $e->getMessage() . "</p>";
    }
}
?>