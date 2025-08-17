<?php 
include '../includes/auth.php'; 
include '../includes/db.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Vote</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-green-50 to-green-50 min-h-screen flex items-center justify-center py-10">
  <div class="bg-white shadow-2xl rounded-2xl w-full max-w-4xl p-8">
    <div class="flex justify-between items-center mb-6">
      <h2 class="text-2xl font-semibold text-green-700">Cast Your Vote</h2>
      <a href="logout.php" class="text-green-600 hover:underline text-sm font-large">Logout</a>
    </div>

    <?php
    // Fetch only approved nominations
    $res = $conn->query("SELECT * FROM nominations WHERE status='approved'");

    if ($res && $res->num_rows > 0): ?>
      <form method="post">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <?php while ($row = $res->fetch_assoc()): ?>
          <label class="block bg-green-50 border border-green-300 rounded-xl p-4 shadow-md hover:shadow-xl cursor-pointer transition">
            <div class="flex items-center gap-4">
              <input type="radio" name="vote" value="<?= $row['id'] ?>" class="w-5 h-5 text-green-600" required>
              <div>
                <div class="text-lg font-semibold text-green-800"><?= htmlspecialchars($row['student_id']) ?></div>
                <div class="text-sm text-gray-600 mt-1">
                  <span class="bg-green-200 text-purple-700 px-2 py-1 rounded-full text-xs"><?= htmlspecialchars($row['role']) ?></span>
                </div>
              </div>
            </div>
            <?php if (!empty($row['manifesto'])): ?>
              <p class="text-sm text-gray-700 mt-2">📝 <strong>Manifesto:</strong> <?= nl2br(htmlspecialchars($row['manifesto'])) ?></p>
            <?php endif; ?>
          </label>
        <?php endwhile; ?>
        </div>
        <button type="submit" name="submit"
                class="mt-6 w-full bg-green-700 hover:bg-green-800 text-white py-3 px-6 rounded-xl font-semibold text-lg shadow-md transition">Submit Vote</button>
      </form>
    <?php else: ?>
      <p class="text-center text-green-600 text-lg font-medium">No approved nominations available at the moment.</p>
    <?php endif; ?>

    <?php
    if (isset($_POST['submit'])) {
        if (!isset($_POST['vote'])) {
            echo "<p class='text-red-600 mt-4 text-center'>⚠️ Please select a candidate.</p>";
        } else {
            $vote_id = intval($_POST['vote']);
            $student_id = $_SESSION['student_id'];
            $student_id_hash = hash("sha256", $student_id);

            // Get candidate role
            $candidate_query = $conn->query("SELECT role FROM nominations WHERE id = $vote_id");
            if ($candidate_query && $candidate_query->num_rows > 0) {
                $candidate = $candidate_query->fetch_assoc();
                $role = $candidate['role'];

                // Check if already voted for this role
                $check = $conn->query("SELECT * FROM votes WHERE student_id_hash = '$student_id_hash' AND role = '$role'");
                if ($check && $check->num_rows > 0) {
                    echo "<p class='text-red-600 mt-4 text-center'>⚠️ You have already voted for $role.</p>";
                } else {
                    // Insert vote record
                    $insert = $conn->query("INSERT INTO votes (student_id_hash, role, candidate_id) VALUES ('$student_id_hash', '$role', $vote_id)");

                    if ($insert) {
                        // Increment vote count in nominations table
                        $update = $conn->query("UPDATE nominations SET votes = votes + 1 WHERE id = $vote_id");

                        if ($update) {
                            echo "<p class='text-green-600 mt-4 text-center font-semibold'>✅ Vote cast successfully for $role!</p>";
                        } else {
                            echo "<p class='text-red-600 mt-4 text-center'>⚠️ Vote recorded, but failed to update candidate's vote count.</p>";
                        }
                    } else {
                        echo "<p class='text-red-600 mt-4 text-center'>❌ Failed to cast vote. Please try again.</p>";
                    }
                }
            } else {
                echo "<p class='text-red-600 mt-4 text-center'>❌ Invalid candidate selection.</p>";
            }
        }
    }
    ?>
  </div>
</body>
</html>
