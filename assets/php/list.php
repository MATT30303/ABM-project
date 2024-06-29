<?php 
include "./conection.php";
$data = [];
$searchTerm = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchTerm = trim($_POST['searchTerm']);

    if (empty($searchTerm)) {
        $sql = "SELECT * FROM personas";
        $result = $pdo->query($sql);
        
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
    } else {
        if (is_numeric($searchTerm)) {
            $sql = $pdo->prepare("SELECT * FROM personas WHERE Id = :id");
            $sql->bindParam(":id", $searchTerm, PDO::PARAM_INT);
        } else {
            $sql = $pdo->prepare("SELECT * FROM personas WHERE nombre LIKE :nombre");
            $likeName = "%$searchTerm%";
            $sql->bindParam(":nombre", $likeName);
        }
        
        $sql->execute();
        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="/assets/css/lista.css" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;0,700;1,400&display=swap"
    rel="stylesheet">


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
            <input type="text" name="searchTerm" placeholder="ID // Nombre" class="search"
                value="<?php echo htmlspecialchars($name ?? ''); ?>" />
            <button type="submit" class="button">Obtener lista</button>
            <a href="/landing.html" class="button">Home</a>
        </form>

        <div id="lista" class="lista">
            <table>
                <tr class="titulos">
                    <td>ID</td>
                    <td>Nombre</td>
                    <td>Apellido</td>
                    <td>DNI</td>
                    <td>Producto</td>
                    <td>Color</td>
                    <td>Precio</td>
                    <td>Estado</td>
                    <td class="acciones">Acciones</td>
                </tr>
                <tbody>

                    <?php foreach ($data as $item): ?>
                    <tr class="list-row">
                        <td><?php echo htmlspecialchars($item['Id'])?></td>
                        <td><?php echo htmlspecialchars($item['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($item['apellido']); ?></td>
                        <td><?php echo htmlspecialchars($item['dni']); ?></td>
                        <td><?php echo htmlspecialchars($item['producto']); ?></td>
                        <td><?php echo htmlspecialchars($item['color']); ?></td>
                        <td>$<?php echo htmlspecialchars($item['precio']); ?></td>
                        <td><?php echo htmlspecialchars($item['estado']); ?></td>
                        <td class="botones">
                            <form method="post" action="/assets/php/modify.php" class="form">
                                <input type="hidden" name="id" value='<?php echo $item['Id']; ?>' />
                                <button type="submit" class="button">Modificar</button>
                            </form>
                            <form method="post" action="/assets/php/delete.php" class="form">
                                <input type="hidden" name="id" value='<?php echo $item['Id']; ?>' />
                                <button type="submit" class="button">Borrar</button>
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