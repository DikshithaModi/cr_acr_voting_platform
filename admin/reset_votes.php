<?php
include '../includes/auth_admin.php';
include '../includes/db.php';

$message = "";

if (isset($_POST['reset'])) {
    // Reset votes table
    if ($conn->query("TRUNCATE TABLE votes") === TRUE) {
        // Reset nomination vote counts
        if ($conn->query("UPDATE nominations SET votes = 0") === TRUE) {
            $message = "✅ All votes have been successfully reset!";
        } else {
            $message = "❌ Failed to reset nomination vote counts: " . $conn->error;
        }
    } else {
        $message = "❌ Failed to truncate votes table: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Reset Votes</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
  <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md text-center">
    <h1 class="text-2xl font-bold text-red-600 mb-6">⚠️ Reset All Votes</h1>

    <?php if (!empty($message)): ?>
      <p class="mb-4 <?= str_starts_with($message, '✅') ? 'text-green-600' : 'text-red-600' ?> font-semibold">
        <?= $message ?>
      </p>
    <?php else: ?>
      <p class="mb-4 text-gray-700">This will permanently delete all votes. Are you sure?</p>
      <form method="post">
        <button type="submit" name="reset" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg font-medium">
          Reset All Votes
        </button>
      </form>
    <?php endif; ?>

    <a href="dashboard.php" class="inline-block mt-6 text-sm text-blue-600 hover:underline">← Back to Dashboard</a>
  </div>
</body>
</html>
