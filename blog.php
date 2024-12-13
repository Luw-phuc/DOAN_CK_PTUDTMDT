<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tin tức</title>
    <link
      href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css"
      rel="stylesheet"
    />
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

    <div>
      <div class="bg-[#D9D9D9] grid h-[520px] grid-cols-7">
        <div class="col-span-3 flex items-center mx-auto">
          <div class="h-[440px] w-[480px]">
            <img class="h-full w-full object-fill" src="./assets/blogs/1.png" />
          </div>
        </div>
        <div class="col-span-4 flex flex-col items-center justify-center">
          <p class="text-3xl">Tỏa sáng cùng Usbibracelet</p>
          <div class="mt-5 text-center">
            <p class="text-6xl mt-1 font-bold text-red-500">
              "THE LOVE OF MINE"
            </p>
            <p class="text-5xl mt-1 font-bold text-red-500">
              QÙA TẶNG Ý NGHĨA CHO
            </p>
            <p class="text-5xl mt-1 font-bold text-red-500">
              NGÀY QUỐC TẾ NAM GIỚI
            </p>
          </div>
          <div class="mt-5 w-[90%]">
            <p class="text-lg">
              Vào ngày 19 tháng 11, Ngày Quốc tế Nam giới được tôn vinh trên
              toàn cầu: khám phá những món trang sức ý nghĩa dành cho anh ấy để
              làm quà tặng trong ngày đặc biệt này.
            </p>
          </div>
          <p class="text-6xl text-red-500">→</p>
        </div>
      </div>
      <div class="mt-10 grid grid-cols-4 gap-10 px-20">
        <div class="h-96 border rounded-lg gap-5">
          <div class="h-2/3">
            <img
              class="h-full rounded-t-lg w-full object-fill"
              src="./assets/blogs/1.png"
            />
          </div>
          <div class="mt-2 px-3 items-center justify-center">
            <p>Tỏa áng cùng Usbibracelet</p>
            <p class="text-red-500 font-bold text-lg">
              Ý tưởng tặng quà cho bạn trai
            </p>
            <p class="line-clamp-2">
              Nên tặng gì cho bạn trai của mình Nên tặng gì cho bạn trai của
              mình Nên tặng gì cho bạn trai của mình Nên tặng gì cho bạn trai
              của mình?
            </p>
          </div>
        </div>
        <div class="h-96 border rounded-lg gap-5">
          <div class="h-2/3">
            <img
              class="h-full rounded-t-lg w-full object-fill"
              src="./assets/blogs/1.png"
            />
          </div>
          <div class="mt-2 px-3 items-center justify-center">
            <p>Tỏa áng cùng Usbibracelet</p>
            <p class="text-red-500 font-bold text-lg">
              Ý tưởng tặng quà cho bạn trai
            </p>
            <p class="line-clamp-2">
              Nên tặng gì cho bạn trai của mình Nên tặng gì cho bạn trai của
              mình Nên tặng gì cho bạn trai của mình Nên tặng gì cho bạn trai
              của mình?
            </p>
          </div>
        </div>
        <div class="h-96 border rounded-lg gap-5">
          <div class="h-2/3">
            <img
              class="h-full rounded-t-lg w-full object-fill"
              src="./assets/blogs/1.png"
            />
          </div>
          <div class="mt-2 px-3 items-center justify-center">
            <p>Tỏa áng cùng Usbibracelet</p>
            <p class="text-red-500 font-bold text-lg">
              Ý tưởng tặng quà cho bạn trai
            </p>
            <p class="line-clamp-2">
              Nên tặng gì cho bạn trai của mình Nên tặng gì cho bạn trai của
              mình Nên tặng gì cho bạn trai của mình Nên tặng gì cho bạn trai
              của mình?
            </p>
          </div>
        </div>
        <div class="h-96 border rounded-lg gap-5">
          <div class="h-2/3">
            <img
              class="h-full rounded-t-lg w-full object-fill"
              src="./assets/blogs/1.png"
            />
          </div>
          <div class="mt-2 px-3 items-center justify-center">
            <p>Tỏa áng cùng Usbibracelet</p>
            <p class="text-red-500 font-bold text-lg">
              Ý tưởng tặng quà cho bạn trai
            </p>
            <p class="line-clamp-2">
              Nên tặng gì cho bạn trai của mình Nên tặng gì cho bạn trai của
              mình Nên tặng gì cho bạn trai của mình Nên tặng gì cho bạn trai
              của mình?
            </p>
          </div>
        </div>
        <div class="h-96 border rounded-lg gap-5">
          <div class="h-2/3">
            <img
              class="h-full rounded-t-lg w-full object-fill"
              src="./assets/blogs/1.png"
            />
          </div>
          <div class="mt-2 px-3 items-center justify-center">
            <p>Tỏa áng cùng Usbibracelet</p>
            <p class="text-red-500 font-bold text-lg">
              Ý tưởng tặng quà cho bạn trai
            </p>
            <p class="line-clamp-2">
              Nên tặng gì cho bạn trai của mình Nên tặng gì cho bạn trai của
              mình Nên tặng gì cho bạn trai của mình Nên tặng gì cho bạn trai
              của mình?
            </p>
          </div>
        </div>
        <div class="h-96 border rounded-lg gap-5">
          <div class="h-2/3">
            <img
              class="h-full rounded-t-lg w-full object-fill"
              src="./assets/blogs/1.png"
            />
          </div>
          <div class="mt-2 px-3 items-center justify-center">
            <p>Tỏa áng cùng Usbibracelet</p>
            <p class="text-red-500 font-bold text-lg">
              Ý tưởng tặng quà cho bạn trai
            </p>
            <p class="line-clamp-2">
              Nên tặng gì cho bạn trai của mình Nên tặng gì cho bạn trai của
              mình Nên tặng gì cho bạn trai của mình Nên tặng gì cho bạn trai
              của mình?
            </p>
          </div>
        </div>
        <div class="h-96 border rounded-lg gap-5">
          <div class="h-2/3">
            <img
              class="h-full rounded-t-lg w-full object-fill"
              src="./assets/blogs/1.png"
            />
          </div>
          <div class="mt-2 px-3 items-center justify-center">
            <p>Tỏa áng cùng Usbibracelet</p>
            <p class="text-red-500 font-bold text-lg">
              Ý tưởng tặng quà cho bạn trai
            </p>
            <p class="line-clamp-2">
              Nên tặng gì cho bạn trai của mình Nên tặng gì cho bạn trai của
              mình Nên tặng gì cho bạn trai của mình Nên tặng gì cho bạn trai
              của mình?
            </p>
          </div>
        </div>
        <div class="h-96 border rounded-lg gap-5">
          <div class="h-2/3">
            <img
              class="h-full rounded-t-lg w-full object-fill"
              src="./assets/blogs/1.png"
            />
          </div>
          <div class="mt-2 px-3 items-center justify-center">
            <p>Tỏa áng cùng Usbibracelet</p>
            <p class="text-red-500 font-bold text-lg">
              Ý tưởng tặng quà cho bạn trai
            </p>
            <p class="line-clamp-2">
              Nên tặng gì cho bạn trai của mình Nên tặng gì cho bạn trai của
              mình Nên tặng gì cho bạn trai của mình Nên tặng gì cho bạn trai
              của mình?
            </p>
          </div>
        </div>
      </div>
    </div>

    <!-- footer -->
    <div
      class="mt-20 grid min-h-40 grid-cols-4 gap-10 bg-[#FDF8F8] px-16 pt-6 text-[#CE112D]"
    >
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
        <a class="mt-2 block text-sm">Trang chủ</a>
        <a class="mt-2 block text-sm">Bài viết</a>
        <a class="mt-2 block text-sm">Cửa hàng</a>
        <a class="mt-2 block text-sm">Câu chuyện Usbi</a>
        <a class="mt-2 block text-sm">Giỏ hàng</a>
      </div>
      <div>
        <h1 class="text-lg">Theo dõi Usbi tại</h1>
      </div>
    </div>
    <!-- footer -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script></script>
  </body>
</html>