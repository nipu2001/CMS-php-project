<?php
session_start();
include "DB_connection.php";
include "phpqrcode/phpqrcode/qrlib.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect user input
    $name = $_POST['name'];
    $email = $_POST['email'];
    $organization = $_POST['organization'];

    // Validate input
    if (!empty($name) && !empty($email) && !empty($organization)) {
        $query = $conn->prepare("INSERT INTO Participants (name, email, organization) VALUES (?, ?, ?)");
        $query->bind_param("sss", $name, $email, $organization);

        if ($query->execute()) {
            $participant_id = $conn->insert_id;
            $qrData = "Participant ID: " . $participant_id;
            $qrFile = "qrcodes/participant_$participant_id.png";

            // Generate QR code
            if (!is_dir("qrcodes")) {
                mkdir("qrcodes");
            }
            QRcode::png($qrData, $qrFile);

            // Update participant record with QR code path
            $conn->query("UPDATE Participants SET QR_code = '$qrFile' WHERE participant_id = $participant_id");

            $_SESSION['participant_id'] = $participant_id; // Set session
            $_SESSION['role'] = 'participant'; // Assign role
            echo "<script>alert('Registration successful! QR Code generated.'); window.location.href='participant_dashboard.php';</script>";
        } else {
            echo "<script>alert('Error during registration: " . $conn->error . "');</script>";
        }
    } else {
        echo "<script>alert('All fields are required.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Register</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif; /* Set a default font */
            background-color: #f4f4f4; /* Light background color */
            margin: 0; /* Remove default margin */
            padding: 20px; /* Add some padding */
        }

        .form-container {
            max-width: 400px; /* Set a max width for the form */
            margin: auto; /* Center the form */
            background: white; /* White background for the form */
            padding: 20px; /* Padding inside the form */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }

        h2 {
            text-align: center; /* Center the heading */
            color: #333; /* Darker color for the heading */
        }

        label {
            display: block; /* Make labels block elements */
            margin-bottom: 5px; /* Space between label and input */
            color: #555; /* Darker color for labels */
        }

        input[type="text"],
        input[type="email"] {
            width: 100%; /* Full width */
            padding: 10px; /* Padding inside inputs */
            margin-bottom: 15px; /* Space below inputs */
            border: 1px solid #ccc; /* Light border */
            border-radius: 4px; /* Rounded corners */
            box-sizing: border-box; /* Include padding in width */
        }

        input[type="text"]:focus,
        input[type="email"]:focus {
            border-color: #007BFF; /* Change border color on focus */
            outline: none; /* Remove default outline */
        }

        button {
            background-color: #007BFF; /* Button color */
            color: white; /* Text color */
            border: none; /* Remove border */
            padding: 10px 15px; /* Padding inside button */
            border-radius: 4px; /* Rounded corners */
            cursor: pointer; /* Pointer cursor on hover */
            width: 100%; /* Full width */
            font-size: 16px; /* Font size */
        }

        button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }

        p {
            text-align: center; /* Center the paragraph */
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Participant Registration</h2>
        <form action="login.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>

            <label for="organization">Organization:</label>
            <input type="text" name="organization" id="organization" required>

            <button type="submit">Register</button>
        </form>
        <p>Already registered? <a href="participant_dashboard.php">Go to Dashboard</a></p>
    </div>
</body>
</html>
