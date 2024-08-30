<?php
session_start();
require "includes/config.php";

// Check if the user is logged in
// if (isset($_SESSION['id'])) {
//     $user_id = $_SESSION['id'];
// } else {
//     // Handle the case where the user is not logged in
//     header("Location: login.php");
//     exit();
// }

// Check if saved_job_id is provided via GET or POST
if (isset($_GET['saved_job_id'])) {
    $saved_job_id = $_GET['saved_job_id'];
} else {
    // Handle the case where saved_job_id is not provided
    die("Error: saved_job_id is not provided.");
}

if ($saved_job_id > 0) {
    // Prepare and execute the deletion query
    $stmt = $conn->prepare("DELETE FROM saved_job WHERE user_id = ? AND job_id = ?");
    $stmt->bind_param("ii", $user_id, $saved_job_id);

    if ($stmt->execute()) {
        // Redirect back to the saved jobs page with a success message
        header("Location: saved.php?message=Job+deleted+successfully");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
