<!DOCTYPE html5>
<html lang="es">

<head>
    <title>SGP</title>
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
        <div class="b1"><h1>Lista de Pedidos</h1></div>

        <br>

        <a href="AltaPedido.php" class="btn btn-primary btn-lg btn-info">Añadir Nuevo Pedido</a>

        <!-- Comienza el Contenedor Principal -->
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <br>

                    <?php
                    // Solicitamos al gestor de MySQL que entregue aquellos datos que queremos mostrar en nuestras páginas. (SQL)
                        $consulta = "SELECT P.Nro_Pedido, P.Nro_CUIT, P.Fecha_Pedido, P.Estado_Pedido, C.Nro_CUIT, C.Apellido FROM pedidos P INNER JOIN clientes C WHERE P.Nro_CUIT = C.Nro_CUIT ORDER BY Estado_Pedido";
                        $result = $conn->query($consulta);  // Acá realmente se hace la consulta, result es un conjunto de filas
                        // Si la cantidad de filas es mayor que 0 muestra
                        if ($result->num_rows > 0) {
                    ?>
                    
                    <table class="table">
                        <thead>
                            <tr>
                            <th>Numero de Pedido</th>
                            <th>CUIT</th>
                            <th>Apellido</th>
                            <th>Fecha de Emision</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                // Datos de salida de cada fila
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                        echo "<td>" . $row["Nro_Pedido"] . "</td>"; 
                                        echo "<td>" . $row["Nro_CUIT"] . "</td>";
                                        echo "<td>" . $row["Apellido"] . "</td>";
                                        echo "<td>" . $row["Fecha_Pedido"] . "</td>";
                                        echo "<td>" . $row["Estado_Pedido"] . "</td>";
                                        echo "<td><a class='btn btn-outline-primary' href='DetallesRemitos.php?Nro_Pedido=". $row["Nro_Pedido"]."'>Remito</a>";
                                        echo "&nbsp;";
                                        echo "&nbsp;";
                                        echo "&nbsp;";
                                        echo "<a class='btn btn-outline-warning' href='DetallesPedidos.php?Nro_Pedido=". $row["Nro_Pedido"]."'>Detalle</a>";
                                        echo "&nbsp;";
                                        echo "&nbsp;";
                                        echo "&nbsp;";
                                        echo "<a class='btn btn-outline-success' href='EditarPedido.php?Nro_Pedido=". $row["Nro_Pedido"]."'>Editar</a></td>";
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