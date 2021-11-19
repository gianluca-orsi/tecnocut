<!DOCTYPE html5>
<html lang="es">

<head>
    <title>SGP - Pedidos del Cliente</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0">
    <link rel="shortcut icon" href="Multimedia/Iconos/icon.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body class="fondoSistema">
<?php
    
    //Conexión al servidor y la BD mediante un archivo externo que proporciona la cadena de conexión
    require_once("conexionremota.php");

    //Si se presiona en el boton enviar
    if(isset($_GET['Nro_CUIT']))
    {
        
        $Nro_CUIT=$_GET['Nro_CUIT'];

        $consulta = "SELECT C.Nro_CUIT, C.Nombre, C.Apellido, C.Email, C.Telefono, C.Direccion, C.Cod_Postal, L.Cod_Postal, L.Localidad FROM clientes C INNER JOIN localidades L WHERE C.Nro_CUIT = '$Nro_CUIT' AND C.Cod_Postal = L.Cod_Postal ";

        echo "<SCRIPT type='text/javascript' language='JavaScript'> alert('".$consulta."');</SCRIPT>"; 

        $datos = mysqli_query ($conn, $consulta);
        
        $valores = mysqli_fetch_array($datos);

        //Asigna a campos del formulario los valores del contacto seleccionado
        $Nro_CUIT=$valores['Nro_CUIT'];
        $Nombre=$valores['Nombre'];
        $Apellido=$valores['Apellido'];
        $Email=$valores['Email'];
        $Telefono=$valores['Telefono'];
        $Direccion=$valores['Direccion']; 
        $Cod_Postal=$valores['Cod_Postal'];
        $Localidad=$valores['Localidad'];    

    }

?>
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
                    Pedidos del Cliente
                </p>
            </header>
        </div>

        <!-- Comienza el Contenedor Principal -->
        <div class="container">

        <form action="PedidosdelCliente.php" method="POST" name="pedido-modificacion" style="background-color: white" class="p-3">

            <div class="form-group row">
                <div class="col-sm-3">
                    <label for="txtNro_CUIT">Nº CUIT</label>
                    <input value="<?php echo $Nro_CUIT?>" type="text" class="form-control" id="txtNro_CUIT" name="txtNro_CUIT" placeholder="Numero de CUIT" required="true" readOnly>
                </div>
                  
                <div class="col-sm-3">
                    <label for="txtNombre">Nombre</label>
                    <input value="<?php echo $Nombre?>" type="text" class="form-control" id="txtNombre" name="txtNombre" placeholder="Nombre" required="true" readOnly>
                </div>

                <div class="col-sm-3">
                    <label for="txtApellido">Apellido</label>
                    <input value="<?php echo $Apellido?>" type="text" class="form-control" id="txtApellido" name="txtApellido" placeholder="Apellido" required="true" readOnly>
                </div>

                <div class="col-sm-3">
                    <label for="txtEmail">Email</label>
                    <input value="<?php echo $Email?>" type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="Email" required="true" readOnly>
                </div>
            </div>

            <div class="form-group row">
                <div class="col">
                    <label for="txtTelefono">Telefono</label>
                    <input value="<?php echo $Telefono?>" type="text" class="form-control" id="txtTelefono" name="txtTelefono" placeholder="Telefono" required="true" readOnly>
                </div>

                <div class="col">
                    <label for="txtDireccion">Direccion</label>
                    <input value="<?php echo $Direccion?>" type="text" class="form-control" id="txtDireccion" name="txtDireccion" placeholder="Direccion" required="true" readOnly>
                </div>

                <div class="col">
                    <label for="txtCod_Postal">Localidad</label>
                    <input value="<?php echo $Cod_Postal," - ",$Localidad?>" type="text" class="form-control" id="txtCod_Postal" name="txtCod_Postal" placeholder="Codigo Postal" required="true" readOnly>
                </div>
            </div>
            <hr>
            <div class="form-group row">
                <div class="col offset-5">
                    <a href="Clientes.php" class="btn btn-md btn-danger" role="button">Volver</a>
                </div>
            </div>

        </form>
        </div>
        <br>
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="background-color: white">

                    <?php
                        // Solicitamos al gestor de MySQL que entregue aquellos datos que queremos mostrar en nuestras páginas. (SQL)
                        $consulta1 = "SELECT P.Nro_Pedido, P.Nro_CUIT, P.Fecha_Pedido, P.Estado_Pedido FROM pedidos P WHERE P.Nro_CUIT = '$Nro_CUIT' ";
                        $result = $conn->query($consulta1);  // Acá realmente se hace la consulta, result es un conjunto de filas
                        // Si la cantidad de filas es mayor que 0 muestra
                        if ($result->num_rows > 0) {
                    ?>
                    
                    <table class="table">
                        <thead>
                            <tr>
                            <th>Nº Pedido</th>
                            <th>Fecha de Emision</th>
                            <th>Estado del Pedido</th>
                            <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                // Datos de salida de cada fila
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                        echo "<td>" . $row["Nro_Pedido"] . "</td>";
                                        echo "<td>" . $row["Fecha_Pedido"] . "</td>";
                                        echo "<td>" . $row["Estado_Pedido"] . "</td>";
                                        echo "<td><a class='btn btn-outline-primary' href='DetallesRemitos.php?Nro_Pedido=". $row["Nro_Pedido"]."'>Remito</a>";
                                        echo "&nbsp;";
                                        echo "&nbsp;";
                                        echo "&nbsp;";
                                        echo "<a class='btn btn-outline-secondary' href='DetallesPedidos.php?Nro_Pedido=". $row["Nro_Pedido"]."'>Detalle</a></td>";
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