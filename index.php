<?php
include('includes/header.php');
include('includes/config.php');

// Handle form submission for searching
$keyword = 'web';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $keyword = isset($_POST['search_keyword']) ? trim($_POST['search_keyword']) : '';
} elseif (isset($_GET['search_keyword'])) {
    $keyword = trim($_GET['search_keyword']);
}

// Check if the keyword is provided and not empty
if (!empty($keyword)) {
    // Check if keyword already exists
    $checkQuery = "SELECT * FROM words WHERE keyword = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("s", $keyword);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // If keyword exists, update its frequency
        $updateQuery = "UPDATE words SET frequency = frequency + 1 WHERE keyword = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("s", $keyword);
        $stmt->execute();
    } else {
        // If keyword doesn't exist, insert a new record
        $insertQuery = "INSERT INTO words (keyword, frequency) VALUES (?, 1)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("s", $keyword);
        $stmt->execute();
    }

    // Now search jobs based on the keyword
    $sql = "SELECT id, job_title, description, vacancy, salary, company_name, company_image 
            FROM jobs 
            WHERE job_title LIKE ? OR company_name LIKE ? OR description LIKE ?";
    $likeKeyword = "%$keyword%";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $likeKeyword, $likeKeyword, $likeKeyword);
    $stmt->execute();
    $jobsResult = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Listings</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="chatbot/style2.css">
</head>
<body><br><br>

<!-- Search Form -->
<form method="post" class="search-jobs-form">
    <center>
        <div class="row mb-5">
            <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                <input type="text" class="form-control form-control-lg" placeholder="Job title, Company..." name="search_keyword" required>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                <select class="selectpicker" data-style="btn-white btn-lg" data-width="100%" data-live-search="true" title="Select Region">
                    <option>Anywhere</option>
                    <option>Mumbai</option>
                    <option>Pune</option>
                    <option>Nagpur</option>
                    <option>Nashik</option>
                    <option>Thane</option>
                    <option>Aurangabad</option>
                    <option>Solapur</option>
                    <option>Kolhapur</option>
                    <option>Amravati</option>
                    <option>Sangli</option>
                </select>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                <select class="selectpicker" data-style="btn-white btn-lg" data-width="100%" data-live-search="true" title="Select Job Type">
                    <option>Part Time</option>
                    <option>Full Time</option>
                </select>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                <button type="submit" class="btn btn-primary btn-lg btn-block text-white btn-search">
                    <span class="icon-search icon mr-2"></span>Search Job
                </button>
            </div>
        </div>
    </center>
</form>

<!-- Display Trending Keywords -->
<div class="row">
    <div class="col-md-12 popular-keywords">
        <h3>Trending Keywords:</h3>
        <ul class="keywords list-unstyled m-0 p-0">
            <?php
            // Fetch top 5 trending keywords
            $trendingQuery = "SELECT keyword FROM words ORDER BY frequency DESC LIMIT 5";
            $trendingResult = $conn->query($trendingQuery);

            while ($row = $trendingResult->fetch_assoc()) {
                echo '<li><a href="?search_keyword=' . urlencode($row['keyword']) . '">' . htmlspecialchars($row['keyword']) . '</a></li>';
            }
            ?>
        </ul>
    </div>
</div>

<!-- Job Listings -->
<div class="job">
    <h1>We Are Hiring</h1>
    <div class="job-list">
        <?php if (isset($jobsResult) && $jobsResult->num_rows > 0): ?>
            <?php while ($row = $jobsResult->fetch_assoc()): ?>
                <div class="job-item">
                    <img src="<?php echo htmlspecialchars($row['company_image']); ?>" alt="Company Image" class="company-image">
                    <div class="job-details">
                        <h2><?php echo htmlspecialchars($row['job_title']); ?></h2>
                        <p><?php echo htmlspecialchars($row['description']); ?></p>
                        <p><strong>Company:</strong> <?php echo htmlspecialchars($row['company_name']); ?></p>
                        <p><strong>Vacancy:</strong> <?php echo htmlspecialchars($row['vacancy']); ?></p>
                        <p><strong>Salary:</strong> <?php echo htmlspecialchars($row['salary']); ?></p>
                        <button type="submit" class="apply-button">
                            <a href="<?php echo APP_URL; ?>actions/details.php?id=<?php echo $row['id']; ?>" class="detail-link">View Details</a>
                        </button>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No results found for "<?php echo htmlspecialchars($keyword); ?>"</p>
        <?php endif; ?>
    </div>
</div><br>

<!-- Floating Chat Icon -->
<div id="chat-icon" onclick="toggleChat()">
    <img src="chatbot/chat-icon.png" alt="Chat Icon" style="width: 50px; height: 50px;">
</div>

<!-- Chatbox -->
<div class="chatbox" id="chatbox" style="display: none;">
    <div class="chatbox-header">
        <img src="chatbot/logo.png" alt="Logo" class="chatbox-logo">
        <div class="chatbox-info">
            <div class="chatbox-website">Udaan [ Job portal ]</div>
            <div class="chatbox-email">skidde7@gmail.com</div>
        </div>
        <div class="chatbox-close" onclick="toggleChat()">&#x2715;</div>
    </div>
    <div class="chatlogs" id="chatlogs"></div>
    <div class="chat-widgets">
        <button onclick="triggerCommand('contact')">📞 Contact</button>
        <button onclick="triggerCommand('address')">📍 Address</button>
        <button onclick="triggerCommand('uptime')">⏱ Uptime</button>
        <button onclick="triggerCommand('help')">❓ Help</button>
    </div>
    <div class="chat-input">
        <input type="text" id="userInput" placeholder="Type your message...">
        <button onclick="sendMessage()">Send</button>
    </div>
</div>

<script src="chatbot/script.js"></script>

<?php include('includes/footer.html'); ?>
</body>
</html>
