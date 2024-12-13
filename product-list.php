<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cửa hàng</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
  <body>
        <!-- header -->
    <div class="flex items-center justify-between px-20 py-4">
      <h1 class="text-2xl font-bold text-[#CE112D]">Usbibracelet</h1>
      <div class="relative flex w-3/5 items-center">
        <input
          class="w-full rounded-xl border bg-[#FFEAEA] p-2"
          placeholder="Tìm kiếm ..."
        />
        <button class="absolute right-3 h-6">
          <img src="./assets/images/search.png" class="h-full w-auto" />
        </button>
      </div>
      <div class="flex items-center gap-1">
        <?php
          if (isset($_SESSION["user_name"])) {
            echo "<a href='cart.php'><button class='rounded-lg border bg-[#FFEAEA] px-6 py-2 font-bold hover:bg-[#FF7973] hover:animate-bounce duration-800'>Giỏ hàng</button></a>";
            echo "<form method='post' action='include/logout.inc.php'><button class='rounded-lg border bg-[#FFEAEA] px-6 py-2 font-bold hover:bg-[#FF7973] hover:animate-bounce duration-800'>Đăng xuất</button></form>";
          } else {
            echo "<button id='btn_login' class='rounded-lg border bg-[#FFEAEA] px-6 py-3 font-bold hover:bg-[#FF7973] hover:animate-bounce duration-800'>Đăng nhập</button>";
            echo "<button class='rounded-lg border bg-[#FFEAEA] px-6 py-3 font-bold hover:bg-[#FF7973] hover:animate-bounce duration-800'>Đăng ký</button>";
          }
          ?> 
      </div>
    </div>
    <div class="bg-[#FFEAEA]">
      <ul
        class="mt-2 flex items-center justify-around py-4 text-2xl font-bold text-[#CE112D]"
      >
        <li><a href="index.php">Trang chủ</a></li>
        <li><a href="product-list.php">Cửa hàng</a></li>
        <li><a href="blog.php">Tin tức</a></li>
        <li><a href="about.php">Về chúng tôi</a></li>
        <li><a href="contact.php">Liên hệ</a></li>
      </ul>
    </div>
    <!-- end header -->

    <!-- category -->
    <div class="mt-7 flex w-full flex-col items-center">
      <h1 class="text-3xl font-bold text-[#CE112D]">CATEGORY</h1>
      <div class="mt-5 grid w-4/5 grid-cols-7 gap-8">
      <div class="flex flex-col items-center">
        <div class="h-25 w-25">
          <img class="h-full w-full" src="./assets/Category/Charmchonu.png" />
        </div>
        <p class="mt-2 text-lg text-center font-bold">Charm cho nữ</p>
      </div>
      <div class="flex flex-col items-center">
        <div class="h-25 w-25">
          <img class="h-full w-full" src="./assets/Category/Charmchonam.png" />
        </div>
        <p class="mt-2 text-lg text-center font-bold">Charm cho nam</p>
      </div>
      <div class="flex flex-col items-center">
        <div class="h-25 w-25">
          <img class="h-full w-full" src="./assets/Category/Charmchuso.png" />
        </div>
        <p class="mt-2 text-lg text-center font-bold">Charm chữ, số</p>
      </div>
      <div class="flex flex-col items-center">
        <div class="h-25 w-25">
          <img class="h-full w-full" src="./assets/Category/Charmlunglang.png" />
        </div>
        <p class="mt-2 text-lg text-center font-bold">Charm lủng lẳng</p>
      </div>
      <div class="flex flex-col items-center">
        <div class="h-25 w-25">
          <img class="h-full w-full" src="./assets/Category/Charmdinhda.png" />
        </div>
        <p class="mt-2 text-lg text-center font-bold">Charm đính đá</p>
      </div>
      <div class="flex flex-col items-center">
        <div class="h-25 w-25">
          <img class="h-full w-full" src="./assets/Category/Charmdai.png" />
        </div>
        <p class="mt-2 text-lg text-center font-bold">Charm dài</p>
      </div>
      <div class="flex flex-col items-center">
        <div class="h-25 w-25">
          <img class="h-full w-full" src="./assets/Category/Samplemixsan.png" />
        </div>
        <p class="mt-2 text-lg text-center font-bold">Sample mix sẵn</p>
      </div>
      </div>
    </div>
    <div class="mx-auto my-5 w-2/5 border"></div>

    <div class="relative mx-auto h-[520px] w-4/5">
      <img
        class="h-full w-full object-fill"
        src="./assets/Cuahang/bannertrangcuahang.png"
      />
      <button
        class="absolute bottom-10 right-20 rounded-md bg-[#CE112D] px-5 py-2 font-bold text-white"
      >
        XEM THÊM
      </button>
    </div>
    <!-- end category -->

    <!-- product grid -->
