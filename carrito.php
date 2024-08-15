<?php
// Conectar a la base de datos
$servername = "localhost";
$username = "root"; // Cambia esto según tu configuración
$password = ""; // Cambia esto según tu configuración
$dbname = "veterinaria_cll";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Inicializar carrito
session_start();
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}

// Agregar al carrito
if (isset($_POST['action']) && $_POST['action'] == 'add') {
    $id_producto = intval($_POST['id']);
    if (!isset($_SESSION['carrito'][$id_producto])) {
        $_SESSION['carrito'][$id_producto] = 1;
    } else {
        $_SESSION['carrito'][$id_producto]++;
    }
}

// Eliminar del carrito
if (isset($_POST['action']) && $_POST['action'] == 'remove') {
    $id_producto = intval($_POST['id']);
    if (isset($_SESSION['carrito'][$id_producto])) {
        unset($_SESSION['carrito'][$id_producto]);
    }
}

// Modificar cantidad
if (isset($_POST['action']) && $_POST['action'] == 'update') {
    $id_producto = intval($_POST['id']);
    $cantidad = intval($_POST['quantity']);
    if ($cantidad > 0) {
        $_SESSION['carrito'][$id_producto] = $cantidad;
    } else {
        unset($_SESSION['carrito'][$id_producto]);
    }
}

// Mostrar carrito
$total = 0;
$productos = array();
if (!empty($_SESSION['carrito'])) {
    $ids = implode(',', array_keys($_SESSION['carrito']));
    $sql = "SELECT * FROM product_details WHERE id IN ($ids)";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $productos[$row['id']] = $row;
        }
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
        }
        img {
            width: 100px;
        }
        .btn {
            display: inline-block;
            padding: 8px 12px;
            font-size: 14px;
            text-align: center;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            color: #fff;
            text-decoration: none;
            margin: 2px;
        }
        .btn-primary {
            background-color: #007bff;
        }
        .btn-danger {
            background-color: #dc3545;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        .total {
            font-size: 18px;
            font-weight: bold;
        }
        .back-link {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Carrito</h1>
    <table>
        <tr>
            <th>Producto</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Total</th>
            <th>Acción</th>
        </tr>
        <?php if (!empty($productos)): ?>
            <?php foreach ($productos as $producto): ?>
                <tr>
                    <td><img src="img/posters/<?php echo htmlspecialchars($producto['image']); ?>" alt="<?php echo htmlspecialchars($producto['name']); ?>"></td>
                    <td><?php echo htmlspecialchars($producto['name']); ?></td>
                    <td><?php echo number_format($producto['price'], 2); ?> USD</td>
                    <td>
                        <form action="carrito.php" method="post" style="display:inline;">
                            <input type="number" name="quantity" value="<?php echo $_SESSION['carrito'][$producto['id']]; ?>" min="1" style="width: 60px; text-align: center;">
                            <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
                            <input type="hidden" name="action" value="update">
                            <button type="submit" class="btn btn-primary">Modificar</button>
                        </form>
                    </td>
                    <td><?php echo number_format($producto['price'] * $_SESSION['carrito'][$producto['id']], 2); ?> USD</td>
                    <td>
                        <form action="carrito.php" method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
                            <input type="hidden" name="action" value="remove">
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
                <?php $total += $producto['price'] * $_SESSION['carrito'][$producto['id']]; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">El carrito está vacío.</td>
            </tr>
        <?php endif; ?>
    </table>
    <h2 class="total">Total: <?php echo number_format($total, 2); ?> USD</h2>
    <a href="mascotas.php" class="back-link">Volver a la tienda</a>
</body>
</html>
