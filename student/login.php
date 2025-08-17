<?php include '../includes/db.php'; session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Student Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-100 to-indigo-100 flex items-center justify-center min-h-screen">
  <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
    <h2 class="text-2xl font-bold mb-6 text-center text-blue-600">Student Login</h2>
    <form method="post" class="space-y-4">
      <input type="text" name="student_id" placeholder="Student ID" required
             class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-blue-400">
      <input type="password" name="password" placeholder="Password" required
             class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-blue-400">
      <button type="submit" name="login"
              class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded">Login</button>
    </form>
    <?php
    if (isset($_POST['login'])) {
        $id = $_POST['student_id'];
        $pass = $_POST['password'];
        $res = $conn->query("SELECT * FROM students WHERE student_id='$id' AND password='$pass'");
        if ($res->num_rows > 0) {
            $_SESSION['student_id'] = $id;
            header("Location: dashboard.php");
        } else {
            echo "<p class='text-red-600 text-center mt-4'>Invalid login.</p>";
        }
    }
    ?>
  </div>
</body>
</html>
