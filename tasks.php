<?php
include 'config.php';
include 'functions.php';
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user']['id'];
$conn = connectDatabase();
$tasks = getTasks($conn, $userId);
closeDatabase($conn);
?>

<?php include 'header.php'; ?>
<div class="task-container">
    <h2>Your Tasks</h2>
    <a href="add_task.php" class="add-button">Add New Task</a>
    <ul class="task-ul">
        <?php while ($task = $tasks->fetch_assoc()): ?>
            <li class="task-li">
                <b><?php echo htmlspecialchars($task['title']); ?></b><br>
                <?php echo "<b>Description:</b> ", htmlspecialchars($task['description']); ?><br>
                <b>Due:</b> <?php echo htmlspecialchars($task['due_date']); ?><br>
                <b>Priority:</b> <?php echo htmlspecialchars($task['priority']); ?>
                <div class="edidele">
                    <a href="edit_task.php?id=<?php echo $task['id']; ?>" class="add-button">Edit</a> 
                    <a href="delete.php?type=tasks&id=<?php echo $task['id']; ?>&redirect=tasks.php" class="add-button">Delete</a>
                </div>
            </li>
        <?php endwhile; ?>
    </ul>
</div>
<?php include 'footer.php'; ?>
