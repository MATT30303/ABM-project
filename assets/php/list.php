<?php 
include "./conection.php";
$data = [];
$name = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);

    if (empty($name)) {
        $sql = "SELECT * FROM personas";
        $result = $pdo->query($sql);
        
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
    } else {
        $sql = $pdo->prepare("SELECT * FROM personas WHERE nombre LIKE :nombre");
        $likeName = "%$name%";
        $sql->bindParam(":nombre", $likeName);
        $sql->execute();
        $data = array();
        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
    }

    if (!empty($name)) {
        $sql = null;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="/assets/css/lista.css" />

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>lista</title>
</head>

<body>
    <div class="container">
        <span class="lista-text">Pedidos</span>
        <form method="post">
            <span class="text">Busqueda: </span>
            <input type="text" name="name" placeholder="nombre" class="search"
                value="<?php echo htmlspecialchars($name ?? ''); ?>" />
            <button type="submit" class="button">Obtener lista</button>
            <a href="/landing.html" class="button">Home</a>
        </form>

        <div id="lista" class="lista">
            <table>
                <tr class="titulos">
                    <td>Nombre</td>
                    <td>Apellido</td>
                    <td>DNI</td>
                    <td>Producto</td>
                    <td>Color</td>
                    <td>Fecha</td>
                    <td>Precio</td>
                    <td>Estado</td>
                    <td>Acciones</td>
                </tr>
                <tbody>

                    <?php foreach ($data as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($item['apellido']); ?></td>
                        <td><?php echo htmlspecialchars($item['dni']); ?></td>
                        <td><?php echo htmlspecialchars($item['producto']); ?></td>
                        <td><?php echo htmlspecialchars($item['color']); ?></td>
                        <td><?php echo htmlspecialchars($item['fecha']); ?></td>
                        <td>$<?php echo htmlspecialchars($item['precio']); ?></td>
                        <td><?php echo htmlspecialchars($item['estado']); ?></td>
                        <td class="botones">
                            <form method="post" action="/assets/php/modify.php" class="form">
                                <input type="hidden" name="id" value='<?php echo $item['Id']; ?>' />
                                <button type="submit" class="button">Modify</button>
                            </form>
                            <form method="post" action="/assets/php/delete.php" class="form">
                                <input type="hidden" name="id" value='<?php echo $item['Id']; ?>' />
                                <button type="submit" class="button">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>