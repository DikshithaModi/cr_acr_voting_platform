<?php
include '../includes/auth_admin.php';
include '../includes/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Voting Results</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>
<body class="bg-gradient-to-tr from-indigo-100 via-purple-100 to-blue-100 min-h-screen">

  <!-- Header -->
  <header class="bg-purple-800 text-white sticky top-0 shadow-md py-4 px-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold">📊 Voting Results</h1>
    <a href="logout.php" class="bg-red-500 hover:bg-red-600 transition px-4 py-2 rounded-md text-sm font-semibold">Logout</a>
  </header>

  <!-- Main Content -->
  <main class="max-w-5xl mx-auto px-4 py-10">
    <?php
    $res = $conn->query("
      SELECT n.id AS nomination_id, n.student_id, n.role, s.name, COUNT(v.id) AS votes
      FROM nominations n
      JOIN students s ON n.student_id = s.student_id
      LEFT JOIN votes v ON v.candidate_id = n.id AND v.role = n.role
      WHERE n.status = 'approved'
      GROUP BY n.id, n.student_id, n.role, s.name
      ORDER BY n.role, votes DESC
    ");

    if ($res->num_rows == 0): ?>
      <p class="text-center text-gray-600 text-lg">No votes have been cast yet.</p>
    <?php else: ?>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php while ($row = $res->fetch_assoc()): ?>
          <div class="bg-white border-l-4 border-purple-500 shadow-md rounded-xl p-6 hover:shadow-xl transition">
            <h2 class="text-xl font-bold text-purple-800 mb-1">🧑 <?= htmlspecialchars($row['name']) ?></h2>
            <p class="text-sm text-gray-600 mb-1">🆔 <?= $row['student_id'] ?></p>
            <p class="text-sm text-purple-700 mb-2 font-semibold">🎯 Role: <?= $row['role'] ?></p>
            <p class="text-lg font-bold text-green-600">🗳️ Votes: <?= $row['votes'] ?></p>
          </div>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>
  </main>

  <footer class="text-center text-gray-500 text-sm py-4">
    © <?= date('Y') ?> Online Voting System – Admin Panel
  </footer>

</body>
</html>
