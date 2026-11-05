
<?php

// ==========================================
// PRACTICA PROGRAMADA #3
// ESTADO DE CUENTA DE TARJETA DE CREDITO
// ==========================================

// ARREGLO DE TRANSACCIONES

$transacciones = array();

// FUNCION PARA REGISTRAR TRANSACCIONES

function registrarTransaccion($id, $descripcion, $monto) {
    global $transacciones;

    $transaccion = array(
        "id" => $id,
        "descripcion" => $descripcion,
        "monto" => $monto
    );

    array_push($transacciones, $transaccion);
}

// FUNCION PARA GENERAR ESTADO DE CUENTA

function generarEstadoDeCuenta() {
    global $transacciones;

    $totalContado = 0;

    foreach ($transacciones as $transaccion) {
        $totalContado += $transaccion["monto"];
    }

    $interes = $totalContado * 0.026;
    $totalConInteres = $totalContado + $interes;

    $cashback = $totalContado * 0.001;

    $totalPagar = $totalConInteres - $cashback;

    // CREAR CONTENIDO DEL ESTADO DE CUENTA

    $contenido = "ESTADO DE CUENTA - TARJETA DE CREDITO\n";
    $contenido .= "========================================\n\n";

    $contenido .= "DETALLE DE TRANSACCIONES:\n";

    foreach ($transacciones as $transaccion) {
        $contenido .= "ID: " . $transaccion["id"] . "\n";
        $contenido .= "Descripcion: " . $transaccion["descripcion"] . "\n";
        $contenido .= "Monto: ₡" . number_format($transaccion["monto"], 2) . "\n";
        $contenido .= "----------------------------------------\n";
    }

    $contenido .= "\nRESUMEN:\n";
    $contenido .= "Total de contado: ₡" . number_format($totalContado, 2) . "\n";
    $contenido .= "Interes (2.6%): ₡" . number_format($interes, 2) . "\n";
    $contenido .= "Total con interes: ₡" . number_format($totalConInteres, 2) . "\n";
    $contenido .= "Cashback (0.1%): ₡" . number_format($cashback, 2) . "\n";
    $contenido .= "TOTAL A PAGAR: ₡" . number_format($totalPagar, 2) . "\n";

    // MOSTRAR ESTADO DE CUENTA

    echo "<h2>Estado de cuenta</h2>";
    echo "<pre>" . $contenido . "</pre>";

    // GENERAR ARCHIVO DE TEXTO

    $archivo = fopen("estado_cuenta.txt", "w");

    if ($archivo) {
        fwrite($archivo, $contenido);
        fclose($archivo);

        echo "<p>Archivo estado_cuenta.txt generado correctamente.</p>";
    } else {
        echo "<p>No se pudo generar el archivo.</p>";
    }
}

// ==========================================
// SIMULACION DE TRANSACCIONES
// ==========================================

registrarTransaccion(1, "Compra de supermercado", 25000);
registrarTransaccion(2, "Pago de gasolina", 18000);
registrarTransaccion(3, "Compra de ropa", 35000);
registrarTransaccion(4, "Pago de internet", 22000);
registrarTransaccion(5, "Compra de alimentos", 15000);

// GENERAR ESTADO DE CUENTA

generarEstadoDeCuenta();

?>
