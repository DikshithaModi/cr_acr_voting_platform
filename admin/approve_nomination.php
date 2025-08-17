<?php 
include '../includes/db.php';
include '../includes/auth_admin.php'; // Use admin auth here!

$message = '';
if (isset($_POST['approve'])) {
    $id = $_POST['nom_id'];
    if ($conn->query("UPDATE nominations SET status='approved' WHERE id='$id'")) {
        $message = "✅ Nomination approved successfully.";
    } else {
        $message = "❌ Failed to approve nomination.";
    }
}

if (isset($_POST['reject'])) {
    $id = $_POST['nom_id'];
    $feedback = $conn->real_escape_string($_POST['feedback']);
    if ($conn->query("UPDATE nominations SET status='rejected', feedback='$feedback' WHERE id='$id'")) {
        $message = "❌ Nomination rejected.";
    } else {
        $message = "❌ Failed to reject nomination.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Approve Nominations</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>
<body class="bg-gradient-to-tr from-purple-50 via-indigo-100 to-blue-50 min-h-screen">

  <!-- Header -->
  <header class="bg-purple-800 text-white sticky top-0 z-50 shadow-md py-4 px-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold">✅ Approve Nominations</h1>
    <a href="logout.php" class="bg-red-500 hover:bg-red-600 transition px-4 py-2 rounded-md text-sm font-semibold">Logout</a>
  </header>

  <!-- Main Content -->
  <main class="max-w-5xl mx-auto px-4 py-10">
    <div class="grid gap-6">

    <?php if (!empty($message)): ?>
      <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 rounded-md shadow">
        <?= htmlspecialchars($message) ?>
      </div>
    <?php endif; ?>

    <?php
    $res = $conn->query("SELECT n.*, s.name FROM nominations n JOIN students s ON n.student_id = s.student_id WHERE n.status = 'pending'");
    if ($res->num_rows === 0) {
        echo "<p class='text-center text-gray-600 text-lg'>No nominations pending approval.</p>";
    }

    while ($row = $res->fetch_assoc()): ?>
      <div class="bg-white border-l-4 border-yellow-400 shadow rounded-xl p-6 hover:shadow-lg transition">
        <p><strong>👤 Name:</strong> <?= htmlspecialchars($row['name']) ?></p>
        <p><strong>🆔 Student ID:</strong> <?= $row['student_id'] ?></p>
        <p><strong>🎯 Role:</strong> <?= $row['role'] ?></p>
        <p class="mt-2 text-sm text-gray-700"><strong>📝 Manifesto:</strong><br><?= nl2br(htmlspecialchars($row['manifesto'])) ?></p>

        <form method="post" class="mt-4 flex flex-col sm:flex-row gap-3 items-start sm:items-center">
          <input type="hidden" name="nom_id" value="<?= $row['id'] ?>">
          <button type="submit" name="approve" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-md shadow">
            ✅ Approve
          </button>
        </form>

        <form method="post" class="mt-3">
          <input type="hidden" name="nom_id" value="<?= $row['id'] ?>">
          <textarea name="feedback" required placeholder="Reason for rejection" class="w-full px-4 py-2 border rounded-md mt-2 text-sm"></textarea>
          <button type="submit" name="reject" class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 mt-2 rounded-md shadow">
            ❌ Reject
          </button>
        </form>
      </div>
    <?php endwhile; ?>

    </div>
  </main>

  <footer class="text-center text-sm text-gray-500 py-4">
    © <?= date('Y') ?> Online Voting System – Admin Panel
  </footer>

</body>
</html>
