<?php
include './conection.php';
try {
    if (isset($_POST['submit'])) {
        $file = $_FILES['file']['tmp_name'];

        if (($archivo = fopen($file, "r")) !== FALSE) {
            $pdo->beginTransaction();
            $stmt = $pdo->prepare("INSERT INTO personas (nombre, apellido, dni, producto, color, precio, estado) VALUES (?, ?, ?, ?, ?, ?, ?)");

            while (($data = fgetcsv($archivo, 1000, ",")) !== FALSE) {
                if (count($data) == 7) {
                    $stmt->execute($data);
                } else {
                    echo "Error: " . implode(",", $data);
                }
            }

            $pdo->commit();
            fclose($archivo);
            echo '<script type="text/javascript">
            confirm("datos insertados correctamente!");
            window.location.href = "/landing.html";
          </script>';
        } else {
            echo '<script type="text/javascript">
            confirm("error al leer el archivo!");
            window.location.href = "/landing.html";
          </script>';
        }
    }
} catch (PDOException $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    echo "Error: " . $e->getMessage();
}

$pdo = null;
?>

<!<!DOCTYPE html>
    <html>
    <link rel="stylesheet" href="/assets/css/upload.css" />

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Upload</title>
    </head>

    <body>
        <div class="container">
            <form action="" method="post" enctype="multipart/form-data">
                <span>Seleccione archivo</span>
                <input type="file" name="file" class="file" />
                <div class="back-upload">
                    <a href="/landing.html">Home</a>
                    <button type="submit" name="submit">Subir</button>
                </div>
            </form>
        </div>
    </body>

    </html>