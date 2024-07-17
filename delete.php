<?php
include 'config.php';
include 'functions.php'; // Ensure your functions for database operations are included

session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Check if ID parameter is set in URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $userId = $_SESSION['user']['id'];

    // Determine which table to delete from based on a parameter (e.g., type=notes/tasks/expenses)
    if (isset($_GET['type'])) {
        $type = $_GET['type'];

        switch ($type) {
            case 'notes':
                $result = deleteNoteById($conn, $userId, $id);
                break;
            case 'tasks':
                $result = deleteTaskById($conn, $userId, $id);
                break;
            case 'expenses':
                $result = deleteExpenseById($conn, $userId, $id);
                break;
            default:
                $result = false;
                break;
        }

        if ($result) {
            header("Location: {$_GET['redirect']}");
            exit();
        } else {
            $error = "Failed to delete item!";
        }
    }
}
?>

<!-- Your HTML or PHP content -->
<?php include 'header.php'; ?>
<div class="container">
    <h2>Delete Item</h2>
    <?php if (isset($error)): ?>
        <p><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <!-- Display confirmation or error message -->
</div>
<?php include 'footer.php'; ?>
