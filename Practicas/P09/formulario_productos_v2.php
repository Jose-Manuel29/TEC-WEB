<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro de productos</title>
    <style type="text/css">
        ol, ul { 
            list-style-type: none;
        }
    </style>
</head>

<body>

    <h1>Tienda Boutique</h1>
    <h2>Registra tus productos</h2>

    <?php
    $producto = [
        "nombre"   => $_POST['nombre'] ?? '',
        "marca"    => $_POST['marca'] ?? '',
        "modelo"   => $_POST['modelo'] ?? '',
        "precio"   => $_POST['precio'] ?? '',
        "unidades" => $_POST['unidades'] ?? '',
        "detalles" => $_POST['detalles'] ?? '',
        "imagen"   => $_POST['imagen'] ?? ''  // Imagen actual si existe
    ];
    ?>

    <form id="formularioProducto" action="http://localhost/tecweb/Practicas/P08/set_producto_v2.php" method="post" enctype="multipart/form-data">
     
        <fieldset>
            <legend>Información del Producto</legend>

            <ul>
                <li>
                    <label for="form-name">Nombre:</label>
                    <input type="text" name="Nombre" id="form-name" maxlength="100" required value="<?= htmlspecialchars($producto['nombre']) ?>">
                </li>
                <li>
                    <label for="form-marca">Marca:</label>
                    <select name="Marca" id="form-marca" required>
                        <option value="">Selecciona una marca</option>
                        <option value="Boss" <?= ($producto['marca'] == 'Boss') ? 'selected' : '' ?>>Boss</option>
                        <option value="Dandy_Hats" <?= ($producto['marca'] == 'Dandy_Hats') ? 'selected' : '' ?>>Dandy Hats</option>
                        <option value="Barbas_Hats" <?= ($producto['marca'] == 'Barbas_Hats') ? 'selected' : '' ?>>Barbas Hats</option>
                        <option value="LV" <?= ($producto['marca'] == 'LV') ? 'selected' : '' ?>>LV</option>
                        <option value="Balenciaga" <?= ($producto['marca'] == 'Balenciaga') ? 'selected' : '' ?>>Balenciaga</option>
                        <option value="31 hats" <?= ($producto['marca'] == '31 hats') ? 'selected' : '' ?>>31 Hats</option>
                    </select>
                </li>
                <li>
                    <label for="form-modelo">Modelo:</label>
                    <input type="text" name="Modelo" id="form-modelo" maxlength="25" pattern="[a-zA-Z0-9]+" required value="<?= htmlspecialchars($producto['modelo']) ?>">
                </li>
                <li>
                    <label for="form-precio">Precio:</label>
                    <input type="text" name="Precio" id="form-precio" step="1.00" min="99.99" required value="<?= htmlspecialchars($producto['precio']) ?>">
                </li>
                <li>
                    <label for="form-detalles">Detalles:</label>
                    <textarea name="Detalles" id="form-detalles" maxlength="250"><?= htmlspecialchars($producto['detalles']) ?></textarea>
                </li>
                <li>
                    <label for="form-unidades">Unidades:</label>
                    <input type="number" name="Unidades" id="form-unidades" min="1" required value="<?= htmlspecialchars($producto['unidades']) ?>">
                </li>
                <li>
                    <label for="form-image">Imagen del Producto (png):</label>
                    <input type="file" name="ImagenNueva" id="form-image" accept="image/png">
                    <?php if (!empty($producto['imagen'])): ?>
                        <br>
                        <img src="<?= htmlspecialchars($producto['imagen']) ?>" alt="Imagen del Producto" style="max-width: 150px;">
                        <input type="hidden" name="Imagen" value="<?= htmlspecialchars($producto['imagen']) ?>">
                    <?php endif; ?>
                </li>
            </ul>
        </fieldset>

        <p>
            <input type="submit" value="Guardar">
            <input type="reset" value="Limpiar">
        </p>
    </form>

    <script src="validacion.js"></script> 

</body>
</html>