<?php
include 'config.php';
include 'functions.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (registerUser($conn, $username, $password)) {
        header("Location: login.php");
    } else {
        $error = "Registration failed!";
    }
}
?>

<?php include 'header.php'; ?>
<div class="gen-container">
    <h2>Register</h2>
    <?php if (isset($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="POST" class="register-form">
        <div class="form-group">
            <input type="text" name="username" class="user" placeholder="Username" required>
        </div>
        <div class="form-group">
            <input type="password" name="password" class="pass" placeholder="Password" required>
        </div>
        <button type="submit" class="user-button">Register</button>
    </form>
</div>
<?php include 'footer.php'; ?>
