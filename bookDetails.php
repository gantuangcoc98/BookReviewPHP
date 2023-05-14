<?php
include 'header.php';

// Retrieve the Book_Key from the query parameters
$bookKey = $_GET['Book_Key'];

// Fetch book details from the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookreview";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare the SQL statement to fetch book details
$sql = "SELECT b.*, c.Category_Name FROM tblbook b
        JOIN tblcategory c ON b.Category_Key = c.Category_Key
        WHERE b.Book_Key = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $bookKey);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Fetch the book details
    $book = $result->fetch_assoc();

    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <style>
            body {
                background-color: skyblue;
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
            }

            .container {
                display: flex;
                flex-direction: column;
                align-items: center;
                min-height: 100vh;
            }

            .book-details {
                background-color: #fff;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            .book-details h2 {
                text-align: center;
                font-weight: bold;
            }

            .book-details p {
                font-weight: bold;
            }

            .review-container {
                margin-top: 20px;
            }

            .review {
                background-color: #f9f9f9;
                padding: 10px;
                border-radius: 5px;
                margin-bottom: 10px;
            }

            .username {
                font-weight: bold;
            }

            .review-title {
                font-weight: bold;
                margin-left: 5px;
            }

            .rating {
                font-weight: bold;
                color: blue;
                display: inline-block;
                margin-left: 5px;
            }

            .review-date {
                font-size: 0.8em;
                color: gray;
                margin-top: 5px;
            }

            .add-review-button {
                margin-top: 20px;
                padding: 10px 20px;
                background-color: #4CAF50;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }

            .add-review-button:hover {
                background-color: #45a049;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="book-details">
                <h2><?php echo $book['Title']; ?></h2>
                <p><strong>Category:</strong> <?php echo $book['Category_Name']; ?></p>
                <p><strong>ISBN:</strong> <?php echo $book['ISBN']; ?></p>
                <p><strong>Author:</strong> <?php echo $book['Authors_Firstname'] . ' ' . $book['Authors_Lastname']; ?></p>
                <p><strong>Description:</strong> <?php echo $book['description']; ?></p>
            </div>

            <div class="review-container">
               
            <?php
}
// Prepare the SQL statement to fetch reviews
$sql = "SELECT * FROM tblreview WHERE Book_Key = ? AND Status = 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $bookKey);
$stmt->execute();
$result = $stmt->get_result();

// Fetch the reviews
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Display the review details
        echo '<div class="review">';
        echo '<p><strong>Username: </strong>' . $row['Username'] . '</p>';
        echo '<p><strong>Title: </strong>' . $row['Title'] . '</p>';
        echo '<p><strong>Review: </strong>' . $row['Review'] . '</p>';
        echo '<p><strong>Rating: </strong>' . $row['Rating'] . '</p>';
        echo '<p><strong>Date, Time: </strong>' . $row['Date'] . ', ' . $row['Time'] . '</p>';
        echo '</div>';
    }
} else {
    
}


// Display the "Add a review" button if the user is logged in
if (isset($_SESSION['username'])) {
    echo '<a href="addReview.php?Book_Key=' . $bookKey . '" class="add-review-button">Add a Review</a>';
}

include 'footer.php';

echo '</div></body></html>';

$stmt->close();
$conn->close();
include 'footer.php';
?>
