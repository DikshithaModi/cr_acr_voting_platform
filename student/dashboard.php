
<?php
session_start();
if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Student Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          animation: {
            fadeIn: "fadeIn 1.2s ease-in-out forwards"
          },
          keyframes: {
            fadeIn: {
              from: { opacity: 0 },
              to: { opacity: 1 }
            }
          }
        }
      }
    }
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-100 to-purple-100 min-h-screen p-20 font-sans">
  <div class="max-w-5xl mx-auto bg-white rounded-2xl shadow-xl p-8 animate-fadeIn">
    <h1 class="text-4xl font-bold text-center text-purple-700 mb-6">Welcome, <span class="text-blue-600"><?= $_SESSION['student_id'] ?></span>
    <div class="flex justify-end">
      <a href="logout.php" class="text-blue-600 hover:underline text-sm font-large">Logout</a>
    </div>
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
      <!-- Nomination Section -->
      <div class="bg-blue-50 rounded-xl p-6 shadow hover:shadow-lg transition duration-300">
        <div class="flex items-center gap-3 mb-4">
          <i class="fas fa-file-signature text-blue-600 text-2xl"></i>
          <h2 class="text-2xl font-semibold text-blue-800">Nominate Yourself</h2>
        </div>
        <form action="nominate.php" method="POST" class="space-y-4">
          <label class="block text-sm font-medium text-gray-700">Select Role</label>
          <select name="role" class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-blue-300">
            <option value="CR">Class Representative (CR)</option>
            <option value="ACR">Assistant Class Representative (ACR)</option>
          </select>
          <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">Submit Nomination</button>
        </form>
      </div>

      <!-- Voting Section -->
      <div class="bg-green-50 rounded-xl p-6 shadow hover:shadow-lg transition duration-300">
        <div class="flex items-center gap-3 mb-4">
          <i class="fas fa-vote-yea text-green-600 text-2xl"></i>
          <h2 class="text-2xl font-semibold text-green-800">Cast Your Vote</h2>
        </div>
        <p class="text-gray-600 mb-11">Your class deserves strong, responsible leaders.<br>Vote thoughtfully to shape your academic journey.</p>
        <a href="vote.php" class="block text-center bg-green-600 text-white py-2 rounded hover:bg-green-700 transition mt-10">Go to Voting Page</a>
      </div>
      <!-- Results Section -->
      <div class="bg-gray-100 rounded-xl p-6 shadow hover:shadow-lg transition duration-300 md:col-span-2">
        <div class="flex items-center gap-3 mb-4">
          <i class="fas fa-chart-bar text-gray-600 text-2xl"></i>
          <h2 class="text-2xl font-semibold text-gray-800">Election Results</h2>
        </div>
        <p class="text-gray-600 mb-6">See who was elected as CR and ACR for your class.</p>
        <a href="results.php" class="block text-center bg-gray-700 text-white py-2 rounded hover:bg-gray-800 transition">View Results</a>
      </div>
    </div>
  </div>
</body>
</html>
