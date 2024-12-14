<?php
session_start();
require_once "include/db.inc.php";

// Khởi tạo mảng sản phẩm mặc định
$product = [
  'id' => null,
  'name' => null,
  'description' => null,
  'price' => null,
  'quantity' => null,
  'category' => null,
  'image' => null
];

// Khởi tạo mảng categories mặc định
$categories = [];

try {
    // Lấy danh sách các danh mục từ bảng categories (giả sử có bảng riêng cho categories)
    $stmt = $pdo->query("SELECT * FROM category");
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Lỗi khi truy vấn danh mục: " . $e->getMessage();
}

// Kiểm tra xem có 'productId' trong URL không
if (isset($_GET['productId'])) {
  $product_id = $_GET['productId']; 
  try {
    // Truy vấn thông tin sản phẩm từ cơ sở dữ liệu
    $stmt = $pdo->prepare("SELECT * FROM product WHERE id = :id");
    $stmt->bindParam(":id", $product_id);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    // Lấy các hình ảnh của sản phẩm
    $stmtImages = $pdo->prepare("SELECT path FROM image WHERE product_id = :productId");
    $stmtImages->bindParam(':productId', $product_id, PDO::PARAM_INT);
    $stmtImages->execute();
    $images = $stmtImages->fetch(PDO::FETCH_ASSOC);
    // Lấy giá sản phẩm
    $stmtPrice = $pdo->prepare('SELECT * FROM productprice WHERE product_id = :productId');
    $stmtPrice->bindParam(':productId', $product_id, PDO::PARAM_INT);
    $stmtPrice->execute();
    $price = $stmtPrice->fetch(PDO::FETCH_ASSOC);
    
    // Kiểm tra nếu sản phẩm không tồn tại
    if (!$product) {
      echo "Sản phẩm không tồn tại.";
      exit;
    }

    if (!$price) {
        echo "Price không tồn tại.";
        exit;
      }
  } catch (PDOException $e) {
    echo "Lỗi khi truy vấn dữ liệu: " . $e->getMessage();
    exit;
  }
}
?>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Product Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
  </head>
  <body class="bg-gray-100">
    <div class="flex h-screen">
           <!-- Sidebar -->
           <div class="bg-[#FFEAEA] h-vh text-white w-64 space-y-6 py-7 px-2">
        <div class="flex items-cNhập space-x-2 px-4">
          <img
            alt="Logo"
            class="h-8 w-12"
            height="20"
            src="./assets/user/logo1.png"
            width="40"
          />
          <span class="text-2xl font-extrabold text-[#CE112D]"> Usbibracelet </span>
        </div>
        <nav class="space-y-2">
          <a
            class="text-black block py-2.5 px-4 rounded transition duration-200 hover:bg-[#CE112D] hover:text-white"
            href="user-management.php"
          >
            <i class="fas fa-tachometer-alt"> </i>
            NGƯỜI DÙNG
          </a>
          <a
            class="text-black block py-2.5 px-4 rounded transition duration-200 hover:bg-[#CE112D] hover:text-white"
            href="product-management.php"
          >
            <i class="fas fa-cube"> </i>
            SẢN PHẨM
          </a>
          <a
            class="text-black block py-2.5 px-4 rounded transition duration-200 hover:bg-[#CE112D] hover:text-white"
            href="order-management.php"
          >
            <i class="fas fa-table"> </i>
            ĐƠN HÀNG
          </a>
          <a
            class="text-black block py-2.5 px-4 rounded transition duration-200 hover:bg-[#CE112D] hover:text-white"
            href="blog-management.php"
          >
            <i class="fas fa-edit"> </i>
            TIN TỨC
          </a>
        </nav>
      </div>
      <!-- Main content -->
      <div class="flex-1 flex flex-col">
        <!-- Header -->
        <header
          class="flex items-cNhập justify-between bg-white py-4 px-6 border-b-2 border-gray-200"
        >
          <div class="flex items-cNhập">
            <input
              class="bg-gray-100 rounded-lg px-4 py-2 focus:outline-none"
              placeholder="Tìm kiếm"
              type="text"
            />
          </div>
          <div class="flex items-cNhập space-x-4">
            <i class="fas fa-bell"> </i>
            <img
              alt="User Avatar"
              class="h-8 w-8 rounded-full"
              height="30"
              src="./assets/user/avatar.jpg"
              width="30"
            />
          </div>
        </header>

      <!-- Main content -->
      <div class="flex-1 flex flex-col">


        <!-- Product Management Form -->
        <main class="flex-1 bg-white p-6 b"> 
          <h1 class="text-3xl font-semibold mb-6"><?= $product['id'] ? 'Chi tiết sản phẩm' : 'Tạo mới sản phẩm' ?></h1>
          <div class="bg-white w-[800px] mx-auto py-5 px-10 rounded-lg shadow-md overflow-hidden border">
            <form action="include/product-management-detail.inc.php" method="POST">
                <div class="flex justify-between gap-10">
                    <!-- ID Field (readonly) -->
                    <div class="mb-4">
                        <label for="id" class="block text-sm font-medium text-gray-700 mb-1">ID sản phẩm</label>
                        <input type="text" id="id" name="id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-indigo-200" placeholder="Nhập ID" value="<?= $product['id'] ?>" readonly />
                    </div>

                    <!-- Name Field -->
                    <div class="mb-4 w-4/5">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Tên sản phẩm</label>
                        <input type="text" id="name" name="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-indigo-200" placeholder="Nhập Tên sản phẩm" value="<?= htmlspecialchars($product['name']) ?>" required />
                    </div>
                </div>
              
              <!-- Description Field -->
              <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Mô tả</label>
                <textarea id="description" name="description" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-indigo-200" placeholder="Nhập Mô tả" required><?= htmlspecialchars($product['description']) ?></textarea>
              </div>

              <!-- Price Field -->
                <div class="flex grid grid-cols-3 gap-10">
                    <div class="mb-4">
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Giá</label>
                        <input type="number" id="price" name="price" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-indigo-200" placeholder="Nhập Giá" value="<?= $price['price'] ?>" required />
                    </div>
                    <div class="mb-4">
                        <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Số lượng</label>
                        <input type="number" id="quantity" name="quantity" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-indigo-200" placeholder="Nhập Số lượng" value="<?= htmlspecialchars($product['quantity']) ?>" required />
                    </div>
                    <!-- Category Field -->
                    <div class="mb-4">
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Phân loại</label>
                        <select id="category" name="category" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-indigo-200" required>
                            <option value="">Chọn phân loại</option>
                            <?php foreach($categories as $category): ?>
                                <option value="<?= $category['id'] ?>" <?= (isset($product['category_id']) && $product['category_id'] == $category['id']) ? 'selected' : '' ?>>
                                    <?= $category['name'] ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
              <!-- Image Path Field -->
              <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Đường dẫn hình ảnh</label>
                <?php if (isset($images)): ?>
                    <input type="text" id="image" name="image" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-indigo-200" placeholder="Nhập Đường dẫn hình ảnh" value="<?= $images['path'] ?>" />
                <?php else: ?>
                    <input type="text" id="image" name="image" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-indigo-200" placeholder="Nhập Đường dẫn hình ảnh" value="" />
                <?php endif; ?>
              </div>

              <!-- Submit Button -->
              <div class="mt-6">
                <button type="submit" class="w-full bg-[#CE112D] text-white py-2 px-4 rounded-lg hover:bg-[#CE112D] focus:outline-none focus:ring focus:ring-[#CE112D]">
                  <?= $product['id'] ? 'Chỉnh sửa sản phẩm' : 'Tạo mới sản phẩm' ?>
                </button>
              </div>
            </form>
          </div>
        </main>
      </div>
    </div>
  </body>
</html>
