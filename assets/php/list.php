<?php 
include "./conection.php";
$data = [];
$target = "";
$searchTerm = "";
$sort = "";
$sorting = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchTerm = trim($_POST['searchTerm']);
    if(isset($_POST["target"])){
        $target = $_POST["target"];
    }
    switch ($searchTerm){
        case "":
            $sql = "SELECT * FROM personas";
            $result = $pdo->query($sql);
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }    
            $sort = "DESC"; 
        break;
        case is_numeric($searchTerm):
            $sql = $pdo->prepare("SELECT * FROM personas WHERE Id = :id");
            $sql->bindParam(":id", $searchTerm, PDO::PARAM_INT);   
            $sql->execute();
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            break;
        case (is_string($searchTerm) && $searchTerm !== "ASC" && $searchTerm !== "DESC"):
            $sql = $pdo->prepare("SELECT * FROM personas WHERE nombre LIKE :nombre");
            $name = "%$searchTerm%";
            $sql->bindParam(":nombre", $name);
            $sql->execute();
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
        break;
        case ($searchTerm == "ASC"):
            $sql = $pdo->prepare("SELECT * FROM personas ORDER BY $target ASC");
            $sql->execute();
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            $sort="DESC";
            break;
    
        case ($searchTerm == "DESC"):
            $sql = $pdo->prepare("SELECT * FROM personas ORDER BY $target DESC");
            $sql->execute();
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            $sort="ASC";
            break;
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
        <form method="post" class="search-form">
            <span class="text">Busqueda: </span>
            <input type="text" name="searchTerm" placeholder="ID // Nombre" class="search" value="<?php echo ""; ?>" />
            <button type="submit" class="button">Obtener lista</button>
            <a href="/landing.html" class="button">Home</a>
        </form>

        <div id="lista" class="lista">
            <table>
                <tr class="titulos">
                    <td class="table-id">
                        <form method="post" class="tittle-form" id="id-form">
                            <input type="text" hidden value="<?php echo $sort;?>" name="searchTerm" id="tittle-id">
                            <input type="text" hidden value="<?php echo "Id";?>" name="target">
                            <button type="submit" class="tittle-button" id="submit-id">ID</button>
                        </form>
                    </td>
                    <td>
                        <form method="post" class="tittle-form" id="id-form">
                            <input type="text" hidden value="<?php echo $sort;?>" name="searchTerm" id="tittle-id">
                            <input type="text" hidden value="<?php echo "nombre";?>" name="target">
                            <button type="submit" class="tittle-button" id="submit-id">Nombre</button>
                        </form>
                    </td>
                    <td>
                        <form method="post" class="tittle-form" id="id-form">
                            <input type="text" hidden value="<?php echo $sort;?>" name="searchTerm" id="tittle-id">
                            <input type="text" hidden value="<?php echo "apellido";?>" name="target">
                            <button type="submit" class="tittle-button" id="submit-id">Apellido</button>
                        </form>
                    </td>
                    <td>
                        <form method="post" class="tittle-form" id="id-form">
                            <input type="text" hidden value="<?php echo $sort;?>" name="searchTerm" id="tittle-id">
                            <input type="text" hidden value="<?php echo "dni";?>" name="target">
                            <button type="submit" class="tittle-button" id="submit-id">DNI</button>
                        </form>
                    </td>
                    <td>
                        <form method="post" class="tittle-form" id="id-form">
                            <input type="text" hidden value="<?php echo $sort;?>" name="searchTerm" id="tittle-id">
                            <input type="text" hidden value="<?php echo "producto";?>" name="target">
                            <button type="submit" class="tittle-button" id="submit-id">Producto</button>
                        </form>
                    </td>
                    <td>
                        <form method="post" class="tittle-form" id="id-form">
                            <input type="text" hidden value="<?php echo $sort;?>" name="searchTerm" id="tittle-id">
                            <input type="text" hidden value="<?php echo "color";?>" name="target">
                            <button type="submit" class="tittle-button" id="submit-id">Color</button>
                        </form>
                    </td>
                    <td>
                        <form method="post" class="tittle-form" id="id-form">
                            <input type="text" hidden value="<?php echo $sort;?>" name="searchTerm" id="tittle-id">
                            <input type="text" hidden value="<?php echo "precio";?>" name="target">
                            <button type="submit" class="tittle-button" id="submit-id">Precio</button>
                        </form>
                    </td>
                    <td>
                        <form method="post" class="tittle-form" id="id-form">
                            <input type="text" hidden value="<?php echo $sort;?>" name="searchTerm" id="tittle-id">
                            <input type="text" hidden value="<?php echo "estado";?>" name="target">
                            <button type="submit" class="tittle-button" id="submit-id">Estado</button>
                        </form>
                    </td>
                    <td class="acciones">
                        <button class="tittle-button" id="acciones-button">Acciones</button>
                    </td>
                </tr>
                <tbody class="tableBody">

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

<script src="/assets/js/control.js" defer></script>


</html>