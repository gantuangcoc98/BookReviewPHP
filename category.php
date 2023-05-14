<?php
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

// Check if category key is provided in the URL
if (isset($_GET['Category_Key'])) {
    $categoryKey = $_GET['Category_Key'];

    // Retrieve category name
    $categorySql = "SELECT Category_Name FROM tblcategory WHERE Category_Key = ?";
    $stmt = $conn->prepare($categorySql);
    $stmt->bind_param("i", $categoryKey);
    $stmt->execute();
    $categoryResult = $stmt->get_result();
    $categoryRow = $categoryResult->fetch_assoc();
    $categoryName = $categoryRow['Category_Name'];

    // Retrieve books for the selected category using a join between tblbook and tblcategory
    $booksSql = "SELECT b.* FROM tblbook b
                 JOIN tblcategory c ON b.Category_Key = c.Category_Key
                 WHERE c.Category_Key = ?";
    $stmt = $conn->prepare($booksSql);
    $stmt->bind_param("i", $categoryKey);
    $stmt->execute();
    $booksResult = $stmt->get_result();
    $books = $booksResult->fetch_all(MYSQLI_ASSOC);
}

include 'header.php';
?>

<style>
    .book {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    .book:hover {
        text-decoration: underline;
    }
</style>

<div class="container">
    <h2><?php echo $categoryName; ?></h2>

    <div class="books-container">
        <?php
        if (isset($books) && !empty($books)) {
            foreach ($books as $book) {
                echo '<a class="book" href="bookDetails.php?Book_Key=' . $book['Book_Key'] . '">';
                echo '<div>';
                echo '<h3>' . $book['Title'] . '</h3>';
                echo '<p>Author: ' . $book['Authors_Firstname'] . ' ' . $book['Authors_Lastname'] . '</p>';
                // Add more book information here as needed
                echo '</div>';
                echo '</a>';
            }
        } else {
            echo '<p>No books found for this category.</p>';
        }
        ?>
    </div>
</div>

<?php include 'footer.php'; ?>
