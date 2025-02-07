<?php
function es_multiplo($num) {
    if ($num % 5 == 0 && $num % 7 == 0) {
        echo '<h3>R= El número ' . $num . ' SÍ es múltiplo de 5 y 7.</h3>';
    } else {
        echo '<h3>R= El número ' . $num . ' NO es múltiplo de 5 y 7.</h3>';
    }
}

function es_secuencia($num) {
    if ($num % 5 == 0 && $num % 7 == 0) {
        echo '<h3>R= El número ' . $num . ' SÍ es múltiplo de 5 y 7.</h3>';
    } else {
        echo '<h3>R= El número ' . $num . ' NO es múltiplo de 5 y 7.</h3>';
    }
}

function generarSecuencia() {
    $matriz = [];
    $iteraciones = 0;
    $totalNumeros = 0;
    
    while (true) {
        $iteraciones++;
        $fila = [];
        
        for ($i = 0; $i < 3; $i++) {
            $fila[$i] = rand(100, 999); // Números aleatorios de 3 dígitos
        }
        
        $totalNumeros += 3;
        $matriz[] = $fila;
        
        // Verificar la condición impar, par, impar
        if ($fila[0] % 2 != 0 && $fila[1] % 2 == 0 && $fila[2] % 2 != 0) {
            break;
        }
    }
    
    // Mostrar la matriz generada
    foreach ($matriz as $fila) {
        echo implode(", ", $fila) . "\n";
    }
    
    echo "\n$totalNumeros números obtenidos en $iteraciones iteraciones.";
}
function multiplo()
{
    if (isset($_GET['num']) && is_numeric($_GET['num']) && $_GET['num'] > 0) {
        $num = intval($_GET['num']); 

        // usando while
        $aleatorio = rand(1, 100);
        while ($aleatorio % $num !== 0) {
            $aleatorio = rand(1, 100);
        }
        echo "<h3> múltiplo con while de $num es: $aleatorio</h3>";

        // usando do-while
        do {
            $aleatorio = rand(1, 100);
        } while ($aleatorio % $num !== 0);
        echo "<h3> múltiplo con do-while de $num es: $aleatorio</h3>";

    } else {
        echo "<h3>proporciona un número válido</h3>";
    }
}
function generarArregloLetras() {
    $arreglo = array(); // Creamos un arreglo vacío

    // Llenamos el arreglo con los valores correspondientes
    for ($i = 97; $i <= 122; $i++) {
        $arreglo[$i] = chr($i); // El índice es $i y el valor es el carácter correspondiente
    }

    // Mostrar el arreglo con los índices y valores
    foreach ($arreglo as $key => $value) {
        echo "$key => $value<br>"; // Imprimimos el índice y la letra correspondiente
    }
}

// Función para verificar la edad y el sexo
function verificarEdadSexo($edad, $sexo) {
    // Verificar si el sexo es femenino y la edad está en el rango de 18 a 35 años
    if ($sexo == 'femenino' && $edad >= 18 && $edad <= 35) {
        echo "<p>Bienvenida, usted está en el rango de edad permitido.</p>";
    } else {
        echo "<p>No cumple con los requisitos. Solo se permite el sexo femenino y edades entre 18 y 35 años.</p>";
    }
}
?>



