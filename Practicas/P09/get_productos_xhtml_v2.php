<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<htm<head>
        <link rel="stylesheet"
              href= "https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" 
              integrity= "sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z"
              crossorigin="anonymous" />
        <script>
         function show(event) {

// se obtiene el id de la fila donde está el botón presinado
var row = event.target.closest("tr");

// se obtienen los datos de la fila en forma de arreglo
var data = row.querySelectorAll(".row-data");
/**
querySelectorAll() devuelve una lista de elementos (NodeList) que 
coinciden con el grupo de selectores CSS indicados.
(ver: https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_Selectors)

En este caso se obtienen todos los datos de la fila con el id encontrado
y que pertenecen a la clase "row-data".
*/
var Id = data[0].innerHTML;
var Nombre = data[1].innerHTML;
var Marca= data[2].innerHTML;
var Modelo= data[3].innerHTML;
var Precio= data[4].innerHTML;
var Unidades= data[5].innerHTML;
var Detalles= data[6].innerHTML;
var Imagen = data[7].querySelector("img").src;

alert("Id: " + Id +
"\nNombre: " + Nombre + 
"\nMarca: " + Marca + 
"\nModelo: " + Modelo + 
"\nPrecio: " + Precio + 
"\nUnidades: " + Unidades + 
"\nDetalles: " + Detalles + 
"\nImagen: " + Imagen);
send2form(Id, Nombre, Marca, Modelo, Precio, Unidades, Detalles, Imagen);
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

if (!empty($tope)) 
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
            echo '<th scope="col">id</th>';
            echo '<th scope="col">nombre</th>';
            echo '<th scope="col">marca</th>';
            echo '<th scope="col">modelo</th>';
            echo '<th scope="col">precio</th>';
            echo '<th scope="col">unidades</th>';
            echo '<th scope="col">detalles</th>';
            echo '<th scope="col">imagen</th>';
            echo '<th scope="col">submit</th>';
          //  echo '<th scope="col">ELIMINADO</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            
            while ($row = $result->fetch_assoc()) {
             
          
            
              echo '<td class="row-data">' . $row['id'] . '</td>';
              echo '<td class="row-data">' . $row['nombre'] . '</td>';
              echo '<td class="row-data">' . $row['marca'] . '</td>';
              echo '<td class="row-data">' . $row['modelo'] . '</td>';
              echo '<td class="row-data">' . '$' . number_format($row['precio'], 2) . '</td>';
              echo '<td class="row-data">' . $row['unidades'] . '</td>';
              echo '<td class="row-data">' . $row['detalles'] . '</td>';
              echo '<td class="row-data"><img src="' . $row['imagen'] . '" alt="Imagen del Producto" style="max-width: 100px; height: auto;" /></td>';
             echo '<td><input type="button" value="Mostrar" onclick="show(event)" /></td>';
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
  
  ?>
  
  <<script>
    function send2form(id, name, brand, model, price, units, details) {
          var form = document.createElement("form");
  
          // Crear y agregar el campo para el ID del producto
          var idIn = document.createElement("input");
          idIn.type = 'hidden';
          idIn.name = 'id';
          idIn.value = id;
          form.appendChild(idIn);
  
          // Crear y agregar el campo para el nombre del producto
          var nameIn = document.createElement("input");
          nameIn.type = 'hidden';
          nameIn.name = 'nombre';
          nameIn.value = name;
          form.appendChild(nameIn);
  
          // Crear y agregar el campo para la marca del producto
          var brandIn = document.createElement("input");
          brandIn.type = 'hidden';
          brandIn.name = 'marca';
          brandIn.value = brand;
          form.appendChild(brandIn);
  
          // Crear y agregar el campo para el modelo del producto
          var modelIn = document.createElement("input");
          modelIn.type = 'hidden';
          modelIn.name = 'modelo';
          modelIn.value = model;
          form.appendChild(modelIn);
  
          // Crear y agregar el campo para el precio del producto
          var priceIn = document.createElement("input");
          priceIn.type = 'hidden';
          priceIn.name = 'precio';
          priceIn.value = price;
          form.appendChild(priceIn);
  
          // Crear y agregar el campo para las unidades del producto
          var unitsIn = document.createElement("input");
          unitsIn.type = 'hidden';
          unitsIn.name = 'unidades';
          unitsIn.value = units;
          form.appendChild(unitsIn);
  
          // Crear y agregar el campo para los detalles del producto
          var detailsIn = document.createElement("input");
          detailsIn.type = 'hidden';
          detailsIn.name = 'detalles';
          detailsIn.value = details;
          form.appendChild(detailsIn);
  
          // Establecer el método y la acción del formulario
          form.method = 'POST';
          form.action = 'formulario_productos_v2.php';  
  
          // Adjuntar el formulario al cuerpo del documento y enviarlo
          document.body.appendChild(form);
          form.submit();
      }
  </script>
  
      </body>
  </html>