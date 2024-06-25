<?php
// Include the database connection file
include 'conection.php';

if (isset($_POST['id'])) {
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
  echo '<script type="text/javascript">
  alert("No se recibio una ID");
  window.location.href = "list.php";
</script>';
}
?>