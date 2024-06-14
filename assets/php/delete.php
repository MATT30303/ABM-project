<?php
// Include the database connection file
include './conection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Prepare and execute the delete query
    $sql = $pdo->prepare("DELETE FROM personas WHERE id = :id");
    $sql->bindParam(":id", $id,PDO::PARAM_INT);
    
    if ($sql->execute()) {
        echo '<script type="text/javascript">
        alert("datos eliminados correctamente");
        window.location.href = "list.php";
      </script>';
    } else {
        echo '<script type="text/javascript">
        alert("error al eliminar los datos");
        window.location.href = "list.php";
      </script>';
    }
    
    $sql=null;
} else {
    echo "No ID received.";
}

$conn->close();

// Redirect back to the main page
header("Location: list.php");
exit();
?>