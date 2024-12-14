<?php
session_start();
require_once "include/db.inc.php";

$productId = isset($_GET['productId']) ? intval($_GET['productId']) : null;

$product = null;

if ($productId) {
  try {
      // Truy vấn thông tin sản phẩm
      $stmt = $pdo->prepare("SELECT * FROM product WHERE id = :id");
      $stmt->bindParam(':id', $productId, PDO::PARAM_INT);
      $stmt->execute();
      $product = $stmt->fetch(PDO::FETCH_ASSOC);
      // Lấy hình ảnh sản phẩm
      $stmtImages = $pdo->prepare("SELECT path FROM image WHERE product_id = :productId");
      $stmtImages->bindParam(':productId', $productId, PDO::PARAM_INT);
      $stmtImages->execute();
      $images = $stmtImages->fetchAll(PDO::FETCH_ASSOC);

      $stmtPrice = $pdo->prepare('SELECT * FROM productprice WHERE product_id = :productId');
      $stmtPrice->bindParam(':productId', $productId, PDO::PARAM_INT);
      $stmtPrice->execute();
      $price = $stmtPrice->fetch(PDO::FETCH_ASSOC);

      $categoryId = $product['category_id']; // Lấy category_id từ sản phẩm hiện tại

      // Truy vấn các sản phẩm cùng categoryId
      $stmtSimilarProducts = $pdo->prepare("
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
        WHERE p.category_id = :categoryId
      ");
      $stmtSimilarProducts->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
      $stmtSimilarProducts->execute();
      $similarProducts = $stmtSimilarProducts->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
      echo "Lỗi khi truy vấn dữ liệu: " . $e->getMessage();
  }
}

if (!$product) {
  echo "<h1>Sản phẩm không tồn tại!</h1>";
  exit;
}
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

    <div class="mt-8 grid grid-cols-4 gap-16 px-40">
      <div class="col-span-2 h-[480px] w-full">
        <div class="splide h-full w-full" role="group" aria-label="Splide">
          <div class="splide__track h-full w-full">
            <ul class="splide__list h-full w-full">
              <?php if (!empty($images)): ?>
                  <?php foreach ($images as $image): ?>
                    <li class="splide__slide">
                        <img
                          class="h-full w-full"
                          src="<?= $image['path'] ?>"
                        />
                    </li>
                  <?php endforeach; ?>
              <?php else: ?>
                  <p>Không có hình ảnh cho sản phẩm này.</p>
              <?php endif; ?>
            </ul>
          </div>
        </div>
      </div>
      <form class="col-span-2" method="post" action="include/add-to-cart.inc.php">
        <h1 class="text-4xl font-bold"><?= $product['name'] ?></h1>
        <div class="flex items-center mt-3 gap-2">
          <div class="mt-1 flex gap-2">
            <img src="./assets/images/star-yellow.svg" />
            <img src="./assets/images/star-yellow.svg" />
            <img src="./assets/images/star-yellow.svg" />
            <img src="./assets/images/star-yellow.svg" />
            <img src="./assets/images/star.svg" />
          </div>
          <p class="translate-y-0.5">(30)</p>
        </div>
        <div class="mt-5">
          <input type="hidden" name="productId" value="<?= $productId ?>"/>
          <h1 class="font-semibold text-3xl text-red-500"><?php echo number_format($price['price'], 0, ',', '.') . 'đ'; ?></h1>
        </div>
        <div class="flex text-2xl h-10 mt-5 font-semibold border-2 w-fit">
          <div id="decrease-quantity" class="w-10 text-center hover:bg-slate-200 cursor-pointer">
            -
          </div>
          <input type="hidden" name="quantity" id="quantityInput" value="1"/>
          <div id="quantity" class="border-r-2 border-l-2 w-20 text-center">1</div>
          <div id="increase-quantity" class="w-10 text-center hover:bg-slate-200 cursor-pointer">
            +
          </div>
        </div>
        <button
          class="block border border-2 py-2 font-semibold rounded-2xl border-red-500 w-96 text-center mt-5 text-2xl"
          type="submit"
        >
          THÊM VÀO GIỎ HÀNG
        </button>
        <button
          class="block py-2 font-semibold rounded-2xl bg-red-500 text-white w-96 text-center mt-5 text-2xl"
        >
          MUA NGAY
        </button>
        <div class="mt-10">
          <div
            id="product-details-container"
            class="w-full border-t border-b py-2 px-5 text-xl font-semibold"
          >
            <div class="flex items-center justify-between">
              <p>PRODUCT DETAILS</p>
              <p id="product-details-icon-trigger">+</p>
            </div>
            <p id="product-details" class="hidden text-sm font-normal italic">
            <?= $product['description'] ?>
            </p>
          </div>
          <div
            id="size-guide-container"
            class="w-full border-t border-b py-2 px-5 text-xl font-semibold"
          >
            <div class="flex items-center justify-between">
              <p>SIZE GUIDE</p>
              <p id="size-guide-icon-trigger">+</p>
            </div>
            <p id="size-guide" class="hidden text-sm font-normal italic">
            Số lượng charm trên một vòng sẽ được điều chỉnh phù hợp với kích cỡ cổ tay của bạn.
            Hãy đo chu vi cổ tay và cộng thêm 2 charm để tính số lượng charm cần thiết.
            Ví dụ: Nếu cổ tay bạn là 15 cm, số charm cần đeo sẽ là 17.

            </p>
          </div>
          <div
            id="shipping-return-container"
            class="w-full border-t border-b py-2 px-5 text-xl font-semibold"
          >
            <div class="flex items-center justify-between">
              <p>SHIPPING & RETURNS</p>
              <p id="shipping-return-icon-trigger">+</p>
            </div>
            <p id="shipping-return" class="hidden text-sm font-normal italic">
            Shipping 
            Chính Sách Miễn Phí Vận Chuyển
            Usbibracelet rất vui thông báo rằng chính sách miễn phí vận chuyển đã được áp dụng cho tất cả các đơn hàng trên Website của chúng tôi. Hy vọng rằng việc cung cấp dịch vụ miễn phí vận chuyển là một phần quan trọng của cam kết mang lại trải nghiệm mua sắm tốt nhất cho khách hàng.
            Ưu đãi miễn phí vận chuyển:
            Miễn phí vận chuyển cho tất cả các đơn hàng.
            Áp dụng cho tất cả các sản phẩm trên Website và Fanpage
            Miễn phí vận chuyển được áp dụng cho tất cả đơn hàng trên toàn quốc.
            Chúng tôi cam kết đảm bảo rằng tất cả các đơn hàng sẽ được xử lý và vận chuyển một cách nhanh chóng và chuyên nghiệp. Với chính sách Miễn phí vận chuyển của chúng tôi, bạn có thể yên tâm mua sắm mà không cần lo lắng về phí vận chuyển.
            Hãy khám phá bộ sưu tập sản phẩm của chúng tôi ngay hôm nay và tận hưởng trải nghiệm mua sắm thuận tiện và tiết kiệm cùng với dịch vụ Miễn phí vận chuyển
            Nếu bạn có bất kỳ câu hỏi nào, vui lòng liên hệ với chúng tôi qua email hoặc số điện thoại được cung cấp trên trang web. Đội ngũ hỗ trợ của chúng tôi luôn sẵn lòng để giúp đỡ bạn.
            Xin chân thành cảm ơn bạn đã lựa chọn mua sắm tại chúng tôi!

            Return 
            Nếu bạn phát hiện bất kỳ lỗi nào khi nhận được charm, hãy liên hệ ngay với chúng tớ qua Fanpage, Instagram: usbibracelet, hoặc hotline 07979.
            Chúng tớ cam kết hỗ trợ đổi trả 1-1 nhanh chóng để bạn yên tâm sử dụng!

            </p>
          </div>
        </div>
      </form>
    </div>

    <div class="mt-20 mx-32 pt-10 border-t-2 border-slate-400">
      <h1 class="text-3xl font-bold text-[#CE112D] text-center">
        SIMILAR PRODUCTS
      </h1>
      <section
        id="image-carousel"
        class="splide mt-10"
        aria-label="Beautiful Images"
      >
        <div class="splide__track mx-16">
          <ul id="splide-list-similar-product" class="splide__list">
            <?php foreach ($similarProducts as $product): ?>
              <li class="splide__slide mx-2">
                <div class="border bg-slate-200 h-[300px]">
                  <img
                    class="h-2/3 w-full"
                    src="<?= $product['image_path'] ?>"
                  />
                  <div class="px-2">
                    <h1 class="text-base font-bold mt-2"><?= $product['product_name'] ?></h1>
                    <div class="mt-1">
                      <h1 class="font-semibold text-lg text-red-500">
                      <?php echo number_format($product['product_price'], 0, ',', '.') . 'đ'; ?>
                      </h1>
                    </div>
                    <div class="flex items-center mt-1 gap-2">
                      <div class="h-4 mt-1 flex gap-1">
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
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </section>
    </div>

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
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      // Kiểm tra xem có thông báo thành công không
      document.addEventListener("DOMContentLoaded", function () {
        if (<?php echo isset($_SESSION['cart_added']) ? 'true' : 'false'; ?>) {
          alert('Sản phẩm đã được thêm vào giỏ hàng!');
          <?php unset($_SESSION['cart_added']); ?>
        }
      });

      var splide = new Splide(".splide", {
        type: "fade",
        rewind: true,
      });
      splide.mount();

      document.addEventListener("DOMContentLoaded", function () {
        new Splide("#image-carousel", {
          type: "loop",
          perPage: 5,
          perMove: 1,
        }).mount();
      });

      document
        .getElementById("product-details-container")
        .addEventListener("click", function () {
          var productDetails = document.getElementById("product-details");
          var productDetailsIconTrigger = document.getElementById(
            "product-details-icon-trigger"
          );
          if (productDetails.classList.contains("hidden")) {
            productDetails.classList.remove("hidden");
            productDetailsIconTrigger.innerText = "-";
          } else {
            productDetails.classList.add("hidden");
            productDetailsIconTrigger.innerText = "+";
          }
        });

      document
        .getElementById("size-guide-container")
        .addEventListener("click", function () {
          var sizeGuide = document.getElementById("size-guide");
          var sizeGuideIconTrigger = document.getElementById(
            "size-guide-icon-trigger"
          );
          if (sizeGuide.classList.contains("hidden")) {
            sizeGuide.classList.remove("hidden");
            sizeGuideIconTrigger.innerText = "-";
          } else {
            sizeGuide.classList.add("hidden");
            sizeGuideIconTrigger.innerText = "+";
          }
        });

      document
        .getElementById("shipping-return-container")
        .addEventListener("click", function () {
          var shippingReturn = document.getElementById("shipping-return");
          var shippingReturnIconTrigger = document.getElementById(
            "shipping-return-icon-trigger"
          );
          if (shippingReturn.classList.contains("hidden")) {
            shippingReturn.classList.remove("hidden");
            shippingReturnIconTrigger.innerText = "-";
          } else {
            shippingReturn.classList.add("hidden");
            shippingReturnIconTrigger.innerText = "+";
          }
        });

      let quantity = 1;
      const quantityElement = document.getElementById("quantity");
      const quantityInput =document.getElementById("quantityInput");
      const decreaseButton = document.getElementById("decrease-quantity");
      const increaseButton = document.getElementById("increase-quantity");

      decreaseButton.addEventListener("click", function () {
        if (quantity > 1) {
          quantity--;
          quantityElement.textContent = quantity;
          quantityInput.value = quantity;
        }
      });

      increaseButton.addEventListener("click", function () {
        quantity++;
        quantityElement.textContent = quantity;
        quantityInput.value = quantity;
      });
    </script>
  </body>
</html>