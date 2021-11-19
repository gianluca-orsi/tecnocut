<!DOCTYPE html5>
<html lang="es">

<head>
    <title>SGP - Clientes</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0">
    <link rel="shortcut icon" href="Multimedia/Iconos/icon.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./css/style.css">
    <?php
        // Conexión al servidor y la BD mediante un archivo externo que proporciona la cadena de conexión
        require_once("conexionremota.php");
    ?>
</head>

<body class="fondoSistema">
<body>
<nav class="navbar level is-mobile is-justify-content-space-around mb-3 p-2 header--fuente">
        <div class="level-item">
            <a href="./index.html">
                <img style="width: 3rem; height: 3rem;" src="./images/logo.gif" alt="Logo Tecnocut">
            </a>
        </div>
        <div class="level-item">
            <a href="./Pedidos.php">Pedidos</a>
        </div>
        <div class="level-item">
            <a href="./Remitos.php">Remitos</a>
        </div>
        <div class="level-item">
            <a href="./Clientes.php">Clientes</a>
        </div>
        <div class="level-item">
            <a href="./Localidades.php">Localidades</a>
        </div>
        <div class="level-item">
            <a href="./Productos.php">Productos</a>
        </div>
    </nav>

<div class="contenedor">
    <header class="cabecera"></header>

        <div class="columns">
            <header class="column is-12 has-text-centered header--fuente">
                <p style="font-size: 2rem">
                    Sistema de Gestion de Pedidos
                </p>
                <p>
                    Clientes
                </p>
            </header>
        </div>

        <div class="container">
            <div class="columns">
                <div class="column is-12 has-text-centered is-centered mt-3">
                    <a href="AltaClientes.php" class="btn btn-primary btn-lg btn-info">Añadir Nuevo Cliente</a>
                </div>
            </div>
        </div>
        
        <!-- Comienza el Contenedor Principal -->
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-lg-12">
                    <br>

                    <?php
                    // Solicitamos al gestor de MySQL que entregue aquellos datos que queremos mostrar en nuestras páginas. (SQL)
                        $consulta = "SELECT C.Nro_CUIT, C.Nombre, C.Apellido, C.Email, C.Telefono, C.Direccion, C.Cod_Postal, L.Cod_Postal, L.Localidad 
                                     FROM clientes C INNER JOIN localidades L WHERE C.Cod_Postal = L.Cod_Postal ORDER BY C.Apellido";
                        $result = $conn->query($consulta);  // Acá realmente se hace la consulta, result es un conjunto de filas
                        // Si la cantidad de filas es mayor que 0 muestra
                        if ($result->num_rows > 0) {
                    ?>
                    
                    <table class="table">
                        <thead>
                            <tr>
                            <th>CUIT</th>
                            <th>Apellido</th>
                            <th>Nombre</th>
                            <th>eMail</th>
                            <th>Telefono</th>
                            <th>Direccion</th>
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
                                        echo "<td>" . $row["Nro_CUIT"] . "</td>"; 
                                        echo "<td>" . $row["Apellido"] . "</td>";  
                                        echo "<td>" . $row["Nombre"] . "</td>";
                                        echo "<td>" . $row["Email"] . "</td>";
                                        echo "<td>" . $row["Telefono"] . "</td>";
                                        echo "<td>" . $row["Direccion"] . "</td>";
                                        echo "<td>" . $row["Cod_Postal"] . "</td>";
                                        echo "<td>" . $row["Localidad"] . "</td>";
                                        echo "<td><a class='btn btn-outline-primary' href='PedidosdelCliente.php?Nro_CUIT=". $row["Nro_CUIT"]."'>Pedidos</a>";
                                        echo "&nbsp;";
                                        echo "&nbsp;";
                                        echo "&nbsp;";
                                        echo "<a class='btn btn-outline-warning' href='EditarCliente.php?Nro_CUIT=". $row["Nro_CUIT"]."'>Editar</a>";
                                        echo "&nbsp;";
                                        echo "&nbsp;";
                                        echo "&nbsp;";
                                        echo "<a class='btn btn-outline-danger' href='BajaCliente.php?Nro_CUIT=". $row["Nro_CUIT"]."'>Borrar</a></td>";
                                    echo "</tr>";
                                    }
                                }else {
                                        echo "La búsqueda no ha dado resultados o no hay clientes listados aun";
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