<!DOCTYPE html5>
<html lang="es">

<head>
    <title>Baja de Remito</title>
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
        
        $consulta = "DELETE FROM detalles_de_remitos WHERE Nro_Remito = '$Nro_Remito' ";
            
            if (mysqli_query($conn, $consulta ) === TRUE) {
                
                $consulta1 = "DELETE FROM remitos WHERE Nro_Remito = '$Nro_Remito' ";
                
                mysqli_query($conn, $consulta1 );
            }
            
        //Vuelta al listado
        echo "<SCRIPT type='text/javascript' language='JavaScript'> window.location = 'Remitos.php'; </SCRIPT>";
           
    } else {
        
        $Nro_Remito=$_GET['Nro_Remito'];
        $Nro_CUIT=$_GET['Nro_Remito'];

        $consulta = "SELECT R.Nro_Remito, R.Nro_CUIT, R.Nro_Pedido, R.Fecha_Remito, C.Nro_CUIT, C.Nombre, C.Apellido FROM remitos R INNER JOIN clientes C WHERE R.Nro_Remito = '$Nro_Remito' AND R.Nro_CUIT = C.Nro_CUIT ";

        echo "<SCRIPT type='text/javascript' language='JavaScript'> alert('".$consulta."');</SCRIPT>"; 

        $datos = mysqli_query ($conn, $consulta);
        
        $valores = mysqli_fetch_array($datos);

        //Asigna a campos del formulario los valores del contacto seleccionado
        $Nro_CUIT=$valores['Nro_CUIT'];
        $Nro_Remito=$valores['Nro_Remito'];
        $Nro_Pedido=$valores['Nro_Pedido'];
        $Fecha_Remito=$valores['Fecha_Remito'];
        $Nombre=$valores['Nombre'];
        $Apellido=$valores['Apellido'];

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
        <div class="b1"><h1>Baja de Remito</h1></div>

        <div class="container">
            
            <div class="row justify-content-md-center">
                <div class="col-12">
    
            <hr><br>
    
            <form action="BajaRemito.php" method="POST" name="agenda-alta">
    
                <div class="form-group row">
                    <div class="col">
                        <label for="txtNro_Remito">Nº Remito</label>
                        <input value="<?php echo $Nro_Remito?>" type="text" class="form-control" id="txtNro_Remito" name="txtNro_Remito" placeholder="Numero de Remito" readonly>
                    </div>

                    <div class="col">
                        <label for="txtNro_Pedido">Nº Pedido</label>
                        <input value="<?php echo $Nro_Pedido?>" type="text" class="form-control" id="txtNro_Pedido" name="txtNro_Pedido" placeholder="Numero de Pedido" readonly>
                    </div>

                    <div class="col">
                        <label for="txtNro_CUIT">Nº CUIT</label>
                        <input value="<?php echo $Nro_CUIT?>" type="text" class="form-control" id="txtNro_CUIT" name="txtNro_CUIT" placeholder="Numero de CUIT" readonly>
                    </div>

                    <div class="col">
                        <label for="txtNombre">Cliente</label>
                        <input value="<?php echo $Nombre?> - <?php echo $Apellido?>" type="text" class="form-control" id="txtNombre" name="txtNombre" placeholder="Nombre" readonly>
                    </div>

                    <div class="col">
                        <label for="txtFecha_Remito">Fecha de Remito</label>
                        <input value="<?php echo $Fecha_Remito?>" type="text" class="form-control" id="txtFecha_Remito" name="txtFecha_Remito" placeholder="Fecha de Remito" readonly>
                    </div>
                </div>
                
                <br><hr>
    
                <div class="form-group row">
                    <div class="col offset-5">
                        <input name="enviar" type="submit" id="enviar" value="Borrar Remito" class="btn btn-primary"> 
                        <a href="Remitos.php" class="btn btn-md btn-danger" role="button">Volver</a>
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