<?php
session_start();
require_once "include/db.inc.php";

try {
  // Truy vấn thông tin sản phẩm
  $stmt = $pdo->prepare("SELECT * FROM account");
  $stmt->execute();
  $accounts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo "Lỗi khi truy vấn dữ liệu: " . $e->getMessage();
}

if (isset($_SESSION['message'])) {
  echo "<script>alert('".$_SESSION['message']."')</script>";
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
            href="#"
          >
            <i class="fas fa-table"> </i>
            ĐƠN HÀNG
          </a>
          <a
            class="text-black block py-2.5 px-4 rounded transition duration-200 hover:bg-[#CE112D] hover:text-white"
            href="#"
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
        <main class="flex-1 bg-WHITE p-6">
          <div class="flex items-center justify-between">
            <h1 class="text-3xl font-semibold mb-6">Người dùng</h1>
            <a href="user-management-detail.php">
              <button class="w-40 h-12 bg-[#CE112D] text-white font-semibold border rounded-lg">Thêm ID mới</button>
            </a>
          </div>
          <div class="bg-white mt-5 rounded-lg shadow-md overflow-hidden">
            <table class="min-w-full bg-white">
              <thead class="bg-gray-50">
                <tr>
                  <th
                    class="py-2 px-4 border-b border-gray-200 text-left text-sm font-semibold text-gray-600"
                  >
                    ID
                  </th>
                  <th
                    class="py-2 px-4 border-b border-gray-200 text-left text-sm font-semibold text-gray-600"
                  >
                    HỌ
                  </th>
                  <th
                    class="py-2 px-4 border-b border-gray-200 text-left text-sm font-semibold text-gray-600"
                  >
                    TÊN
                  </th>
                  <th
                    class="py-2 px-4 border-b border-gray-200 text-left text-sm font-semibold text-gray-600"
                  >
                    EMAIL
                  </th>
                  <th
                    class="py-2 px-4 border-b border-gray-200 text-left text-sm font-semibold text-gray-600"
                  >
                    VAI TRÒ
                  </th>
                  <th
                    class="py-2 px-4 border-b border-gray-200 text-left text-sm font-semibold text-gray-600"
                  >
                    HÀNH ĐỘNG
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php if ($accounts): ?>
                  <?php foreach($accounts as $account): ?>
                    <tr>
                      <td
                        class="py-2 px-4 border-b border-gray-200 "
                      >
                        <p><?= $account['id'] ?></p>
                      </td>
                      <td
                        class="py-2 px-4 border-b border-gray-200 "
                      >
                        <p><?= $account['firstname'] ?></p>
                      </td>
                      <td class="py-2 px-4 border-b border-gray-200 text-sm">
                      <p><?= $account['lastname'] ?></p>
                      </td>
                      <td class="py-2 px-4 border-b border-gray-200 text-sm">
                      <p><?= $account['email'] ?></p>
                      </td>
                      <td class="py-2 px-4 border-b border-gray-200 text-sm">
                      <p><?= $account['role'] ?></p>
                      </td>
                      <td
                        class="py-2 px-4 border-b border-gray-200 text-sm text-blue-500 cursor-pointer"
                      >
                      <a href="user-management-detail.php?account_id=<?= $account['id'] ?>">
                          <button   
                            class="rounded-md bg-[#FFEAEA] py-2 px-4 border border-transparent text-center text-sm text-black transition-all shadow-md hover:shadow-lg focus:bg-[#FFEAEA] focus:shadow-none active:bg-[#FFEAEA] hover:bg-[#FFEAEA] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2" type="button">
                            Edit
                          </button>
                      </a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </main>
      </div>
    </div>
    <script>
    </script>
  </body>
</html>
