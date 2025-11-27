<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Multas de Biblioteca</title>
    <style>
        body { background-color: #ffffff; font-family: Arial; color: #000000; }
        .container {
            width: 430px; margin: 60px auto; padding: 22px;
            border: 2px solid #cc0000; border-radius: 8px;
            background-color: #002b66; color: #ffffff;
        }
        h2 { text-align: center; }
        label { font-weight: bold; }
        input, button, select {
            width: 100%; padding: 10px; margin-top: 8px;
            border-radius: 5px; border: 1px solid #000000;
        }
        input, select { background-color: #ffffff; color: #000000; }
        button {
            background-color: #cc0000; color: white;
            cursor: pointer; border-color: #990000; margin-top: 10px;
        }
        button:hover { background-color: #990000; }
        .resultado {
            margin-top: 18px; padding: 14px; background-color: #d3e4ff;
            border-radius: 5px; border: 1px solid #002b66; color: #000000;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Sistema de Multas</h2>

    <form method="POST">
        <label>Cantidad de libros atrasados:</label>
        <input type="number" name="libros" required min="1">

        <label>Días de retraso:</label>
        <input type="number" name="dias" required min="0">

        <label>¿Entregado el mismo día?</label>
        <select name="mismo_dia" required>
            <option value="si">Sí</option>
            <option value="no">No</option>
        </select>

        <button type="submit">Calcular multa</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $libros = intval($_POST['libros']);
        $dias = intval($_POST['dias']);
        $mismoDia = $_POST['mismo_dia'];

        $multaBase = 5 * $libros;
        $recargo = 2 * $dias * $libros;
        $total = $multaBase + $recargo;

        if ($mismoDia === "si") {
            $total = $total * 0.80; // 20% de descuento
        }

        echo "<div class='resultado'>
                <strong>Total a pagar: \$" . number_format($total, 2) . "</strong>
              </div>";
    }
    ?>
</div>

</body>
</html>
