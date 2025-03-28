<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Về chúng tôi</title>
    <style>
        body {
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: white;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .section {
            margin-bottom: 30px;
        }

        .section h2 {
            font-size: 2.5rem;
            color: #ce112d;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .section p {
            font-size: 1rem;
            color: black;
            margin-bottom: 15px;
        }

        .services {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .service-item {
            flex: 1 1 calc(33.333% - 20px);
            background-color: #FFEAEA;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .service-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .service-item h3 {
            font-size: 1.2rem;
            color: #333;
            margin-bottom: 10px;
        }

        .service-item p {
            font-size: 0.9rem;
            color: #555;
        }
        .banner {
            display: flex;
    justify-content: center;
        }
        .anh{
            display: flex;
    justify-content: center;
        }
          .about {
            padding-left: 50px;
            padding-right: 50px;
        }

        @media (min-width: 1200px) {
            .about{
                padding-left: 80px;
                padding-right: 80px;
            }
        }
    </style>
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

      <div class="about">
    <div class="container">
        <div class="section">
            <div class="banner">
                <img src="./assets/About/cover-about.png" alt="Usbibracelet Banner">
            </div>
            <h2>Về Usbibracelet và Vòng tay Italian Charm Bracelet</h2>
            <p>Usbibracelet được thành lập năm 2024 với mong muốn đồng hành cùng bạn trên hành trình khẳng định phong cách cá nhân, 
              lưu giữ kỷ niệm và thể hiện câu chuyện riêng thông qua những chiếc vòng tay Italian charm bracelet độc đáo.</p>
        </div>
        <div class="section">
            <h2>Vòng tay nhà Usbibracelet</h2>
            <p>Sản phẩm của chúng tôi không chỉ là món trang sức làm đẹp, mà còn là cách bạn khắc họa dấu ấn cá nhân, gửi gắm những thông điệp ý nghĩa trong 
              từng chiếc charm.</p>
          <p>Với cam kết mang đến những sản phẩm chất lượng cao, đội ngũ Usbibracelet lựa chọn từng chất liệu tỉ mỉ, 
            từ kim loại bền bỉ đến thiết kế charm tinh xảo, đảm bảo mỗi chiếc vòng đều phản ánh sự độc nhất và giá trị cá nhân của bạn.</p>
            <p>Chúng tôi hiểu rằng trang sức không chỉ là phụ kiện, mà còn là cách bạn thể hiện cá tính, cảm xúc và kết nối với những người thân yêu. Với vòng tay Italian charm bracelet từ Usbibracelet, 
             bạn có thể kể nên câu chuyện của riêng mình, ghi dấu từng khoảnh khắc đáng nhớ và trân quý từng kỷ niệm.</p>
        </div>
        <div class="anh">
            <img src="./assets/About/anhabout.jpg" alt="anh">
        </div>

        <div class="section">
            <h2>Các dịch vụ mà Usbibracelet cung cấp</h2>
            <div class="services">
                <div class="service-item">
                    <h3>Thiết kế đa dạng</h3>
                    <p>Cung cấp các dòng vòng tay với thiết kế phong phú, từ cổ điển đến hiện đại.</p>
                </div>
                <div class="service-item">
                    <h3>Cá nhân hóa charm</h3>
                    <p>Dịch vụ khắc hoặc in tên, hình ảnh, hoặc thông điệp riêng lên charm.</p>
                </div>
                <div class="service-item">
                    <h3>Set quà tặng ý nghĩa</h3>
                    <p>Tạo các set quà độc đáo cho các dịp đặc biệt như sinh nhật, lễ kỷ niệm.</p>
                </div>
                <div class="service-item">
                    <h3>Giao hàng nhanh</h3>
                    <p>Giao hàng trong ngày tại TP.HCM và Hà Nội.</p>
                </div>
                <div class="service-item">
                    <h3>Dịch vụ doanh nghiệp</h3>
                    <p>Nhận đặt số lượng lớn làm quà tặng đối tác hoặc nhân viên.</p>
                </div>
                <div class="service-item">
                    <h3>Thiết kế miễn phí</h3>
                    <p>Hỗ trợ thiết kế hộp quà và thiệp tặng miễn phí.</p>
                </div>
            </div>
        </div>
        <div class="section">
            <h2>Giá trị mà Usbibracelet hướng đến</h2>
                <li>Cá nhân hóa và sáng tạo</li>
                <li>Hiện đại và thân thiện</li>
                <li>Tận tâm và gần gũi với khách hàng</li>
                <li>Lan tỏa yêu thương và ý nghĩa qua từng sản phẩm</li>

            <p>Usbibracelet tin rằng hành trình khẳng định phong cách và lưu giữ những khoảnh khắc quý 
                giá cùng khách hàng vẫn còn dài và tràn đầy tiềm năng. Chúng tôi rất mong được sự
                ủng hộ và đồng hành từ bạn trên hành trình này.</p>

            Thân thương,
                <p>𝐔𝐬𝐛𝐢𝐛𝐫𝐚𝐜𝐞𝐥𝐞𝐭 - 𝐘𝐎𝐔𝐑 𝐎𝐖𝐍 𝐁𝐑𝐀𝐂𝐄𝐋𝐄𝐓, 𝐘𝐎𝐔𝐑 𝐎𝐖𝐍 𝐒𝐓𝐎𝐑𝐘</p>
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
</body>
</html>
