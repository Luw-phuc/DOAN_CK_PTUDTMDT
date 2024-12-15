<?php
session_start();
require_once "./include/db.inc.php";

// Truy vấn tất cả các bài viết của người dùng
$stmt = $pdo->prepare("SELECT id, title, timestamp, isDeleted FROM blog WHERE isDeleted = false ORDER BY timestamp DESC");
$stmt->execute();

// Lấy tất cả bài viết vào một mảng
$blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (isset($_SESSION['message'])) {
  echo "<script>alert('" . $_SESSION['message'] . "')</script>";
  unset($_SESSION['message']);
}
?>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>User Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css"
      rel="stylesheet"
    />
  </head>
  <body class="bg-gray-100">
    <div class="flex h-screen">
      <!-- Sidebar -->
      <div class="bg-[#FFEAEA] h-vh text-white w-64 space-y-6 py-7 px-2">
        <div class="flex items-center space-x-2 px-4">
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
          class="flex items-center justify-between bg-white py-4 px-6 border-b-2 border-gray-200"
        >
          <div class="flex items-center">
            <input
              class="bg-gray-100 rounded-lg px-4 py-2 focus:outline-none"
              placeholder="Tìm kiếm"
              type="text"
            />
          </div>
          <div class="flex items-center space-x-4">
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
        <!-- Dashboard content -->
        <main class="flex-1 bg-white p-6">
          <div class="flex items-center justify-between">
            <h1 class="text-3xl font-semibold mb-6">Tin tức</h1>
            <a href="blog-management-detail.php">
              <button
                class="w-40 h-12 bg-[#CE112D] text-white font-semibold border rounded-lg"
              >
                Thêm tin tức mới
              </button>
            </a>
          </div>
          <div
            class="bg-white mt-5 rounded-lg shadow-md h-[72vh] overflow-hidden border"
          >
            <!-- blog list -->
            <div class="space-y-4 h-full overflow-auto">
              <?php if ($blogs): ?>
                <?php foreach ($blogs as $blog): ?>
                  <div class="border-b border-gray-300 p-4">
                    <div class="flex justify-between">
                      <h2 class="text-xl font-semibold"><?= htmlspecialchars($blog['title']) ?></h2>
                      <span class="text-sm text-gray-500"><?= date("F j, Y", strtotime($blog['timestamp'])) ?></span>
                    </div>
                    <div class="flex space-x-4">
                          <a href="blog-management-detail.php?blogId=<?= $blog['id'] ?>" class="text-blue-500">Edit</a>
                          <a href="./include/delete-blog.inc.php?blogId=<?= $blog['id'] ?>" class="text-red-500" onclick="return confirm('Are you sure you want to delete this blog?');">Delete</a>
                      </div>
                  </div>
                <?php endforeach; ?>
              <?php else: ?>
                <p class="text-center text-gray-500">Không tìm thấy tin tức nào.</p>
              <?php endif; ?>
            </div>
          </div>

        </main>
      </div>
    </div>
    <!-- Include the Quill library -->
  </body>
</html>