<?php
include 'header.php';

// Fetch validated reviews from the database
$result = $conn->query("SELECT * FROM tblreview WHERE Status = 1") or die($mysqli->error);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reviews</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        .container {
            padding: 20px;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .review-box {
            width: 400px;
            margin-bottom: 20px;
            background-color: #f5f5f5;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            word-wrap: break-word;
        }

        .book-title {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .username {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .review-content {
            margin-top: 10px;
        }

        .review-text {
            font-weight: bold;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Reviews</h2>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Fetch book details for the review
            $bookID = $row['Book_Key'];
            $bookResult = $conn->query("SELECT * FROM tblbook WHERE Book_Key = $bookID") or die($conn->error);
            $book = $bookResult->fetch_assoc();

            echo '<div class="review-box">';
            echo '<p class="book-title"><strong>Book Title:</strong> ' . $book['Title'] . '</p>';
            echo '<p class="username"><strong>Username:</strong> ' . $row['Username'] . '</p>';
            echo '<div class="review-content">';
            echo '<p class="review-text"><strong>Review:</strong></p>';
            echo '<p>' . $row['Review'] . '</p>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<p>No reviews available.</p>';
    }
    ?>
</div>

<?php require_once 'footer.php'; ?>

</body>
</html>
