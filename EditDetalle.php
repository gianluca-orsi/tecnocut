<!DOCTYPE html5>
<html lang="es">

<head>
    <title>Edicion de Detalle</title>
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
    if(isset($_POST['enviar']))
    {
        //Asigna a variales los valores de los campos de formularios  
        $Nro_Pedido=$_POST['txtNro_Pedido'];
        $Cod_Producto=$_POST['txtCod_Producto'];
        $Cantidad=$_POST['txtCantidad'];
        $Estado_Prod=$_POST['txtEstado_Prod']; 
        $Observacion=$_POST['txtObservacion'];       

        //(SQL) Instruccion SQL modificacion
        $consulta = "UPDATE detalles_de_pedidos SET Cantidad='$Cantidad',Estado_Prod='$Estado_Prod', Observacion='$Observacion' WHERE Nro_Pedido = '$Nro_Pedido' AND Cod_Producto = '$Cod_Producto'";

        //Para que PHP envíe una consulta SQL hacia el gestor de MySQL (PHP)
        $datos= mysqli_query ($conn, $consulta);
            
        //Vuelta al listado
        echo "<SCRIPT type='text/javascript' language='JavaScript'> window.location = 'DetallesPedidos.php?Nro_Pedido=". $Nro_Pedido ."'; </SCRIPT>";	
           
    } else if(isset($_POST['volver'])) {

        $Nro_Pedido=$_POST['txtNro_Pedido'];
        
        echo "<SCRIPT type='text/javascript' language='JavaScript'> window.location = 'DetallesPedidos.php?Nro_Pedido=". $Nro_Pedido ."'; </SCRIPT>";

    } else {

        $Nro_Pedido=$_GET['Nro_Pedido'];
        $Cod_Producto=$_GET['Cod_Producto'];

        $consulta = "SELECT * FROM detalles_de_pedidos WHERE Nro_Pedido = '$Nro_Pedido' AND Cod_Producto = '$Cod_Producto'";

        $datos = mysqli_query ($conn, $consulta);
        
        $valores = mysqli_fetch_array($datos);

        //Asigna a campos del formulario los valores del contacto seleccionado
        $Nro_Pedido=$valores['Nro_Pedido'];
        $Cod_Producto=$valores['Cod_Producto'];
        $Cantidad=$valores['Cantidad'];
        $Estado_Prod=$valores['Estado_Prod'];
        $Observacion=$valores['Observacion']; 

    }

    mysqli_close($conn);

?>
<div class="contenedor">
    <header class="cabecera"></header>
    <div class="caja4">
        <div class="ti1"><h1>Sistema de Gestion de Pedidos</h1></div>
        <div class="border"></div>
        <div class="b1"><h1>Editar Detalle</h1></div>

        <!-- Comienza el Contenedor Principal -->
        <div class="container">
        
        <div class="row justify-content-md-center">
            <div class="col-12">
            <br>

        <hr>

        <form action="EditDetalle.php" method="POST" name="pedido-modificacion">

            <div class="form-group row">
                <div class="col">
                    <label for="txtNro_Pedido">Nº Pedido</label>
                    <input value="<?php echo $Nro_Pedido?>" type="text" class="form-control" id="txtNro_Pedido" name="txtNro_Pedido" placeholder="Numero de Pedido" required="true" readOnly>
                </div>

                <div class="col">
                    <label for="txtCod_Producto">Codigo Producto</label>
                    <input value="<?php echo $Cod_Producto?>" type="text" class="form-control" id="txtCod_Producto" name="txtCod_Producto" placeholder="Codigo de Producto" required="true" readOnly>
                </div>
                  
                <div class="col">
                    <label for="txtCantidad">Cantidad</label>
                    <input value="<?php echo $Cantidad?>" type="number" class="form-control" id="txtCantidad" name="txtCantidad" placeholder="Cantidad" required="true">
                </div>

                <div class="col">
                    <label for="txtEstado_Prod">Estado de Productos</label>
                    <input value="<?php echo $Estado_Prod?>" type="text" class="form-control" id="txtEstado_Prod" name="txtEstado_Prod" placeholder="Estado de Productos">
                </div>

                <div class="col">
                    <label for="txtObservacion">Observacion</label>
                    <input value="<?php echo $Observacion?>" type="text" class="form-control" id="txtObservacion" name="txtObservacion" placeholder="Observacion">
                </div>
            </div>

            <hr>
                <div class="col offset-5">
                    <input name="enviar" type="submit" id="enviar" value="Actualizar" class="btn btn-primary"> 
                    <input name="volver" type="submit" id="volver" value="Volver" class="btn btn-md btn-danger">
                </div>
            </div>

        </form>
        </div>
        </div>

    </div>
</div>
    
    <footer class="piedpag">
        <div class="container"></div>
    </footer>
</body>

</html>