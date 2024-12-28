<?php
include "db_connection.php";

$result = $conn->query("SELECT s.title AS session_title, s.time, s.venue, t.title AS track_title 
                        FROM Sessions s 
                        JOIN Tracks t ON s.track_id = t.track_id");

$schedule = [];
while ($row = $result->fetch_assoc()) {
    $schedule[] = $row;
}
echo json_encode($schedule);
?>
