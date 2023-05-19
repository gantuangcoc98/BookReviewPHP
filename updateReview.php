<?php

    // Start the session
    require_once 'header.php';


    // Check if the user is a moderator or userType 1
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }


    // Check if the form was submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Check if the validate button was clicked
        if (isset($_POST['validate'])) {
            // Get the review ID
            $reviewID = $_POST['reviewID'];

            // Update the review status to 1 (validated)
            $conn->query("UPDATE tblreview SET Status = 1 WHERE Review_ID = $reviewID") or die($conn->error);

            // Redirect back to the validation page
            header("Location: validateReview.php");
            exit();
        }

        // Check if the reject button was clicked
        if (isset($_POST['reject'])) {
            // Get the review ID
            $reviewID = $_POST['reviewID'];

            // Delete the review
            $conn->query("DELETE FROM tblreview WHERE Review_ID = $reviewID") or die($conn->error);

            // Redirect back to the validation page
            header("Location: validateReview.php");
            exit();
        }

    }

?>