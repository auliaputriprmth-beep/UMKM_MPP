<?php
session_start();
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengiriman - UMKM Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
        .shipping-card { transition: all 0.3s ease; }
        .shipping-card:hover { transform: translateY(-5px); box-shadow: 0 10px 30px rgba(0,0,0,0.15); }
        .fade-in { animation: fadeIn 0.8s ease; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-lg sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <i class="fas fa-store text-indigo-600 text-2xl mr-2"></i>
                        <span class="font-bold text-xl text-gray-800">UMKM Store</span>
                    </div>
                    <div class="hidden md:ml-10 md:flex md:space-x-8">
                        <a href="index.php" class="text-gray-700 hover:text-indigo-600 px-3 py-2 text-sm font-medium transition">Beranda</a>
                        <a href="index.php#products" class="text-gray-700 hover:text-indigo-600 px-3 py-2 text-sm font-medium transition">Produk</a>
                        <a href="tentang.php" class="text-gray-700 hover:text-indigo-600 px-3 py-2 text-sm font-medium transition">Tentang</a>
                        <a href="layanan.php" class="text-gray-700 hover:text-indigo-600 px-3 py-2 text-sm font-medium transition">Layanan</a>
                        <a href="kontak.php" class="text-gray-700 hover:text-indigo-600 px-3 py-2 text-sm font-medium transition">Kontak</a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <?php if (isset($_SESSION['user'])): ?>
                        <a href="logout.php" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                            <i class="fas fa-sign-out-alt mr-2"></i>Keluar
                        </a>
                    <?php else: ?>
                        <a href="login.php" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                            <i class="fas fa-sign-in-alt mr-2"></i>Masuk
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Layanan Pengiriman</h1>
                <p class="text-xl mb-8">Pengiriman cepat dan aman ke seluruh Indonesia</p>
            </div>
        </div>
    </section>

    <!-- Shipping Options -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-12">Pilihan Pengiriman</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="shipping-card bg-white rounded-lg shadow-lg p-6">
                    <div class="text-center mb-4">
                        <i class="fas fa-bolt text-4xl text-yellow-500"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Same Day Delivery</h3>
                    <p class="text-gray-600 mb-4">Pengiriman di hari yang sama untuk area Jabodetabek</p>
                    <div class="text-2xl font-bold text-indigo-600">Rp 25.000</div>
                    <p class="text-sm text-gray-500">Estimasi: 6-8 jam</p>
                </div>

                <div class="shipping-card bg-white rounded-lg shadow-lg p-6">
                    <div class="text-center mb-4">
                        <i class="fas fa-truck text-4xl text-blue-500"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Regular Delivery</h3>
                    <p class="text-gray-600 mb-4">Pengiriman standar ke seluruh Indonesia</p>
                    <div class="text-2xl font-bold text-indigo-600">Rp 15.000</div>
                    <p class="text-sm text-gray-500">Estimasi: 2-3 hari</p>
                </div>

                <div class="shipping-card bg-white rounded-lg shadow-lg p-6">
                    <div class="text-center mb-4">
                        <i class="fas fa-rocket text-4xl text-purple-500"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Express Delivery</h3>
                    <p class="text-gray-600 mb-4">Pengiriman ekspres untuk kebutuhan mendesak</p>
                    <div class="text-2xl font-bold text-indigo-600">Rp 50.000</div>
                    <p class="text-sm text-gray-500">Estimasi: 1 hari</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Coverage Area -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-12">Area Pengiriman</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div>
                    <h3 class="text-2xl font-semibold mb-6 text-indigo-600">
                        <i class="fas fa-map-marked-alt mr-2"></i>Cakupan Pengiriman
                    </h3>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                            <div>
                                <h4 class="font-semibold">Pulau Jawa</h4>
                                <p class="text-gray-600">Semua kota besar dan kecil di Jawa, Bali, dan Madura</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                            <div>
                                <h4 class="font-semibold">Sumatera</h4>
                                <p class="text-gray-600">Medan, Palembang, Padang, Pekanbaru, Batam, dan kota lainnya</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                            <div>
                                <h4 class="font-semibold">Kalimantan</h4>
                                <p class="text-gray-600">Balikpapan, Samarinda, Pontianak, Palangkaraya, Banjarmasin</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                            <div>
                                <h4 class="font-semibold">Sulawesi & Papua</h4>
                                <p class="text-gray-600">Makassar, Manado, Kendari, Palu, Jayapura, dan lainnya</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <h3 class="text-2xl font-semibold mb-6 text-indigo-600">
                        <i class="fas fa-shipping-fast mr-2"></i>Waktu Pengiriman
                    </h3>
                    <div class="bg-gray-50 rounded-lg p-6">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b">
                                    <th class="text-left py-2">Area</th>
                                    <th class="text-right py-2">Estimasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b">
                                    <td class="py-2">Jakarta & Sekitarnya</td>
                                    <td class="text-right">1-2 hari</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-2">Jawa Barat</td>
                                    <td class="text-right">2-3 hari</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-2">Jawa Tengah & DIY</td>
                                    <td class="text-right">2-3 hari</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-2">Jawa Timur & Bali</td>
                                    <td class="text-right">2-4 hari</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-2">Sumatera</td>
                                    <td class="text-right">3-5 hari</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-2">Kalimantan, Sulawesi, NTB, NTT</td>
                                    <td class="text-right">4-7 hari</td>
                                </tr>
                                <tr>
                                    <td class="py-2">Papua & Maluku</td>
                                    <td class="text-right">5-10 hari</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tracking Section -->
    <section class="py-16 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-3xl font-bold text-center mb-8">Lacak Pengiriman</h2>
                <div class="max-w-2xl mx-auto">
                    <div class="flex space-x-4">
                        <input type="text" placeholder="Masukkan nomor resi" class="flex-1 px-4 py-3 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                        <button class="bg-indigo-600 text-white px-8 py-3 rounded-lg hover:bg-indigo-700 transition">
                            <i class="fas fa-search mr-2"></i>Lacak
                        </button>
                    </div>
                    <div class="mt-6 text-center text-gray-600">
                        <p>Contoh nomor resi: 1234567890</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center mb-4">
                        <i class="fas fa-store text-2xl mr-2"></i>
                        <span class="font-bold text-xl">UMKM Store</span>
                    </div>
                    <p class="text-gray-400">Mendukung produk lokal berkualitas dari UMKM Indonesia</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="index.php" class="hover:text-white transition">Beranda</a></li>
                        <li><a href="tentang.php" class="hover:text-white transition">Tentang</a></li>
                        <li><a href="layanan.php" class="hover:text-white transition">Layanan</a></li>
                        <li><a href="kontak.php" class="hover:text-white transition">Kontak</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Layanan</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="pengiriman.php" class="hover:text-white transition">Pengiriman</a></li>
                        <li><a href="pengembalian.php" class="hover:text-white transition">Pengembalian</a></li>
                        <li><a href="pembayaran.php" class="hover:text-white transition">Metode Pembayaran</a></li>
                        <li><a href="faq.php" class="hover:text-white transition">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Newsletter</h4>
                    <p class="text-gray-400 mb-4">Dapatkan penawaran terbaru dari kami</p>
                    <form class="flex">
                        <input type="email" placeholder="Email Anda" class="px-4 py-2 rounded-l-lg text-gray-800 flex-1">
                        <button type="submit" class="bg-indigo-600 px-4 py-2 rounded-r-lg hover:bg-indigo-700 transition">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2024 UMKM Store. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>