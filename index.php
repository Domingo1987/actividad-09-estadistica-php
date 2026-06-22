<?php
session_start();

/*
    Actividad 09 — Estadística con PHP

    El programa permite cargar datos numéricos en un arreglo.
    Luego, al presionar "Pausar y calcular", debe mostrar los estadísticos.

    Las funciones estadísticas están incompletas.
    El estudiante debe completarlas.
*/

// Inicializar arreglo de datos
if (!isset($_SESSION["datos"])) {
    $_SESSION["datos"] = [];
}

// Inicializar estado de pausa
if (!isset($_SESSION["pausado"])) {
    $_SESSION["pausado"] = false;
}

// Agregar dato
if (isset($_POST["agregar"])) {
    if (!$_SESSION["pausado"] && isset($_POST["valor"]) && $_POST["valor"] !== "") {
        $valor = floatval($_POST["valor"]);
        $_SESSION["datos"][] = $valor;
    }
}

// Pausar carga
if (isset($_POST["pausar"])) {
    $_SESSION["pausado"] = true;
}

// Continuar carga
if (isset($_POST["continuar"])) {
    $_SESSION["pausado"] = false;
}

// Reiniciar datos
if (isset($_POST["reiniciar"])) {
    $_SESSION["datos"] = [];
    $_SESSION["pausado"] = false;
}

$datos = $_SESSION["datos"];
$pausado = $_SESSION["pausado"];



/* =====================================================
   FUNCIONES A COMPLETAR
   ===================================================== */

function calcularMedia($datos) {
    // TODO:
    // Calcular y devolver la media de los datos.
    // Recordar: media = suma de los datos / cantidad de datos.
    return null;
}

function calcularMediana($datos) {
    // TODO:
    // Ordenar los datos.
    // Si la cantidad de datos es impar, devolver el valor central.
    // Si es par, devolver el promedio de los dos valores centrales.
    return null;
}

function calcularModa($datos) {
    // TODO:
    // Contar cuántas veces aparece cada valor.
    // Devolver el o los valores que más se repiten.
    return null;
}

function calcularVarianza($datos) {
    // TODO:
    // Calcular la media.
    // Luego calcular el promedio de las diferencias al cuadrado.
    return null;
}

function calcularDesvioEstandar($datos) {
    // TODO:
    // Calcular la raíz cuadrada de la varianza.
    return null;
}

function calcularFrecuencias($datos) {
    $frecuencias = [];

    foreach ($datos as $dato) {
        $clave = (string)$dato;

        if (isset($frecuencias[$clave])) {
            $frecuencias[$clave]++;
        } else {
            $frecuencias[$clave] = 1;
        }
    }

    // Ordena los datos de menor a mayor
    ksort($frecuencias, SORT_NUMERIC);

    return $frecuencias;
}

/* =====================================================
   RESULTADOS
   ===================================================== */

$media = null;
$mediana = null;
$moda = null;
$varianza = null;
$desvio = null;
$frecuencias = [];

if ($pausado && count($datos) > 0) {
    $media = calcularMedia($datos);
    $mediana = calcularMediana($datos);
    $moda = calcularModa($datos);
    $varianza = calcularVarianza($datos);
    $desvio = calcularDesvioEstandar($datos);
    $frecuencias = calcularFrecuencias($datos);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actividad 09 - Estadística con PHP</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 30px;
        }
        
.grafico {
    margin-top: 20px;
}

.fila-grafico {
    display: grid;
    grid-template-columns: 80px 1fr 60px;
    align-items: center;
    gap: 10px;
    margin-bottom: 10px;
}

.etiqueta-grafico {
    font-weight: bold;
    text-align: right;
}

.contenedor-barra {
    background: #e6edf5;
    border-radius: 8px;
    overflow: hidden;
    height: 28px;
}

.barra-grafico {
    height: 28px;
    background: #4c78a8;
    border-radius: 8px;
}

.valor-frecuencia {
    font-weight: bold;
}

