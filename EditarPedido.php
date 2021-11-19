<!DOCTYPE html5>
<html lang="es">

<head>
    <title>SGP - Editar Pedido</title>
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
    if(isset($_POST['enviar']))
    {
        //Asigna a variales los valores de los campos de formularios  
        $Nro_Pedido=$_POST['txtNro_Pedido'];
        $Nro_CUIT=$_POST['txtNro_CUIT'];
        $Fecha_Pedido=$_POST['txtFecha_Pedido'];
        $Estado_Pedido=$_POST['txtEstado_Pedido'];   

        //(SQL) Instruccion SQL modificacion
        $consulta = "UPDATE pedidos SET Nro_Pedido='$Nro_Pedido', Nro_CUIT='$Nro_CUIT', Fecha_Pedido='$Fecha_Pedido', Estado_Pedido='$Estado_Pedido' WHERE Nro_Pedido = '$Nro_Pedido'";

        //Para que PHP envíe una consulta SQL hacia el gestor de MySQL (PHP)
        $datos= mysqli_query ($conn, $consulta);
            
        //Vuelta al listado
        echo "<SCRIPT type='text/javascript' language='JavaScript'> window.location = 'Pedidos.php'; </SCRIPT>";
           
    } else {

        $Nro_Pedido=$_GET['Nro_Pedido'];

        $consulta = "SELECT P.Nro_Pedido, P.Nro_CUIT, P.Fecha_Pedido, P.Estado_Pedido, C.Nro_CUIT, C.Apellido FROM pedidos P INNER JOIN clientes C WHERE P.Nro_Pedido = '$Nro_Pedido' AND P.Nro_CUIT = C.Nro_CUIT";

        $datos = mysqli_query ($conn, $consulta);
        
        $valores = mysqli_fetch_array($datos);

        //Asigna a campos del formulario los valores del contacto seleccionado
        $Nro_CUIT=$valores['Nro_CUIT'];
        $Apellido=$valores['Apellido'];
        $Fecha_Pedido=$valores['Fecha_Pedido'];
        $Estado_Pedido=$valores['Estado_Pedido'];

        $consulta1 = "SELECT * FROM clientes";

        $result = $conn->query($consulta1);

        if ($result->num_rows > 0) {

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
                    Editar Pedido
                </p>
            </header>
        </div>

        <!-- Comienza el Contenedor Principal -->
        <div class="container">
        
        <div class="row">
            <div class="col-12">
            <br>
            </div>
        </div>

        <hr>

        <form action="EditarPedido.php" method="POST" name="agenda-edicion" style="background-color: white" class="p-3">
    
            <div class="form-group row">
                <div class="col-sm-3">
                    <label for="txtNro_Pedido">Nº Pedido</label>
                    <input value="<?php echo $Nro_Pedido?>" type="text" class="form-control" id="txtNro_Pedido" name="txtNro_Pedido" placeholder="Numero de Pedido" required="true" readonly>
                </div>
                <div class="col-sm-4">
                <label>Nº CUIT</label>
                    <select class='form-control input-sm' id="txtNro_CUIT" name="txtNro_CUIT" required="true">
                        <option value=""><?php echo $Nro_CUIT,' - ', $Apellido ?></option>
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
                    <input value="<?php echo $Fecha_Pedido?>" type="text" class="form-control" id="txtFecha_Pedido" name="txtFecha_Pedido" placeholder="Fecha" maxlength="10" required="true">
                </div>
                <div class="col-sm-2">
                    <label for="txtEstado_Pedido">Estado</label>
                    <input value="<?php echo $Estado_Pedido?>" type="text" class="form-control" id="txtEstado_Pedido" name="txtEstado_Pedido" placeholder="Estado Actual" maxlength="30" required="true">
                </div>
            </div>
            
            <br><hr>
        
            <div class="form-group row">
                <div class="col offset-5">
                    <input name="enviar" type="submit" id="enviar" value="Actualizar" class="btn btn-primary"> 
                    <a href="Pedidos.php" class="btn btn-md btn-danger" role="button">Volver</a>
                </div>
            </div>
        
        
        </form>

    </div>
</div>
    
    <footer class="piedpag">
        <div class="container"></div>
    </footer>
</body>

</html>