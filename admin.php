<?php
session_start();
require_once 'config.php';

// Check if user is logged in and is admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

// Handle product operations
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                handleAddProduct();
                break;
            case 'edit':
                handleEditProduct();
                break;
            case 'delete':
                handleDeleteProduct();
                break;
        }
    }
}

function handleAddProduct() {
    global $conn;
    
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $stock = $_POST['stock'];
    $description = $_POST['description'];
    $image = '';

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $fileName = time() . '_' . basename($_FILES['image']['name']);
        $targetFile = $uploadDir . $fileName;
        
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $image = $targetFile;
        }
    }

    $stmt = $conn->prepare("INSERT INTO products (name, price, image, category, stock, description) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sdssis", $name, $price, $image, $category, $stock, $description);
    $stmt->execute();
    
    header('Location: admin.php?success=added');
    exit();
}

function handleEditProduct() {
    global $conn;
    
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $stock = $_POST['stock'];
    $description = $_POST['description'];
    
    // Get current product to check old image
    $stmt = $conn->prepare("SELECT image FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $currentProduct = $result->fetch_assoc();
    
    $image = $currentProduct['image'];
    
    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Delete old image if exists
        if ($image && file_exists($image)) {
            unlink($image);
        }
        
        $uploadDir = 'uploads/';
        $fileName = time() . '_' . basename($_FILES['image']['name']);
        $targetFile = $uploadDir . $fileName;
        
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $image = $targetFile;
        }
    }

    $stmt = $conn->prepare("UPDATE products SET name = ?, price = ?, image = ?, category = ?, stock = ?, description = ? WHERE id = ?");
    $stmt->bind_param("sdssisi", $name, $price, $image, $category, $stock, $description, $id);
    $stmt->execute();
    
    header('Location: admin.php?success=updated');
    exit();
}

