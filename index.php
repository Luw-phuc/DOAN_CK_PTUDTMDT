<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Trang chủ</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="
        https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css
        " rel="stylesheet"
    >
  </head>
  <body>
    <!-- header -->
    <div class="flex items-center justify-between px-20 py-7 bg-[#FDF8F8]">
      <h1 class="text-3xl font-bold text-[#CE112D]">𝐔𝐒𝐁𝐈𝐁𝐑𝐀𝐂𝐄𝐋𝐄𝐓</h1>
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
            echo "<a href='cart.php'><button class='rounded-lg border bg-[#FFEAEA] px-6 py-2 font-bold hover:bg-[#CE112D] hover:animate-bounce duration-800 hover:text-white'>Giỏ hàng</button></a>";
            echo "<form method='post' action='include/logout.inc.php'><button class='rounded-lg border bg-[#FFEAEA] px-6 py-2 font-bold hover:bg-[#CE112D] hover:animate-bounce duration-800 hover:text-white'>Đăng xuất</button></form>";
          } else {
            echo "<button id='btn_login' class='rounded-lg border bg-[#FFEAEA] px-6 py-3 font-bold hover:bg-[#CE112D] hover:animate-bounce duration-800 hover:text-white'>Đăng nhập</button>";
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
            <div class= "hover:bg-[#CE112D] hover:text-white"><ul><a  href="/product-list.php?categoryId=2">Charm Cho Nam</a></ul></div>
            <div class= "hover:bg-[#CE112D] hover:text-white"><ul><a href="/product-list.php?categoryId=1">Charm Cho Nữ</a></ul></div>
            <div class= "hover:bg-[#CE112D] hover:text-white"><ul><a href="/product-list.php?categoryId=4">Charm chữ, số</a></ul></div>
            <div class= "hover:bg-[#CE112D] hover:text-white"><ul><a href="/product-list.php?categoryId=3">Charm lủng lẳng</a></ul></div>
            <div class= "hover:bg-[#CE112D] hover:text-white"><ul><a href="/product-list.php?categoryId=7">Charm đính đá</a></ul></div>
            <div class= "hover:bg-[#CE112D] hover:text-white"><ul><a href="/product-list.php?categoryId=6">Charm dài</a></ul></div>
            <div class= "hover:bg-[#CE112D] hover:text-white"><ul><a href="/product-list.php?categoryId=5">Sample mix sẵn</a></ul></div>
          </div></li>
        <li><a href="blog.php">Tin tức</a></li>
        <li><a href="about.php">Về chúng tôi</a></li>
        <li><a href="contact.php">Liên hệ</a></li>
      </ul>
    </div>
    <!-- end header -->



    </div>
    <div class="splide mt-10 mx-auto h-[520px] w-4/5" role="group" aria-label="Splide Basic HTML Example">
        <div class="splide__track w-full h-full">
            <ul class="splide__list w-full h-full">
                <li class="splide__slide">
                    <img
                        class="h-full w-full object-fill"
                        src="./assets/index/Banner index 1.png"
                    />
                </li>
                <li class="splide__slide">
                    <img
                        class="h-full w-full object-fill"
                        src="./assets/index/Banner index 2.png"
                    />
                </li>
                <li class="splide__slide">
                    <img
                        class="h-full w-full object-fill"
                        src="./assets/index/Banner index 3.png"
                    />
                </li>
            </ul>
        </div>
    </div>

    <div class="mx-auto my-10 w-3/5 border-2"></div>

    <!-- product grid -->
    

    <div class="w-4/5 mx-auto">
      <div class="flex gap-5">
        <div class="h-10 w-5 bg-red-500"></div>
        <h1 class="font-bold text-3xl">Phân loại</h1>
      </div>
      <h1 class="mt-5 text-[#CE112D] font-semibold text-3xl">DANH MỤC SẢN PHẨM</h1>
      <div class="mt-8 grid w-full grid-cols-7 gap-8">
        <div class="flex flex-col items-center">
          <div class="h-25 w-25">
            <img
              class="h-full w-full"
              src="./assets/Category/Charmchonu.png"
            />
          </div>
          <p class="mt-2 text-lg text-center font-bold">Charm cho nữ</p>
        </div>
        <div class="flex flex-col items-center">
          <div class="h-25 w-25">
            <img class="h-full w-full" src="./assets/Category/Charmchonam.png">
          </div>
          <p class="mt-2 text-lg text-center font-bold">Charm cho nam</p>
        </div>
        <div class="flex flex-col items-center">
          <div class="h-25 w-25">
            <img
              class="h-full w-full"
              src="./assets/Category/Charmchuso.png"
            />
          </div>
          <p class="mt-2 text-lg text-center font-bold">Charm chữ, số</p>
        </div>
        <div class="flex flex-col items-center">
          <div class="h-25 w-25">
            <img class="h-full w-full" src="./assets/Category/Charmlunglang.png" />
          </div>
          <p class="mt-2 text-lg text-center font-bold">Charm lủng lẳng</p>
        </div><div class="flex flex-col items-center">
          <div class="h-25 w-25">
            <img
              class="h-full w-full"
              src="./assets/Category/Charmdinhda.png"
            />
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
            <img
              class="h-full w-full"
              src="./assets/Category/Samplemixsan.png"
            />
          </div>
          <p class="mt-2 text-lg text-center font-bold">Sample mix sẵn</p>
        </div>
      </div>
    </div>
<!--HDSD-->
<div class="mx-auto my-10 w-3/5 border-2"></div>
    <div class="w-4/5 mx-auto">
      <div class="flex gap-5">
        <div class="h-10 w-5 bg-red-500"></div>
        <h1 class="font-bold text-3xl">Sản phẩm</h1>
      </div>

      <div class="col-span-8">
    <p class="mt-5 text-[#CE112D] font-semibold text-3xl mb-5">BEST SELLER</p>
    <div class="mt-3 grid grid-cols-4 gap-x-6 gap-y-1">
      <div id="product-detail" class="h-96 w-72 rounded-sm border bg-slate-200">
            <div
              class="h-3/4 w-full"
            > <img src="./assets/images/Charmchonam/Charm Logo Ferrari 59k.jpg" />
          </div>
            <div class="mt-3 px-3">
              <a href="product-detail.php?productId=1" class="font-bold">Logo Ferrari</a>
              <p class="mt-1">59.000 VND</p>
              <div class="flex items-center gap-2">
                <div class="mt-1 flex gap-2">
                  <img src="./assets/images/star.png" />
                  <img src="./assets/images/star.png" />
                  <img src="./assets/images/star.png" />
                  <img src="./assets/images/star.png" />
                  <img src="./assets/images/star.svg" />
                </div>
                <p class="translate-y-0.5">(25)</p>
              </div>
            </div>
          </div>
          <div class="h-96 w-72 rounded-sm border bg-slate-200">
            <div
              class="h-3/4 w-full]"
            ><img src="./assets/images/Charmchonu/Charm hoa Tulip hồng 55k.jpg"/></div>
            <div class="mt-3 px-3">
              <p class="font-bold">Hoa Tulip hồng</p>
              <p class="mt-1">55.000 VND</p>
              <div class="flex items-center gap-2">
                <div class="mt-1 flex gap-2">
                  <img src="./assets/images/star.png" />
                  <img src="./assets/images/star.png" />
                  <img src="./assets/images/star.png" />
                  <img src="./assets/images/star.png" />
                  <img src="./assets/images/star.svg" />
                </div>
                <p class="translate-y-0.5">(30)</p>
              </div>
            </div>
          </div>
          <div class="h-96 w-72 rounded-sm border bg-slate-200">
          <div
              class="h-3/4 w-full]"
            ><img src="./assets/images/Samplemixsan/Vòng tay Sample Family 499k.png"/></div>
            <div class="mt-3 px-3">
              <p class="font-bold">Vòng tay Sample Family</p>
              <p class="mt-1">499.000 VND</p>
              <div class="flex items-center gap-2">
                <div class="mt-1 flex gap-2">
                  <img src="./assets/images/star.png" />
                  <img src="./assets/images/star.png" />
                  <img src="./assets/images/star.png" />
                  <img src="./assets/images/star.png" />
                  <img src="./assets/images/star.png" />
                </div>
                <p class="translate-y-0.5">(29)</p>
              </div>
            </div>
          </div>
          <div class="h-96 w-72 rounded-sm border bg-slate-200">
          <div
              class="h-3/4 w-full]"
            ><img src="./assets/images/Charmdai/Charm I Love My Family 89k.png"/></div>
            <div class="mt-3 px-3">
              <p class="font-bold">I Love My Family</p>
              <p class="mt-1">89.000 VND</p>
              <div class="flex items-center gap-2">
                <div class="mt-1 flex gap-2">
                  <img src="./assets/images/star.png" />
                  <img src="./assets/images/star.png" />
                  <img src="./assets/images/star.png" />
                  <img src="./assets/images/star.png" />
                  <img src="./assets/images/star.svg" />
                </div>
                <p class="translate-y-0.5">(17)</p>
              </div>
            </div>
          </div>
          </div>
          </div>
        
          </div> 
  <!--HDSD-->
    <div class="mx-auto my-10 w-3/5 border-2"></div>
    <div class="w-4/5 mx-auto">
      <div class="flex gap-5">
        <div class="h-10 w-5 bg-red-500"></div>
        <h1 class="font-bold text-3xl">Hướng dẫn</h1>
      </div>
      <h1 class="mt-5 text-[#CE112D] font-semibold text-3xl">CÁCH SỬ DỤNG</h1>
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
<!--HDSD-->

    <div class="mx-auto my-10 w-3/5 border-2"></div>

   <div class="mt-20 h-96 w-4/5 mx-auto grid grid-cols-2 gap-10 mt-5 ">
      <div class="h-full w-full bg-slate-500 border">
        <img class="w-full h-full object-fill"
        src="./assets/index/Banner index 2.png"/>
      </div>
      <div class="h-full w-full grid grid-rows-2 gap-8">
        <div class="h-full w-full grid grid-cols-2 gap-10">
          <div class="h-full w-full bg-slate-500 border"><img class="w-full h-full object-fill"
          src="./assets/index/1.png"/></div>
          <div class="h-full w-full bg-slate-500 border"><img class="w-full h-full object-fill"
          src="./assets/index/2.png"/></div>
        </div>
        <div class="h-full w-full bg-slate-500 border"><img class="w-full h-full object-fill"
        src="./assets/index/3.png"/></div>
      </div>
    </div>
    <div class="mx-auto my-10 w-3/5 border-2"></div>
    
 <!--blogs-->
    <div class="w-full py-16 bg-[#FDF8F8] h-vh">
      <div class="w-4/5 mx-auto grid gap-12 grid-cols-10">
        <div class="col-span-4 h-80 bg-red-300 w-full">
        <img class="w-full h-full object-fill"
        src="./assets/blogs/Blog3/0Blog3.png"
        alt="Charm cho nữ"
      />
</div>
        <div class="col-span-6 flex flex-col justify-between">
          <div>
            <p class="font-bold text-4xl text-[#CE112D]">THE LOVE OF MINE</p>
            <p class="text-xl mt-5 max-w-[650px] text-justify">Tặng đồ trang sức tôn vinh gia đình không chỉ là một món quà có giá trị mà còn là một hành động mang ý nghĩa sâu sắc, giàu cảm xúc và đong đầy những giá trị tinh thần: nó không dừng lại ở khía cạnh vật chất, mà còn vượt lên để trở thành biểu tượng hữu hình của tình yêu thương, sự gắn bó keo sơn và lòng biết ơn chân thành đối với những người thân yêu trong gia đình.</p>  
          </div>
          <div>
            <button class="text-2xl font-bold text-white bg-[#CE112D] px-5 py-3 rounded animate-bounce hover:text-white">ĐỌC NGAY</button>
          </div>
        </div>
      </div>
      <div class="w-4/5 mx-auto mt-16">
        <h1 class="font-bold text-5xl text-center text-[#CE112D]">KHÁM PHÁ USBIBRACELET</h1>
        <div class="mt-10 grid grid-cols-3 gap-10">
          <div>
            <div class="h-60 w-full rounded bg-slate-500">
            <img class="w-full h-full object-fill"
        src="./assets/blogs/Blog2/0Blog2.png"
        alt="Charm cho nữ"
      /></div>
            <div class="mt-6 text-center">
              <h1 class="text-2xl font-bold">LOVE X USBI</h1>
              <a class="mt-2 underline italic">Khám phá ngay</a>
            </div>
          </div>
          <div>
            <div class="h-60 w-full rounded bg-slate-500">
            <img class="w-full h-full object-fill"
        src="./assets/blogs/Blog7/0Blog7.png"
        alt="Charm cho nữ"
      /> </div>
            <div class="mt-6 text-center">
              <h1 class="text-2xl font-bold">BRACESUCCEESS</h1>
              <a class="mt-2 underline italic">Khám phá ngay</a>
            </div>
          </div>
          <div>
            <div class="h-60 w-full rounded bg-slate-500">
            <img class="w-full h-full object-fill"
        src="./assets/blogs/Blog6/0Blog6.png"
        alt="Charm cho nữ"
      /> </div>
            <div class="mt-6 text-center">
              <h1 class="text-2xl font-bold">MY MUSE</h1>
              <a class="mt-2 underline italic">Khám phá ngay</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="mx-auto grid grid-cols-3 gap-24 my-10 w-4/5">
      <div class="flex flex-col items-center">
        <div class="h-24 w-1/2">
          <img class="h-full w-full" src="https://lamha.com.vn/image/cache/catalog/blog/khuyen-mai/free_shipping_PNG2-640x360.png"/>
        </div>
        <div class="text-center mt-5">
          <p class="font-bold text-2xl">Miễn phí vận chuyển</p>
          <p class="mt-2">Miễn phí giao hàng trên toàn quốc với mọi giá trị đơn hàng</p>
        </div>
      </div>
      <div class="flex flex-col items-center">
        <div class="h-24 w-1/2">
          <img class="h-full w-full" src="https://lamha.com.vn/image/cache/catalog/blog/khuyen-mai/free_shipping_PNG2-640x360.png"/>
        </div>
        <div class="text-center mt-5">
          <p class="font-bold text-2xl">Hỗ trợ 24/7</p>
          <p class="mt-2">Đội ngũ chuyên nghiệp luôn hỗ trợ và tư vấn hoàn toàn miễn phí</p>
        </div>
      </div>
      <div class="flex flex-col items-center">
        <div class="h-24 w-1/2">
          <img class="h-full w-full" src="https://lamha.com.vn/image/cache/catalog/blog/khuyen-mai/free_shipping_PNG2-640x360.png"/>
        </div>
        <div class="text-center mt-5">
          <p class="font-bold text-2xl">Bảo hành tuyệt đối</p>
          <p class="mt-2">Bảo hành sản phẩm uy tín với thời gian tối đa lên đến 1 năm</p>
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
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <script>
        var splide = new Splide( '.splide' );
        splide.mount();
        btn_login = document.getElementById("btn_login");
        btn_login.addEventListener("click", function () {
        window.location.href = "./login.php";
        });
    </script>
  </body>
</html>
