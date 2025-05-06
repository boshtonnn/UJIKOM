<?php 
$title = 'Guest Book';
require 'connect.php';

if(isset($_POST["kirim"])){
    if(addGuestBook($_POST) > 0){
        echo "
            <script>
                alert('Pesan berhasil dikirim!');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Pesan gagal dikirim!');
                document.location.href = 'index.php';
            </script>
        ";
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
  <!-- Summernote CSS -->
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
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
    .btn-green {
      background: linear-gradient(135deg, #6B73FF 0%, #000DFF 100%);
      transition: all 0.3s ease;
    }
    .btn-green:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 20px rgba(76, 175, 80, 0.3);
    }
    .input-focus:focus {
      border-color: #6B73FF;
      box-shadow: 0 0 0 3px rgba(107, 115, 255, 0.2);
    }
    .note-editor.note-frame {
      border: 1px solid #e5e7eb !important;
      border-radius: 0.5rem !important;
    }
    .note-editor.note-frame .note-statusbar {
      background-color: #f9fafb !important;
      border-bottom-left-radius: 0.5rem !important;
      border-bottom-right-radius: 0.5rem !important;
    }
    .note-editable {
      background-color: white !important;
    }
  </style>
</head>

<body class="bg-gray-50">
  <div class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
      <div class="text-center mb-8">
        <div class="flex justify-center mb-4">
          <img src="img/logoapotik.jpeg" alt="APOTIKLogo" class="h-16">
        </div>
        <h1 class="text-3xl font-bold text-gray-800">
          <span class="bg-clip-text text-transparent gradient-bg">Hei Doc!</span>
        </h1>
        <p class="text-gray-600 mt-2">Your trusted pharmacy partner</p>
      </div>

      <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="p-8">
          <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Guest Book</h2>
            <p class="text-gray-600">Leave us your message or feedback</p>
          </div>

          <form method="POST" class="space-y-5">
            <div>
              <label for="namaGuest" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
              <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <i class="fas fa-user text-gray-400"></i>
                </div>
                <input type="text" id="namaGuest" name="namaGuest" required
                  class="input-focus pl-10 w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500 transition duration-200"
                  placeholder="Enter your full name">
              </div>
            </div>

            <div>
              <label for="emailGuest" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
              <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <i class="fas fa-envelope text-gray-400"></i>
                </div>
                <input type="email" id="emailGuest" name="emailGuest" required
                  class="input-focus pl-10 w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500 transition duration-200"
                  placeholder="Enter your email address">
              </div>
            </div>

            <div>
              <label for="pesanGuest" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
              <textarea id="pesanGuest" name="pesanGuest" required></textarea>
            </div>

            <button type="submit" name="kirim"
              class="btn-green w-full py-3 px-4 rounded-lg text-white font-semibold shadow-md hover:shadow-lg transition duration-200">
              <i class="fas fa-paper-plane mr-2"></i> Submit Message
            </button>
          </form>

          <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
              Want to shop with us? 
              <a href="login.php" class="font-medium text-blue-600 hover:text-blue-500 ml-1">Customer Login</a>
            </p>
          </div>

          <div class="mt-6">
            <div class="relative">
              <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-300"></div>
              </div>
              <div class="relative flex justify-center text-sm">
                <span class="px-2 bg-white text-gray-500">Quick Links</span>
              </div>
            </div>

            <div class="mt-6 grid grid-cols-2 gap-3">
              <a href="index.php" class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                <i class="fas fa-home text-blue-500 mr-2"></i> Home
              </a>
              <a href="loginAdmin.php" class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                <i class="fas fa-user-shield text-blue-500 mr-2"></i> Admin Login
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

  <!-- jQuery and Summernote JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
  
  <script>
    $('#pesanGuest').summernote({
      placeholder: 'Type your message here...',
      tabsize: 2,
      height: 150,
      toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['insert', ['link']],
        ['view', ['help']]
      ],
      callbacks: {
        onInit: function() {
          $('.note-editable').css('background-color', '#fff');
        }
      }
    });
  </script>
</body>
</html>