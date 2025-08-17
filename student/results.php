<?php
include '../includes/db.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Election Results</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center font-sans">
  <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-2xl">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold text-green-700">Election Results</h1>
      <a href="logout.php" class="text-green-600 hover:underline text-sm">Logout</a>
    </div>

    <?php
    // Top CR
    $crResult = $conn->query("
        SELECT s.name, s.class, COUNT(v.id) AS total_votes
        FROM votes v
        JOIN nominations n ON v.candidate_id = n.id
        JOIN students s ON n.student_id = s.student_id
        WHERE v.role = 'CR'
        GROUP BY v.candidate_id
        ORDER BY total_votes DESC
        LIMIT 1
    ");

    if ($crResult && $crResult->num_rows > 0) {
        $cr = $crResult->fetch_assoc();
        echo '
        <div class="bg-blue-100 border-l-4 border-blue-400 p-4 mb-4 rounded">
            <p class="font-semibold text-blue-700">Class Representative (CR)</p>
            <p>Name: ' . htmlspecialchars($cr['name']) . '</p>
            <p>Class: ' . htmlspecialchars($cr['class']) . '</p>
            <p>Total Votes: ' . $cr['total_votes'] . '</p>
        </div>';
    } else {
        echo '<p class="text-red-600">No votes found for CR.</p>';
    }

    // Top ACR
    $acrResult = $conn->query("
        SELECT s.name, s.class, COUNT(v.id) AS total_votes
        FROM votes v
        JOIN nominations n ON v.candidate_id = n.id
        JOIN students s ON n.student_id = s.student_id
        WHERE v.role = 'ACR'
        GROUP BY v.candidate_id
        ORDER BY total_votes DESC
        LIMIT 1
    ");

    if ($acrResult && $acrResult->num_rows > 0) {
        $acr = $acrResult->fetch_assoc();
        echo '
        <div class="bg-purple-100 border-l-4 border-purple-400 p-4 rounded">
            <p class="font-semibold text-purple-700">Assistant Class Representative (ACR)</p>
            <p>Name: ' . htmlspecialchars($acr['name']) . '</p>
            <p>Class: ' . htmlspecialchars($acr['class']) . '</p>
            <p>Total Votes: ' . $acr['total_votes'] . '</p>
        </div>';
    } else {
        echo '<p class="text-red-600 mt-4">No votes found for ACR.</p>';
    }
    ?>
  </div>
</body>
</html>
