<?php 
$title = 'Registrasi';

require 'connect.php';

if(isset($_POST["submit"])){
    if(registrasi($_POST) > 0){
        echo "<script>
                alert('user baru berhasil ditambahkan');
                header('Location: login.php');
                </script>";
    }else{
        echo "<script>
                alert('user baru gagal ditambahkan');
                </script>";
    }
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
    <div class="w-full max-w-4xl"> <!-- Increased max width for registration form -->
      <div class="text-center mb-8">
        <div class="flex justify-center mb-4">
          <img src="img/logoapotik.jpeg" alt="APOTIK Logo" class="h-16">
        </div>
        <h1 class="text-3xl font-bold text-gray-800">
          <span class="bg-clip-text text-transparent gradient-bg">Hei Doc!</span>
        </h1>
        <p class="text-gray-600 mt-2">Your trusted pharmacy partner</p>
      </div>

      <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="p-8">
          <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Create Your Account</h2>
            <p class="text-gray-600">Fill in your details to get started</p>
          </div>

          <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Column 1 -->
            <div class="space-y-5">
              <div>
                <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username*</label>
                <div class="relative">
                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-user text-gray-400"></i>
                  </div>
                  <input type="text" id="username" name="username" required
                    class="input-focus pl-10 w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500 transition duration-200"
                    placeholder="Choose a username">
                </div>
              </div>

              <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password*</label>
                <div class="relative">
                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-lock text-gray-400"></i>
                  </div>
                  <input type="password" id="password" name="password" required
                    class="input-focus pl-10 w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500 transition duration-200"
                    placeholder="Create password">
                </div>
              </div>

              <div>
                <label for="password2" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password*</label>
                <div class="relative">
                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-lock text-gray-400"></i>
                  </div>
                  <input type="password" id="password2" name="password2" required
                    class="input-focus pl-10 w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500 transition duration-200"
                    placeholder="Retype your password">
                </div>
              </div>

              <div>
                <label for="yourName" class="block text-sm font-medium text-gray-700 mb-1">Full Name*</label>
                <div class="relative">
                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-id-card text-gray-400"></i>
                  </div>
                  <input type="text" name="namaLengkap" required
                    class="input-focus pl-10 w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500 transition duration-200"
                    placeholder="Your full name">
                </div>
              </div>

              <div>
                <label for="yourEmail" class="block text-sm font-medium text-gray-700 mb-1">Email*</label>
                <div class="relative">
                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-envelope text-gray-400"></i>
                  </div>
                  <input type="email" name="email" required
                    class="input-focus pl-10 w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500 transition duration-200"
                    placeholder="Your email address">
                </div>
              </div>
            </div>

            <!-- Column 2 -->
            <div class="space-y-5">
              <div>
                <label for="dob" class="block text-sm font-medium text-gray-700 mb-1">Date of Birth*</label>
                <div class="relative">
                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-calendar-alt text-gray-400"></i>
                  </div>
                  <input type="date" name="dob" required
                    class="input-focus pl-10 w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500 transition duration-200">
                </div>
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Gender*</label>
                <div class="flex space-x-6">
                  <label class="inline-flex items-center">
                    <input type="radio" name="gender" value="male" required
                      class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                    <span class="ml-2 text-gray-700">Male</span>
                  </label>
                  <label class="inline-flex items-center">
                    <input type="radio" name="gender" value="female" required
                      class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                    <span class="ml-2 text-gray-700">Female</span>
                  </label>
                </div>
              </div>

              <div>
                <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Address*</label>
                <div class="relative">
                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-home text-gray-400"></i>
                  </div>
                  <input type="text" name="alamat" required
                    class="input-focus pl-10 w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500 transition duration-200"
                    placeholder="Your address">
                </div>
              </div>

              <div>
                <label for="kota" class="block text-sm font-medium text-gray-700 mb-1">City*</label>
                <div class="relative">
                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-city text-gray-400"></i>
                  </div>
                  <input type="text" name="kota" required
                    class="input-focus pl-10 w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500 transition duration-200"
                    placeholder="Your city">
                </div>
              </div>

              <div>
                <label for="contact" class="block text-sm font-medium text-gray-700 mb-1">Contact Number*</label>
                <div class="relative">
                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-phone text-gray-400"></i>
                  </div>
                  <input type="tel" name="contact" required pattern="[0-9]*"
                    class="input-focus pl-10 w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500 transition duration-200"
                    placeholder="Your phone number">
                </div>
              </div>

              <div>
                <label for="paypalID" class="block text-sm font-medium text-gray-700 mb-1">PayPal ID*</label>
                <div class="relative">
                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fab fa-paypal text-gray-400"></i>
                  </div>
                  <input type="text" name="paypalID" required pattern="[0-9]*"
                    class="input-focus pl-10 w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500 transition duration-200"
                    placeholder="Your PayPal ID">
                </div>
              </div>
            </div>

            <!-- Full width row for buttons -->
            <div class="md:col-span-2 pt-4">
              <div class="flex flex-col sm:flex-row justify-center gap-4">
                <button type="submit" name="submit"
                  class="btn-primary px-6 py-3 rounded-lg text-white font-semibold shadow-md hover:shadow-lg transition duration-200">
                  Create Account
                </button>
                <button type="reset"
                  class="px-6 py-3 rounded-lg border border-gray-300 font-medium text-gray-700 bg-white hover:bg-gray-50 transition duration-200">
                  Reset Form
                </button>
              </div>
            </div>
          </form>

          <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
              Already have an account? 
              <a href="login.php" class="font-medium text-blue-600 hover:text-blue-500 ml-1">Login here</a>
            </p>
          </div>

          <div class="mt-6">
            <div class="relative">
              <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-300"></div>
              </div>
              <div class="relative flex justify-center text-sm">
                <span class="px-2 bg-white text-gray-500">Or continue with</span>
              </div>
            </div>

            <div class="mt-6 grid grid-cols-2 gap-3">
              <a href="loginAdmin.php" class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                <i class="fas fa-user-shield text-blue-500 mr-2"></i> Admin Login
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