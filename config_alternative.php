<?php
// config_alternative.php
 $host = '127.0.0.1'; // Coba IP localhost
 $username = 'root';
 $password = '';
 $database = 'umkm_mpp';

// Opsi 1: Tanpa port
try {
    $conn = new mysqli($host, $username, $password, $database);
    echo "Koneksi berhasil tanpa port!";
} catch (Exception $e) {
    echo "Gagal tanpa port: " . $e->getMessage() . "<br>";
    
    // Opsi 2: Port 3306
    try {
        $conn = new mysqli($host, $username, $password, $database, 3306);
        echo "Koneksi berhasil ke port 3306!";
    } catch (Exception $e) {
        echo "Gagal ke port 3306: " . $e->getMessage() . "<br>";
        
        // Opsi 3: Port 3307
        try {
            $conn = new mysqli($host, $username, $password, $database, 3307);
            echo "Koneksi berhasil ke port 3307!";
        } catch (Exception $e) {
            echo "Gagal ke port 3307: " . $e->getMessage() . "<br>";
            
            // Opsi 4: Dengan socket (Unix/Linux)
            if (strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN') {
                try {
                    $conn = new mysqli(null, $username, $password, $database, null, "/var/run/mysqld/mysqld.sock");
                    echo "Koneksi berhasil dengan socket!";
                } catch (Exception $e) {
                    echo "Gagal dengan socket: " . $e->getMessage() . "<br>";
                }
            }
        }
    }
}
?>