<?php
session_start();
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengembalian - UMKM Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
        .return-card { transition: all 0.3s ease; }
        .return-card:hover { transform: translateY(-5px); box-shadow: 0 10px 30px rgba(0,0,0,0.15); }
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
    <section class="bg-gradient-to-r from-green-600 to-green-800 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Kebijakan Pengembalian</h1>
                <p class="text-xl mb-8">Pengembalian produk yang mudah dan transparan</p>
            </div>
        </div>
    </section>

    <!-- Return Policy -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">
                    <h2 class="text-3xl font-bold mb-8">Kebijakan Pengembalian</h2>
                    
                    <div class="space-y-8">
                        <div class="bg-white rounded-lg shadow-lg p-6">
                            <h3 class="text-xl font-semibold mb-4 text-green-600">
                                <i class="fas fa-clock mr-2"></i>Waktu Pengembalian
                            </h3>
                            <p class="text-gray-600">Anda dapat mengajukan pengembalian dalam waktu <strong>7 hari</strong> setelah menerima produk. Pastikan produk masih dalam kondisi baik dan belum digunakan.</p>
                        </div>

                        <div class="bg-white rounded-lg shadow-lg p-6">
                            <h3 class="text-xl font-semibold mb-4 text-green-600">
                                <i class="fas fa-check-circle mr-2"></i>Syarat Pengembalian
                            </h3>
                            <ul class="space-y-2 text-gray-600">
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                    Produk masih dalam kondisi original (tidak rusak, tidak kotor)
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                    Kelengkapan produk (box, manual, aksesoris) masih utuh
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                    Bukti pembayaran masih tersedia
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                    Produk cacat produksi atau tidak sesuai deskripsi
                                </li>
                            </ul>
                        </div>

                        <div class="bg-white rounded-lg shadow-lg p-6">
                            <h3 class="text-xl font-semibold mb-4 text-green-600">
                                <i class="fas fa-times-circle mr-2"></i>Produk Tidak Dapat Dikembalikan
                            </h3>
                            <ul class="space-y-2 text-gray-600">
                                <li class="flex items-start">
                                    <i class="fas fa-times text-red-500 mt-1 mr-3"></i>
                                    Produk makanan yang sudah dibuka
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-times text-red-500 mt-1 mr-3"></i>
                                    Produk yang sudah digunakan atau rusak karena kesalahan pembeli
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-times text-red-500 mt-1 mr-3"></i>
                                    Produk sale atau clearance
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-times text-red-500 mt-1 mr-3"></i>
                                    Lewat 7 hari dari tanggal penerimaan
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="bg-white rounded-lg shadow-lg p-6 sticky top-24">
                        <h3 class="text-xl font-semibold mb-4">Ajukan Pengembalian</h3>
                        <form class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Pesanan</label>
                                <input type="text" placeholder="Contoh: #0001" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Alasan Pengembalian</label>
                                <select class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500">
                                    <option>Pilih alasan</option>
                                    <option>Produk cacat</option>
                                    <option>Tidak sesuai deskripsi</option>
                                    <option>Kirim produk salah</option>
                                    <option>Lainnya</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
                                <textarea rows="3" placeholder="Jelaskan masalah produk" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500"></textarea>
                            </div>
                            <button type="submit" class="w-full bg-green-600 text-white py-3 rounded-lg hover:bg-green-700 transition">
                                <i class="fas fa-paper-plane mr-2"></i>Ajukan Pengembalian
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Process Steps -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-12">Proses Pengembalian</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl font-bold text-green-600">1</span>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Ajukan Pengembalian</h3>
                    <p class="text-gray-600">Isi form pengembalian dengan lengkap</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl font-bold text-green-600">2</span>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Verifikasi</h3>
                    <p class="text-gray-600">Tim kami akan memverifikasi pengajuan Anda</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl font-bold text-green-600">3</span>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Kirim Produk</h3>
                    <p class="text-gray-600">Kemas dan kirim produk ke alamat kami</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl font-bold text-green-600">4</span>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Pengembalian Dana</h3>
                    <p class="text-gray-600">Dana akan dikembalikan ke rekening Anda</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-12">FAQ Pengembalian</h2>
            <div class="space-y-4">
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <button onclick="toggleFAQ(this)" class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-gray-50 transition">
                        <span class="font-semibold">Berapa lama proses pengembalian dana?</span>
                        <i class="fas fa-chevron-down transition-transform"></i>
                    </button>
                    <div class="hidden px-6 py-4 border-t">
                        <p class="text-gray-600">Proses pengembalian dana memakan waktu 3-7 hari kerja setelah produk kami terima dan verifikasi.</p>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <button onclick="toggleFAQ(this)" class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-gray-50 transition">
                        <span class="font-semibold">Apakah ongkir pengembalian ditanggung?</span>
                        <i class="fas fa-chevron-down transition-transform"></i>
                    </button>
                    <div class="hidden px-6 py-4 border-t">
                        <p class="text-gray-600">Ongkir pengembalian ditanggung pembeli, kecuali jika produk cacat produksi atau kesalahan dari pihak kami.</p>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <button onclick="toggleFAQ(this)" class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-gray-50 transition">
                        <span class="font-semibold">Bagaimana cara mengajukan pengembalian?</span>
                        <i class="fas fa-chevron-down transition-transform"></i>
                    </button>
                    <div class="hidden px-6 py-4 border-t">
                        <p class="text-gray-600">Anda bisa mengajukan pengembalian melalui form di halaman ini atau menghubungi customer service kami.</p>
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

    <script>
        function toggleFAQ(button) {
            const content = button.nextElementSibling;
            const icon = button.querySelector('i');
            
            content.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
        }
    </script>
</body>
</html>