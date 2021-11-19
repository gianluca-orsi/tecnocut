<!DOCTYPE html5>
<html lang="es">

<head>
    <title>SGP - Alta de Remitos</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0">
    <link rel="shortcut icon" href="Multimedia/Iconos/icon.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./css/style.css">
    <?php
    
    //Conexión al servidor y la BD mediante un archivo externo que proporciona la cadena de conexión
    require_once("conexionremota.php");

    //Si se presiona en el boton enviar
    if(isset($_POST['enviar']))
    {
        //Asigna a variales los valores de los campos de formularios  
        $Nro_Remito=$_POST['txtNro_Remito'];
        $Nro_CUIT=$_POST['txtNro_CUIT'];
        $Nro_Pedido=$_POST['txtNro_Pedido'];
        $Fecha_Remito=$_POST['txtFecha_Remito'];

        $consulta = "INSERT INTO remitos (Nro_Remito, Nro_CUIT, Nro_Pedido, Fecha_Remito) VALUES ('$Nro_Remito', '$Nro_CUIT', '$Nro_Pedido', '$Fecha_Remito')";

        $datos = mysqli_query ($conn, $consulta);
         
        //Vuelta al listado
        echo "<SCRIPT type='text/javascript' language='JavaScript'> window.location = 'Remitos.php'; </SCRIPT>";
           
    } else {

        $Nro_Pedido=$_GET['Nro_Pedido'];
        $Nro_CUIT=$_GET['Nro_CUIT'];
        $Apellido=$_GET['Apellido'];

    }
mysqli_close($conn);
    ?>
</head>

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
                    Alta de Remito
                </p>
            </header>
        </div>

        <div class="container">
            
            <div class="row justify-content-md-center">
                <div class="col-10">
    
            <form action="AltaRemito.php" method="POST" name="agenda-alta" style="background-color: white" class="p-3">
    
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="txtNro_Remito">Nº Remito</label>
                        <input type="text" class="form-control" id="txtNro_Remito" name="txtNro_Remito" placeholder="Numero de Remito" title="Ingresa 10 digitos para el Numero de Remito" maxlength="10" required="true">
                    </div>

                    <div class="col-sm-2">
                        <label for="txtNro_CUIT">Nº CUIT</label>
                        <input value="<?php echo $Nro_CUIT?>" type="text" class="form-control" id="txtNro_CUIT" name="txtNro_CUIT" placeholder="Numero de CUIT" maxlength="11" required="true" readOnly>
                    </div>

                    <div class="col-sm-2">
                        <label for="txtApellido">Apellido</label>
                        <input value="<?php echo $Apellido?>" type="text" class="form-control" id="txtApellido" name="txtApellido" placeholder="Apellido" maxlength="30" readOnly>
                    </div>

                    <div class="col-sm-2">
                        <label for="txtNro_Pedido">Nº Pedido</label>
                        <input value="<?php echo $Nro_Pedido?>" type="text" class="form-control" id="txtNro_Pedido" name="txtNro_Pedido" placeholder="Numero del Pedido" maxlength="10" required="true" readOnly>
                    </div>

                    <div class="col-sm-2">
                        <label for="txtFecha_Remito">Fecha de Remito</label>
                        <input type="text" class="form-control" id="txtFecha_Remito" name="txtFecha_Remito" placeholder="Fecha" maxlength="10" required="true">
                    </div>
                </div>
                
                <br><hr>
    
                <div class="form-group row">
                    <div class="col offset-5">
                        <input name="enviar" type="submit" id="enviar" value="Añadir Remito" class="btn btn-primary"> 
                        <a href="Pedidos.php" class="btn btn-md btn-danger" role="button">Cancelar</a>
                    </div>
                </div>

    
            </form>
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