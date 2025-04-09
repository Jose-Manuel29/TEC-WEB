<?php
    include_once __DIR__.'/database.php';

    // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
    $data = array();
    
    // SE VERIFICA HABER RECIBIDO EL TÉRMINO DE BÚSQUEDA
    if (isset($_POST['search'])) {
        $search = $_POST['search'];
    
        // SE REALIZA LA QUERY DE BÚSQUEDA FLEXIBLE
        if ($result = $conexion->query("SELECT * FROM productos WHERE id LIKE '%{$search}%'OR nombre LIKE '%{$search}%' OR marca LIKE '%{$search}%' OR detalles LIKE '%{$search}%'")) {
            $rows = $result->fetch_all(MYSQLI_ASSOC);
    
            if (!empty($rows)) {
                foreach ($rows as $row) {
                    $producto = array();
                    foreach ($row as $key => $value) {
                        $producto[$key] = $value; // utf8_encode($value);
                    }
                    $data[] = $producto;
                }
            }
            $result->free();
        } else {
            die('Query Error: '.mysqli_error($conexion));
        }
    }
    
    $conexion->close();
    
        
        // SE HACE LA CONVERSIÓN DE ARRAY A JSON
        echo json_encode($data, JSON_PRETTY_PRINT);
    ?>