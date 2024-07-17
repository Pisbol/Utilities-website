<?php
// Function to connect to the database
function connectDatabase() {
    // Your database connection code
    $conn = new mysqli("localhost", "gellena", "potpot16", "utilities");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

// Function to register a new user
function registerUser($conn, $username, $password) {
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $passwordHash);
    return $stmt->execute();
}

// Function to login a user
function loginUser($conn, $username, $password) {
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            return $user;
        }
    }
    return false;
}

// Function to add a task
function addTask($conn, $userId, $title, $description, $due_date, $priority) {
    $stmt = $conn->prepare("INSERT INTO tasks (user_id, title, description, due_date, priority) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $userId, $title, $description, $due_date, $priority);
    return $stmt->execute();
}

// Function to fetch tasks for a user
function getTasks($conn, $userId) {
    $stmt = $conn->prepare("SELECT * FROM tasks WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    return $stmt->get_result();
}

// Function to add an expense
function addExpense($conn, $userId, $amount, $description, $category, $date) {
    $stmt = $conn->prepare("INSERT INTO expenses (user_id, amount, description, category, date) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("idsss", $userId, $amount, $description, $category, $date);
    return $stmt->execute();
}

// Function to fetch expenses for a user
function getExpenses($conn, $userId) {
    $stmt = $conn->prepare("SELECT * FROM expenses WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    return $stmt->get_result();
}

// Function to add a note
function addNote($conn, $userId, $title, $content) {
    $stmt = $conn->prepare("INSERT INTO notes (user_id, title, content) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $userId, $title, $content);
    return $stmt->execute();
}

// Function to fetch notes for a user
function getNotes($conn, $userId) {
    $stmt = $conn->prepare("SELECT * FROM notes WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    return $stmt->get_result();
}

// Function to delete a note by ID for a specific user
function deleteNoteById($conn, $userId, $noteId) {
    $sql = "DELETE FROM notes WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $noteId, $userId);
    return $stmt->execute();
}

// Function to delete a task by ID for a specific user
function deleteTaskById($conn, $userId, $taskId) {
    $sql = "DELETE FROM tasks WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $taskId, $userId);
    return $stmt->execute();
}

// Function to delete an expense by ID for a specific user
function deleteExpenseById($conn, $userId, $expenseId) {
    $sql = "DELETE FROM expenses WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $expenseId, $userId);
    return $stmt->execute();
}

// Function to close the database connection
function closeDatabase($conn) {
    $conn->close();
}
?>
