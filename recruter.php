
<?php
//session_start();
require "includes/header.php";
require "includes/config.php";

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    die("You must be logged in to view applied users.");
}

// Get the job ID from the URL
$job_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch job details
$sql_job = "SELECT * FROM jobs WHERE id = ?";
$stmt_job = $conn->prepare($sql_job);
$stmt_job->bind_param("i", $job_id);
$stmt_job->execute();
$result_job = $stmt_job->get_result();
$job = $result_job->fetch_assoc();
$stmt_job->close();

// Fetch applied users
$sql_users = "SELECT users.id, users.username, users.email, applied.cv 
              FROM applied 
              JOIN users ON applied.user_id = users.id 
              WHERE applied.job_id = ?";
$stmt_users = $conn->prepare($sql_users);
$stmt_users->bind_param("i", $job_id);
$stmt_users->execute();
$result_users = $stmt_users->get_result();

$stmt_users->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applied Users</title>
    <link rel="stylesheet" href="css/recruter.css">
</head>
<body>
    <div class="container7">
        <h2>Applied Users for <?php echo htmlspecialchars($job['job_title']); ?></h2>
        <?php if ($result_users->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>CV</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($user = $result_users->fetch_assoc()): ?>
                        <tr>
                        <td><?php echo htmlspecialchars($user['id']); ?></td>
                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td><a href="<?php echo htmlspecialchars($user['cv']); ?>" target="_blank">View CV</a></td>
                            <td><a href="<?php echo APP_URL; ?>delete.php?id=<?php echo $user['id']; ?>&job_id=<?php echo $job_id; ?>">Delete</a></td>

                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No users have applied for this job yet.</p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php require "includes/footer.html"; ?>
