<?php
session_start();
require_once "include/db.inc.php";

// Kiểm tra xem có blogId trong URL không
$blogId = isset($_GET['blogId']) ? $_GET['blogId'] : null;
$title = "";
$content = "";

// Nếu có blogId, lấy dữ liệu bài viết từ cơ sở dữ liệu
if ($blogId) {
    // Truy vấn cơ sở dữ liệu để lấy thông tin bài viết
    $stmt = $pdo->prepare("SELECT title, content FROM blog WHERE id = :blogId");
    $stmt->bindParam(':blogId', $blogId, PDO::PARAM_INT);
    $stmt->execute();

    $blog = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($blog) {
        $title = $blog['title'];
        $content = $blog['content'];
        $_SESSION['blogId'] = $blogId; // Lưu blogId vào session để xử lý sau
    }
}
?>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>User Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css"
      rel="stylesheet"
    />
  </head>
  <body class="bg-gray-100">
    <div class="flex h-screen">
      <!-- Sidebar -->
      <div class="bg-[#FFEAEA] h-vh text-white w-64 space-y-6 py-7 px-2">
        <div class="flex items-center space-x-2 px-4">
          <img
            alt="Logo"
            class="h-8 w-12"
            height="20"
            src="./assets/user/logo1.png"
            width="40"
          />
          <span class="text-2xl font-extrabold text-[#CE112D]"> Usbibracelet </span>
        </div>
        <nav class="space-y-2">
          <a
            class="text-black block py-2.5 px-4 rounded transition duration-200 hover:bg-[#CE112D] hover:text-white"
            href="user-management.php"
          >
            <i class="fas fa-tachometer-alt"> </i>
            NGƯỜI DÙNG
          </a>
          <a
            class="text-black block py-2.5 px-4 rounded transition duration-200 hover:bg-[#CE112D] hover:text-white"
            href="product-management.php"
          >
            <i class="fas fa-cube"> </i>
            SẢN PHẨM
          </a>
          <a
            class="text-black block py-2.5 px-4 rounded transition duration-200 hover:bg-[#CE112D] hover:text-white"
            href="order-management.php"
          >
            <i class="fas fa-table"> </i>
            ĐƠN HÀNG
          </a>
          <a
            class="text-black block py-2.5 px-4 rounded transition duration-200 hover:bg-[#CE112D] hover:text-white"
            href="blog-management.php"
          >
            <i class="fas fa-edit"> </i>
            TIN TỨC
          </a>
        </nav>
      </div>
      <!-- Main content -->
      <div class="flex-1 flex flex-col">
        <!-- Header -->
        <header
          class="flex items-center justify-between bg-white py-4 px-6 border-b-2 border-gray-200"
        >
          <div class="flex items-center">
            <input
              class="bg-gray-100 rounded-lg px-4 py-2 focus:outline-none"
              placeholder="Tìm kiếm"
              type="text"
            />
          </div>
          <div class="flex items-center space-x-4">
            <i class="fas fa-bell"> </i>
            <img
              alt="User Avatar"
              class="h-8 w-8 rounded-full"
              height="30"
              src="./assets/user/avatar.jpg"
              width="30"
            />
          </div>
        </header>

      <!-- Main content -->
      <div class=" flex-1 bg-white p-6 <main class=">
        <?php if (isset($blogId)): ?>
          <input id="blogId" type="hidden" value="<?= $blogId ?>"/>
        <?php endif; ?>

        <div class="mb-4">
          <label for="title" class="block text-sm font-medium text-gray-700">Tiêu đề</label>
          <input
            type="text"
            id="title"
            class="mt-2 p-3 w-full border border-gray-300 rounded-md"
            placeholder="Nhập tiêu đề tin tức"
            value="<?= $title ?>"
            required
          />
        </div>

        <div class="mb-4 h-[62vh]">
          <label for="editor" class="block text-sm font-medium text-gray-700">Nội dung</label>
          <div id="editor"><?= $content ?></div>
        </div>

        <button
          type="button"
          id="btnSave"
          class="px-6 py-2 translate-y-14 bg-[#CE112D] text-white rounded "
        >
          <?= isset($blogId) ? 'Cập nhật tin tức' : 'Thêm mới tin tức' ?> <!-- Thay đổi tên nút tùy vào trạng thái -->
        </button>
      </div>
    </div>
    <!-- Include the Quill library -->
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>

    <!-- Initialize Quill editor -->
    <script>
      const quill = new Quill("#editor", {
        theme: "snow",
        modules: {
          toolbar: [
            ["bold", "italic", "underline", "strike"],
            ["link", "image"],
            [{ header: 1 }, { header: 2 }],
            [{ list: "ordered" }, { list: "bullet" }, { list: "check" }],
            [{ script: "sub" }, { script: "super" }],
            [{ indent: "-1" }, { indent: "+1" }],
            [{ direction: "rtl" }],
            [{ header: [1, 2, 3, 4, 5, 6, false] }],
            [{ color: [] }, { background: [] }],
            [{ font: [] }],
            [{ align: [] }],
            ["clean"], // remove formatting button
          ],
        },
      });

      // Nếu là bài viết chỉnh sửa, dữ liệu đã có sẵn trong Quill editor
      document.getElementById("btnSave").addEventListener("click", async () => {
        const title = document.getElementById("title").value;
        const content = quill.root.innerHTML;
        const blogId = document.getElementById("blogId") ? document.getElementById("blogId").value : null;

        if (!title || !content) {
          alert("Title and content are required!");
          return;
        }

        try {
          const formData = new FormData();
          formData.append("title", title);
          formData.append("content", content);
          if (blogId) {
            formData.append("blogId", blogId);
          }

          const response = await fetch("./include/blog-management-detail.inc.php", {
            method: "POST",
            body: formData,
          });

          if (!response.ok) {
            throw new Error("Network response was not ok");
          }

          const data = await response.text();
          alert(data);
          window.location.href = "blog-management.php"; // Điều hướng về trang quản lý blog

        } catch (error) {
          console.error("Error:", error);
          alert("An error occurred while saving the blog.");
        }
      });
    </script>
  </body>
</html>