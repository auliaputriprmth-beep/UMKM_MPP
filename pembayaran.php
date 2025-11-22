<?php
session_start();
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Metode Pembayaran - UMKM Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
        .payment-card { transition: all 0.3s ease; }
        .payment-card:hover { transform: translateY(-5px); box-shadow: 0 10px 30px rgba(0,0,0,0.15); }
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
    <section class="bg-gradient-to-r from-purple-600 to-purple-800 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Metode Pembayaran</h1>
                <p class="text-xl mb-8">Berbagai pilihan pembayaran yang aman dan nyaman</p>
            </div>
        </div>
    </section>

    <!-- Payment Methods -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-12">Pilih Metode Pembayaran</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Transfer Bank -->
                <div class="payment-card bg-white rounded-lg shadow-lg p-6">
                    <div class="text-center mb-4">
                        <i class="fas fa-university text-5xl text-blue-600"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Transfer Bank</h3>
                    <p class="text-gray-600 mb-4">Transfer langsung ke rekening kami</p>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span>BCA</span>
                            <span class="font-semibold">123-456-7890</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Mandiri</span>
                            <span class="font-semibold">987-654-3210</span>
                        </div>
                        <div class="flex justify-between">
                            <span>BNI</span>
                            <span class="font-semibold">456-789-0123</span>
                        </div>
                    </div>
                </div>

                <!-- E-Wallet -->
                <div class="payment-card bg-white rounded-lg shadow-lg p-6">
                    <div class="text-center mb-4">
                        <i class="fas fa-wallet text-5xl text-green-600"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">E-Wallet</h3>
                    <p class="text-gray-600 mb-4">Pembayaran instan dengan e-wallet</p>
                    <div class="grid grid-cols-3 gap-2">
                        <div class="text-center">
                            <div class="bg-gray-100 rounded p-2">
                                <i class="fab fa-gopay text-2xl text-green-500"></i>
                            </div>
                            <p class="text-xs mt-1">GoPay</p>
                        </div>
                        <div class="text-center">
                            <div class="bg-gray-100 rounded p-2">
                                <i class="fab fa-cc-visa text-2xl text-blue-500"></i>
                            </div>
                            <p class="text-xs mt-1">OVO</p>
                        </div>
                        <div class="text-center">
                            <div class="bg-gray-100 rounded p-2">
                                <i class="fas fa-money-bill text-2xl text-purple-500"></i>
                            </div>
                            <p class="text-xs mt-1">DANA</p>
                        </div>
                    </div>
                </div>

                <!-- COD -->
                <div class="payment-card bg-white rounded-lg shadow-lg p-6">
                    <div class="text-center mb-4">
                        <i class="fas fa-hand-holding-usd text-5xl text-orange-600"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Cash on Delivery</h3>
                    <p class="text-gray-600 mb-4">Bayar saat pesanan tiba</p>
                    <div class="bg-orange-50 rounded p-3">
                        <p class="text-sm text-orange-800">
                            <i class="fas fa-info-circle mr-1"></i>
                            Tersedia untuk area Jabodetabek
                        </p>
                    </div>
                </div>

                <!-- Credit Card -->
                <div class="payment-card bg-white rounded-lg shadow-lg p-6">
                    <div class="text-center mb-4">
                        <i class="fas fa-credit-card text-5xl text-indigo-600"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Kartu Kredit</h3>
                    <p class="text-gray-600 mb-4">Pembayaran dengan kartu kredit/debit</p>
                    <div class="flex justify-center space-x-2">
                        <i class="fab fa-cc-visa text-2xl text-blue-600"></i>
                        <i class="fab fa-cc-mastercard text-2xl text-red-600"></i>
                        <i class="fab fa-cc-jcb text-2xl text-purple-600"></i>
                    </div>
                </div>

                <!-- Virtual Account -->
                <div class="payment-card bg-white rounded-lg shadow-lg p-6">
                    <div class="text-center mb-4">
                        <i class="fas fa-qrcode text-5xl text-teal-600"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Virtual Account</h3>
                    <p class="text-gray-600 mb-4">Pembayaran melalui virtual account</p>
                    <div class="space-y-1 text-sm">
                        <p>• BCA Virtual Account</p>
                        <p>• Mandiri Virtual Account</p>
                        <p>• Permata Virtual Account</p>
                    </div>
                </div>

                <!-- Indomaret -->
                <div class="payment-card bg-white rounded-lg shadow-lg p-6">
                    <div class="text-center mb-4">
                        <i class="fas fa-store text-5xl text-red-600"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Indomaret/Alfamart</h3>
                    <p class="text-gray-600 mb-4">Bayar di gerai terdekat</p>
                    <div class="flex justify-center space-x-4">
                        <div class="text-center">
                            <div class="bg-blue-100 rounded p-2">
                                <span class="text-xs font-bold text-blue-800">INDOMARET</span>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="bg-red-100 rounded p-2">
                                <span class="text-xs font-bold text-red-800">ALFAMART</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Security Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-12">Keamanan Pembayaran</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-lock text-3xl text-green-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Enkripsi SSL</h3>
                    <p class="text-gray-600">Semua transaksi terenkripsi dengan SSL 256-bit</p>
                </div>
                
                <div class="text-center">
                    <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-shield-alt text-3xl text-blue-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">3D Secure</h3>
                    <p class="text-gray-600">Verifikasi tambahan untuk keamanan kartu kredit</p>
                </div>
                
                <div class="text-center">
                    <div class="w-20 h-20 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-certificate text-3xl text-purple-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">PCI DSS</h3>
                    <p class="text-gray-600">Sertifikasi keamanan standar internasional</p>
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