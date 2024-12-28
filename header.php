<link rel="stylesheet" href="css/style.css">
<nav>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><a href="register.php">Register</a></li>
        <?php if (isset($_SESSION['role'])) { ?>
            <li><a href="logout.php">Logout</a></li>
        <?php } ?>
    </ul>
</nav>
