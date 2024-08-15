<?php
// Conectar a la base de datos
function get_db_connection() {
    $servername = "localhost";
    $username = "root"; // Cambia esto según tu configuración
    $password = ""; // Cambia esto según tu configuración
    $dbname = "veterinaria_cll";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
    return $conn;
}

// Inicializar el carrito
function initialize_cart() {
    session_start();
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = array();
    }
}

// Agregar un producto al carrito
function add_to_cart($product_id) {
    initialize_cart();
    $product_id = intval($product_id);
    if (!isset($_SESSION['carrito'][$product_id])) {
        $_SESSION['carrito'][$product_id] = 1;
    } else {
        $_SESSION['carrito'][$product_id]++;
    }
}

// Eliminar un producto del carrito
function remove_from_cart($product_id) {
    initialize_cart();
    $product_id = intval($product_id);
    if (isset($_SESSION['carrito'][$product_id])) {
        unset($_SESSION['carrito'][$product_id]);
    }
}

// Obtener productos del carrito
function get_cart_products() {
    initialize_cart();
    $products = array();
    if (!empty($_SESSION['carrito'])) {
        $ids = implode(',', array_keys($_SESSION['carrito']));
        $conn = get_db_connection();
        $sql = "SELECT * FROM product_details WHERE id IN ($ids)";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $products[$row['id']] = $row;
            }
        }
        $conn->close();
    }
    return $products;
}

// Calcular el total del carrito
function calculate_cart_total() {
    $total = 0;
    $products = get_cart_products();
    foreach ($products as $product) {
        $total += $product['price'] * $_SESSION['carrito'][$product['id']];
    }
    return $total;
}
?>
