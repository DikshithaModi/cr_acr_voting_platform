<?php
include '../includes/auth_admin.php';
include '../includes/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>All Candidates</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>
<body class="bg-gradient-to-tr from-purple-50 via-indigo-100 to-blue-50 min-h-screen">

  <!-- Header -->
  <header class="bg-purple-800 text-white sticky top-0 shadow-md py-4 px-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold">📋 All Candidates</h1>
    <a href="logout.php" class="bg-red-500 hover:bg-red-600 transition px-4 py-2 rounded-md text-sm font-semibold">Logout</a>
  </header>

  <main class="max-w-6xl mx-auto px-4 py-10">
    <?php
    $res = $conn->query("
      SELECT n.*, s.name 
      FROM nominations n 
      JOIN students s ON n.student_id = s.student_id
      WHERE n.status IN ('approved', 'rejected')
      ORDER BY n.status DESC, n.role
    ");

    if ($res->num_rows == 0): ?>
      <p class="text-center text-gray-600 text-lg">No candidates to display yet.</p>
    <?php else: ?>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php while ($row = $res->fetch_assoc()): ?>
          <div class="bg-white border-l-4 <?= $row['status'] === 'approved' ? 'border-green-500' : 'border-red-500' ?> shadow-md rounded-xl p-6 hover:shadow-xl transition">
            <h2 class="text-xl font-bold text-purple-800 mb-1">🧑 <?= htmlspecialchars($row['name']) ?></h2>
            <p class="text-sm text-gray-600">🆔 <?= $row['student_id'] ?></p>
            <p class="text-sm text-indigo-700 font-semibold mt-1">🎯 Role: <?= $row['role'] ?></p>
            <p class="text-sm <?= $row['status'] === 'approved' ? 'text-green-700' : 'text-red-600' ?> font-semibold mt-1">
              <?= strtoupper($row['status']) ?>
            </p>
            <?php if (!empty($row['manifesto'])): ?>
              <p class="text-sm text-gray-700 mt-2">📝 <strong>Manifesto:</strong> <?= nl2br(htmlspecialchars($row['manifesto'])) ?></p>
            <?php endif; ?>
            <?php if ($row['status'] === 'rejected' && !empty($row['feedback'])): ?>
              <p class="text-sm text-red-500 mt-2">💬 <strong>Feedback:</strong> <?= nl2br(htmlspecialchars($row['feedback'])) ?></p>
            <?php endif; ?>
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
