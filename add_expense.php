<?php
include 'config.php';
include 'functions.php';
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $amount = $_POST['amount'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $date = $_POST['date'];
    $userId = $_SESSION['user']['id'];

    if (addExpense($conn, $userId, $amount, $description, $category, $date)) {
        header("Location: expenses.php");
    } else {
        $error = "Failed to add expense!";
    }
}
?>

<?php include 'header.php'; ?>
<div class="task-container">
    <h2>Add Expense</h2>
    <?php if (isset($error)): ?>
        <p class="error"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <form method="POST">
        <div class="form-group-amount">
            <input type="number"  name="amount" placeholder="Amount" required>
        </div>
        <div class="form-group">
            <input type="text" name="description" placeholder="Description" required>
        </div>
        <div class="form-group">
            <input type="text" name="category" placeholder="Category" required>
        </div>
        <div class="form-group">
            <input type="date" name="date" required>
        </div>
        <button type="submit" class="button">Add Expense</button>
    </form>
</div>
<?php include 'footer.php'; ?>
