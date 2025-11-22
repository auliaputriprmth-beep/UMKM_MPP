<?php
session_start();
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - UMKM Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
        .faq-item { transition: all 0.3s ease; }
        .faq-item:hover { box-shadow: 0 5px 20px rgba(0,0,0,0.1); }
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
    <section class="bg-gradient-to-r from-orange-600 to-orange-800 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Frequently Asked Questions</h1>
                <p class="text-xl mb-8">Pertanyaan yang sering diajukan oleh pelanggan</p>
                <div class="max-w-2xl mx-auto">
                    <div class="relative">
                        <input type="text" id="faqSearch" placeholder="Cari pertanyaan..." class="w-full px-6 py-4 rounded-full text-gray-800 pr-12">
                        <i class="fas fa-search absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Categories -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-12">
                <button onclick="filterFAQ('all')" class="category-btn bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                    Semua
                </button>
                <button onclick="filterFAQ('order')" class="category-btn bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition">
                    Pemesanan
                </button>
                <button onclick="filterFAQ('payment')" class="category-btn bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition">
                    Pembayaran
                </button>
                <button onclick="filterFAQ('shipping')" class="category-btn bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition">
                    Pengiriman
                </button>
            </div>

            <div class="space-y-4" id="faqContainer">
                <!-- Order Questions -->
                <div class="faq-item bg-white rounded-lg shadow-md overflow-hidden" data-category="order">
                    <button onclick="toggleFAQ(this)" class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-gray-50 transition">
                        <span class="font-semibold">Bagaimana cara melakukan pemesanan?</span>
                        <i class="fas fa-chevron-down transition-transform"></i>
                    </button>
                    <div class="hidden px-6 py-4 border-t">
                        <p class="text-gray-600">Anda dapat melakukan pemesanan dengan cara:</p>
                        <ol class="list-decimal list-inside mt-2 space-y-1">
                            <li>Pilih produk yang diinginkan</li>
                            <li>Tambahkan ke keranjang belanja</li>
                            <li>Klik tombol Checkout</li>
                            <li>Isi data pengiriman dan pilih metode pembayaran</li>
                            <li>Konfirmasi pesanan</li>
                        </ol>
                    </div>
                </div>

                <div class="faq-item bg-white rounded-lg shadow-md overflow-hidden" data-category="order">
                    <button onclick="toggleFAQ(this)" class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-gray-50 transition">
                        <span class="font-semibold">Apakah harus login untuk berbelanja?</span>
                        <i class="fas fa-chevron-down transition-transform"></i>
                    </button>
                    <div class="hidden px-6 py-4 border-t">
                        <p class="text-gray-600">Ya, Anda harus login terlebih dahulu untuk dapat melakukan pemesanan. Login juga membantu melacak status pesanan Anda.</p>
                    </div>
                </div>

                <div class="faq-item bg-white rounded-lg shadow-md overflow-hidden" data-category="order">
                    <button onclick="toggleFAQ(this)" class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-gray-50 transition">
                        <span class="font-semibold">Bagaimana cara membatalkan pesanan?</span>
                        <i class="fas fa-chevron-down transition-transform"></i>
                    </button>
                    <div class="hidden px-6 py-4 border-t">
                        <p class="text-gray-600">Anda dapat membatalkan pesanan sebelum status berubah menjadi "Processing". Hubungi customer service kami untuk bantuan pembatalan.</p>
                    </div>
                </div>

                <!-- Payment Questions -->
                <div class="faq-item bg-white rounded-lg shadow-md overflow-hidden" data-category="payment">
                    <button onclick="toggleFAQ(this)" class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-gray-50 transition">
                        <span class="font-semibold">Metode pembayaran apa saja yang tersedia?</span>
                        <i class="fas fa-chevron-down transition-transform"></i>
                    </button>
                    <div class="hidden px-6 py-4 border-t">
                        <p class="text-gray-600">Kami menyediakan berbagai metode pembayaran:</p>
                        <ul class="list-disc list-inside mt-2 space-y-1">
                            <li>Transfer Bank (BCA, Mandiri, BNI)</li>
                            <li>E-Wallet (GoPay, OVO, DANA)</li>
                            <li>Kartu Kredit/Debit</li>
                            <li>Virtual Account</li>
                            <li>COD (Cash on Delivery)</li>
                            <li>Indomaret/Alfamart</li>
                        </ul>
                    </div>
                </div>

                <div class="faq-item bg-white rounded-lg shadow-md overflow-hidden" data-category="payment">
                    <button onclick="toggleFAQ(this)" class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-gray-50 transition">
                        <span class="font-semibold">Apakah pembayaran aman?</span>
                        <i class="fas fa-chevron-down transition-transform"></i>
                    </button>
                    <div class="hidden px-6 py-4 border-t">
                        <p class="text-gray-600">Ya, semua transaksi dilindungi dengan enkripsi SSL 256-bit dan kami bersertifikat PCI DSS untuk keamanan data kartu kredit Anda.</p>
                    </div>
                </div>

                <div class="faq-item bg-white rounded-lg shadow-md overflow-hidden" data-category="payment">
                    <button onclick="toggleFAQ(this)" class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-gray-50 transition">
                        <span class="font-semibold">Bagaimana jika pembayaran gagal?</span>
                        <i class="fas fa-chevron-down transition-transform"></i>
                    </button>
                    <div class="hidden px-6 py-4 border-t">
                        <p class="text-gray-600">Jika pembayaran gagal, pesanan akan dibatalkan otomatis. Anda dapat melakukan pemesanan kembali atau mencoba metode pembayaran lain.</p>
                    </div>
                </div>

                <!-- Shipping Questions -->
                <div class="faq-item bg-white rounded-lg shadow-md overflow-hidden" data-category="shipping">
                    <button onclick="toggleFAQ(this)" class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-gray-50 transition">
                        <span class="font-semibold">Berapa lama pengiriman?</span>
                        <i class="fas fa-chevron-down transition-transform"></i>
                    </button>
                    <div class="hidden px-6 py-4 border-t">
                        <p class="text-gray-600">Waktu pengiriman tergantung area:</p>
                        <ul class="list-disc list-inside mt-2 space-y-1">
                            <li>Jabodetabek: 1-2 hari</li>
                            <li>Jawa & Bali: 2-3 hari</li>
                            <li>Sumatera: 3-5 hari</li>
                            <li>Kalimantan, Sulawesi: 4-7 hari</li>
                            <li>Papua & Maluku: 5-10 hari</li>
                        </ul>
                    </div>
                </div>

                <div class="faq-item bg-white rounded-lg shadow-md overflow-hidden" data-category="shipping">
                    <button onclick="toggleFAQ(this)" class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-gray-50 transition">
                        <span class="font-semibold">Bagaimana cara melacak pengiriman?</span>
                        <i class="fas fa-chevron-down transition-transform"></i>
                    </button>
                    <div class="hidden px-6 py-4 border-t">
                        <p class="text-gray-600">Anda dapat melacak pengiriman dengan nomor resi yang dikirimkan via email. Gunakan fitur "Lacak Pengiriman" di website atau aplikasi ekspedisi.</p>
                    </div>
                </div>

                <div class="faq-item bg-white rounded-lg shadow-md overflow-hidden" data-category="shipping">
                    <button onclick="toggleFAQ(this)" class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-gray-50 transition">
                        <span class="font-semibold">Apakah bisa mengubah alamat pengiriman?</span>
                        <i class="fas fa-chevron-down transition-transform"></i>
                    </button>
                    <div class="hidden px-6 py-4 border-t">
                        <p class="text-gray-600">Perubahan alamat hanya bisa dilakukan sebelum pesanan dikirim. Hubungi customer service secepatnya untuk bantuan perubahan alamat.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-4">Masih Ada Pertanyaan?</h2>
            <p class="text-xl text-gray-600 mb-8">Tim customer service kami siap membantu Anda</p>
            <div class="flex justify-center space-x-4">
                <a href="kontak.php" class="bg-indigo-600 text-white px-8 py-3 rounded-full font-semibold hover:bg-indigo-700 transition transform hover:scale-105">
                    <i class="fas fa-phone mr-2"></i>Hubungi Kami
                </a>
                <a href="mailto:support@umkmstore.com" class="border-2 border-indigo-600 text-indigo-600 px-8 py-3 rounded-full font-semibold hover:bg-indigo-600 hover:text-white transition transform hover:scale-105">
                    <i class="fas fa-envelope mr-2"></i>Email Kami
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

    <script>
        function toggleFAQ(button) {
            const content = button.nextElementSibling;
            const icon = button.querySelector('i');
            
            content.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
        }

        function filterFAQ(category) {
            const items = document.querySelectorAll('.faq-item');
            const buttons = document.querySelectorAll('.category-btn');
            
            // Update button styles
            buttons.forEach(btn => {
                btn.classList.remove('bg-indigo-600', 'text-white');
                btn.classList.add('bg-gray-200', 'text-gray-700');
            });
            
            event.target.classList.remove('bg-gray-200', 'text-gray-700');
            event.target.classList.add('bg-indigo-600', 'text-white');
            
            // Filter items
            items.forEach(item => {
                if (category === 'all' || item.dataset.category === category) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        // Search functionality
        document.getElementById('faqSearch').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const items = document.querySelectorAll('.faq-item');
            
            items.forEach(item => {
                const question = item.querySelector('span').textContent.toLowerCase();
                const answer = item.querySelector('.hidden p').textContent.toLowerCase();
                
                if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>