<?php
include '../includes/auth_admin.php';
include '../includes/db.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>
<body class="bg-gradient-to-tr from-purple-50 via-indigo-100 to-blue-100 min-h-screen">

  <!-- Header -->
  <header class="bg-blue-800 text-white sticky top-0 z-50 shadow-lg">
    <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-4">
      <h1 class="text-2xl font-bold tracking-wide">Class Incharge</h1>
      <a href="logout.php" class="text-white text-sm hover:underline">Logout</a>
    </div>
  </header>

  <!-- Main Content -->
  <main class="max-w-6xl mx-auto px-4 py-12">
    <?php if (isset($_GET['reset'])): ?>
      <div class="max-w-xl mx-auto mt-6 p-4 rounded-lg 
              <?= $_GET['reset'] === 'success' ? 'bg-green-100 text-green-800 border-green-400' : 'bg-red-100 text-red-800 border-red-400' ?> 
              border text-center font-medium">
              <?= $_GET['reset'] === 'success' ? '✔ Votes reset successfully.' : '✖ Failed to reset votes. Please try again.' ?>
      </div>
    <?php endif; ?>


    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

      <!-- Card: Approve Nominations -->
      <a href="approve_nomination.php" class="group bg-white p-6 rounded-2xl border-l-4 border-green-500 shadow hover:shadow-2xl transition duration-300 hover:scale-[1.02]">
        <div class="flex items-center gap-4">
          <div class="text-green-600 text-3xl">✅</div>
          <div>
            <h3 class="text-xl font-semibold text-green-800">Approve Nominations</h3>
            <p class="text-sm text-gray-600 mt-1">Review and approve/reject submitted candidates.</p>
          </div>
        </div>
      </a>

      <!-- Card: Voting Results -->
      <a href="results.php" class="group bg-white p-6 rounded-2xl border-l-4 border-blue-500 shadow hover:shadow-2xl transition duration-300 hover:scale-[1.02]">
        <div class="flex items-center gap-4">
          <div class="text-blue-600 text-3xl">📊</div>
          <div>
            <h3 class="text-xl font-semibold text-blue-800">Voting Results</h3>
            <p class="text-sm text-gray-600 mt-1">Live vote count for each approved role and candidate.</p>
          </div>
        </div>
      </a>

      <!-- Card: View Candidates -->
      <a href="dashboard.php" class="group bg-white p-6 rounded-2xl border-l-4 border-purple-500 shadow hover:shadow-2xl transition duration-300 hover:scale-[1.02]">
        <div class="flex items-center gap-4">
          <div class="text-purple-600 text-3xl">📋</div>
          <div>
            <h3 class="text-xl font-semibold text-purple-800">All Candidates</h3>
            <p class="text-sm text-gray-600 mt-1">View full list of approved & rejected nominations.</p>
          </div>
        </div>
      </a>

      <!-- Card: Reset All Votes -->
      <a href="reset_votes.php" 
         onclick="return confirm('Are you sure you want to delete all votes? This action cannot be undone.')" 
         class="group bg-white p-6 rounded-2xl border-l-4 border-red-500 shadow hover:shadow-2xl transition duration-300 hover:scale-[1.02]">
        <div class="flex items-center gap-4">
          <div class="text-red-600 text-3xl">🗑️</div>
          <div>
            <h3 class="text-xl font-semibold text-red-700">Reset All Votes</h3>
            <p class="text-sm text-gray-600 mt-1">Delete all voting records and prepare for a new election.</p>
          </div>
        </div>
      </a>

    </div>
  </main>

  <!-- Footer -->
  <footer class="text-center text-gray-500 text-sm py-4">
    © <?= date('Y') ?> Online Voting System
  </footer>

</body>
</html>
