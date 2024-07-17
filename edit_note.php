<?php
include 'config.php';
include 'functions.php';
session_start();

// Redirect to login page if user is not logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Redirect to index if note id is not provided
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$userId = $_SESSION['user']['id'];
$noteId = $_GET['id'];
$conn = connectDatabase();

// Handle form submission to update note
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Update the note in the database
    $stmt = $conn->prepare("UPDATE notes SET title = ?, content = ? WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ssii", $title, $content, $noteId, $userId);

    if ($stmt->execute()) {
        // Redirect to notes.php after successful update
        header("Location: notes.php");
        exit();
    } else {
        $error = "Error updating note.";
    }
}

// Retrieve the note details from the database
$stmt = $conn->prepare("SELECT * FROM notes WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $noteId, $userId);
$stmt->execute();
$result = $stmt->get_result();
$note = $result->fetch_assoc();

// Close the database connection
closeDatabase($conn);

// Redirect to index.php if note does not exist or user does not have access
if (!$note) {
    header("Location: index.php");
    exit();
}
?>

<?php include 'header.php'; ?>
<div class="note-container">
    <h2>Edit Note</h2>
    <?php if (isset($error)) echo "<p>$error</p>"; ?>
    <form method="post">
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($note['title']); ?>" required>
        </div>
        <div class="form-group">
            <label>Content</label>
            <textarea name="content" rows="8" required><?php echo htmlspecialchars($note['content']); ?></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="button">Update Note</button>
        </div>
    </form>
</div>
<?php include 'footer.php'; ?>
