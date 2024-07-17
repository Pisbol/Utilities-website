<?php
include 'config.php';
include 'functions.php';
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $amount = $_POST['amount'];
    $category = $_POST['category'];
    $date = $_POST['date'];
    $userId = $_SESSION['user']['id'];

    if (addExpense($conn, $userId, $title, $amount, $category, $date)) {
        header("Location: expenses.php");
        exit();
    } else {
        $error = "Failed to add expense!";
    }
}
?>

<?php include 'header.php'; ?>

<div class="expense-container">
    <h2>Add Expense</h2>
    <?php if (isset($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="POST">
        <div class="form-group">
            <input type="text" name="title" placeholder="Expense Title" required>
        </div>
        <div class="form-group">
            <input type="number" step="0.01" name="amount" placeholder="Amount" required>
        </div>
        <div class="form-group">
            <input type="text" name="category" placeholder="Category" required>
        </div>
        <div class="form-group">
            <input type="date" name="date" required>
        </div>
        <button type="submit" class="add-button">Add Expense</button>
    </form>
    <a href="expenses.php" class="go-back">Go Back</a>
</div>

<?php include 'footer.php'; ?>
