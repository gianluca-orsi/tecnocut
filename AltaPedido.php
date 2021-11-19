<!DOCTYPE html5>
<html lang="es">

<head>
    <title>Alta de Pedidos</title>
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
        $Nro_CUIT=$_POST['txtNro_CUIT'];
        $Fecha_Pedido=$_POST['txtFecha_Pedido'];
        $Estado_Pedido=$_POST['txtEstado_Pedido'];

        $consulta = "INSERT INTO pedidos (Nro_Pedido, Nro_CUIT, Fecha_Pedido, Estado_Pedido) VALUES ('$Nro_Pedido', '$Nro_CUIT', '$Fecha_Pedido', '$Estado_Pedido')";

        $datos = mysqli_query ($conn, $consulta);
         
        //Vuelta al listado
        echo "<SCRIPT type='text/javascript' language='JavaScript'> window.location = 'pedidos.php'; </SCRIPT>";
        
        mysqli_close($conn);
           
    } else {

        $consulta = "SELECT * FROM clientes";

        $result = $conn->query($consulta);

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
        <div class="b1"><h1>Alta de Pedidos</h1></div>

        <div class="container">
            
            <div class="row justify-content-md-center">
                <div class="col-10">
    
            <hr><br>
    
            <form action="AltaPedido.php" method="POST" name="agenda-alta">
    
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="txtNro_Pedido">Nº Pedido</label>
                        <input type="text" class="form-control" id="txtNro_Pedido" name="txtNro_Pedido" placeholder="Numero de Pedido" title="Ingresa 11 digitos del Numero de CUIT" maxlength="11" required="true">
                    </div>

                    <div class="col-sm-4">
                    <label>Nº CUIT</label>
                        <select class='form-control input-sm' id="txtNro_CUIT" name="txtNro_CUIT">
                            <?php 
                                while ($row = $result->fetch_assoc()){
                                    $output = "<option value='".$row['Nro_CUIT']."'";
                                    if($_POST['txtNro_CUIT'] == $row['Nro_CUIT']){
                                        $output .= " selected='selected'";
                                    }
                                    $output .= ">".$row['Nro_CUIT']." - ".$row["Apellido"]."</option>";
                                    echo $output;
                                }
                            }
                            mysqli_close($conn);
                            ?>    
                        </select>
                    </div>

                    <div class="col-sm-2">
                        <label for="txtFecha_Pedido">Fecha de Emision</label>
                        <input type="text" class="form-control" id="txtFecha_Pedido" name="txtFecha_Pedido" placeholder="Fecha" maxlength="10" required="true">
                    </div>

                    <div class="col-sm-2">
                        <label for="txtEstado_Pedido">Estado</label>
                        <input type="text" class="form-control" id="txtEstado_Pedido" name="txtEstado_Pedido" placeholder="Estado Actual" maxlength="30" required="true">
                    </div>
                </div>
                
                <br><hr>
    
                <div class="form-group row">
                    <div class="col offset-5">
                        <input name="enviar" type="submit" id="enviar" value="Añadir Pedido" class="btn btn-primary"> 
                        <a href="Pedidos.php" class="btn btn-md btn-danger" role="button">Volver</a>
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