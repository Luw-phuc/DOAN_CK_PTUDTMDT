<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link
      href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css"
      rel="stylesheet"
    />
  </head>
  <body>
    <!-- header -->
    <div class="flex items-center justify-between px-20 py-7 bg-[#FDF8F8]">
    <a href="index.php">
  <h1 class="text-3xl font-bold text-[#CE112D]">𝐔𝐒𝐁𝐈𝐁𝐑𝐀𝐂𝐄𝐋𝐄𝐓</h1>
     </a>
     <form class="relative flex w-3/5 items-center" action="./include/search-product.inc.php" method="post">        <input
          class="w-full rounded-xl border bg-[#FFEAEA] p-2"
          placeholder="Tìm kiếm ..."
          name="searchTerm"
        />
        <button class="absolute right-3 h-6">
          <img src="./assets/images/search.png" class="h-full w-auto" />
        </button>
        </form>
        <div class="flex items-center gap-1">
        <?php
          if (isset($_SESSION["user_name"])) {
            echo "<a href='cart.php'><button class='rounded-lg border bg-[#FFEAEA] px-6 py-2 font-bold hover:bg-[#CE112D] hover:animate-bounce duration-800 hover:text-white'>Giỏ hàng</button></a>";
            echo "<form method='post' action='include/logout.inc.php'><button class='rounded-lg border bg-[#FFEAEA] px-6 py-2 font-bold hover:bg-[#CE112D] hover:animate-bounce duration-800 hover:text-white'>Đăng xuất</button></form>";
          } else {
            echo "<button id='btn_login' onclick=\"window.location.href='login.php'\" class='rounded-lg border bg-[#FFEAEA] px-6 py-3 font-bold hover:bg-[#CE112D] hover:animate-bounce duration-800 hover:text-white'>Đăng nhập</button>";
            echo "<button class='rounded-lg border bg-[#FFEAEA] px-6 py-3 font-bold hover:bg-[#CE112D] hover:animate-bounce duration-800 hover:text-white'>Đăng ký</button>";
          }
          ?> 
      </div>
    </div>
    <div class="bg-[#FFEAEA]">
      <ul
        class="mt-2 flex items-center justify-around py-3 text-2xl font-bold text-[#CE112D] relative"
      >
        <li><a href="index.php">Trang chủ</a></li>
        <li class="group relative py-4"><a href="product-list.php" class="menu-hover">Cửa hàng</a>
        <div class="text-lg border font-semibold w-60 px-3 invisible  translate-y-[16px] -translate-x-10 bg-[#FDF8F8] absolute z-50 flex flex-col py-0 min-w-48 text-black shadow-xl group-hover:visible ">
            <div class= "hover:bg-[#CE112D] hover:text-white"><ul><a  href="product-list.php?categoryId=2">Charm Cho Nam</a></ul></div>
            <div class= "hover:bg-[#CE112D] hover:text-white"><ul><a href="product-list.php?categoryId=1">Charm Cho Nữ</a></ul></div>
            <div class= "hover:bg-[#CE112D] hover:text-white"><ul><a href="product-list.php?categoryId=4">Charm chữ, số</a></ul></div>
            <div class= "hover:bg-[#CE112D] hover:text-white"><ul><a href="product-list.php?categoryId=3">Charm lủng lẳng</a></ul></div>
            <div class= "hover:bg-[#CE112D] hover:text-white"><ul><a href="product-list.php?categoryId=7">Charm đính đá</a></ul></div>
            <div class= "hover:bg-[#CE112D] hover:text-white"><ul><a href="product-list.php?categoryId=6">Charm dài</a></ul></div>
            <div class= "hover:bg-[#CE112D] hover:text-white"><ul><a href="product-list.php?categoryId=5">Sample mix sẵn</a></ul></div>
          </div></li>
        <li><a href="blog.php">Tin tức</a></li>
        <li><a href="about.php">Về chúng tôi</a></li>
        <li><a href="contact.php">Liên hệ</a></li>
      </ul>
    </div>
    <!-- end header -->

    <div class="flex flex-col items-center mt-10">
      <h1 class="text-red-500 font-bold text-3xl">Đặt hàng thành công</h1>
      <div class="flex justify-center mt-4">
          <img src="./assets/checkoutsuccess/tick.png" alt="Success Icon" class="w-32 h-32 object-contain">
      </div>
      <h3 class="mt-6 text-2xl">Tổng giá trị đơn hàng: 100.000 VNĐ</h3>
      <h3 class="mt-2 text-2xl">Mã đơn hàng: <?= $_SESSION['order_id'] ?></h3>
      <div class="mt-10 grid grid-cols-2 gap-10">
        <button
          class="w-60 py-1 text-red-500 font-bold border border-red-500 rounded-lg"
        >
        <a href="product-list.php">Tiếp tục mua sắm</a>
        </button>
        <button
          class="w-60 py-1 text-red-500 font-bold border border-red-500 rounded-lg"
        >
          Xem trạng thái đơn hàng
        </button>
      </div>
    </div>
    <<!-- footer -->
<div
  class="mt-20 min-h-40 grid-cols-4 bg-[#FDF8F8] px-16 pt-6 text-[#CE112D]"
>
  <div class="mb-3">
    <input
      class="py-2 px-5 border rounded"
      placeholder="Nhập email của bạn ..."
    />
    <button class="bg-[#FFEAEA] w-32 font-bold h-10 rounded">
      Đăng ký
    </button>
  </div>
  <div class="grid grid-cols-4 gap-10">
    <div>
      <h1 class="text-3xl font-bold">Usbibracelet</h1>
      <h3 class="mt-2 text-lg">Đăng ký</h3>
      <h1 class="mt-2 text-xl font-semibold italic">
        Nhận ngay mã giảm giá 12%
      </h1>
    </div>
    <div>
      <h1 class="text-lg font-bold">Hỗ trợ</h1>
      <h3 class="mt-2 text-sm">Đường CMT8, Quận 10, TP HCM</h3>
      <h3 class="mt-2 text-sm">Usbi@gmail.com</h3>
      <h3 class="mt-2 text-sm">08358588484</h3>
    </div>
    <div>
      <h1 class="text-lg font-bold">Menu</h1>
      <a href="index.php" class="mt-2 block text-sm">Trang chủ</a>
      <a href="product-list.php" class="mt-2 block text-sm">Cửa hàng</a>
      <a href="blog.php" class="mt-2 block text-sm">Tin tức</a>
      <a href="about.php" class="mt-2 block text-sm">Về chúng tôi</a>
      <a href="contact.php" class="mt-2 block text-sm mb-6">Liên hệ</a>
    </div>
    <div>
      <h1 class="text-lg font-bold">Theo dõi Usbi tại</h1>
      <div class="flex gap-4 mt-4">
        <a href="https://www.facebook.com/profile.php?id=61566981405194" target="_blank">
          <img
            src="https://cdn-icons-png.flaticon.com/512/733/733547.png"
            alt="Facebook"
            class="w-6 h-6"
          />
        </a>
        <a href="https://www.instagram.com/usbibracelet/" target="_blank">
          <img
            src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png"
            alt="Instagram"
            class="w-6 h-6"
          />
        </a>
        <a href="https://www.tiktok.com/@usbibracelet20s" target="_blank">
          <img
            src="https://cdn-icons-png.flaticon.com/512/3046/3046121.png"
            alt="TikTok"
            class="w-6 h-6"
          />
        </a>
      </div>
    </div>
  </div>
</div>
<!-- end footer -->
    <script src="https://cdn.tailwindcss.com"></script>
  </body>
</html>
