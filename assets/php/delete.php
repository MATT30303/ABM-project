<?php
// Include the database connection file
include './realconection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Prepare and execute the delete query
    $sql = $conn->prepare("DELETE FROM personas WHERE id = ?");
    $sql->bind_param("i", $id);
    
    if ($sql->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    
    $sql->close();
} else {
    echo "No ID received.";
}

$conn->close();

// Redirect back to the main page
header("Location: list.php");
exit();
?>