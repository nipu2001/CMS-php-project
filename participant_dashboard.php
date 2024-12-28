<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'participant') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Participant Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include "header.php"; ?>
    <div class="container">
        <h2>Welcome, <?= isset($_SESSION['name']) ? $_SESSION['name'] : 'Guest' ?></h2>
        <h3>Your Conference Schedule</h3>
        <div id="schedule"></div>
    </div>
    <script>
        fetch('get_schedule.php')
            .then(response => response.json())
            .then(data => {
                const scheduleDiv = document.getElementById('schedule');
                data.forEach(session => {
                    const sessionDiv = document.createElement('div');
                    sessionDiv.innerHTML = `
                        <h4>${session.track_title} - ${session.session_title}</h4>
                        <p>Time: ${session.time}</p>
                        <p>Venue: ${session.venue}</p>
                    `;
                    scheduleDiv.appendChild(sessionDiv);
                });
            });
    </script>
</body>
</html>

