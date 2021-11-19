<!DOCTYPE html5>
<html lang="es">

<head>
    <title>Añadir a Detalle de Remito</title>
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
        $Cod_Producto=$_POST['txtCod_Producto'];
        $Cantidad=$_POST['txtCantidad'];

        $consulta = "INSERT INTO detalles_de_remitos (Nro_Remito, Cod_Producto, Cantidad) VALUES ('$Nro_Remito', '$Cod_Producto', '$Cantidad')";

        $datos = mysqli_query ($conn, $consulta);
         
        //Vuelta al listado
        echo "<SCRIPT type='text/javascript' language='JavaScript'> window.location = 'DetallesRemitos.php?Nro_Remito=". $Nro_Remito ."'; </SCRIPT>";
           
    } else if(isset($_POST['volver'])) {

        $Nro_Pedido=$_POST['txtNro_Pedido'];
        
        echo "<SCRIPT type='text/javascript' language='JavaScript'> window.location = 'DetallesPedidos.php?Nro_Pedido=". $Nro_Pedido ."'; </SCRIPT>";

    } else {

        $Nro_Pedido=$_GET['Nro_Pedido'];
        $Cod_Producto=$_GET['Cod_Producto'];
        $Desc_Prod=$_GET['Desc_Prod'];
        $Cantidad=$_GET['Cantidad'];

        $consulta = "SELECT * FROM remitos WHERE Nro_Pedido = '$Nro_Pedido'";

        $datos = mysqli_query ($conn, $consulta);
        
        $valores = mysqli_fetch_array($datos);

        //Asigna a campos del formulario los valores del contacto seleccionado
        $Nro_Remito=$valores['Nro_Remito'];
        $Nro_CUIT=$valores['Nro_CUIT'];

        $consulta1 = "SELECT * FROM productos";

    }

    ?>
</head>

<body>
<div class="contenedor">
    <header class="cabecera"></header>
    <div class="caja4">
        <div class="ti1"><h1>Sistema de Gestion de Pedidos</h1></div>
        <div class="border"></div>
        <div class="b1"><h1>Agregar a Detalle de Remito</h1></div>

        <div class="container">
            
            <div class="row justify-content-md-center">
                <div class="col-12">
    
            <hr><br>
    
            <form action="AltaProdRem.php" method="POST" name="agenda-alta">

            <input id="txtNro_Pedido" name="txtNro_Pedido" type="hidden" value="<?php echo $Nro_Pedido?>">
    
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="txtNro_Remito">Nº Remito</label>
                        <input value="<?php echo $Nro_Remito?>" type="text" class="form-control" id="txtNro_Remito" name="txtNro_Remito" placeholder="Numero de Remito" readonly>
                    </div>

                    <div class="col-sm-3">
                        <label for="txtCod_Producto">Codigo de Producto</label>
                        <input value="<?php echo $Cod_Producto?>" type="text" class="form-control" id="txtCod_Producto" name="txtCod_Producto" placeholder="Codigo de Producto" readonly>
                    </div>

                    <div class="col-sm-3">
                        <label for="txtDesc_Prod">Producto</label>
                        <input value="<?php echo $Desc_Prod?>" type="text" class="form-control" id="txtDesc_Prod" name="txtDesc_Prod" placeholder="Producto" readonly>
                    </div>

                    <div class="col-sm-2">
                        <label for="txtCantidad">Cantidad</label>
                        <input value="<?php echo $Cantidad?>" type="number" class="form-control" id="txtCantidad" name="txtCantidad" placeholder="Cantidad" readonly>
                    </div>
                </div>
                
                <br><hr>
    
                <div class="col offset-5">
                    <input name="enviar" type="submit" id="enviar" value="Añadir Linea" class="btn btn-primary">
                    <input name="volver" type="submit" id="volver" value="Volver" class="btn btn-md btn-danger">
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