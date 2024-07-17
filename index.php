<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Utilities App</title>
    <link rel="stylesheet" href="stylez.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="tasks.php">Tasks</a></li>
            <li><a href="notes.php">Notes</a></li>
            <li><a href="expenses.php">Expenses</a></li>
            <li><a href="pomodoro.php">Pomodoro Timer</a></li>
            <?php if (isset($_SESSION['user'])): ?>
                <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <div class="main-container">
        <h2>Welcome to Utilities</h2>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
