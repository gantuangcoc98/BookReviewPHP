<?php include 'header.php';
 ?>

<div class="container">
    <form action="validateLogin.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <input type="submit" value="Submit">
    </form>
</div>

<?php include 'footer.php'; ?>
