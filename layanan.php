<?php
session_start();
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan - UMKM Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
        .service-card { transition: all 0.3s ease; }
        .service-card:hover { transform: translateY(-10px); box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
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
                        <a href="layanan.php" class="text-indigo-600 px-3 py-2 text-sm font-medium transition border-b-2 border-indigo-600">Layanan</a>
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
    <section class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Layanan Kami</h1>
                <p class="text-xl mb-8">Solusi lengkap untuk kebutuhan belanja Anda</p>
            </div>
        </div>
    </section>

    <!-- Services Grid -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <a href="pengiriman.php" class="service-card bg-white rounded-lg shadow-lg overflow-hidden group">
                    <div class="h-48 bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                        <i class="fas fa-truck text-white text-6xl group-hover:scale-110 transition-transform"></i>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">Pengiriman</h3>
                        <p class="text-gray-600">Layanan pengiriman cepat dan aman ke seluruh Indonesia</p>
                        <div class="mt-4 text-indigo-600 font-semibold flex items-center">
                            <span>Pelajari lebih lanjut</span>
                            <i class="fas fa-arrow-right ml-2 group-hover:translate-x-2 transition-transform"></i>
                        </div>
                    </div>
                </a>

                <a href="pengembalian.php" class="service-card bg-white rounded-lg shadow-lg overflow-hidden group">
                    <div class="h-48 bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center">
                        <i class="fas fa-undo text-white text-6xl group-hover:scale-110 transition-transform"></i>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">Pengembalian</h3>
                        <p class="text-gray-600">Kebijakan pengembalian yang mudah dan transparan</p>
                        <div class="mt-4 text-indigo-600 font-semibold flex items-center">
                            <span>Pelajari lebih lanjut</span>
                            <i class="fas fa-arrow-right ml-2 group-hover:translate-x-2 transition-transform"></i>
                        </div>
                    </div>
                </a>

                <a href="pembayaran.php" class="service-card bg-white rounded-lg shadow-lg overflow-hidden group">
                    <div class="h-48 bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center">
                        <i class="fas fa-credit-card text-white text-6xl group-hover:scale-110 transition-transform"></i>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">Metode Pembayaran</h3>
                        <p class="text-gray-600">Berbagai pilihan pembayaran yang aman dan nyaman</p>
                        <div class="mt-4 text-indigo-600 font-semibold flex items-center">
                            <span>Pelajari lebih lanjut</span>
                            <i class="fas fa-arrow-right ml-2 group-hover:translate-x-2 transition-transform"></i>
                        </div>
                    </div>
                </a>

                <a href="faq.php" class="service-card bg-white rounded-lg shadow-lg overflow-hidden group">
                    <div class="h-48 bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center">
                        <i class="fas fa-question-circle text-white text-6xl group-hover:scale-110 transition-transform"></i>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">FAQ</h3>
                        <p class="text-gray-600">Pertanyaan yang sering diajukan oleh pelanggan</p>
                        <div class="mt-4 text-indigo-600 font-semibold flex items-center">
                            <span>Pelajari lebih lanjut</span>
                            <i class="fas fa-arrow-right ml-2 group-hover:translate-x-2 transition-transform"></i>
                        </div>
                    </div>
                </a>

                <div class="service-card bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="h-48 bg-gradient-to-br from-pink-400 to-pink-600 flex items-center justify-center">
                        <i class="fas fa-headset text-white text-6xl"></i>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">Customer Service</h3>
                        <p class="text-gray-600">Tim support siap membantu 24/7</p>
                        <div class="mt-4 text-indigo-600 font-semibold">
                            <i class="fas fa-phone mr-2"></i>0812-3456-7890
                        </div>
                    </div>
                </div>

                <div class="service-card bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="h-48 bg-gradient-to-br from-teal-400 to-teal-600 flex items-center justify-center">
                        <i class="fas fa-shield-alt text-white text-6xl"></i>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">Garansi</h3>
                        <p class="text-gray-600">Jaminan kualitas dan kepuasan pelanggan</p>
                        <div class="mt-4 text-indigo-600 font-semibold">
                            <i class="fas fa-check-circle mr-2"></i>100% Original
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-12">Mengapa Memilih Kami?</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center fade-in">
                    <div class="w-20 h-20 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-shipping-fast text-3xl text-indigo-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Pengiriman Cepat</h3>
                    <p class="text-gray-600">Proses pengiriman 1-3 hari kerja</p>
                </div>
                
                <div class="text-center fade-in">
                    <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-lock text-3xl text-green-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Pembayaran Aman</h3>
                    <p class="text-gray-600">Transaksi terenkripsi dan terjamin</p>
                </div>
                
                <div class="text-center fade-in">
                    <div class="w-20 h-20 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-award text-3xl text-purple-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Kualitas Terjamin</h3>
                    <p class="text-gray-600">Produk berkualitas dari UMKM terbaik</p>
                </div>
                
                <div class="text-center fade-in">
                    <div class="w-20 h-20 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-smile text-3xl text-orange-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Kepuasan 100%</h3>
                    <p class="text-gray-600">Kepuasan pelanggan adalah prioritas kami</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-4">Butuh Bantuan?</h2>
            <p class="text-xl mb-8">Tim customer service kami siap membantu Anda 24/7</p>
            <div class="flex justify-center space-x-4">
                <a href="kontak.php" class="bg-white text-indigo-600 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition transform hover:scale-105">
                    <i class="fas fa-phone mr-2"></i>Hubungi Kami
                </a>
                <a href="faq.php" class="border-2 border-white text-white px-8 py-3 rounded-full font-semibold hover:bg-white hover:text-indigo-600 transition transform hover:scale-105">
                    <i class="fas fa-question mr-2"></i>Lihat FAQ
                </a>
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