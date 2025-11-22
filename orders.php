<?php
session_start();
require_once 'config.php';

// Check if user is logged in and is admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

// Get all orders
 $orders = $conn->query("SELECT * FROM orders ORDER BY created_at DESC")->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan - UMKM Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-white shadow-lg sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <i class="fas fa-cog text-indigo-600 text-2xl mr-2"></i>
                        <span class="font-bold text-xl text-gray-800">Admin Panel</span>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="admin.php" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                    <a href="logout.php" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                        <i class="fas fa-sign-out-alt mr-2"></i>Keluar
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h2 class="text-2xl font-bold mb-6">Daftar Pesanan</h2>
        
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($orders as $order): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="font-medium">#<?php echo str_pad($order['id'], 4, '0', STR_PAD_LEFT); ?></span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900"><?php echo $order['customer_name']; ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900"><?php echo $order['customer_email']; ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">Rp <?php echo number_format($order['total'], 0, ',', '.'); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    <?php 
                                    switch($order['status']) {
                                        case 'pending': echo 'bg-yellow-100 text-yellow-800'; break;
                                        case 'processing': echo 'bg-blue-100 text-blue-800'; break;
                                        case 'shipped': echo 'bg-purple-100 text-purple-800'; break;
                                        case 'delivered': echo 'bg-green-100 text-green-800'; break;
                                        case 'cancelled': echo 'bg-red-100 text-red-800'; break;
                                    }
                                    ?>">
                                    <?php echo ucfirst($order['status']); ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <?php echo date('d/m/Y', strtotime($order['created_at'])); ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button onclick="viewOrder(<?php echo $order['id']; ?>)" class="text-indigo-600 hover:text-indigo-900">
                                    <i class="fas fa-eye"></i> Detail
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Order Detail Modal -->
    <div id="orderModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
        <div class="bg-white rounded-lg p-8 max-w-3xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold">Detail Pesanan</h3>
                <button onclick="closeOrderModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div id="orderDetail">
                <!-- Order details will be loaded here -->
            </div>
        </div>
    </div>

    <script>
        function viewOrder(orderId) {
            // Load order details via AJAX
            fetch(`api/orders.php?id=${orderId}`)
                .then(response => response.json())
                .then(data => {
                    let itemsHtml = '';
                    data.items.forEach(item => {
                        itemsHtml += `
                            <tr>
                                <td class="px-4 py-2">${item.product_name}</td>
                                <td class="px-4 py-2">Rp ${parseInt(item.price).toLocaleString('id-ID')}</td>
                                <td class="px-4 py-2">${item.quantity}</td>
                                <td class="px-4 py-2">Rp ${parseInt(item.subtotal).toLocaleString('id-ID')}</td>
                            </tr>
                        `;
                    });

                    document.getElementById('orderDetail').innerHTML = `
                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div>
                                <h4 class="font-semibold mb-2">Informasi Pelanggan</h4>
                                <p><strong>Nama:</strong> ${data.customer_name}</p>
                                <p><strong>Email:</strong> ${data.customer_email}</p>
                                <p><strong>Telepon:</strong> ${data.customer_phone || '-'}</p>
                                <p><strong>Alamat:</strong> ${data.address}</p>
                            </div>
                            <div>
                                <h4 class="font-semibold mb-2">Informasi Pesanan</h4>
                                <p><strong>Order ID:</strong> #${String(data.id).padStart(4, '0')}</p>
                                <p><strong>Metode Pembayaran:</strong> ${data.payment_method}</p>
                                <p><strong>Status:</strong> ${data.status}</p>
                                <p><strong>Tanggal:</strong> ${new Date(data.created_at).toLocaleDateString('id-ID')}</p>
                            </div>
                        </div>
                        
                        <div class="mb-6">
                            <h4 class="font-semibold mb-2">Detail Produk</h4>
                            <table class="w-full border">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-2 text-left">Produk</th>
                                        <th class="px-4 py-2 text-left">Harga</th>
                                        <th class="px-4 py-2 text-left">Qty</th>
                                        <th class="px-4 py-2 text-left">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${itemsHtml}
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="text-right">
                            <p><strong>Subtotal:</strong> Rp ${parseInt(data.subtotal).toLocaleString('id-ID')}</p>
                            <p><strong>Ongkir:</strong> Rp ${parseInt(data.shipping).toLocaleString('id-ID')}</p>
                            <p class="text-xl font-bold">Total: Rp ${parseInt(data.total).toLocaleString('id-ID')}</p>
                        </div>
                    `;
                    
                    document.getElementById('orderModal').classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal memuat detail pesanan');
                });
        }

        function closeOrderModal() {
            document.getElementById('orderModal').classList.add('hidden');
        }
    </script>
</body>
</html>