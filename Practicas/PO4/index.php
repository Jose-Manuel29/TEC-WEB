<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Práctica 3</title>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <p>Determina cuál de las siguientes variables son válidas y explica por qué:</p>
    <p>$_myvar,  $_7var,  myvar,  $myvar,  $var7,  $_element1, $house*5</p>
    <?php
        //AQUI VA MI CÓDIGO PHP
        $_myvar;
        $_7var;
        //myvar;       // Inválida
        $myvar;
        $var7;
        $_element1;
        //$house*5;     // Invalida
        
        echo '<h4>Respuesta:</h4>';   
    
        echo '<ul>';
        echo '<li>$_myvar es válida porque inicia con guión bajo.</li>';
        echo '<li>$_7var es válida porque inicia con guión bajo.</li>';
        echo '<li>myvar es inválida porque no tiene el signo de dolar ($).</li>';
        echo '<li>$myvar es válida porque inicia con una letra.</li>';
        echo '<li>$var7 es válida porque inicia con una letra.</li>';
        echo '<li>$_element1 es válida porque inicia con guión bajo.</li>';
        echo '<li>$house*5 es inválida porque el símbolo * no está permitido.</li>';
        echo '</ul>';
    ?>
    <h2>Ejercicio 2</h2>
    <p> Proporcionar los valores de $a, $b, $c como sigue:</p>
    <?php
     echo "<h3> 2.Proporcionar valores  <br /> </h3>";
     $a = "ManejadorSQL";  
     $b = 'MySQL';        
     $c = &$a;     
     echo "a = $a, b = $b, c = $c<br />";
     
     $a = "PHP server";
     $b = &$a;
     echo "a = $a, b = $b, c = $c<br />";
     echo "lo que ocurrio en el segundo bloque de asignaciones es que se modifico el valor 
     de  a y b, pero b hace referencia a la varibale a de igual manera que lo hace c, por lo que imprimen lo mismo <br />";
     unset($a, $b, $c);  
     ?>
     <h2>Ejercicio 3</h2>
    <p> Muestra el contenido de cada variable inmediatamente después de cada asignación,
verificar la evolución del tipo de estas variables (imprime todos los componentes de los
arreglo):</p>
    <?php
     
     echo"1.- " ;
     $a = "PHP5";
     var_dump($a);
     echo "<br />";
     
     echo"2.- ";
     $z[] = &$a;
     var_dump($z);
     echo "<br />";
     
     echo"3.- ";
     $b = "5a version de PHP";
     var_dump($b);
     echo "<br />";
     
     echo"4.- " ; 
     $c = intval($b)*10;
     var_dump($c);
     echo "<br />";
     
     echo "5.- ";
     // **Solución:** Convertir `$b` a cadena antes de concatenar
     $a .= strval($b);
     var_dump($a);
     echo "<br />";
     
     echo"6.- ";
     $b = intval($b);
     $b *= $c;
     var_dump($b);
     echo "<br />";
     
     echo"7.- "  ;
     $z[0] = "MySQL";
     var_dump($z);
     
     ?>
     <h2>Ejercicio 4</h2>
    <p> Acceso a variables con \$GLOBALS</p>
    <?php
     
     // Usamos $GLOBALS para acceder a las variables globales
     echo "Valor de \$GLOBALS['a']: ";
     var_dump($GLOBALS['a']);
     echo "<br /><br />";
     
     echo "Valor de \$GLOBALS['b']: ";
     var_dump($GLOBALS['b']);
     echo "<br /><br />";
     
     echo "Valor de \$GLOBALS['c']: ";
     var_dump($GLOBALS['c']);
     echo "<br /><br />";
     
     echo "Valor de \$GLOBALS['z']: ";
     var_dump($GLOBALS['z']);
     echo "<br /><br />";
     
     // Liberar variables
     unset($a, $b, $c, $z);
?>     
<h2>Ejercicio 5</h2>
    <p> Dar el valor de las variables $a, $b, $c al final del siguiente script:</p>
    <?php
 $a = "7 personas";
 $b = (integer) $a;
 $a = "9E3";
 $c = (double) $a;

 echo "Valor de \$a: ";
var_dump($a);
echo "<br />";

echo "Valor de \$b: ";
var_dump($b); // 
echo "<br />";

echo "Valor de \$c: ";
var_dump($c); 
echo "<br />";
?>
    <h2>Ejercicio 6</h2>
    <p> Dar y comprobar el valor booleano de las variables $a, $b, $c, $d, $e y $f y muéstralas
    usando la función var_dump(<datos>).</p>
    <?php

$a = "0";    // Cadena "0", que se considera FALSE en una evaluación booleana.
$b = "TRUE"; // Cadena "TRUE", que se considera TRUE en una evaluación booleana.
$c = FALSE;  // Es FALSE explícitamente.
$d = ($a OR $b);  // $d será TRUE porque "TRUE" es interpretado como TRUE.
$e = ($a AND $c); // $e será FALSE, porque uno de los operandos es FALSE.
$f = ($a XOR $b); // $f será TRUE, porque el operador XOR evalúa a TRUE cuando los operandos son diferentes.

echo"<br />";
var_dump($a); 
echo"<br />";
var_dump($b); 
echo"<br />";
var_dump($c); 
echo"<br />";
var_dump($d); 
echo"<br />";
var_dump($e); 
echo"<br />";
var_dump($f);
echo "<br />";
echo"función de PHP que permita transformar el valor booleano de $c y $e
en uno que se pueda mostrar con un echo:<br />";
echo "Valor de \$c: " . var_export((bool) $c, true) . "<br />";
echo "Valor de \$e: " . var_export((bool) $e, true) . "<br />";
?>
</body>
</html>