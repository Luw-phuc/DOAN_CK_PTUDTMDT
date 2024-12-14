<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Chi tiết tin tức</title>
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

    <div class="flex justify-between mt-10 px-4 mx-auto max-w-screen-xl">
      <article class="mx-auto w-full">
        <header class="mb-4">
          <h1 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900">
            Best practices for successful prototypes
          </h1>
        </header>
        <p class="lead">
          Flowbite is an open-source library of UI components built with the
          utility-first classes from Tailwind CSS. It also includes interactive
          elements such as dropdowns, modals, datepickers.
        </p>
        <p>
          Before going digital, you might benefit from scribbling down some
          ideas in a sketchbook. This way, you can think things through before
          committing to an actual design project.
        </p>
        <p>
          But then I found a
          <a href="https://flowbite.com"
            >component library based on Tailwind CSS called Flowbite</a
          >. It comes with the most commonly used UI components, such as
          buttons, navigation bars, cards, form elements, and more which are
          conveniently built with the utility classes from Tailwind CSS.
        </p>
        <figure>
          <img
            src="https://flowbite.s3.amazonaws.com/typography-plugin/typography-image-1.png"
            alt=""
          />
          <figcaption>Digital art by Anonymous</figcaption>
        </figure>
        <h2>Getting started with Flowbite</h2>
        <p>
          First of all you need to understand how Flowbite works. This library
          is not another framework. Rather, it is a set of components based on
          Tailwind CSS that you can just copy-paste from the documentation.
        </p>
        <p>
          It also includes a JavaScript file that enables interactive
          components, such as modals, dropdowns, and datepickers which you can
          optionally include into your project via CDN or NPM.
        </p>
        <p>
          You can check out the
          <a href="https://flowbite.com/docs/getting-started/quickstart/"
            >quickstart guide</a
          >
          to explore the elements by including the CDN files into your project.
          But if you want to build a project with Flowbite I recommend you to
          follow the build tools steps so that you can purge and minify the
          generated CSS.
        </p>
      </article>
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

