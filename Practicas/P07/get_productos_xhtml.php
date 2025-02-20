<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">

<?php

// Verificar si el parámetro "tope" está presente en la URL
if(isset($_GET['tope'])) {
    $tope = $_GET['tope'];
} else {
    die('Parámetro "tope" no detectado...');
}

if (!empty($tope)) {
    // Conexión a la base de datos
    @$link = new mysqli('localhost', 'root', 'jmanuel29', 'marketzone');

    // Verificar la conexión
    if ($link->connect_errno) {
        die('Falló la conexión: '.$link->connect_error.'<br/>');
    }

    // Asegurar que la conexión use UTF-8
    $link->set_charset('utf8');


    $query = "SELECT * FROM productos WHERE unidades <= $tope";
    if ($result = $link->query($query)) {
        // Iniciar el documento XHTML
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<!DOCTYPE html>';
        echo '<html xmlns="http://www.w3.org/1999/xhtml">';
        echo '<head>';
        echo '<title>Listado de Productos</title>';
        echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
        echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">';
        echo '</head>';
        echo '<body>';
        
        // Sección de título con Bootstrap
        echo '<div class="container mt-5">';
        echo '<h3 class="text-center">Productos con Unidades Menores o Iguales a '.$tope.'</h3>';
        echo '<br />';

        // Verificación y mostrar tabla de productos si existen
        if ($result->num_rows > 0) {
            echo '<table class="table table-bordered">';
            echo '<thead class="thead-dark">';
            echo '<tr>';
            echo '<th scope="col">#</th>';
            echo '<th scope="col">Nombre</th>';
            echo '<th scope="col">Marca</th>';
            echo '<th scope="col">Modelo</th>';
            echo '<th scope="col">Precio</th>';
            echo '<th scope="col">Unidades</th>';
            echo '<th scope="col">Detalles</th>';
            echo '<th scope="col">Imagen</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            
            // Mostrar productos
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<th scope="row">' . $row['id'] . '</th>';
                echo '<td>' . $row['nombre'] . '</td>';
                echo '<td>' . $row['marca'] . '</td>';
                echo '<td>' . $row['modelo'] . '</td>';
                echo '<td>' . '$' . number_format($row['precio'], 2) . '</td>';
                echo '<td>' . $row['unidades'] . '</td>';
                echo '<td>' . $row['detalles'] . '</td>';
                echo '<td><img src="' . $row['imagen'] . '" alt="Imagen del Producto" style="max-width: 100px; height: auto;" /></td>';
                echo '</tr>';
            }
            
            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p>No se encontraron productos con unidades menores o iguales a ' . $tope . '.</p>';
        }

        echo '</div>'; // Fin del contenedor

        // Liberar memoria
        $result->free();
    }

    // Cerrar la conexión
    $link->close();
}
?>

</body>
</html>
