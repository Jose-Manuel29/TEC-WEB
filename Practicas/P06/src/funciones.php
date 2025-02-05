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


?>
