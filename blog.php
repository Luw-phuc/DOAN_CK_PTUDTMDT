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
      <div class="bg-[#FDF8F8] grid h-[440px] grid-cols-7">
        <div class="col-span-3 flex items-center mx-auto">
          <div class="h-[440px] w-[680px]">
            <img class="h-full w-full object-fill" src="./assets/blogs/bia.png" />
          </div>
        </div>
        <div class="col-span-4 flex flex-col items-center justify-center ">
          <p class="text-3xl">𝑼𝒔𝒃𝒊𝒃𝒓𝒂𝒄𝒆𝒍𝒆𝒕 𝑰𝒅𝒆𝒂𝒔</p>
          <div class="mt-5 text-center">
            <p class="text-6xl mt-1 font-bold text-[#CE112D]">
            Món quà cưới hoàn hảo cho người bạn đời của bạn
            </p>
          </div>
          <div class="mt-5 w-[90%]">
            <p class="text-lg text-justify mb-5">
            Đám cưới của người bạn thân nhất của bạn là khoảnh khắc xứng đáng nhận được một món quà đặc biệt như dịp này. 
            Đó là cơ hội để bạn thể hiện bạn trân trọng tình bạn của mình như thế nào và bạn vui mừng như thế nào về chương mới thú vị của họ. 
            Nhưng món quà lý tưởng để thể hiện tất cả những điều này là gì? 
            Câu trả lời rất đơn giản: một món đồ trang sức 
            </p>
          </div>
          <p class="text-6xl text-[#CE112D] animate-bounce">→</p>
        </div>
      </div>
      <div class="mt-10 grid grid-cols-4 gap-10 px-20 ">
        <div class="h-96 border rounded-lg gap-5 hover:scale-125 transition-transform duration-500">
          <div class="h-2/3 ">
            <img
              class="h-full rounded-t-lg w-full object-fill"
              src="./assets/blogs/Blog2/0Blog2.png"
            />
          </div>
          <div class="mt-2 px-3 items-center justify-center">
            <p class="text-[#CE112D] font-bold text-lg">
            Trang sức vàng hồng: 5 lựa chọn đề cử cho mùa hè

            </p>
            <p class="line-clamp-2">
            Vàng hồng được yêu thích vì màu sắc ấm áp, lãng mạn mang đến nét tinh tế cho bất kỳ trang phục nào. 
            Cho dù đó là một chiếc nhẫn... 
            </p>
          </div>
        </div>
        <div class="h-96 border rounded-lg gap-5 hover:scale-125 transition-transform duration-500">
          <div class="h-2/3">
            <img
              class="h-full rounded-t-lg w-full object-fill"
              src="./assets/blogs/Blog3/0Blog3.png"
            />
          </div>
          <div class="mt-2 px-3 items-center justify-center">
          
            <p class="text-[#CE112D] font-bold text-lg">
            Trang sức gia đình có biểu tượng: Liên kết tình thân
            </p>
            <p class="line-clamp-2">
            Tặng đồ trang sức tôn vinh gia đình là một cử chỉ vô cùng ý nghĩa , giàu cảm xúc và ý nghĩa: 
            nó vượt qua giá trị vật chất đơn thuần, trở thành biểu hiện hữu hình của tình yêu , sự gắn kết và lòng trân trọng.
            </p>
          </div>
        </div>
        <div class="h-96 border rounded-lg gap-5 hover:scale-125 transition-transform duration-500">
          <div class="h-2/3">
            <img
              class="h-full rounded-t-lg w-full object-fill"
              src="./assets/blogs/Blog4/0Blog4.png"
            />
          </div>
          <div class="mt-2 px-3 items-center justify-center">
         
            <p class="text-[#CE112D] font-bold text-lg">
            Đá quý có ý nghĩa gì?
            </p>
            <p class="line-clamp-2">
            Không chỉ đầy màu sắc và đẹp: nhiều ý nghĩa khác nhau đã được gán cho các loại đá quý tự nhiên đã tô điểm cho đồ trang sức qua nhiều thế kỷ. 
            Bạn thậm chí thường nghe nói đến liệu pháp pha lê : đó là gì? Theo những người ủng hộ bộ môn này, mỗi loại đá quý tự nhiên đều có một sức mạnh có lợi cụ thể giúp kích thích năng lượng tự nhiên và tinh thần của mỗi cá nhân theo một cách nào đó.
            </p>
          </div>
        </div>
        <div class="h-96 border rounded-lg gap-5 hover:scale-125 transition-transform duration-500">
          <div class="h-2/3">
            <img
              class="h-full rounded-t-lg w-full object-fill"
              src="./assets/blogs/Blog5/0Blog5.png"
            />
          </div>
          <div class="mt-2 px-3 items-center justify-center">
           
            <p class="text-[#CE112D] font-bold text-lg">
            Ngày của Mẹ: những câu nói hay dành tặng mẹ
            </p>
            <p class="line-clamp-2">
            Lời nói rất quan trọng ; một thông điệp viết ra sẽ không bao giờ phai mờ. 
            Bạn đã bao giờ thấy mình không thể nói ra điều mình thực sự muốn chưa? Ai cũng có lúc cảm thấy xấu hổ, cứng đờ, đột nhiên trở nên ngại ngùng khi muốn thổ lộ tình cảm chân thành nhất của mình với một người quan trọng đối với mình.

            </p>
          </div>
        </div>
        <div class="h-96 border rounded-lg gap-5 hover:scale-125 transition-transform duration-500">
          <div class="h-2/3">
            <img
              class="h-full rounded-t-lg w-full object-fill"
              src="./assets/blogs/Blog6/0Blog6.png"
            />
          </div>
          <div class="mt-2 px-3 items-center justify-center">
          
            <p class="text-[#CE112D] font-bold text-lg">
            20 tuổi: một món quà sinh nhật độc đáo và mang tính cá nhân

            </p>
            <p class="line-clamp-2">
            Bước sang tuổi 20 là một thời điểm quan trọng trong cuộc đời . Giống như bạn chính thức bước qua ngưỡng cửa trưởng thành, trong khi trước đây bạn vẫn còn là một đứa trẻ trong độ tuổi 20. 
            Theo thông lệ, bạn sẽ tổ chức một bữa tiệc lớn để ăn mừng sự kiện quan trọng này với những người bạn lâu năm, ôn lại tất cả những điều hoang dã và điên rồ mà bạn đã trải qua, và những khoảng thời gian tuyệt vời bên nhau trong suốt những năm qua.
            </p>
          </div>
        </div>
        <div class="h-96 border rounded-lg gap-5 hover:scale-125 transition-transform duration-500">
          <div class="h-2/3">
            <img
              class="h-full rounded-t-lg w-full object-fill"
              src="./assets/blogs/Blog7/0Blog7.png"
            />
          </div>
          <div class="mt-2 px-3 items-center justify-center">
         
            <p class="text-[#CE112D] font-bold text-lg">
            Quà tặng tốt nghiệp
            </p>
            <p class="line-clamp-2">
            Tốt nghiệp trung học là một thành tựu quan trọng đối với những người trẻ tuổi. Sau nhiều năm học, làm bài tập về nhà, học hành và thi cử, cuối cùng cũng đến lúc phải rời xa trường học. Và không tránh khỏi một chút buồn bã! Những tình bạn được hình thành trong lớp học, tình đồng chí với bạn bè, và thậm chí cả giáo viên sẽ là một số điều chúng ta sẽ nhớ nhất khi nhìn 
            lại những khoảng thời gian đó trong khi chuẩn bị cho một kỳ thi đại học khác hoặc trong khi làm việc.
            </p>
          </div>
        </div>
        <div class="h-96 border rounded-lg gap-5 hover:scale-125 transition-transform duration-500">
          <div class="h-2/3">
            <img
              class="h-full rounded-t-lg w-full object-fill"
              src="./assets/blogs/Blog8/0Blog8.png"
            />
          </div>
          <div class="mt-2 px-3 items-center justify-center">
          
            <p class="text-[#CE112D] font-bold text-lg">
            Mua gì tặng bố mẹ vào dịp Giáng sinh
            </p>
            <p class="line-clamp-2">
            Quà tặng cho bố mẹ xứng đáng đóng vai trò chính trong số tất cả những món quà Giáng sinh bạn cần mua. 
            Nên tặng gì cho bố mẹ vào dịp Giáng sinh và làm thế nào để chọn được món quà phù hợp cho hai người quan trọng như vậy?
            </p>
          </div>
        </div>
        <div class="h-96 border rounded-lg gap-5 hover:scale-125 transition-transform duration-500">
          <div class="h-2/3">
            <img
              class="h-full rounded-t-lg w-full object-fill"
              src="./assets/blogs/Blog9/0Blog9.png"
            />
          </div>
          <div class="mt-2 px-3 items-center justify-center">
          
            <p class="text-[#CE112D] font-bold text-lg">
            Quà tặng cho bạn bè: Ý tưởng tạo ra một món đồ trang sức độc đáo
            </p>
            <p class="line-clamp-2">
            Không có gì đẹp đẽ và thú vị hơn việc tặng một món quà độc đáo và trên hết là chân thành . Đó là lý do tại sao khi tặng quà cho bạn bè, việc lựa chọn tạo ra một món đồ trang sức được cá nhân hóa dựa trên sở thích của cô ấy, nhưng cũng dựa trên những gì kết nối hai bạn, chắc chắn là một lựa chọn tuyệt vời. 
            Sau đây là một số mẹo truyền cảm hứng về cách chọn và tạo ra một món quà được cá nhân hóa cho một người bạn đặc biệt .
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
