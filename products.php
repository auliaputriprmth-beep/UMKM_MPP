<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

require_once '../config.php';

 $method = $_SERVER['REQUEST_METHOD'];
 $input = json_decode(file_get_contents('php://input'), true);

switch ($method) {
    case 'GET':
        handleGet($conn);
        break;
    case 'POST':
        handlePost($conn, $input);
        break;
    case 'PUT':
        handlePut($conn, $input);
        break;
    case 'DELETE':
        handleDelete($conn);
        break;
    default:
        echo json_encode(['error' => 'Invalid request method']);
        break;
}

function handleGet($conn) {
    $category = isset($_GET['category']) ? $_GET['category'] : '';
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $id = isset($_GET['id']) ? $_GET['id'] : '';

    if ($id) {
        // Get single product
        $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();
        echo json_encode($product);
    } else {
        // Get all products with filters
        $query = "SELECT * FROM products WHERE 1=1";
        $params = [];
        $types = "";

        if ($category) {
            $query .= " AND category = ?";
            $params[] = $category;
            $types .= "s";
        }

        if ($search) {
            $query .= " AND (name LIKE ? OR category LIKE ? OR description LIKE ?)";
            $searchTerm = "%$search%";
            $params[] = $searchTerm;
            $params[] = $searchTerm;
            $params[] = $searchTerm;
            $types .= "sss";
        }

        $query .= " ORDER BY created_at DESC";

        $stmt = $conn->prepare($query);
        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $products = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($products);
    }
}

function handlePost($conn, $input) {
    $name = $input['name'];
    $price = $input['price'];
    $category = $input['category'];
    $stock = $input['stock'];
    $description = $input['description'] ?? '';
    $image = '';

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = uploadImage($_FILES['image']);
    }

    $stmt = $conn->prepare("INSERT INTO products (name, price, image, category, stock, description) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sdssis", $name, $price, $image, $category, $stock, $description);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'id' => $conn->insert_id]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }
}

function handlePut($conn, $input) {
    $id = $input['id'];
    $name = $input['name'];
    $price = $input['price'];
    $category = $input['category'];
    $stock = $input['stock'];
    $description = $input['description'] ?? '';
    
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
        $image = uploadImage($_FILES['image']);
    }

    $stmt = $conn->prepare("UPDATE products SET name = ?, price = ?, image = ?, category = ?, stock = ?, description = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?");
    $stmt->bind_param("sdssisi", $name, $price, $image, $category, $stock, $description, $id);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }
}

function handleDelete($conn) {
    $id = $_GET['id'];
    
    // Get product image before deletion
    $stmt = $conn->prepare("SELECT image FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    
    // Delete product
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        // Delete image file
        if ($product['image'] && file_exists($product['image'])) {
            unlink($product['image']);
        }
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }
}

function uploadImage($file) {
    $uploadDir = 'uploads/';
    $fileName = time() . '_' . basename($file['name']);
    $targetFile = $uploadDir . $fileName;
    
    // Check if image file is actual image
    $check = getimagesize($file['tmp_name']);
    if ($check === false) {
        throw new Exception("File is not an image.");
    }
    
    // Check file size (5MB max)
    if ($file['size'] > 5000000) {
        throw new Exception("File is too large.");
    }
    
    // Allow certain file formats
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    if (!in_array($fileType, $allowedTypes)) {
        throw new Exception("Only JPG, JPEG, PNG & GIF files are allowed.");
    }
    
    if (move_uploaded_file($file['tmp_name'], $targetFile)) {
        return $targetFile;
    } else {
        throw new Exception("Error uploading file.");
    }
}
?>