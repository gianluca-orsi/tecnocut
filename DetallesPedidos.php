<!DOCTYPE html5>
<html lang="es">

<head>
    <title>Detalle de Pedido</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0">
    <link rel="shortcut icon" href="Multimedia/Iconos/icon.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body>
<?php
    
    //Conexión al servidor y la BD mediante un archivo externo que proporciona la cadena de conexión
    require_once("conexionremota.php");

    //Si se presiona en el boton enviar
    if(isset($_GET['Nro_Pedido']))
    {

        $Nro_Pedido=$_GET['Nro_Pedido'];

        $consulta = "SELECT P.Nro_Pedido, P.Nro_CUIT, P.Fecha_Pedido, P.Estado_Pedido, C.Nro_CUIT, C.Apellido FROM pedidos P INNER JOIN clientes C WHERE P.Nro_Pedido = '$Nro_Pedido' AND P.Nro_CUIT = C.Nro_CUIT ";

        echo "<SCRIPT type='text/javascript' language='JavaScript'> alert('".$consulta."');</SCRIPT>"; 

        $datos = mysqli_query ($conn, $consulta);
        
        $valores = mysqli_fetch_array($datos);

        //Asigna a campos del formulario los valores del contacto seleccionado
        $Nro_Pedido=$valores['Nro_Pedido'];
        $Nro_CUIT=$valores['Nro_CUIT'];
        $Apellido=$valores['Apellido'];
        $Fecha_Pedido=$valores['Fecha_Pedido'];
        $Estado_Pedido=$valores['Estado_Pedido'];  

    }

?>
<div class="contenedor">
    <header class="cabecera"></header>
    <div class="caja4">
        <div class="ti1"><h1>Sistema de Gestion de Pedidos</h1></div>
        <div class="border"></div>
        <div class="b1"><h1>Detalle de Pedido</h1></div>

        <!-- Comienza el Contenedor Principal -->
        <div class="container">

        <hr>

        <form action="AltaProdPed.php" method="POST" name="pedido-modificacion">

            <div class="form-group row">
                <div class="col">
                    <label for="txtIdContacto">Nº Pedido</label>
                    <input value="<?php echo $Nro_Pedido?>" type="text" class="form-control" id="txtIdContacto" name="txtIdContacto" placeholder="Numero de Pedido" required="true" readOnly>
                </div>

                <div class="col">
                    <label for="txtNombre">Nº CUIT - Cliente</label>
                    <input value="<?php echo $Nro_CUIT?> - <?php echo $Apellido?>" type="text" class="form-control" id="txtNombre" name="txtNombre" placeholder="CUIT" required="true" readOnly>
                </div>
                  
                <div class="col">
                    <label for="txtEmail">Fecha de Emision</label>
                    <input value="<?php echo $Fecha_Pedido?>" type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="Fecha de Pedido" required="true" readOnly>
                </div>

                <div class="col">
                    <label for="txtTelefono">Estado</label>
                    <input value="<?php echo $Estado_Pedido?>" type="text" class="form-control" id="txtTelefono" name="txtTelefono" placeholder="Estado" required="true" readOnly>
                </div>
            </div>
            <hr>
            <div class="form-group row">
                <div class="col-12 offset-5">
                    <a href="AltaProdPed.php?Nro_Pedido=<?php echo $Nro_Pedido?>" class="btn btn-primary" role="button">Agregar</a>
                    &nbsp;&nbsp;
                    <a href="AltaRemito.php?Nro_Pedido=<?php echo $Nro_Pedido?>&Nro_CUIT=<?php echo $Nro_CUIT?>&Apellido=<?php echo $Apellido?>" class="btn btn-secondary" role="button">Remitir</a>
                    &nbsp;&nbsp;
                    <a href="Pedidos.php" class="btn btn-md btn-danger" role="button">Volver</a>
                </div>
            </div>

        </form>
        </div>
        <br>
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <?php
                        // Solicitamos al gestor de MySQL que entregue aquellos datos que queremos mostrar en nuestras páginas. (SQL)
                        $consulta1 = "SELECT D.Nro_Pedido, D.Cod_Producto, D.Cantidad, D.Estado_Prod, D.Observacion, P.Cod_Producto, P.Desc_Prod FROM detalles_de_pedidos D INNER JOIN productos P WHERE D.Nro_Pedido = '$Nro_Pedido' AND D.Cod_Producto = P.Cod_Producto ";
                        $result = $conn->query($consulta1);  // Acá realmente se hace la consulta, result es un conjunto de filas
                        // Si la cantidad de filas es mayor que 0 muestra
                        if ($result->num_rows > 0) {
                    ?>
                    
                    <table class="table">
                        <thead>
                            <tr>
                            <th>Codigo de Producto</th>
                            <th>Descripcion</th>
                            <th>Cantidad</th>
                            <th>Estado del Producto</th>
                            <th>Observacion</th>
                            <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                // Datos de salida de cada fila
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                        echo "<td>" . $row["Cod_Producto"] . "</td>";
                                        echo "<td>" . $row["Desc_Prod"] . "</td>";
                                        echo "<td>" . $row["Cantidad"] . "</td>";
                                        echo "<td>" . $row["Estado_Prod"] . "</td>";
                                        echo "<td>" . $row["Observacion"] . "</td>";
                                        echo "<td><a class='btn btn-outline-primary' href='AltaProdRem.php?Nro_Pedido=". $row["Nro_Pedido"]."&Cod_Producto=". $row["Cod_Producto"]."&Cantidad=". $row["Cantidad"]."&Desc_Prod=". $row["Desc_Prod"]."'>Remitir</a>";
                                        echo "&nbsp;";
                                        echo "&nbsp;";
                                        echo "&nbsp;";
                                        echo "<a class='btn btn-outline-warning' href='EditDetalle.php?Nro_Pedido=". $row["Nro_Pedido"]."&Cod_Producto=". $row["Cod_Producto"]."'>Editar</a>";
                                        echo "&nbsp;";
                                        echo "&nbsp;";
                                        echo "&nbsp;";
                                        echo "<a class='btn btn-outline-danger' href='DetallesPedidosBajaProd.php?Nro_Pedido=". $row["Nro_Pedido"]."&Cod_Producto=". $row["Cod_Producto"]."&Desc_Prod=". $row["Desc_Prod"]."'>Borrar</a></td>";
                                    echo "</tr>";
                                    }
                                }else {
                                        echo "No se encontro ningun detalle";
                                    }
                                mysqli_close($conn);
                            ?>
                        </tbody>
                    </table>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>
    
    <footer class="piedpag">
        <div class="container"></div>
    </footer>
</body>

</html>