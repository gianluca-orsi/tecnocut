<!DOCTYPE html5>
<html lang="es">

<head>
    <title>Alta de Remitos</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0">
    <link rel="shortcut icon" href="Multimedia/Iconos/icon.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    
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
<div class="contenedor">
    <header class="cabecera"></header>
    <div class="caja4">
        <div class="ti1"><h1>Sistema de Gestion de Pedidos</h1></div>
        <div class="border"></div>
        <div class="b1"><h1>Alta de Remitos</h1></div>

        <div class="container">
            
            <div class="row justify-content-md-center">
                <div class="col-10">
    
            <hr><br>
    
            <form action="AltaRemito.php" method="POST" name="agenda-alta">
    
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