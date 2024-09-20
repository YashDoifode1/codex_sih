<?php
//session_start();
require "..\includes/header.php";
require "..\includes/config.php";

// Fetch job ID from the GET parameter
$job_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch job details based on job ID
$sql = "SELECT * FROM jobs WHERE id = $job_id";
$result = $conn->query($sql);

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    die("You must be logged in to save a job.");
}

// Handle form submission (saving job)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['id'];  // Correct session variable for user ID
    $job_id = $_POST['job_id'];

    // Insert into saved_job table
    $stmt = $conn->prepare("INSERT INTO saved_job (user_id, job_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $job_id);  // Bind user_id and job_id

    if ($stmt->execute()) {
        echo "<script>alert('Job saved successfully');</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Details</title>
    <link rel="stylesheet" href="..\css/list.css">
</head>
<body>

<!-- JOB DATA -->
    <div class="container5">
        <?php if ($result->num_rows > 0): ?>
            <?php $row = $result->fetch_assoc(); ?>
            <div class="job-detail-box">
                <div class="image-section">
                    <img src="<?php echo htmlspecialchars($row['company_image']); ?>" alt="Company Image" class="company-image">
                </div>
                <div class="details-section">
                    <h2><?php echo htmlspecialchars($row['job_title']); ?></h2>
                    <p><strong>Company:</strong> <?php echo htmlspecialchars($row['company_name']); ?></p>
                    <p><strong>Company Email:</strong> <?php echo htmlspecialchars($row['company_email']); ?></p>
                    <p><strong>Location:</strong> <?php echo htmlspecialchars($row['state']) . ', ' . htmlspecialchars($row['region']); ?></p>
                    <p><strong>Job Time:</strong> <?php echo htmlspecialchars($row['job_time']); ?></p>
                    <p><strong>Vacancy:</strong> <?php echo htmlspecialchars($row['vacancy']); ?></p>
                    <p><strong>Salary:</strong> <?php echo htmlspecialchars($row['salary']); ?></p>
                    <p><strong>Experience:</strong> <?php echo htmlspecialchars($row['experience']); ?></p>
                    <p><strong>Responsibilities:</strong> <?php echo htmlspecialchars($row['responsibility']); ?></p>
                    <p><strong>Education Required:</strong> <?php echo htmlspecialchars($row['education_required']); ?></p>
                    <p><strong>Description:</strong> <?php echo htmlspecialchars($row['description']); ?></p>
                    <div class="buttons">
                        <!-- Apply Now Form -->
                        <form action="<?php echo APP_URL; ?>actions/apply.php" method="post">
                            <input type="hidden" name="job_id" value="<?php echo $job_id; ?>">
                            <button type="submit" class="apply-button">Apply Now</button>
                        </form>
                        <!-- Save Job Form -->
                        <form action="<?php echo APP_URL; ?>actions/details.php?id=<?php echo $job_id; ?>" method="post" class="save-job-form">
                            <input type="hidden" name="job_id" value="<?php echo $job_id; ?>">
                            <button type="submit" class="save-button">Save Job</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <p>No job details found.</p>
        <?php endif; ?>
    </div>

</body>
</html>

<?php require "..\includes/footer.html"; ?>
