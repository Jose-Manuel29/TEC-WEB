<?php 
// Validar si los datos han sido enviados desde el formulario 
if (isset($_POST['name'], $_POST['marca'], $_POST['modelo'], $_POST['precio'], $_POST['detalles'], $_POST['unidades'])) { 
    $nombre = $_POST['name']; 
    $marca = $_POST['marca']; 
    $modelo = $_POST['modelo']; 
    $precio = $_POST['precio']; 
    $detalles = $_POST['detalles']; 
    $unidades = $_POST['unidades']; 
    $imagen = 'img/imagen.png'; 
    
    /** SE CREA EL OBJETO DE CONEXION */ 
    @$link = new mysqli('localhost', 'root', 'jmanuel29', 'marketzone');    

    /** Comprobar la conexión */ 
    if ($link->connect_errno) { 
        die('Falló la conexión: ' . $link->connect_error . '<br/>'); 
    } 

    /** Verificar si el producto ya existe */ 
    $sql_check = "SELECT id FROM productos WHERE nombre = ? AND marca = ? AND modelo = ?"; 
    $stmt_check = $link->prepare($sql_check); 
    if (!$stmt_check) { 
        die('Error al preparar consulta de verificación: ' . $link->error . '<br/>'); 
    } 

    $stmt_check->bind_param("sss", $nombre, $marca, $modelo); 
    $stmt_check->execute(); 
    $stmt_check->store_result(); 

    if ($stmt_check->num_rows > 0) { 
        echo 'El Producto ya existe en la base de datos.<br/>'; 
    } else { 
        /** Si no existe, insertar el nuevo producto */ 
        $sql_insert = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen, ELIMINADO)
        VALUES (?, ?, ?, ?, ?, ?, ?, 0)";  
          
        $stmt_insert = $link->prepare($sql_insert);

        if (!$stmt_insert) { 
            die('Error al preparar consulta de inserción: ' . $link->error . '<br/>'); 
        } 

        $stmt_insert->bind_param("sssdsis", $nombre, $marca, $modelo, $precio, $detalles, $unidades, $imagen); 

        if ($stmt_insert->execute()) { 
            // El producto se insertó correctamente, ahora mostramos el HTML de confirmación
            ?>
            <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
            <head>
                <meta http-equiv="content-type" content="text/html;charset=utf-8" />
                <title>Registro Completado</title>
                <style type="text/css">
                    body {margin: 20px; background-color:rgb(10, 10, 9); font-family: Verdana, Helvetica, sans-serif; font-size: 90%;}
                    h1 {color:rgb(255, 255, 255); border-bottom: 1px solidrgb(0, 0, 0);}
                    h2 {font-size: 1.2em; color:rgb(255, 248, 255);}
                </style>    
            </head>
            <body>
                <h1>REGISTRO EXITOSO</h1>
                <p>Gracias por registrar tus productos; hemos recibido la siguiente información:</p>

                <h2>Detalles del producto:</h2>
                <ul>
                    <li><strong>Nombre:</strong> <em><?php echo htmlspecialchars($nombre); ?></em></li>
                    <li><strong>Marca:</strong> <em><?php echo htmlspecialchars($marca); ?></em></li>
                    <li><strong>Modelo:</strong> <em><?php echo htmlspecialchars($modelo); ?></em></li>
                    <li><strong>Precio:</strong> <em><?php echo htmlspecialchars($precio); ?></em></li>
                    <li><strong>Detalles:</strong> <em><?php echo htmlspecialchars($detalles); ?></em></li>
                    <li><strong>Unidades:</strong> <em><?php echo htmlspecialchars($unidades); ?></em></li>
                </ul>
                
                <p>
                    <a href="http://validator.w3.org/check?uri=referer">
                        <img src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Strict" height="31" width="88" />
                    </a>
                </p>
            </body>
            </html>
            <?php
        } else { 
            echo 'El Producto no pudo ser insertado: ' . $stmt_insert->error . '<br/>'; 
        } 

        $stmt_insert->close(); 
    } 

    $stmt_check->close(); 
    $link->close(); 
} else { 
    echo 'Por favor, completa todos los campos del formulario.<br/>'; 
} 