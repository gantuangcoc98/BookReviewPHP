<?php
include 'header.php';


if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

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

$sql = "SELECT userType FROM tbluseraccount WHERE Username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$userType = $row['userType'];


?>

<div class="container">
    <div class="hello">
        <h2>
            <?php
            switch ($userType) {
                case 0:
                    echo "Hello, User " . $_SESSION['username'];
                    break;
                case 1:
                    echo "Hello, Moderator " . $_SESSION['username'];
                    break;
                case 2:
                    echo "Hello, Admin " . $_SESSION['username'];
                    break;
            }
            ?>
        </h2>
    </div>

    <div class="buttons">
        <?php
        switch ($userType) {
            case 0:
                echo '<button class="profile-button" onclick="location.href=\'editProfile.php\'">Edit Profile</button>';
                break;
            case 1:
                echo '<button class="profile-button" onclick="location.href=\'validateReview.php\'">Validate Reviews</button>';
                break;
            case 2:
                echo '<button class="profile-button" onclick="location.href=\'addBook.php\'">Manage Books</button>';
                echo '<button class="profile-button" onclick="location.href=\'addAdmin.php\'">Manage Admins</button>';
                echo '<button class="profile-button" onclick="location.href=\'addModerator.php\'">Manage Moderators</button>';
                echo '<button class="profile-button" onclick="location.href=\'addCategory.php\'">Manage Categories</button>';
                break;
        }
        ?>
        <button class="logout-button" onclick="location.href='logout.php'">Logout</button>
    </div>
</div>

<?php include 'footer.php'; ?>

<?php
$conn->close();
?>
