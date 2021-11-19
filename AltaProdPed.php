<!DOCTYPE html5>
<html lang="es">

<head>
    <title>Añadir a Detalle de Pedido</title>
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
        $Nro_Pedido=$_POST['txtNro_Pedido'];
        $Cod_Producto=$_POST['txtCod_Producto'];
        $Cantidad=$_POST['txtCantidad'];
        $Estado_Prod=$_POST['txtEstado_Prod'];
        $Observacion=$_POST['txtObservacion'];

        $consulta = "INSERT INTO detalles_de_pedidos (Nro_Pedido, Cod_Producto, Cantidad, Estado_Prod, Observacion) VALUES ('$Nro_Pedido', '$Cod_Producto', '$Cantidad', '$Estado_Prod', '$Observacion')";

        $datos = mysqli_query ($conn, $consulta);
         
        //Vuelta al listado
        echo "<SCRIPT type='text/javascript' language='JavaScript'> window.location = 'DetallesPedidos.php?Nro_Pedido=". $Nro_Pedido ."'; </SCRIPT>";
        
        mysqli_close($conn);
           
    } else if(isset($_POST['volver'])) {

        $Nro_Pedido=$_POST['txtNro_Pedido'];
        
        echo "<SCRIPT type='text/javascript' language='JavaScript'> window.location = 'DetallesPedidos.php?Nro_Pedido=". $Nro_Pedido ."'; </SCRIPT>";

    } else {

        $Nro_Pedido=$_GET['Nro_Pedido'];

        $consulta1 = "SELECT * FROM productos";

        $result = $conn->query($consulta1);

        if ($result->num_rows > 0) {

    }

    ?>
</head>

<body>
<div class="contenedor">
    <header class="cabecera"></header>
    <div class="caja4">
        <div class="ti1"><h1>Sistema de Gestion de Pedidos</h1></div>
        <div class="border"></div>
        <div class="b1"><h1>Agregar a Detalle de Pedido</h1></div>

        <div class="container">
            
            <div class="row justify-content-md-center">
                <div class="col-12">
    
            <hr><br>
    
            <form action="AltaProdPed.php" method="POST" name="agenda-alta">
    
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="txtNro_Pedido">Nº Pedido</label>
                        <input value="<?php echo $Nro_Pedido?>" type="text" class="form-control" id="txtNro_Pedido" name="txtNro_Pedido" placeholder="Numero de Pedido" readonly>
                    </div>

                    <div class="col-sm-3">
                    <label>Producto</label>
                        <select class='form-control input-sm' id="txtCod_Producto" name="txtCod_Producto">
                            <?php 
                                while ($row = $result->fetch_assoc()){
                                    $output = "<option value='".$row['Cod_Producto']."'";
                                    if($_POST['txtCod_Producto'] == $row['Cod_Producto']){
                                        $output .= " selected='selected'";
                                    }
                                    $output .= ">".$row["Desc_Prod"]."</option>";
                                    echo $output;
                                }
                            }
                            mysqli_close($conn);
                            ?>    
                        </select>
                    </div>

                    <div class="col-sm-2">
                        <label for="txtCantidad">Cantidad</label>
                        <input type="number" class="form-control" id="txtCantidad" name="txtCantidad" placeholder="Cantidad" maxlength="2">
                    </div>

                    <div class="col-sm-2">
                        <label for="txtEstado_Prod">Estado de Producto</label>
                        <input type="text" class="form-control" id="txtEstado_Prod" name="txtEstado_Prod" placeholder="Estado" maxlength="30">
                    </div>

                    <div class="col-sm-2">
                        <label for="txtObservacion">Observacion</label>
                        <input type="text" class="form-control" id="txtObservacion" name="txtObservacion" placeholder="Observacion" maxlength="30">
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