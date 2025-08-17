<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Online Voting System - Index</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
    }
  </style>
</head>
<body class="bg-gray-50">

  <!-- Static Header Image -->
  <div class="w-full shadow">
    <img src="images/header.png" alt="Stanley College Banner" class="w-full object-cover">
  </div>

  <!-- Login Cards -->
  <div class="flex justify-center items-center min-h-[70vh] gap-10 px-4 flex-wrap">
    <!-- Admin Login -->
    <div class="bg-white border-2 border-blue-500 shadow-lg rounded-xl p-6 w-80 text-center hover:scale-105 transition">
      <div class="text-5xl mb-3 text-blue-600">👤</div>
      <h2 class="text-xl font-semibold text-blue-700 mb-4">Class Incharge Login</h2>
      <a href="admin/logina.php" class="inline-block bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">Login as CI</a>
    </div>

    <!-- Student Login -->
    <div class="bg-white border-2 border-blue-500 shadow-lg rounded-xl p-6 w-80 text-center hover:scale-105 transition">
      <div class="text-5xl mb-3 text-blue-600">🎓</div>
      <h2 class="text-xl font-semibold text-blue-700 mb-4">Student Login</h2>
      <a href="student/login.php" class="inline-block bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">Login as Student</a>
    </div>
  </div>

  <!-- Footer -->
  <footer class="text-center text-gray-500 py-4 border-t">
    &copy; 2025 Stanley College of Engineering & Technology for Women. All Rights Reserved.
  </footer>
</body>
</html>
