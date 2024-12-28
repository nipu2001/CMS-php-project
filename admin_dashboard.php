<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include "inc/header.php"; ?>
    <div class="container">
        <h2>Admin Dashboard</h2>
        <h3>Manage Conference Tracks and Sessions</h3>
        <a href="add_track.php">Add New Track</a>
        <a href="add_session.php">Add New Session</a>
        <div id="sessions"></div>
    </div>
</body>
</html>
