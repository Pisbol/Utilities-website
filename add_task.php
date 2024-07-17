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
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];
    $priority = $_POST['priority'];
    $userId = $_SESSION['user']['id'];

    if (addTask($conn, $userId, $title, $description, $due_date, $priority)) {
        header("Location: tasks.php");
        exit();
    } else {
        $error = "Failed to add task!";
    }
}
?>

<?php include 'header.php'; ?>

<div class="task-container">
    <h2>Add Task</h2>
    <?php if (isset($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="POST">
        <div class="form-group">
            <input type="text" name="title" placeholder="Task Title" required>
        </div>
        <div class="form-group">
            <textarea name="description" placeholder="Task Description"></textarea>
        </div>
        <div class="form-group">
            <input type="date" name="due_date" required>
        </div>
        <div class="form-group">
            <select name="priority" required>
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
                <option value="High">High</option>
            </select>
        </div>
        <button type="submit" class="add-button">Add Task</button>
    </form>
    <a href="tasks.php" class="go-back">Go Back</a>
</div>

<?php include 'footer.php'; ?>
