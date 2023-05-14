<?php

session_start();
        // End the user's session
        session_destroy();
        header("Location: login.php");
        exit();
?>
