<?php
include '../includes/auth.php';      // For login check
include '../includes/db.php';        // For $conn
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Results</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">
<h2 class="text-2xl font-bold mb-6 text-center text-green-700">Election Results</h2>
<div class="max-w-3xl mx-auto bg-white rounded shadow p-6">
    <table class="w-full text-left">
      <thead>
        <tr class="border-b bg-gray-200">
          <th class="py-2 px-4">Candidate</th>
          <th class="py-2 px-4">Position</th>
          <th class="py-2 px-4">Votes</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $res = $conn->query("
          SELECT s.name, n.role, COUNT(v.id) AS total_votes
          FROM nominations n
          JOIN students s ON n.student_id = s.student_id
          LEFT JOIN votes v ON v.candidate_id = n.id AND v.role = n.role
          WHERE n.status = 'approved'
          GROUP BY n.id, s.name, n.role
          ORDER BY n.role, total_votes DESC
        ");

        if ($res && $res->num_rows > 0) {
          while ($row = $res->fetch_assoc()) {
            echo "<tr class='border-b hover:bg-gray-50'>
                    <td class='py-2 px-4'>" . htmlspecialchars($row['name']) . "</td>
                    <td class='py-2 px-4'>" . htmlspecialchars($row['role']) . "</td>
                    <td class='py-2 px-4 text-green-600 font-bold'>" . $row['total_votes'] . "</td>
                  </tr>";
          }
        } else {
          echo "<tr><td colspan='3' class='text-center py-4 text-red-500'>No results found.</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>
