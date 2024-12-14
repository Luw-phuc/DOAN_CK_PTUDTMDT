<?php
session_start();
require_once "include/db.inc.php";

// Get current page for pagination (default to 1 if not set)
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = 10; // Number of orders per page
$offset = ($page - 1) * $perPage;

$sql = "
    SELECT 
        o.id, 
        a.firstname, 
        a.lastname, 
        o.phonenumber, 
        o.address, 
        o.shippingMethod, 
        o.paymentMethod, 
        o.total, 
        o.status
    FROM `order` AS o
    JOIN `account` AS a ON o.account_id = a.id
    ORDER BY o.id ASC
    LIMIT :offset, :perPage
";

// Prepare the query
$stmt = $pdo->prepare($sql);

// Bind values for pagination
$offset = ($page - 1) * $perPage;
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->bindValue(':perPage', $perPage, PDO::PARAM_INT);

// Execute the query
$stmt->execute();

// Fetch results
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get total number of orders for pagination
$totalSql = "SELECT COUNT(*) FROM `order`";
$totalStmt = $pdo->query($totalSql);
$totalOrders = $totalStmt->fetchColumn();
$totalPages = ceil($totalOrders / $perPage);
?>

<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Order Management</title>
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

        <!-- Orders Table -->
        <main class="flex-1 bg-white p-6">
        <div class="flex items-center justify-between">
            <h1 class="text-3xl font-semibold mb-6">Đơn hàng</h1>
            </div>
            <table class="min-w-full bg-white">
              <thead class="bg-gray-50">
                <tr>
                  <th class="py-2 px-4 border-b">ID</th>
                  <th class="py-2 px-4 border-b">Tên</th>
                  <th class="py-2 px-4 border-b">Số điện thoại</th>
                  <th class="py-2 px-4 border-b">Địa chỉ</th>
                  <th class="py-2 px-4 border-b">Vận chuyển</th>
                  <th class="py-2 px-4 border-b">Thanh toán</th>
                  <th class="py-2 px-4 border-b">Tổng giá trị</th>
                  <th class="py-2 px-4 border-b">Tình trạng</th>
                  <th class="py-2 px-4 border-b"></th>
                </tr>
              </thead>
              <tbody>
                <?php if ($orders): ?>
                  <?php foreach ($orders as $order): ?>
                    <tr class="hover:bg-gray-50">
                      <td class="py-2 px-4 border-b"><?= htmlspecialchars($order['id']) ?></td>
                      <td class="py-2 px-4 border-b"><?= htmlspecialchars($order['firstname']) ?> <?= htmlspecialchars($order['lastname']) ?></td>
                      <td class="py-2 px-4 border-b"><?= htmlspecialchars($order['phonenumber']) ?></td>
                      <td class="py-2 px-4 border-b"><?= htmlspecialchars($order['address']) ?></td>
                      <td class="py-2 px-4 border-b"><?= htmlspecialchars($order['shippingMethod']) ?></td>
                      <td class="py-2 px-4 border-b"><?= htmlspecialchars($order['paymentMethod']) ?></td>
                      <td class="py-2 px-4 border-b"><?= number_format($order['total'], 0, ',', '.') ?>đ</td>
                      <td class="py-2 px-4 border-b"><?= htmlspecialchars($order['status']) ?></td>
                      <td class="py-2 px-4 border-b">
                        <a href="order-detail.php?orderId=<?= $order['id'] ?>">
                                        <button class="block rounded px-4 py-1 bg-[#FFEAEA] text-black text-center ">
                                            Xem
                                        </button>
                                    </a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="8" class="py-4 text-center text-gray-500">No orders found.</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>

            <!-- Pagination -->
            <div class="flex justify-center mt-4">
              <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?= $i ?>" class="mx-1 px-4 py-2 <?= $i == $page ? 'bg-[#CE112D] text-white' : 'bg-gray-200' ?> rounded">
                  <?= $i ?>
                </a>
              <?php endfor; ?>
            </div>
          </div>
        </main>
      </div>
    </div>
  </body>
</html>