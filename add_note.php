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
    $content = $_POST['content'];
    $userId = $_SESSION['user']['id'];

    if (addNote($conn, $userId, $title, $content)) {
        header("Location: notes.php");
    } else {
        $error = "Failed to add note!";
    }
}
?>

<?php include 'header.php'; ?>
<div class="note-container">
    <h2>Add Note</h2>
    <?php if (isset($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="POST">
        <div class="form-group">
            <input type="text" name="title" placeholder="Note Title" required>
        </div>
        <div class="form-group">
            <textarea name="content" placeholder="Note Content" required></textarea>
        </div>
        <button type= "submit" class="add-button">Add Task</button>
        <a href = "notes.php" class="go-back">Go back</a>
    </form>
</div>
<?php include 'footer.php'; ?>