.grafico-contenedor {
    width: 100%;
    height: 350px;
    margin-top: 20px;
    background: #ffffff;
    border: 1px solid #d6dce3;
    border-radius: 10px;
    padding: 20px;
}

        .contenedor {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
        }

        h1, h2 {
            color: #002d55;
        }

        form {
            margin-bottom: 20px;
        }

        input[type="number"] {
            padding: 10px;
            width: 200px;
        }

        button {
            padding: 10px 15px;
            margin: 5px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            background: #002d55;
            color: white;
        }

        button:hover {
            background: #004b88;
        }

        .pausado {
            padding: 10px;
            background: #ffe9a8;
            border-left: 5px solid #d49b00;
            margin-bottom: 15px;
        }

        .datos {
            background: #eef3f8;
            padding: 10px;
            border-radius: 6px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }

        th {
            background: #002d55;
            color: white;
        }

        .barra {
            background: #4c78a8;
            color: white;
            padding: 5px;
            margin: 4px 0;
            border-radius: 4px;
        }

        .resultado {
            background: #f0f8f0;
            padding: 15px;
            border-radius: 8px;
            margin-top: 15px;
        }
    </style>
</head>

<body>
<div class="contenedor">

    <h1>Actividad 09 — Estadística con PHP</h1>

    <p>
        Ingresá datos numéricos relacionados con soporte informático.
        Por ejemplo: tiempos de resolución de tickets, tokens usados,
        cantidad de intentos o fallas detectadas.
    </p>

    <?php if ($pausado): ?>
        <div class="pausado">
            La carga está pausada. Ahora se muestran los resultados estadísticos.
        </div>
    <?php endif; ?>

    <form method="post">
        <input 
            type="number" 
            step="0.01" 
            name="valor" 
            placeholder="Ingresar dato"
            <?php if ($pausado) echo "disabled"; ?>
        >

        <button type="submit" name="agregar" <?php if ($pausado) echo "disabled"; ?>>
            Agregar dato
        </button>

        <button type="submit" name="pausar">
            Pausar y calcular
        </button>

        <button type="submit" name="continuar">
            Continuar carga
        </button>

        <button type="submit" name="reiniciar">
            Reiniciar
        </button>
    </form>

    <h2>Datos cargados</h2>

    <div class="datos">
        <?php
        if (count($datos) == 0) {
            echo "No hay datos cargados.";
        } else {
            echo implode(" - ", $datos);
        }
        ?>
    </div>

    <?php if ($pausado && count($datos) > 0): ?>

        <h2>Resultados estadísticos</h2>

        <div class="resultado">
            <p><strong>Media:</strong> <?php echo $media ?? "Función pendiente"; ?></p>
            <p><strong>Mediana:</strong> <?php echo $mediana ?? "Función pendiente"; ?></p>
            <p><strong>Moda:</strong> 
                <?php 
                if (is_array($moda)) {
                    echo implode(", ", $moda);
                } else {
                    echo $moda ?? "Función pendiente";
                }
                ?>
            </p>
            <p><strong>Varianza:</strong> <?php echo $varianza ?? "Función pendiente"; ?></p>
            <p><strong>Desvío estándar:</strong> <?php echo $desvio ?? "Función pendiente"; ?></p>
        </div>

        <h2>Tabla de frecuencias</h2>

        <?php if (count($frecuencias) == 0): ?>
            <p>Función de frecuencias pendiente.</p>
        <?php else: ?>
            <table>
                <tr>
                    <th>Dato</th>
                    <th>Frecuencia</th>
                </tr>

                <?php foreach ($frecuencias as $dato => $frecuencia): ?>
                    <tr>
                        <td><?php echo $dato; ?></td>
                        <td><?php echo $frecuencia; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>

           <h2>Gráfico de frecuencias</h2>

<div class="grafico-contenedor">
    <canvas id="graficoFrecuencias"></canvas>
</div>

<script>
    const etiquetas = <?php echo json_encode(array_keys($frecuencias)); ?>;
    const valores = <?php echo json_encode(array_values($frecuencias)); ?>;

    const ctx = document.getElementById('graficoFrecuencias');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: etiquetas,
            datasets: [{
                label: 'Frecuencia',
                data: valores,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });
</script>
        <?php endif; ?>

    <?php endif; ?>

</div>
</body>
</html>
