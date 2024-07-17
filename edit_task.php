<?php
include 'config.php';
include 'functions.php';
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$userId = $_SESSION['user']['id'];
$taskId = $_GET['id'];
$conn = connectDatabase();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];
    $priority = $_POST['priority'];

    $stmt = $conn->prepare("UPDATE tasks SET title = ?, description = ?, due_date = ?, priority = ? WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ssssii", $title, $description, $due_date, $priority, $taskId, $userId);

    if ($stmt->execute()) {
        header("Location: tasks.php");
        exit();
    } else {
        $error = "Error updating task.";
    }
}

$stmt = $conn->prepare("SELECT * FROM tasks WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $taskId, $userId);
$stmt->execute();
$result = $stmt->get_result();
$task = $result->fetch_assoc();

closeDatabase($conn);

if (!$task) {
    header("Location: index.php");
    exit();
}
?>

<?php include 'header.php'; ?>
<div class="task-container">
    <h2>Edit Task</h2>
    <?php if (isset($error)) echo "<p>$error</p>"; ?>
    <form method="post">
        <div class="tasks">
        <div>
            <label>Title</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($task['title']); ?>" required>
        </div>
        <div>
            <label>Description</label>
            <textarea name="description" required><?php echo htmlspecialchars($task['description']); ?></textarea>
        </div>
        <div>
            <label>Due Date</label>
            <input type="date" name="due_date" value="<?php echo htmlspecialchars($task['due_date']); ?>" required>
        </div>
        <div>
            <label>Priority</label>
            <select name="priority" required>
                <option value="Low" <?php if ($task['priority'] == 'Low') echo 'selected'; ?>>Low</option>
                <option value="Medium" <?php if ($task['priority'] == 'Medium') echo 'selected'; ?>>Medium</option>
                <option value="High" <?php if ($task['priority'] == 'High') echo 'selected'; ?>>High</option>
            </select>
        </div>
        </div>
        <div>
            <button type="Update" class="button">Update task</button>
        </div>
    </form>
</div>
<?php include 'footer.php'; ?>
