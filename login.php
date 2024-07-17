<?php
include 'config.php';
include 'functions.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($user = loginUser($conn, $username, $password)) {
        $_SESSION['user'] = $user;
        header("Location: index.php");
    } else {
        $error = "Login failed!";
    }
}
?>

<?php include 'header.php'; ?>
<div class="gen-container">
    <h2>Login</h2>
    <?php if (isset($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="POST" class="login-form">
        <div class="form-group">
            <input type="text" name="username" class="user" placeholder="Username" required>
        </div>
        <div class="form-group">
            <input type="password" name="password" class="pass" placeholder="Password" required>
        </div>
        <button type="submit" class="user-button">Login</button>
    </form>
</div>
<?php include 'footer.php'; ?>
