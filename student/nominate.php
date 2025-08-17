<?php
session_start();
include '../includes/db.php';
include '../includes/auth_student.php';

$student_id = $_SESSION['student_id'];

if (isset($_POST['submit_nomination'])) {
    $role = $_POST['role'];
    $manifesto = $conn->real_escape_string($_POST['manifesto']);

    $res = $conn->query("SELECT * FROM nominations WHERE student_id = '$student_id'");
    if ($res->num_rows > 0) {
        echo "<script>alert('You have already nominated yourself.');</script>";
    } else {
        $conn->query("INSERT INTO nominations (student_id, role, manifesto, status) VALUES ('$student_id', '$role', '$manifesto', 'pending')");
        echo "<script>alert('Nomination submitted successfully.'); window.location.href='nominate.php';</script>";
    }
}

if (isset($_POST['delete_nomination'])) {
    $conn->query("DELETE FROM nominations WHERE student_id = '$student_id'");
    echo "<script>alert('Nomination deleted successfully.'); window.location.href='nominate.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Nominate Yourself</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-purple-50 to-indigo-100 min-h-screen p-6">
  <div class="max-w-xl mx-auto bg-white p-8 rounded-xl shadow-md">
    <div class="flex justify-between items-center mb-6">
      <h2 class="text-2xl font-semibold text-indigo-700">Nominate Yourself</h2>
      <a href="logout.php" class="text-indigo-600 hover:underline text-sm font-medium">Logout</a>
    </div>

    <form method="post" class="space-y-4">
      <div>
        <label for="role" class="block text-sm font-medium text-gray-700">Select Role</label>
        <select id="role" name="role" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
          <option value="CR">Class Representative (CR)</option>
          <option value="ACR">Assistant Class Representative (ACR)</option>
        </select>
      </div>

      <div>
        <label for="manifesto" class="block text-sm font-medium text-gray-700">Manifesto</label>
        <textarea id="manifesto" name="manifesto" rows="4" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
      </div>

      <button type="submit" name="submit_nomination" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-md shadow">
        Submit Nomination
      </button>
    </form>

    <?php
    $res = $conn->query("SELECT * FROM nominations WHERE student_id = '$student_id'");
    if ($res->num_rows > 0):
    ?>
      <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded-md mt-6">
        <p class="text-red-600 font-medium">You have already submitted a nomination.</p>
        <form method="post" class="mt-2">
          <button type="submit" name="delete_nomination" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md shadow">
            🗑️ Delete Nomination
          </button>
        </form>
      </div>
    <?php endif; ?>
  </div>
</body>
</html>
