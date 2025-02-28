<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<htm<head>
        <link rel="stylesheet"
              href= "https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" 
              integrity= "sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z"
              crossorigin="anonymous" />
        <script>
            function show() {
                // se obtiene el id de la fila donde está el botón presinado
                var rowId = event.target.parentNode.parentNode.id;

                // se obtienen los datos de la fila en forma de arreglo
                var data = document.getElementById(rowId).querySelectorAll(".row-data");
                /**
                querySelectorAll() devuelve una lista de elementos (NodeList) que 
                coinciden con el grupo de selectores CSS indicados.
                (ver: https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_Selectors)

                En este caso se obtienen todos los datos de la fila con el id encontrado
                y que pertenecen a la clase "row-data".
                */

                var Nombre = data[0].innerHTML;
                var Marca= data[1].innerHTML;
                var Modelo= data[2].innerHTML;
                var Precio= data[3].innerHTML;
                var Unidades= data[4].innerHTML;
                var Detalles= data[5].innerHTML;
                var Imagen= data[6].innerHTML;

               alert("Nombre: " + Nombre + 
      "\nMarca: " + Marca + 
      "\nModelo: " + Modelo + 
      "\nPrecio: " + Precio + 
      "\nUnidades: " + Unidades + 
      "\nDetalles: " + Detalles + 
      "\nImagen: " + Imagen);
            }

            
        </script>
    </head>

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
            echo '<th scope="col">Submit</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            
            // Mostrar productos
            while ($row = $result->fetch_assoc()) {
               
            
                echo '<tr id="row_' . $row['id'] . '">'; // Agregar el ID de la fila correctamente
                echo '<td class="row-data">' . $row['id'] . '</td>';
                echo '<td class="row-data">' . $row['nombre'] . '</td>';
                echo '<td class="row-data">' . $row['marca'] . '</td>';
                echo '<td class="row-data">' . $row['modelo'] . '</td>';
                echo '<td class="row-data">' . '$' . number_format($row['precio'], 2) . '</td>';
                echo '<td class="row-data">' . $row['unidades'] . '</td>';
                echo '<td class="row-data">' . $row['detalles'] . '</td>';
                echo '<td class="row-data"><img src="' . $row['imagen'] . '" alt="Imagen del Producto" style="max-width: 100px; height: auto;" /></td>';
                echo '<td><input type="button" value="Mostrar" onclick="show()" /></td>';
                echo '</tr>'; // Cierra correctamente la fila
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
