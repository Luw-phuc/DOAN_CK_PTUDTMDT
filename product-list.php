<?php
session_start();
require_once "include/db.inc.php";

try {
  // Kiểm tra nếu có categoryId trên URL
  $categoryId = isset($_GET['categoryId']) ? intval($_GET['categoryId']) : null;
  // Kiểm tra nếu có sort trên URL
  $sort = isset($_GET['sort']) ? $_GET['sort'] : 'default'; ///// chưa viết docs đoạn này
    // Kiểm tra nếu có searchTerm trong URL
    $searchTerm = isset($_GET['searchTerm']) ? $_GET['searchTerm'] : null;
    // Kiểm tra nếu có trang (page) trong URL
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1; // Mặc định là trang 1
    // Số lượng sản phẩm trên mỗi trang
    $productsPerPage = 12;
    // Tính toán offset dựa vào trang hiện tại
    $offset = ($page - 1) * $productsPerPage;
    // Xây dựng câu truy vấn SQL cơ bản
      $sql = "
      SELECT 
          p.id AS product_id,
          p.name AS product_name,
          p.description,
          p.quantity,
          pp.price AS product_price,
          c.name AS category_name,
          i.path AS image_path
      FROM product p
      LEFT JOIN (
          SELECT product_id, price 
          FROM productprice
          WHERE starting_timestamp = (
              SELECT MIN(starting_timestamp) 
              FROM productprice pp2 
              WHERE pp2.product_id = productprice.product_id
          )
      ) pp ON p.id = pp.product_id
      LEFT JOIN (
          SELECT product_id, path 
          FROM image i
          WHERE id = (
              SELECT MIN(id) 
              FROM image i2 
              WHERE i2.product_id = i.product_id
          )
      ) i ON p.id = i.product_id
      LEFT JOIN category c ON p.category_id = c.id
  ";
  // Thêm điều kiện WHERE nếu có categoryId
  if ($categoryId !== null) {
    $sql .= " AND p.category_id = :categoryId ";
    }

  // Thêm điều kiện tìm kiếm nếu có searchTerm
    if ($searchTerm !== null) {
      if ($categoryId !== null) {
          $sql .= " AND p.name LIKE :searchTerm ";
      } else {
          $sql .= " WHERE p.name LIKE :searchTerm ";
      }
  }

    // Thêm điều kiện ORDER BY nếu có sắp xếp
    if ($sort === 'asc') {
        $sql .= "ORDER BY pp.price ASC ";
    } elseif ($sort === 'desc') {
        $sql .= "ORDER BY pp.price DESC ";
    } else {
        $sql .= "ORDER BY p.id ASC ";  // Sắp xếp theo ID nếu không có sắp xếp
  }
    // Thêm LIMIT và OFFSET cho phân trang
    $sql .= "LIMIT :limit OFFSET :offset";
    // Chuẩn bị và thực thi câu truy vấn để lấy sản phẩm
    $stmt = $pdo->prepare($sql);
  // Bind giá trị nếu có categoryId
  if ($categoryId !== null) {
      $stmt->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
  }
  // Bind giá trị nếu có searchTerm
if ($searchTerm !== null) {
  $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
}
  // Bind LIMIT và OFFSET cho phân trang
$stmt->bindValue(':limit', $productsPerPage, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

  $stmt->execute();
  $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

   // Lấy tổng số sản phẩm để tính số trang
   $countSql = "
   SELECT COUNT(*) AS total FROM product p
   LEFT JOIN category c ON p.category_id = c.id
";
if ($categoryId !== null) {
   $countSql .= " WHERE p.category_id = :categoryId ";
}
if ($searchTerm !== null) {
   if ($categoryId !== null) {
       $countSql .= " AND p.name LIKE :searchTerm ";
   } else {
       $countSql .= " WHERE p.name LIKE :searchTerm ";
   }
}
$countStmt = $pdo->prepare($countSql);
// Bind giá trị count
if ($categoryId !== null) {
   $countStmt->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
}
if ($searchTerm !== null) {
   $countStmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
}
$countStmt->execute();
$countResult = $countStmt->fetch(PDO::FETCH_ASSOC);
$totalProducts = $countResult['total'];
// Tính toán số trang
$totalPages = ceil($totalProducts / $productsPerPage);

  // Lấy tên danh mục nếu có categoryId
  $categoryName = "TẤT CẢ SẢN PHẨM";
  if ($categoryId !== null) {
      $stmtCategory = $pdo->prepare("SELECT name FROM category WHERE id = :categoryId");
      $stmtCategory->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
      $stmtCategory->execute();
      $category = $stmtCategory->fetch(PDO::FETCH_ASSOC);
      if ($category) {
          $categoryName = $category['name'];
      }
  }
  // Lấy tất cả danh mục
  $stmtAllCategories = $pdo->prepare("SELECT id, name FROM category");
  $stmtAllCategories->execute();
  $categories = $stmtAllCategories->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
  echo "Lỗi khi truy vấn dữ liệu: " . $e->getMessage();
}
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

    <!-- category -->
    
    <div class="mt-7 flex w-full flex-col items-center">
      <h1 class="text-3xl font-bold text-[#CE112D]">DANH MỤC SẢN PHẨM</h1>
      <div class="mt-5 grid w-4/5 grid-cols-7 gap-8">
      <div class="flex flex-col items-center">
        <div class="h-25 w-25">
          <a  href="product-list.php?categoryId=1">
          <img class="h-full w-full" src="./assets/Category/Charmchonu.png" /></a>
        </div>
        <p class="mt-2 text-lg text-center font-bold"><a href="product-list.php?categoryId=1">Charm Cho Nữ</a></p>
      </div>
      <div class="flex flex-col items-center">
        <div class="h-25 w-25">
          <a href="product-list.php?categoryId=2">
          <img class="h-full w-full" src="./assets/Category/Charmchonam.png" /></a>
        </div>
        <p class="mt-2 text-lg text-center font-bold"><a  href="product-list.php?categoryId=2">Charm Cho Nam</a></p>
      </div>
      <div class="flex flex-col items-center">
        <div class="h-25 w-25">
          <a href="product-list.php?categoryId=4">
          <img class="h-full w-full" src="./assets/Category/Charmchuso.png" /></a>
        </div>
        <p class="mt-2 text-lg text-center font-bold"><a href="product-list.php?categoryId=4">Charm chữ, số</a></p>
      </div>
      <div class="flex flex-col items-center">
        <div class="h-25 w-25">
          <a href="product-list.php?categoryId=3">  
          <img class="h-full w-full" src="./assets/Category/Charmlunglang.png" /></a>
        </div>
        <p class="mt-2 text-lg text-center font-bold"><a href="product-list.php?categoryId=3">Charm lủng lẳng</a></p>
      </div>
      <div class="flex flex-col items-center">
        <div class="h-25 w-25">
          <a href="product-list.php?categoryId=7"> 
          <img class="h-full w-full" src="./assets/Category/Charmdinhda.png" /></a>
        </div>
        <p class="mt-2 text-lg text-center font-bold"><a href="product-list.php?categoryId=7">Charm đính đá</a></p>
      </div>
      <div class="flex flex-col items-center">
        <div class="h-25 w-25">
          <a href="product-list.php?categoryId=6">
          <img class="h-full w-full" src="./assets/Category/Charmdai.png" /></a>
        </div>
        <p class="mt-2 text-lg text-center font-bold"><a href="product-list.php?categoryId=6">Charm dài</a></p>
      </div>
      <div class="flex flex-col items-center">
        <div class="h-25 w-25">
          <a href="product-list.php?categoryId=5">
          <img class="h-full w-full" src="./assets/Category/Samplemixsan.png" /></a>
        </div>
        <p class="mt-2 text-lg text-center font-bold"><a href="product-list.php?categoryId=5">Sample mix sẵn</a></p>
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
    <div class="mx-10 mt-12 grid grid-cols-10 gap-10">
    <div class="col-span-2 border-r px-1">
      <div class="border-b pb-3">
        <select id="sort" class="w-full border p-2">
          <option value="default">Sắp xếp theo</option>
          <option value="asc">Giá từ thấp đến cao</option>
          <option value="desc">Giá từ cao đến thấp</option>
        </select>
    </div>
    <div class="mt-3">
    <?php foreach ($categories as $category): ?>
            <div class="mb-2 flex items-center gap-2">
              <?php if ($category['id'] == $categoryId): ?>
                <a href="?categoryId=<?= $category['id'] ?>" class="font-semibold italic underline"><?= $category['name'] ?></a>
              <?php else: ?>
                <a href="?categoryId=<?= $category['id'] ?>" class="font-semibold"><?= $category['name'] ?></a>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
    </div>
  </div>
  <div class="col-span-8">
  <p class="text-2xl font-bold text-[#CE112D]"><?= $categoryName ?></p>    <div class="mt-3 grid grid-cols-4 gap-x-6 gap-y-1">
          <!-- product -->
          <?php if (empty($products)): ?>
              <p>Không tìm thấy sản phẩm nào</p>
          <?php else: ?>
            <?php foreach ($products as $product): ?>
              <div id="product-detail" class="h-96 w-72 rounded-sm border bg-slate-200">
                  <img class="h-3/4 w-full" src="<?= $product['image_path'] ?>"/>
                  <div class="mt-3 px-3">
                      <a href="product-detail.php?productId=<?= $product['product_id'] ?>" class="font-bold"><?= $product['product_name'] ?></a>
                      <p class="mt-1"><?php echo number_format($product['product_price'], 0, ',', '.') . 'đ'; ?></p>
                      <div class="flex items-center gap-2">
                          <div class="mt-1 flex gap-2">
                              <img src="./assets/images/star-yellow.svg" />
                              <img src="./assets/images/star-yellow.svg" />
                              <img src="./assets/images/star-yellow.svg" />
                              <img src="./assets/images/star-yellow.svg" />
                              <img src="./assets/images/star.svg" />
                          </div>
                          <p class="translate-y-0.5">(30)</p>
                      </div>
                  </div>
              </div>
              <?php endforeach; ?>
          <?php endif; ?>
        </div>
          <!-- product -->
           <!-- Phân trang -->
        <div class="mt-10 text-center">
            <ul class="flex justify-center gap-4">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li>
                        <a href="?page=<?= $i ?>
                            <?php if (!empty($categoryId)) echo '&categoryId=' . $categoryId; ?>
                            <?php if (!empty($sort) && $sort !== 'default') echo '&sort=' . $sort; ?>
                            <?php if (!empty($searchTerm)) echo '&searchTerm=' . urlencode($searchTerm); ?>"
                          class="px-4 py-2 <?= $i == $page ? 'bg-red-500 text-white' : 'bg-gray-300' ?>">
                            <?= $i ?>
                        </a>
                    </li>
                <?php endfor; ?>
            </ul>
        </div>
      </div>
    </div>

    <!-- end product grid -->
    <!--HDSD-->
    <div class="mt-7 flex w-full flex-col items-center">
    <h1 class="text-3xl font-bold text-[#CE112D]">HƯỚNG DẪN SỬ DỤNG</h1>
      <div class="mt-8 grid w-full grid-cols-3 gap-8">
  <div class="flex flex-col items-center">
    <div class="w-full aspect-w-1 aspect-h-1">
      <img
        class="object-contain"
        src="./assets/index/Bước 1.png"
        alt="Charm cho nữ"
      />
    </div>
    <p class="mt-2 text-lg text-center">Mở rộng mối nối của vòng đeo tay</p>
  </div>
  <div class="flex flex-col items-center">
    <div class="w-full aspect-w-1 aspect-h-1">
      <img
        class="object-contain"
        src="./assets/index/Bước 2.png"
        alt="Charm cho nam"
      />
    </div>
    <p class="mt-2 text-lg text-center">Nắm bắt hai đầu của charm muốn tách và tháo ra</p>
  </div>
  <div class="flex flex-col items-center">
    <div class="w-full aspect-w-1 aspect-h-1">
      <img
        class="object-contain"
        src="./assets/index/Bước 3.png"
        alt="Charm chữ, số"
      />
    </div>
    <p class="mt-2 text-lg text-center">Chèn và nối các Charms mới lại với nhau</p>
  </div>
</div>
</div>
<!--HDSD--> 

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


    <script>
      /* ĐÂY LÀ LỌC - CHƯA GHI VÔ DOC */
      btn_login = document.getElementById("btn_login");
      btn_login.addEventListener("click", function () {
        window.location.href = "/login.php";
      });
      document.getElementById("product-detail").addEventListener("click", function () {
        window.location.href = "/product-detail.php?product_id=1";
      });
      // Chỉ cho phép chọn một category
      document.addEventListener('DOMContentLoaded', function() {
        const sortElement = document.getElementById('sort');
        if (sortElement) {
          sortElement.addEventListener('change', function() {
            const sortValue = this.value;
            const url = new URL(window.location.href);
            if (sortValue !== 'default') {
              url.searchParams.set('sort', sortValue);  // Thêm tham số sort vào URL
            } else {
              url.searchParams.delete('sort');  // Nếu không chọn sắp xếp, xóa tham số sort
            }
            window.location.href = url.toString();  // Làm mới trang với URL mới
          });
        }
      });
     </script>
  </body>
</html>