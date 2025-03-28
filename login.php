<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
  </head>
  <body>
    <div class="grid w-screen grid-cols-2 bg-white">
      <div class="flex h-screen w-full items-center justify-center">
        <img
          alt="usbi"
          class="h-[80%] w-auto object-fill"
          src="./assets/login/loginbia.png"
        />
      </div>
      <div class="flex w-4/5 flex-col items-center justify-center">
        <h1 class="mb-5 text-4xl font-bold text-red-600">ĐĂNG NHẬP</h1>
        <form class="w-4/5" action="include/login.inc.php" method="post"> <!--action trong form này chỉ định rằng khi người dùng nhấn nút "Đăng nhập", form sẽ gửi dữ liệu đến file login.inc.php để xử lý        -->
          <div class="mb-4 grid grid-cols-5 items-center gap-3"> <!--Form gửi dữ liệu qua phương thức POST -->
            <label htmlFor="email" class="text-xl"> Email: </label>
            <input
              id="email"
              name="email"
              class="col-span-4 rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-600"
              placeholder="Địa chỉ email"
              type="email"
            />
          </div>
          <div class="mb-4 grid grid-cols-5 items-center gap-3">
            <label htmlFor="password" class="text-xl"> Password: </label>
            <input
              id="password"
              name="password"
              class="col-span-4 rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-600"
              placeholder="Mật khẩu"
              type="password"
            />
          </div>
          <button
            class="w-full rounded-lg bg-red-600 py-2 text-white hover:bg-red-700"
            type="submit"
          >
            Đăng nhập
          </button>
        </form>
        <div class="mt-4 text-center text-gray-500">
          <p class="italic">
            Bạn chưa có tài khoản?
            <span
              class="cursor-pointer not-italic text-blue-500 hover:underline"
            >
              Đăng ký
            </span>
          </p>
        </div>
      </div>
    </div>
    <script src="https://cdn.tailwindcss.com"></script>
  </body>
</html>