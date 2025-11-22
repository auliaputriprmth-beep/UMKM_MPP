<?php
session_start();
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMKM Store - Produk Lokal Berkualitas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
        .product-card { transition: all 0.3s ease; }
        .product-card:hover { transform: translateY(-5px); box-shadow: 0 10px 30px rgba(0,0,0,0.15); }
        .cart-item { animation: slideIn 0.3s ease; }
        @keyframes slideIn { from { opacity: 0; transform: translateX(20px); } to { opacity: 1; transform: translateX(0); } }
        .notification { animation: fadeIn 0.3s ease; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Notification -->
    <div id="notification" class="fixed top-4 right-4 z-50 hidden notification">
        <div class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center space-x-2">
            <i class="fas fa-check-circle"></i>
            <span id="notificationText">Produk ditambahkan ke keranjang!</span>
        </div>
    </div>

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
                    <button onclick="toggleProfile()" class="text-gray-700 hover:text-indigo-600 transition">
                        <i class="fas fa-user-circle text-2xl"></i>
                    </button>
                    <button onclick="toggleCart()" class="relative text-gray-700 hover:text-indigo-600 transition">
                        <i class="fas fa-shopping-cart text-2xl"></i>
                        <span id="cartCount" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">0</span>
                    </button>
                    <?php if (isset($_SESSION['user'])): ?>
                        <button onclick="logout()" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                            <i class="fas fa-sign-out-alt mr-2"></i>Keluar
                        </button>
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
    <section id="home" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Produk Lokal Berkualitas</h1>
                <p class="text-xl mb-8">Dukung UMKM Indonesia dengan berbelanja produk berkualitas tinggi</p>
                <button onclick="document.getElementById('products').scrollIntoView({behavior: 'smooth'})" class="bg-white text-indigo-600 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition transform hover:scale-105">
                    Lihat Produk
                </button>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section id="products" class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold">Produk Kami</h2>
                <div class="flex items-center space-x-4">
                    <select id="categoryFilter" onchange="filterProducts()" class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                        <option value="">Semua Kategori</option>
                        <option value="Kerajinan">Kerajinan</option>
                        <option value="Fashion">Fashion</option>
                        <option value="Makanan">Makanan</option>
                        <option value="Aksesoris">Aksesoris</option>
                        <option value="Seni">Seni</option>
                    </select>
                    <div class="relative">
                        <input type="text" id="searchInput" onkeyup="searchProducts()" placeholder="Cari produk..." class="pl-10 pr-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6" id="productGrid">
                <!-- Products will be loaded here -->
            </div>
        </div>
    </section>

    <!-- Cart Sidebar -->
    <div id="cartSidebar" class="fixed right-0 top-0 h-full w-96 bg-white shadow-2xl transform translate-x-full transition-transform duration-300 z-50">
        <div class="p-6 border-b">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-bold">Keranjang Belanja</h3>
                <button onclick="toggleCart()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
        </div>
        <div id="cartItems" class="p-6 overflow-y-auto" style="height: calc(100% - 200px);">
            <!-- Cart items will be loaded here -->
        </div>
        <div class="absolute bottom-0 left-0 right-0 p-6 border-t bg-white">
            <div class="flex justify-between mb-4">
                <span class="font-semibold">Total:</span>
                <span class="font-bold text-xl" id="cartTotal">Rp 0</span>
            </div>
            <button onclick="checkout()" class="w-full bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 transition">
                Checkout
            </button>
        </div>
    </div>

    <!-- Profile Modal -->
    <div id="profileModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
        <div class="bg-white rounded-lg p-8 max-w-md w-full mx-4">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold">Profil Saya</h3>
                <button onclick="toggleProfile()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div id="profileContent">
                <!-- Profile content will be loaded here -->
            </div>
        </div>
    </div>

    <!-- Checkout Modal -->
    <div id="checkoutModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
        <div class="bg-white rounded-lg p-8 max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold">Checkout</h3>
                <button onclick="closeCheckout()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <form id="checkoutForm" onsubmit="processCheckout(event)">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" id="checkoutName" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" id="checkoutEmail" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">No. Telepon</label>
                        <input type="tel" id="checkoutPhone" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Metode Pembayaran</label>
                        <select id="paymentMethod" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Pilih Metode</option>
                            <option value="transfer">Transfer Bank</option>
                            <option value="ewallet">E-Wallet</option>
                            <option value="cod">COD</option>
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Pengiriman</label>
                        <textarea id="checkoutAddress" required rows="3" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                    </div>
                </div>
                <div class="mt-6 p-4 bg-gray-100 rounded-lg">
                    <div class="flex justify-between mb-2">
                        <span>Subtotal:</span>
                        <span id="checkoutSubtotal">Rp 0</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span>Ongkir:</span>
                        <span>Rp 15.000</span>
                    </div>
                    <div class="flex justify-between font-bold text-lg">
                        <span>Total:</span>
                        <span id="checkoutTotal">Rp 0</span>
                    </div>
                </div>
                <button type="submit" class="w-full mt-6 bg-green-600 text-white py-3 rounded-lg hover:bg-green-700 transition">
                    <i class="fas fa-check mr-2"></i>Konfirmasi Pesanan
                </button>
            </form>
        </div>
    </div>

    <script>
        let cart = [];
        let currentUser = <?php echo isset($_SESSION['user']) ? json_encode($_SESSION['user']) : 'null'; ?>;
        let allProducts = [];

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            loadProducts();
            updateCartCount();
        });

        // Load Products from Database
        async function loadProducts() {
            try {
                const response = await fetch('api/products.php');
                allProducts = await response.json();
                renderProducts(allProducts);
            } catch (error) {
                console.error('Error loading products:', error);
                showNotification('Gagal memuat produk', 'error');
            }
        }

        // Render Products
        function renderProducts(products) {
            const grid = document.getElementById('productGrid');
            if (products.length === 0) {
                grid.innerHTML = '<div class="col-span-full text-center text-gray-500 py-8">Tidak ada produk yang ditemukan</div>';
                return;
            }
            
            grid.innerHTML = products.map(product => `
                <div class="product-card bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="${product.image || 'https://picsum.photos/seed/' + product.id + '/300/300'}" alt="${product.name}" class="w-full h-48 object-cover" onerror="this.src='https://picsum.photos/seed/${product.id}/300/300'">
                    <div class="p-4">
                        <span class="text-xs bg-indigo-100 text-indigo-600 px-2 py-1 rounded-full">${product.category}</span>
                        <h3 class="font-semibold text-lg mt-2">${product.name}</h3>
                        <p class="text-gray-600 text-sm mt-1">Stok: ${product.stock}</p>
                        <div class="flex justify-between items-center mt-4">
                            <span class="font-bold text-xl text-indigo-600">Rp ${parseFloat(product.price).toLocaleString('id-ID')}</span>
                            <button onclick="addToCart(${product.id})" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition ${product.stock === 0 ? 'opacity-50 cursor-not-allowed' : ''}" ${product.stock === 0 ? 'disabled' : ''}>
                                <i class="fas fa-cart-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `).join('');
        }

        // Filter Products by Category
        function filterProducts() {
            const category = document.getElementById('categoryFilter').value;
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            
            let filtered = allProducts;
            
            if (category) {
                filtered = filtered.filter(p => p.category === category);
            }
            
            if (searchTerm) {
                filtered = filtered.filter(p => 
                    p.name.toLowerCase().includes(searchTerm) || 
                    p.category.toLowerCase().includes(searchTerm)
                );
            }
            
            renderProducts(filtered);
        }

        // Search Products
        function searchProducts() {
            filterProducts();
        }

        // Add to Cart
        async function addToCart(productId) {
            if (!currentUser) {
                showNotification('Silakan login terlebih dahulu!', 'error');
                window.location.href = 'login.php';
                return;
            }

            try {
                const response = await fetch(`api/products.php?id=${productId}`);
                const product = await response.json();
                
                if (!product || product.stock === 0) {
                    showNotification('Produk tidak tersedia!', 'error');
                    return;
                }

                const existingItem = cart.find(item => item.id === productId);
                
                if (existingItem) {
                    if (existingItem.quantity < product.stock) {
                        existingItem.quantity++;
                        showNotification('Jumlah produk ditambahkan!');
                    } else {
                        showNotification('Stok tidak mencukupi!', 'error');
                        return;
                    }
                } else {
                    cart.push({ ...product, quantity: 1 });
                    showNotification('Produk ditambahkan ke keranjang!');
                }
                
                updateCartCount();
                renderCart();
            } catch (error) {
                console.error('Error adding to cart:', error);
                showNotification('Gagal menambahkan produk', 'error');
            }
        }

        // Toggle Cart
        function toggleCart() {
            const sidebar = document.getElementById('cartSidebar');
            sidebar.classList.toggle('translate-x-full');
            renderCart();
        }

        // Render Cart
        function renderCart() {
            const cartItems = document.getElementById('cartItems');
            const cartTotal = document.getElementById('cartTotal');
            
            if (cart.length === 0) {
                cartItems.innerHTML = '<p class="text-center text-gray-500">Keranjang kosong</p>';
                cartTotal.textContent = 'Rp 0';
                return;
            }
            
            cartItems.innerHTML = cart.map(item => `
                <div class="cart-item flex items-center space-x-4 mb-4 p-3 bg-gray-50 rounded-lg">
                    <img src="${item.image || 'https://picsum.photos/seed/' + item.id + '/300/300'}" alt="${item.name}" class="w-16 h-16 object-cover rounded" onerror="this.src='https://picsum.photos/seed/${item.id}/300/300'">
                    <div class="flex-1">
                        <h4 class="font-semibold">${item.name}</h4>
                        <p class="text-sm text-gray-600">Rp ${parseFloat(item.price).toLocaleString('id-ID')}</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button onclick="updateQuantity(${item.id}, -1)" class="w-8 h-8 bg-gray-200 rounded hover:bg-gray-300">-</button>
                        <span class="w-8 text-center">${item.quantity}</span>
                        <button onclick="updateQuantity(${item.id}, 1)" class="w-8 h-8 bg-gray-200 rounded hover:bg-gray-300">+</button>
                    </div>
                    <button onclick="removeFromCart(${item.id})" class="text-red-500 hover:text-red-700">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            `).join('');
            
            const total = cart.reduce((sum, item) => sum + (parseFloat(item.price) * item.quantity), 0);
            cartTotal.textContent = `Rp ${total.toLocaleString('id-ID')}`;
        }

        // Update Quantity
        function updateQuantity(productId, change) {
            const item = cart.find(item => item.id === productId);
            
            if (item) {
                item.quantity += change;
                if (item.quantity <= 0) {
                    removeFromCart(productId);
                } else {
                    updateCartCount();
                    renderCart();
                }
            }
        }

        // Remove from Cart
        function removeFromCart(productId) {
            cart = cart.filter(item => item.id !== productId);
            updateCartCount();
            renderCart();
            showNotification('Produk dihapus dari keranjang');
        }

        // Update Cart Count
        function updateCartCount() {
            const count = cart.reduce((sum, item) => sum + item.quantity, 0);
            document.getElementById('cartCount').textContent = count;
        }

        // Checkout
        function checkout() {
            if (!currentUser) {
                showNotification('Silakan login terlebih dahulu!', 'error');
                window.location.href = 'login.php';
                return;
            }
            
            if (cart.length === 0) {
                showNotification('Keranjang masih kosong!', 'error');
                return;
            }
            
            const subtotal = cart.reduce((sum, item) => sum + (parseFloat(item.price) * item.quantity), 0);
            document.getElementById('checkoutSubtotal').textContent = `Rp ${subtotal.toLocaleString('id-ID')}`;
            document.getElementById('checkoutTotal').textContent = `Rp ${(subtotal + 15000).toLocaleString('id-ID')}`;
            
            // Auto-fill user data if logged in
            if (currentUser) {
                document.getElementById('checkoutName').value = currentUser.name || '';
                document.getElementById('checkoutEmail').value = currentUser.email || '';
            }
            
            document.getElementById('checkoutModal').classList.remove('hidden');
        }

        // Close Checkout
        function closeCheckout() {
            document.getElementById('checkoutModal').classList.add('hidden');
        }

        // Process Checkout
        async function processCheckout(event) {
            event.preventDefault();
            
            const orderData = {
                customerName: document.getElementById('checkoutName').value,
                customerEmail: document.getElementById('checkoutEmail').value,
                customerPhone: document.getElementById('checkoutPhone').value,
                address: document.getElementById('checkoutAddress').value,
                paymentMethod: document.getElementById('paymentMethod').value,
                items: cart.map(item => ({
                    id: item.id,
                    name: item.name,
                    price: parseFloat(item.price),
                    quantity: item.quantity,
                    subtotal: parseFloat(item.price) * item.quantity
                })),
                subtotal: cart.reduce((sum, item) => sum + (parseFloat(item.price) * item.quantity), 0),
                shipping: 15000,
                total: cart.reduce((sum, item) => sum + (parseFloat(item.price) * item.quantity), 0) + 15000
            };
            
            try {
                const response = await fetch('api/orders.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(orderData)
                });
                
                const result = await response.json();
                
                if (result.success) {
                    cart = [];
                    updateCartCount();
                    renderCart();
                    closeCheckout();
                    showNotification(`Pesanan berhasil! Order ID: #${String(result.orderId).padStart(4, '0')}`);
                    loadProducts(); // Reload products to update stock display
                } else {
                    showNotification('Gagal membuat pesanan: ' + result.error, 'error');
                }
            } catch (error) {
                console.error('Error processing checkout:', error);
                showNotification('Gagal memproses pesanan', 'error');
            }
        }

        // Toggle Profile
        function toggleProfile() {
            const modal = document.getElementById('profileModal');
            const content = document.getElementById('profileContent');
            
            if (currentUser) {
                content.innerHTML = `
                    <div class="text-center mb-6">
                        <div class="w-24 h-24 bg-indigo-100 rounded-full mx-auto mb-4 flex items-center justify-center">
                            <i class="fas fa-user text-4xl text-indigo-600"></i>
                        </div>
                        <h4 class="text-xl font-semibold">${currentUser.name}</h4>
                        <p class="text-gray-600">${currentUser.email}</p>
                        <span class="inline-block mt-2 px-3 py-1 bg-green-100 text-green-600 rounded-full text-sm">
                            ${currentUser.role === 'admin' ? 'Admin' : 'User'}
                        </span>
                    </div>
                    <div class="space-y-3">
                        <button onclick="window.location.href='admin.php'" class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition ${currentUser.role !== 'admin' ? 'hidden' : ''}">
                            <i class="fas fa-cog mr-2"></i>Panel Admin
                        </button>
                        <button onclick="logout()" class="w-full bg-red-500 text-white py-2 rounded-lg hover:bg-red-600 transition">
                            <i class="fas fa-sign-out-alt mr-2"></i>Keluar
                        </button>
                    </div>
                `;
            } else {
                content.innerHTML = `
                    <div class="text-center">
                        <p class="text-gray-600 mb-4">Anda belum login</p>
                        <button onclick="window.location.href='login.php'" class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition">
                            <i class="fas fa-sign-in-alt mr-2"></i>Masuk
                        </button>
                    </div>
                `;
            }
            
            modal.classList.toggle('hidden');
        }

        // Logout
        function logout() {
            window.location.href = 'logout.php';
        }

        // Show Notification
        function showNotification(message, type = 'success') {
            const notification = document.getElementById('notification');
            const notificationText = document.getElementById('notificationText');
            const notificationDiv = notification.querySelector('div');
            
            notificationText.textContent = message;
            
            if (type === 'error') {
                notificationDiv.className = 'bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center space-x-2';
            } else {
                notificationDiv.className = 'bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center space-x-2';
            }
            
            notification.classList.remove('hidden');
            
            setTimeout(() => {
                notification.classList.add('hidden');
            }, 3000);
        }
    </script>
</body>
</html>