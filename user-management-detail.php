<?php
session_start();
require_once "include/db.inc.php";

if (isset($_GET['account_id'])) {
  $account_id = $_GET['account_id']; 
  try {
    // Truy vấn thông tin sản phẩm
    $stmt = $pdo->prepare("SELECT * FROM account WHERE id = :id");
    $stmt->bindParam(":id", $account_id);
    $stmt->execute();
    $account = $stmt->fetch(mode: PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    echo "Lỗi khi truy vấn dữ liệu: " . $e->getMessage();
  }
} else {
  $account['id'] = null;
  $account['email'] = null;
  $account['lastname'] = null;
  $account['firstname'] = null;
  $account['role'] = null;
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
          <h1 class="text-3xl font-semibold mb-6">Biểu mẫu người dùng</h1>
          <div class="bg-white w-[800px] mx-auto py-5 px-10 rounded-lg shadow-md overflow-hidden">
            <form class="" action="include/user-management-detail.inc.php" method="POST">
              <!-- ID Field -->
              <div class="grid grid-cols-2 items-center gap-10">
              <input
                      type="hidden"
                      id="id"
                      name="id"
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-indigo-200"
                      placeholder="Enter ID"
                      value="<?= $account['id'] ?>"
                  />
                  <div class="grid grid-cols-2 items-center gap-10">
              <!-- Email Field -->
                  <div class="mb-4">
                  <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                  <input
                    type="email"
                    id="email"
                    name="email"
                    class="w-80 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-indigo-200"
                    placeholder="Nhập Email"
                    value="<?= $account['email'] ?>"
                    required
                  />
                </div>
              </div>
              <div class="grid grid-cols-2 items-center gap-10">
                <!-- First Name Field -->
                <div class="mb-4">
                  <label for="firstname" class="block text-sm font-medium text-gray-700 mb-1">Họ</label>
                  <input
                    type="text"
                    id="firstname"
                    name="firstname"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-indigo-200"
                    placeholder="Nhập Họ"
                    value="<?= $account['firstname'] ?>"
                    required
                  />
                </div>
                <!-- Last Name Field -->
                <div class="mb-4">
                  <label for="lastname" class="block text-sm font-medium text-gray-700 mb-1">Tên</label>
                  <input
                    type="text"
                    id="lastname"
                    name="lastname"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-indigo-200"
                    placeholder="Nhập tên"
                    value="<?= $account['lastname'] ?>"
                    required
                  />
                </div>
              </div>
              <!-- Role Field -->
              <div class="mb-4">
                <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Vai trò</label>
                <select
                  id="role"
                  name="role"
                  class="w-full px-4 py-2 border border-[#FFEAEA] rounded-lg focus:outline-none focus:ring focus:ring-[#FFEAEA]"
                  value="<?= $account['role'] ?>"
                >
                  <option value="">Chọn vai trò</option>
                  <option value="admin">Admin</option>
                  <option value="user">User</option>
                </select>
              </div>
              <!-- Submit Button -->
              <div class="mt-6">
                <button
                  type="submit"
                  class="w-full bg-[#CE112D] text-white py-2 px-4 rounded-lg hover:bg-[#CE112D] focus:outline-none focus:ring focus:ring-bg-[#CE112D]"
                >
                  Đăng ký
                </button>
              </div>
            </form>
          </div>
        </main>
      </div>
    </div>
    <script>
    </script>
  </body>
</html>
