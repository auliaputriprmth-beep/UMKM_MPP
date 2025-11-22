<?php
session_start();
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Demo users (in real app, use password hashing)
    $users = [
        'user@example.com' => ['password' => 'user123', 'name' => 'User Demo', 'role' => 'user'],
        'admin@example.com' => ['password' => 'admin123', 'name' => 'Admin Demo', 'role' => 'admin']
    ];
    
    if (isset($users[$email]) && $users[$email]['password'] === $password) {
        $_SESSION['user'] = [
            'email' => $email,
            'name' => $users[$email]['name'],
            'role' => $users[$email]['role']
        ];
        
        if ($users[$email]['role'] === 'admin') {
            header('Location: admin.php');
        } else {
            header('Location: index.php');
        }
        exit();
    } else {
        $error = 'Email atau password salah!';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - UMKM Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
        .login-card { animation: slideUp 0.5s ease; }
        @keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center p-4">
    <div class="login-card bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden">
        <div class="p-8">
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-indigo-100 rounded-full mb-4">
                    <i class="fas fa-store text-3xl text-indigo-600"></i>
                </div>
                <h2 class="text-3xl font-bold text-gray-800">Selamat Datang</h2>
                <p class="text-gray-600 mt-2">Masuk ke akun Anda</p>
            </div>

            <?php if (isset($error)): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Email</label>
                    <input type="email" name="email" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="email@example.com">
                </div>
                
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Password</label>
                    <input type="password" name="password" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="••••••••">
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-3 rounded-lg font-semibold hover:from-indigo-700 hover:to-purple-700 transition transform hover:scale-105">
                    <i class="fas fa-sign-in-alt mr-2"></i>Masuk
                </button>
            </form>

            <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                <p class="text-sm text-gray-600 text-center mb-2">Akun Demo:</p>
                <div class="text-xs space-y-1">
                    <p><span class="font-semibold">User:</span> user@example.com / user123</p>
                    <p><span class="font-semibold">Admin:</span> admin@example.com / admin123</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>