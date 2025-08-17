<?php 
include '../includes/db.php'; 
session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-100 to-indigo-100 flex items-center justify-center min-h-screen">

  <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
    <h2 class="text-3xl font-bold mb-6 text-center text-blue-600">Class Incharge Login</h2>

    <!-- ✅ Admin Login Form -->
    <form method="post" class="space-y-5">
      <input type="text" name="username" placeholder="Admin Username" required
             class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
             
      <input type="password" name="password" placeholder="Password" required
             class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
             
      <button type="submit" name="login"
              class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded font-semibold">Login</button>
    </form>

    <!-- ✅ PHP Login Logic -->
    <?php
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $pass = $_POST['password'];

        // 🧠 Prevent SQL injection (basic escaping — consider prepared statements in future)
        $username = $conn->real_escape_string($username);
        $pass = $conn->real_escape_string($pass);

        $res = $conn->query("SELECT * FROM admin WHERE username='$username' AND password='$pass'");

        if ($res && $res->num_rows > 0) {
            $_SESSION['admin_id'] = $username;
            header("Location: admin_dashboard.php"); // ✅ Redirect to Dashboard
            exit();
        } else {
            echo "<p class='text-blue-600 text-center mt-4'>❌ Invalid username or password.</p>";
        }
    }
    ?>
  </div>

</body>
</html>
