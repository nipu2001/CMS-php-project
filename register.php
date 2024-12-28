<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Link to your external stylesheet -->
    <style>
        body {
            font-family: Arial, sans-serif; /* Set a default font */
            background-color: #f4f4f4; /* Light background color */
            margin: 0; /* Remove default margin */
            padding: 20px; /* Add some padding */
        }

        .container {
            max-width: 600px; /* Set a max width for the form */
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
        input[type="email"],
        select {
            width: 100%; /* Full width */
            padding: 10px; /* Padding inside inputs */
            margin-bottom: 15px; /* Space below inputs */
            border: 1px solid #ccc; /* Light border */
            border-radius: 4px; /* Rounded corners */
            box-sizing: border-box; /* Include padding in width */
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        select:focus {
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
    </style>
</head>
<body>
    <?php include "header.php"; ?>
    <div class="container">
        <h2>Register</h2>
        <form method="POST">
            <label for="name">Name:</label>
            <input type="text" name="name" required>

            <label for="email">Email:</label>
            <input type="email" name="email" required>

            <label for="organization">Organization:</label>
            <input type="text" name="organization" required>

            <label for="role">Role:</label>
            <select name="role" required>
                <option value="participant">Participant</option>
                <option value="admin">Admin</option>
            </select>

            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>