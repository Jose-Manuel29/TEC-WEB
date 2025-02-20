<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Práctica 3</title>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <p>Determina cuál de las siguientes variables son válidas y explica por qué:</p>
    <p>$_myvar, $_7var, myvar, $myvar, $var7, $_element1, $house*5</p>
    
    <?php
        $_myvar;
        $_7var;
        $myvar;
        $var7;
        $_element1;
        
        echo '<h4>Respuesta:</h4>';   
        echo '<ul>';
        echo '<li>$_myvar es válida porque inicia con guión bajo.</li>';
        echo '<li>$_7var es válida porque inicia con guión bajo.</li>';
        echo '<li>myvar es inválida porque no tiene el signo de dólar ($).</li>';
        echo '<li>\$myvar es válida porque inicia con una letra.</li>';
        echo '<li>$var7 es válida porque inicia con una letra.</li>';
        echo '<li>$_element1 es válida porque inicia con guión bajo.</li>';
        echo '<li>$house*5 es inválida porque el símbolo * no está permitido.</li>';
        echo '</ul>';
    ?>

    <h2>Ejercicio 2</h2>
    <p>Proporcionar los valores de $a, $b, $c como sigue:</p>
    
    <?php
        echo '<h3>2. Proporcionar valores</h3>';
        $a = "ManejadorSQL";  
        $b = 'MySQL';        
        $c = &$a;     
        echo "<p>a = $a, b = $b, c = $c</p>";

        $a = "PHP server";
        $b = &$a;
        echo "<p>a = $a, b = $b, c = $c</p>";
        echo "<p>Lo que ocurrió en el segundo bloque de asignaciones es que se modificó el valor 
        de a y b, pero b hace referencia a la variable a de igual manera que lo hace c, por lo que imprimen lo mismo.</p>";
        unset($a, $b, $c);  
    ?>

    <h2>Ejercicio 3</h2>
    <p>Muestra el contenido de cada variable inmediatamente después de cada asignación.</p>
    
    <?php
        $a = "PHP5";
        echo '<p>1.- ' . htmlspecialchars(var_export($a, true)) . '</p>';
        
        $z[] = &$a;
        echo '<p>2.- ' . htmlspecialchars(var_export($z, true)) . '</p>';
        
        $b = "5a version de PHP";
        echo '<p>3.- ' . htmlspecialchars(var_export($b, true)) . '</p>';
        
        $c = intval($b) * 10;
        echo '<p>4.- ' . htmlspecialchars(var_export($c, true)) . '</p>';
        
        $a .= strval($b);
        echo '<p>5.- ' . htmlspecialchars(var_export($a, true)) . '</p>';
        
        $b = intval($b) * $c;
        echo '<p>6.- ' . htmlspecialchars(var_export($b, true)) . '</p>';
        
        $z[0] = "MySQL";
        echo '<p>7.- ' . htmlspecialchars(var_export($z, true)) . '</p>';
    ?>

    <h2>Ejercicio 4</h2>
    <p>Acceso a variables con <code>$GLOBALS</code></p>
    
    <?php
        echo '<p>Valor de $GLOBALS["a"]: ' . htmlspecialchars(var_export($GLOBALS['a'], true)) . '</p>';
        echo '<p>Valor de $GLOBALS["b"]: ' . htmlspecialchars(var_export($GLOBALS['b'], true)) . '</p>';
        echo '<p>Valor de $GLOBALS["c"]: ' . htmlspecialchars(var_export($GLOBALS['c'], true)) . '</p>';
        echo '<p>Valor de $GLOBALS["z"]: ' . htmlspecialchars(var_export($GLOBALS['z'], true)) . '</p>';
        unset($a, $b, $c, $z);
    ?>

    <h2>Ejercicio 5</h2>
    <p>Dar el valor de las variables $a, $b, $c al final del siguiente script:</p>
    
    <?php
        $a = "7 personas";
        $b = (integer) $a;
        $a = "9E3";
        $c = (double) $a;

        echo '<p>Valor de $a: ' . htmlspecialchars(var_export($a, true)) . '</p>';
        echo '<p>Valor de $b: ' . htmlspecialchars(var_export($b, true)) . '</p>';
        echo '<p>Valor de $c: ' . htmlspecialchars(var_export($c, true)) . '</p>';
    ?>

    <h2>Ejercicio 6</h2>
    <p>Comprobación del valor booleano de las variables $a, $b, $c, $d, $e y $f:</p>
    
    <?php
        $a = "0";
        $b = "TRUE";
        $c = FALSE;
        $d = ($a OR $b);
        $e = ($a AND $c);
        $f = ($a XOR $b);

        echo '<p>' . htmlspecialchars(var_export($a, true)) . '</p>';
        echo '<p>' . htmlspecialchars(var_export($b, true)) . '</p>';
        echo '<p>' . htmlspecialchars(var_export($c, true)) . '</p>';
        echo '<p>' . htmlspecialchars(var_export($d, true)) . '</p>';
        echo '<p>' . htmlspecialchars(var_export($e, true)) . '</p>';
        echo '<p>' . htmlspecialchars(var_export($f, true)) . '</p>';

        echo "<p>Función de PHP que permita transformar el valor booleano de \$c y \$e en uno que se pueda mostrar con echo:</p>";
        echo '<p>Valor de $c: ' . var_export((bool) $c, true) . '</p>';
        echo '<p>Valor de $e: ' . var_export((bool) $e, true) . '</p>';
    ?>

    <h2>Ejercicio 7</h2>
    <p>Usando la variable predefinida $_SERVER, determina lo siguiente:</p>
    
    <?php
        echo "<p>Versión de Apache y PHP: " . htmlspecialchars($_SERVER['SERVER_SOFTWARE'], ENT_QUOTES, 'UTF-8') . "</p>";
        echo "<p>Sistema operativo del servidor: " . PHP_OS . "</p>";
        echo "<p>Idioma del navegador: " . htmlspecialchars($_SERVER['HTTP_ACCEPT_LANGUAGE'], ENT_QUOTES, 'UTF-8') . "</p>";
    ?>
</body>
<p>
    <a href="https://validator.w3.org/markup/check?uri=referer"><img
      src="https://www.w3.org/Icons/valid-xhtml11" alt="Valid XHTML 1.1" height="31" width="88" /></a>
  </p>
</html>