function handleDeleteProduct() {
    global $conn;
    
    $id = $_POST['id'];
    
    // Get product image before deletion
    $stmt = $conn->prepare("SELECT image FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    
    // Delete product
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    
    // Delete image file
    if ($product['image'] && file_exists($product['image'])) {
        unlink($product['image']);
    }
    
    header('Location: admin.php?success=deleted');
    exit();
}

// Get statistics
 $totalProducts = $conn->query("SELECT COUNT(*) as count FROM products")->fetch_assoc()['count'];
 $totalStock = $conn->query("SELECT SUM(stock) as total FROM products")->fetch_assoc()['total'];
 $totalOrders = $conn->query("SELECT COUNT(*) as count FROM orders")->fetch_assoc()['count'];
 $totalRevenue = $conn->query("SELECT SUM(total) as total FROM orders WHERE status != 'cancelled'")->fetch_assoc()['total'];

// Get all products
 $products = $conn->query("SELECT * FROM products ORDER BY created_at DESC")->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - UMKM Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
        .fade-in { animation: fadeIn 0.3s ease; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        .slide-in { animation: slideIn 0.3s ease; }
        @keyframes slideIn { from { transform: translateX(-20px); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Notification -->
    <?php if (isset($_GET['success'])): ?>
        <div class="fixed top-4 right-4 z-50 fade-in">
            <div class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center space-x-2">
                <i class="fas fa-check-circle"></i>
                <span>
                    <?php 
                    switch($_GET['success']) {
                        case 'added': echo 'Produk berhasil ditambahkan!'; break;
                        case 'updated': echo 'Produk berhasil diupdate!'; break;
                        case 'deleted': echo 'Produk berhasil dihapus!'; break;
                    }
                    ?>
                </span>
            </div>
        </div>
    <?php endif; ?>

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
                    <span class="text-gray-600">
                        <i class="fas fa-user-shield mr-2"></i>
                        <?php echo $_SESSION['user']['name']; ?>
                    </span>
                    <a href="index.php" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                        <i class="fas fa-store mr-2"></i>Lihat Toko
                    </a>
                    <a href="logout.php" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                        <i class="fas fa-sign-out-alt mr-2"></i>Keluar
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md h-screen sticky top-16">
            <div class="p-4">
                <ul class="space-y-2">
                    <li>
                        <button onclick="showSection('dashboard')" class="w-full text-left px-4 py-3 rounded-lg hover:bg-indigo-50 transition flex items-center bg-indigo-50">
                            <i class="fas fa-dashboard mr-3 text-indigo-600"></i>
                            <span>Dashboard</span>
                        </button>
                    </li>
                    <li>
                        <button onclick="showSection('products')" class="w-full text-left px-4 py-3 rounded-lg hover:bg-indigo-50 transition flex items-center">
                            <i class="fas fa-box mr-3 text-indigo-600"></i>
                            <span>Produk</span>
                        </button>
                    </li>
                    <li>
                        <button onclick="showSection('addProduct')" class="w-full text-left px-4 py-3 rounded-lg hover:bg-indigo-50 transition flex items-center">
                            <i class="fas fa-plus-circle mr-3 text-indigo-600"></i>
                            <span>Tambah Produk</span>
                        </button>
                    </li>
                    <li>
                        <a href="orders.php" class="w-full text-left px-4 py-3 rounded-lg hover:bg-indigo-50 transition flex items-center">
                            <i class="fas fa-shopping-cart mr-3 text-indigo-600"></i>
                            <span>Pesanan</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <!-- Dashboard Section -->
            <section id="dashboard" class="fade-in">
                <h2 class="text-2xl font-bold mb-6">Dashboard</h2>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600">Total Produk</p>
                                <p class="text-3xl font-bold text-indigo-600"><?php echo $totalProducts; ?></p>
                            </div>
                            <i class="fas fa-box text-4xl text-indigo-200"></i>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600">Total Stok</p>
                                <p class="text-3xl font-bold text-green-600"><?php echo $totalStock; ?></p>
                            </div>
                            <i class="fas fa-warehouse text-4xl text-green-200"></i>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600">Total Pesanan</p>
                                <p class="text-3xl font-bold text-purple-600"><?php echo $totalOrders; ?></p>
                            </div>
                            <i class="fas fa-shopping-cart text-4xl text-purple-200"></i>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600">Total Revenue</p>
                                <p class="text-3xl font-bold text-orange-600">Rp <?php echo number_format($totalRevenue, 0, ',', '.'); ?></p>
                            </div>
                            <i class="fas fa-money-bill-wave text-4xl text-orange-200"></i>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Products Section -->
            <section id="products" class="hidden fade-in">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Kelola Produk</h2>
                    <button onclick="showSection('addProduct')" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                        <i class="fas fa-plus mr-2"></i>Tambah Produk
                    </button>
                </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gambar</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php foreach ($products as $product): ?>
                                <tr class="hover:bg-gray-50 slide-in">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <img src="<?php echo $product['image'] ?: 'https://picsum.photos/seed/'.$product['id'].'/100/100'; ?>" alt="<?php echo $product['name']; ?>" class="w-12 h-12 object-cover rounded">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900"><?php echo $product['name']; ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                            <?php echo $product['category']; ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        Rp <?php echo number_format($product['price'], 0, ',', '.'); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm <?php echo $product['stock'] < 5 ? 'text-red-600 font-semibold' : 'text-gray-900'; ?>">
                                            <?php echo $product['stock']; ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button onclick="editProduct(<?php echo $product['id']; ?>)" class="text-indigo-600 hover:text-indigo-900 mr-3">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="deleteProduct(<?php echo $product['id']; ?>)" class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <!-- Add Product Section -->
            <section id="addProduct" class="hidden fade-in">
                <h2 class="text-2xl font-bold mb-6">Tambah Produk Baru</h2>
                <div class="bg-white rounded-lg shadow-md p-6">
                    <form method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="add">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Produk</label>
                                <input type="text" name="name" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                                <select name="category" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                                    <option value="">Pilih Kategori</option>
                                    <option value="Kerajinan">Kerajinan</option>
                                    <option value="Fashion">Fashion</option>
                                    <option value="Makanan">Makanan</option>
                                    <option value="Aksesoris">Aksesoris</option>
                                    <option value="Seni">Seni</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Harga</label>
                                <input type="number" name="price" required min="0" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Stok</label>
                                <input type="number" name="stock" required min="0" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                                <textarea name="description" rows="3" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500"></textarea>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Produk</label>
                                <input type="file" name="image" accept="image/*" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                            </div>
                        </div>
                        <div class="mt-6 flex space-x-4">
                            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition">
                                <i class="fas fa-save mr-2"></i>Simpan Produk
                            </button>
                            <button type="button" onclick="showSection('products')" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </section>
        </main>
    </div>

    <!-- Edit Product Modal -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
        <div class="bg-white rounded-lg p-8 max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold">Edit Produk</h3>
                <button onclick="closeEditModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <form id="editProductForm" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="edit">
                <input type="hidden" name="id" id="editProductId">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Produk</label>
                        <input type="text" name="name" id="editProductName" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                        <select name="category" id="editProductCategory" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                            <option value="Kerajinan">Kerajinan</option>
                            <option value="Fashion">Fashion</option>
                            <option value="Makanan">Makanan</option>
                            <option value="Aksesoris">Aksesoris</option>
                            <option value="Seni">Seni</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Harga</label>
                        <input type="number" name="price" id="editProductPrice" required min="0" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Stok</label>
                        <input type="number" name="stock" id="editProductStock" required min="0" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                        <textarea name="description" id="editProductDescription" rows="3" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500"></textarea>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Produk</label>
                        <input type="file" name="image" accept="image/*" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                        <p class="text-sm text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah gambar</p>
                    </div>
                </div>
                <div class="mt-6 flex space-x-4">
                    <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition">
                        <i class="fas fa-save mr-2"></i>Update Produk
                    </button>
                    <button type="button" onclick="closeEditModal()" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
        <div class="bg-white rounded-lg p-8 max-w-md w-full mx-4">
            <div class="text-center">
                <i class="fas fa-exclamation-triangle text-5xl text-red-500 mb-4"></i>
                <h3 class="text-2xl font-bold mb-4">Konfirmasi Hapus</h3>
                <p class="text-gray-600 mb-6">Apakah Anda yakin ingin menghapus produk ini? Tindakan ini tidak dapat dibatalkan.</p>
                <form method="POST">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" id="deleteProductId">
                    <div class="flex space-x-4">
                        <button type="submit" class="bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600 transition">
                            <i class="fas fa-trash mr-2"></i>Hapus
                        </button>
                        <button type="button" onclick="closeDeleteModal()" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Show Section
        function showSection(section) {
            const sections = ['dashboard', 'products', 'addProduct'];
            sections.forEach(s => {
                const element = document.getElementById(s);
                if (s === section) {
                    element.classList.remove('hidden');
                } else {
                    element.classList.add('hidden');
                }
            });
            
            // Update sidebar active state
            document.querySelectorAll('aside button').forEach(btn => {
                btn.classList.remove('bg-indigo-50');
            });
            event.target.closest('button').classList.add('bg-indigo-50');
        }

        // Edit Product
        function editProduct(id) {
            const productData = <?php echo json_encode($products); ?>;
            const product = productData.find(p => p.id == id);
            
            if (product) {
                document.getElementById('editProductId').value = product.id;
                document.getElementById('editProductName').value = product.name;
                document.getElementById('editProductCategory').value = product.category;
                document.getElementById('editProductPrice').value = product.price;
                document.getElementById('editProductStock').value = product.stock;
                document.getElementById('editProductDescription').value = product.description || '';
                
                document.getElementById('editModal').classList.remove('hidden');
            }
        }

        // Close Edit Modal
        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        // Delete Product
        function deleteProduct(id) {
            document.getElementById('deleteProductId').value = id;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        // Close Delete Modal
        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        // Auto-hide notifications
        setTimeout(() => {
            const notifications = document.querySelectorAll('.fixed.top-4.right-4');
            notifications.forEach(notification => {
                notification.style.display = 'none';
            });
        }, 3000);
    </script>
</body>
</html>