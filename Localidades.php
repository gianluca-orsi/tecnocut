<!DOCTYPE html5>
<html lang="es">

<head>
    <title>Localidades</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0">
    <link rel="shortcut icon" href="Multimedia/Iconos/icon.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    
    <?php
        // Conexión al servidor y la BD mediante un archivo externo que proporciona la cadena de conexión
        require_once("conexionremota.php");
    ?>
</head>

<body>
<div class="contenedor">
    <header class="cabecera"></header>
    <div class="caja4">
        <div class="ti1"><h1>Sistema de Gestion de Pedidos</h1></div>
        <div class="border"></div>
        <div class="b1"><h1>Localidades</h1></div>

        <br>

        <a href="AltaLocalidad.php" class="btn btn-primary btn-lg btn-info">Añadir Codigo Postal</a>

        <!-- Comienza el Contenedor Principal -->
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-6">
                    <br>

                    <?php
                    // Solicitamos al gestor de MySQL que entregue aquellos datos que queremos mostrar en nuestras páginas. (SQL)
                        $consulta = "SELECT * FROM localidades";
                        $result = $conn->query($consulta);  // Acá realmente se hace la consulta, result es un conjunto de filas
                        // Si la cantidad de filas es mayor que 0 muestra
                        if ($result->num_rows > 0) {
                    ?>
                    
                    <table class="table">
                        <thead>
                            <tr>
                            <th>Codigo Postal</th>
                            <th>Localidad</th>
                            <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                // Datos de salida de cada fila
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                        echo "<td>" . $row["Cod_Postal"] . "</td>"; 
                                        echo "<td>" . $row["Localidad"] . "</td>";
                                        echo "<td><a class='btn btn-outline-warning' href='EditarLocalidad.php?Cod_Postal=". $row["Cod_Postal"]."'>Editar</a>";
                                        echo "&nbsp;";
                                        echo "&nbsp;";
                                        echo "&nbsp;";
                                        echo "<a class='btn btn-outline-danger' href='BajaLocalidad.php?Cod_Postal=". $row["Cod_Postal"]."'>Borrar</a></td>";
                                    echo "</tr>";
                                    }
                                }else {
                                        echo "La búsqueda no ha dado resultados";
                                    }
                                mysqli_close($conn);
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>
    
    <footer class="piedpag">
        <div class="container"></div>
    </footer>
</body>

</html>