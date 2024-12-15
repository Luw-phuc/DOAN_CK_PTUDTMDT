<?php
  session_start();
  require_once "include/db.inc.php";


  // Get the current page from the query string (default to page 1 if not present)
  $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
  $perPage = 8; // Number of blogs per page
  $offset = ($page - 1) * $perPage;


  // Prepare the SQL query to fetch the blogs with images using LEFT JOIN
  $sql = "
      SELECT blog.*, image.path AS image_path
      FROM blog
      LEFT JOIN image ON blog.id = image.blog_id
      LIMIT :offset, :perPage
  ";
  $stmt = $pdo->prepare($sql);


  // Bind the offset and perPage values
  $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
  $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);


  // Execute the query
  $stmt->execute();
  $blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);


  // Get the total number of blogs for pagination logic
  $totalBlogsSql = "SELECT COUNT(*) FROM blog";
  $totalBlogsStmt = $pdo->query($totalBlogsSql);
  $totalBlogs = $totalBlogsStmt->fetchColumn();


  // Calculate total pages
  $totalPages = ceil($totalBlogs / $perPage);


  // Pass the blogs and total pages to the view
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Blogs with Pagination</title>
    <link
      href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css"
      rel="stylesheet"
    />
    <script src="https://cdn.tailwindcss.com"></script>
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


    <div class="">
      <div class="bg-[#FDF8F8] grid h-[440px] grid-cols-7">
        <div class="col-span-3 flex items-center mx-auto">
          <div class="h-[440px] w-[680px]">
            <img class="h-full w-full object-fill" src="./assets/blogs/biablog.png" />
          </div>
        </div>
        <div class="col-span-4 flex flex-col items-center justify-center">
          <p class="text-3xl">𝑼𝒔𝒃𝒊𝒃𝒓𝒂𝒄𝒆𝒍𝒆𝒕 𝑰𝒅𝒆𝒂𝒔</p>
          <div class="mt-5 text-center">
            <p class="text-6xl mt-3 mb-5 font-bold text-[#CE112D]">
              "THE LOVE OF MINE"
            </p>
            <p class="text-5xl mt-3 font-bold text-[#CE112D]">
              QUÀ TẶNG Ý NGHĨA CHO
            </p>
            <p class="text-5xl mt-1 font-bold text-[#CE112D]">
              NGÀY QUỐC TẾ NAM GIỚI
            </p>
          </div>
          <div class="mt-8 w-[90%]">
            <p class="text-lg">
              Vào ngày 19 tháng 11, Ngày Quốc tế Nam giới được tôn vinh trên
              toàn cầu: khám phá những món trang sức ý nghĩa dành cho anh ấy để
              làm quà tặng trong ngày đặc biệt này.
            </p>
          </div>
          <p class="text-6xl text-[#CE112D] animate-bounce">→</p>
        </div>
      </div>
      <div>


        <div class="mt-10 grid grid-cols-4 gap-10 px-20">
          <?php foreach ($blogs as $blog): ?>
            <div class="h-96 border rounded-lg gap-5 hover:scale-125 transition-transform duration-500">
              <div class="h-3/4">
                <?php if (!empty($blog['image_path'])): ?>
                  <img src="<?= $blog['image_path']; ?>" alt="Blog Image" class="h-full w-full object-cover" />
                <?php else: ?>
                  <div class="h-full w-full bg-gray-200 flex items-center justify-center">
                    <span>No Image</span>
                  </div>
                <?php endif; ?>
              </div>
              <div class="mt-2 px-3 items-center justify-center">
           
                <a href="blogdetail.php?blogId=<?= $blog['id'] ?>" class="text-[#CE112D] font-bold text-lg center">
                  <?= htmlspecialchars($blog['title']); ?>
                </a>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
     


        <!-- Pagination -->
        <div class="pagination mx-auto w-96 flex items-center justify-between gap-3 mt-5">
            <div class="flex gap-3">
              <a href="?page=1" class=" text-white px-2 py-1 rounded bg-[#CE112D] pagination-btn <?= ($page == 1) ? 'disabled' : ''; ?>">First</a>
              <a href="?page=<?= max(1, $page - 1); ?>" class="text-white px-2 py-1 rounded bg-[#CE112D] pagination-btn <?= ($page == 1) ? 'disabled' : ''; ?>">Previous</a>
            </div>
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?= $i; ?>" class="pagination-btn <?= ($i == $page) ? 'active' : ''; ?>"><?= $i; ?></a>
            <?php endfor; ?>
            <div class="flex gap-3">
              <a href="?page=<?= min($totalPages, $page + 1); ?>" class=" text-white px-2 py-1 rounded bg-[#CE112D] pagination-btn <?= ($page == $totalPages) ? 'disabled' : ''; ?>">Next</a>
              <a href="?page=<?= $totalPages; ?>" class="text-white px-2 py-1 rounded bg-[#CE112D] pagination-btn <?= ($page == $totalPages) ? 'disabled' : ''; ?>">Last</a>
            </div>
        </div>
      </div>
    </div>
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
    <script></script>
  </body>
</html>