<div class="mx-auto my-5 w-2/5 border"></div>

<div class="mx-10 grid grid-cols-10 gap-10">
  <div class="col-span-2 border-r px-1">
    <div class="border-b pb-3">
      <select id="sort" class="w-full border p-2">
        <option>Sắp xếp theo</option>
        <option>Giá từ thấp đến cao</option>
        <option>Giá từ cao đến thấp</option>
      </select>
    </div>
    <div class="mt-3">
      <div class="mb-2 flex items-center gap-2">
        <input type="checkbox" />
        <p class="">CHARM CHO NỮ (10)</p>
      </div>
      <div class="mb-2 flex items-center gap-2">
        <input type="checkbox" />
        <p class="">CHARM CHO NAM (10)</p>
      </div>
      <div class="mb-2 flex items-center gap-2">
        <input type="checkbox" />
        <p class="">CHARM CHỮ, SỐ (10)</p>
      </div>
      <div class="mb-2 flex items-center gap-2">
        <input type="checkbox" />
        <p class="">CHARM LỦNG LẲNG (10)</p>
      </div>
      <div class="mb-2 flex items-center gap-2">
        <input type="checkbox" />
        <p class="">CHARM ĐÍNH ĐÁ (10)</p>
      </div>
      <div class="mb-2 flex items-center gap-2">
        <input type="checkbox" />
        <p class="">CHARM DÀI (10)</p>
      </div>
      <div class="mb-2 flex items-center gap-2">
        <input type="checkbox" />
        <p class="">SAMPLE MIX SẴN (10)</p>
      </div>
    </div>
  </div>
  <div class="col-span-8">
    <p class="text-2xl font-bold text-[#CE112D]">TẤT CẢ SẢN PHẨM</p>
    <div class="mt-3 grid grid-cols-4 gap-x-6 gap-y-1">
          <!-- product -->
          <div id="product-detail" class="h-96 w-72 rounded-sm border bg-slate-200">
            <div
              class="h-3/4 w-full bg-[url(https://global.danielwellington.com/cdn/shop/products/fgjgwwd0ks2zfgs7ukku.png?v=1686813006&width=540)] bg-contain bg-center hover:bg-[url(https://global.danielwellington.com/cdn/shop/products/21d7003412869400afe0702f9e9090c9810e55ec.png?v=1686813008)]"
            ></div>
            <div class="mt-3 px-3">
              <a href="product-detail.php?productId=1" class="font-bold">Classic Bracelet</a>
              <p class="mt-1">5.000.000 VND</p>
              <div class="flex items-center gap-2">
                <div class="mt-1 flex gap-2">
                  <img src="./assets/images/star.png" />
                  <img src="./assets/images/star.png" />
                  <img src="./assets/images/star.png" />
                  <img src="./assets/images/star.svg" />
                  <img src="./assets/images/star.svg" />
                </div>
                <p class="translate-y-0.5">(30)</p>
              </div>
            </div>
          </div>
          <div class="h-96 w-72 rounded-sm border bg-slate-200">
            <div
              class="h-3/4 w-full bg-[url(https://global.danielwellington.com/cdn/shop/products/fgjgwwd0ks2zfgs7ukku.png?v=1686813006&width=540)] bg-contain bg-center hover:bg-[url(https://global.danielwellington.com/cdn/shop/products/21d7003412869400afe0702f9e9090c9810e55ec.png?v=1686813008)]"
            ></div>
            <div class="mt-3 px-3">
              <p class="font-bold">Classic Bracelet</p>
              <p class="mt-1">5.000.000 VND</p>
              <div class="flex items-center gap-2">
                <div class="mt-1 flex gap-2">
                  <img src="./assets/images/star.png" />
                  <img src="./assets/images/star.png" />
                  <img src="./assets/images/star.png" />
                  <img src="./assets/images/star.svg" />
                  <img src="./assets/images/star.svg" />
                </div>
                <p class="translate-y-0.5">(30)</p>
              </div>
            </div>
          </div>
          <div class="h-96 w-72 rounded-sm border bg-slate-200">
            <div
              class="h-3/4 w-full bg-[url(https://global.danielwellington.com/cdn/shop/products/fgjgwwd0ks2zfgs7ukku.png?v=1686813006&width=540)] bg-contain bg-center hover:bg-[url(https://global.danielwellington.com/cdn/shop/products/21d7003412869400afe0702f9e9090c9810e55ec.png?v=1686813008)]"
            ></div>
            <div class="mt-3 px-3">
              <p class="font-bold">Classic Bracelet</p>
              <p class="mt-1">5.000.000 VND</p>
              <div class="flex items-center gap-2">
                <div class="mt-1 flex gap-2">
                  <img src="./assets/images/star.png" />
                  <img src="./assets/images/star.png" />
                  <img src="./assets/images/star.png" />
                  <img src="./assets/images/star.svg" />
                  <img src="./assets/images/star.svg" />
                </div>
                <p class="translate-y-0.5">(30)</p>
              </div>
            </div>
          </div>
          <div class="h-96 w-72 rounded-sm border bg-slate-200">
            <div
              class="h-3/4 w-full bg-[url(https://global.danielwellington.com/cdn/shop/products/fgjgwwd0ks2zfgs7ukku.png?v=1686813006&width=540)] bg-contain bg-center hover:bg-[url(https://global.danielwellington.com/cdn/shop/products/21d7003412869400afe0702f9e9090c9810e55ec.png?v=1686813008)]"
            ></div>
            <div class="mt-3 px-3">
              <p class="font-bold">Classic Bracelet</p>
              <p class="mt-1">5.000.000 VND</p>
              <div class="flex items-center gap-2">
                <div class="mt-1 flex gap-2">
                  <img src="./assets/images/star.png" />
                  <img src="./assets/images/star.png" />
                  <img src="./assets/images/star.png" />
                  <img src="./assets/images/star.svg" />
                  <img src="./assets/images/star.svg" />
                </div>
                <p class="translate-y-0.5">(30)</p>
              </div>
            </div>
          </div>
          <div class="h-96 w-72 rounded-sm border bg-slate-200">
            <div
              class="h-3/4 w-full bg-[url(https://global.danielwellington.com/cdn/shop/products/fgjgwwd0ks2zfgs7ukku.png?v=1686813006&width=540)] bg-contain bg-center hover:bg-[url(https://global.danielwellington.com/cdn/shop/products/21d7003412869400afe0702f9e9090c9810e55ec.png?v=1686813008)]"
            ></div>
            <div class="mt-3 px-3">
              <p class="font-bold">Classic Bracelet</p>
              <p class="mt-1">5.000.000 VND</p>
              <div class="flex items-center gap-2">
                <div class="mt-1 flex gap-2">
                  <img src="./assets/images/star.png" />
                  <img src="./assets/images/star.png" />
                  <img src="./assets/images/star.png" />
                  <img src="./assets/images/star.svg" />
                  <img src="./assets/images/star.svg" />
                </div>
                <p class="translate-y-0.5">(30)</p>
              </div>
            </div>
          </div>
          <div class="h-96 w-72 rounded-sm border bg-slate-200">
            <div
              class="h-3/4 w-full bg-[url(https://global.danielwellington.com/cdn/shop/products/fgjgwwd0ks2zfgs7ukku.png?v=1686813006&width=540)] bg-contain bg-center hover:bg-[url(https://global.danielwellington.com/cdn/shop/products/21d7003412869400afe0702f9e9090c9810e55ec.png?v=1686813008)]"
            ></div>
            <div class="mt-3 px-3">
              <p class="font-bold">Classic Bracelet</p>
              <p class="mt-1">5.000.000 VND</p>
              <div class="flex items-center gap-2">
                <div class="mt-1 flex gap-2">
                  <img src="./assets/images/star.png" />
                  <img src="./assets/images/star.png" />
                  <img src="./assets/images/star.png" />
                  <img src="./assets/images/star.svg" />
                  <img src="./assets/images/star.svg" />
                </div>
                <p class="translate-y-0.5">(30)</p>
              </div>
            </div>
          </div>
          <div class="h-96 w-72 rounded-sm border bg-slate-200">
            <div
              class="h-3/4 w-full bg-[url(https://global.danielwellington.com/cdn/shop/products/fgjgwwd0ks2zfgs7ukku.png?v=1686813006&width=540)] bg-contain bg-center hover:bg-[url(https://global.danielwellington.com/cdn/shop/products/21d7003412869400afe0702f9e9090c9810e55ec.png?v=1686813008)]"
            ></div>
            <div class="mt-3 px-3">
              <p class="font-bold">Classic Bracelet</p>
              <p class="mt-1">5.000.000 VND</p>
              <div class="flex items-center gap-2">
                <div class="mt-1 flex gap-2">
                  <img src="./assets/images/star.png" />
                  <img src="./assets/images/star.png" />
                  <img src="./assets/images/star.png" />
                  <img src="./assets/images/star.svg" />
                  <img src="./assets/images/star.svg" />
                </div>
                <p class="translate-y-0.5">(30)</p>
              </div>
            </div>
          </div>
          <div class="h-96 w-72 rounded-sm border bg-slate-200">
            <div
              class="h-3/4 w-full bg-[url(https://global.danielwellington.com/cdn/shop/products/fgjgwwd0ks2zfgs7ukku.png?v=1686813006&width=540)] bg-contain bg-center hover:bg-[url(https://global.danielwellington.com/cdn/shop/products/21d7003412869400afe0702f9e9090c9810e55ec.png?v=1686813008)]"
            ></div>
            <div class="mt-3 px-3">
              <p class="font-bold">Classic Bracelet</p>
              <p class="mt-1">5.000.000 VND</p>
              <div class="flex items-center gap-2">
                <div class="mt-1 flex gap-2">
                  <img src="./assets/images/star.png" />
                  <img src="./assets/images/star.png" />
                  <img src="./assets/images/star.png" />
                  <img src="./assets/images/star.svg" />
                  <img src="./assets/images/star.svg" />
                </div>
                <p class="translate-y-0.5">(30)</p>
              </div>
            </div>
          </div>

          <!-- product -->
        </div>
      </div>
    </div>

    <!-- end product grid -->

    <!-- footer -->
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
          <h1 class="text-lg">Hỗ trợ</h1>
          <h3 class="mt-2 text-sm">Đường CMT8, Quận 10, TP HCM</h3>
          <h3 class="mt-2 text-sm">Usbi@gmail.com</h3>
          <h3 class="mt-2 text-sm">08358588484</h3>
        </div>
        <div>
          <h1 class="text-lg">Menu</h1>
          <a href="/index.html" class="mt-2 block text-sm">Trang chủ</a>
          <a href="/blog.html" class="mt-2 block text-sm">Bài viết</a>
          <a class="mt-2 block text-sm">Cửa hàng</a>
          <a class="mt-2 block text-sm">Câu chuyện Usbi</a>
          <a class="mt-2 block text-sm">Giỏ hàng</a>
        </div>
        <div>
          <h1 class="text-lg">Theo dõi Usbi tại</h1>
        </div>
      </div>
    </div>
    <!-- end footer -->
     <script>
      btn_login = document.getElementById("btn_login");
      btn_login.addEventListener("click", function () {
        window.location.href = "/login.php";
      });
      document.getElementById("product-detail").addEventListener("click", function () {
        window.location.href = "/product-detail.php?product_id=1";
      });
     </script>
  </body>
</html>