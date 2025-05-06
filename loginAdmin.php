<?php 
$title = 'Login Admin';

session_start();
require 'connect.php';

// SET COOKIE
if(isset($_COOKIE['username']) && isset($_COOKIE['key'])){
    $username = $_COOKIE['username'];
    $key = $_COOKIE['key'];

    $result = mysqli_query($connect, "SELECT username FROM admin WHERE username = '$username'");
    $row = mysqli_fetch_assoc($result);

    if($key === hash('sha256', $row['username'])){
        $_SESSION['login'] = true;
    }
}

// SET SESSION DAN REDIRECT LOGIN
if(isset($_SESSION["login"])){
    header("Location: index.php");
    exit;
}

if(isset($_POST["login"])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($connect, "SELECT * FROM admin WHERE username = '$username'");

    if(mysqli_num_rows($result) === 1){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row["password"])){
            $_SESSION['username'] = $row["username"];
            $_SESSION["login"] = true;

            if(isset($_POST['remember'])){
                setcookie('username', $row['username'], time()+60);
                setcookie('key', hash('sha256', $row['username']));
            }
            header("Location: Admin/dashboard.php");
        }
    }

    $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title; ?></title>
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Font Awesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Custom styles -->
  <style>
    .gradient-bg {
      background: linear-gradient(135deg, #6B73FF 0%, #000DFF 100%);
    }
    .btn-primary {
      background: linear-gradient(135deg, #6B73FF 0%, #000DFF 100%);
      transition: all 0.3s ease;
    }
    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 20px rgba(107, 115, 255, 0.3);
    }
    .input-focus:focus {
      border-color: #6B73FF;
      box-shadow: 0 0 0 3px rgba(107, 115, 255, 0.2);
    }
  </style>
</head>

<body class="bg-gray-50">
  <div class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
      <div class="text-center mb-8">
        <div class="flex justify-center mb-4">
          <img src="img/logoapotik.jpeg" alt="Apotik Logo" class="h-16">
        </div>
        <h1 class="text-3xl font-bold text-gray-800">
          <span class="bg-clip-text text-transparent gradient-bg">Hai Doc!</span>
        </h1>
        <p class="text-gray-600 mt-2">Admin Portal</p>
      </div>

      <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="p-8">
          <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Admin Login</h2>
            <p class="text-gray-600">Please enter your admin credentials</p>
          </div>

          <?php if(isset($error)) : ?>
            <div class="mb-4 p-3 bg-red-50 text-red-700 rounded-lg flex items-center">
              <i class="fas fa-exclamation-circle mr-2"></i>
              <span>Username or password is incorrect!</span>
            </div>
          <?php endif; ?>

          <form method="post" class="space-y-5">
            <div>
              <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
              <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <i class="fas fa-user-shield text-gray-400"></i>
                </div>
                <input type="text" id="username" name="username" required
                  class="input-focus pl-10 w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500 transition duration-200"
                  placeholder="Enter admin username">
              </div>
            </div>

            <div>
              <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
              <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <i class="fas fa-lock text-gray-400"></i>
                </div>
                <input type="password" id="password" name="password" required
                  class="input-focus pl-10 w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500 transition duration-200"
                  placeholder="Enter admin password">
              </div>
            </div>

            <div class="flex items-center justify-between">
              <div class="flex items-center">
                <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="remember" class="ml-2 block text-sm text-gray-700">Remember me</label>
              </div>
            </div>

            <button type="submit" name="login"
              class="btn-primary w-full py-3 px-4 rounded-lg text-white font-semibold shadow-md hover:shadow-lg transition duration-200">
              Login
            </button>
          </form>

          <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
              Not an admin? 
              <a href="login.php" class="font-medium text-blue-600 hover:text-blue-500 ml-1">Customer Login</a>
            </p>
          </div>

          <div class="mt-6">
            <div class="relative">
              <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-300"></div>
              </div>
              <div class="relative flex justify-center text-sm">
                <span class="px-2 bg-white text-gray-500">Other options</span>
              </div>
            </div>

            <div class="mt-6 grid grid-cols-2 gap-3">
              <a href="registrasi.php" class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                <i class="fas fa-user-plus text-blue-500 mr-2"></i> Register
              </a>
              <a href="guestBook.php" class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                <i class="fas fa-book-open text-green-500 mr-2"></i> Guest Book
              </a>
            </div>
          </div>
        </div>
      </div>

      <div class="mt-8 text-center">
        <p class="text-xs text-gray-500">
          &copy; 2025 Hei Doc!. All rights reserved.
        </p>
      </div>
    </div>
  </div>
</body>
</html>