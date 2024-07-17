<?php
include 'config.php';
include 'functions.php';
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user']['id'];
$expenses = getExpenses($conn, $userId);
?>

<?php include 'header.php'; ?>
<div class="gen-container">
    <h2>Your Expenses</h2>
    <a href="add_expense.php" class="add-button">Add New Expense</a>
    <ul class="task-ul">
        <?php while ($expense = $expenses->fetch_assoc()): ?>
            <li class="task-li">
                <p><b>Amount:</b> $<?php echo htmlspecialchars($expense['amount']); ?></p>
                <p><b>Description:</b> <?php echo htmlspecialchars($expense['description']); ?></p>
                <p><b>Category:</b> <?php echo htmlspecialchars($expense['category']); ?></p>
                <p><b>Date:</b> <?php echo htmlspecialchars($expense['date']); ?></p>
                <a href="edit_expense.php?id=<?php echo $expense['id']; ?>" class="add-button">Edit</a>
                <a href="delete.php?type=expenses&id=<?php echo $expense['id']; ?>&redirect=expenses.php" class="add-button">Delete</a>
            </li>
        <?php endwhile; ?>
    </ul>
</div>
<?php include 'footer.php'; ?>
