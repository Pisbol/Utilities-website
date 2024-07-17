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
$notes = getNotes($conn, $userId);
closeDatabase($conn);
?>

<?php include 'header.php'; ?>
<div class="note-container">
    <h2>Your Notes</h2>
    <a href="add_note.php" class="add-button">Add New Note</a>
    <ul class="task-ul">
        <?php foreach ($notes as $note): ?>
            <li class="task-li">
                <h3><?php echo htmlspecialchars($note['title']); ?></h3>
                <p><?php echo htmlspecialchars($note['content']); ?></p>
                <div class="edidele">
                    <a href="edit_note.php?id=<?php echo $note['id']; ?>" class="add-button">Edit</a>
                    <a href="delete.php?type=notes&id=<?php echo $note['id']; ?>&redirect=notes.php" class="add-button">Delete</a>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
<?php include 'footer.php'; ?>
