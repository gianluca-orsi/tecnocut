<!DOCTYPE html5>
<html lang="es">

<head>
    <title>TP PHP</title>
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
        $Cod_Postal=$_POST['txtCod_Postal'];
        $Localidad=$_POST['txtLocalidad'];     

        //(SQL) Instruccion SQL modificacion
        $consulta = "UPDATE localidades SET Localidad='$Localidad' WHERE Cod_Postal = '$Cod_Postal' ";

        //Para que PHP envíe una consulta SQL hacia el gestor de MySQL (PHP)
        $datos= mysqli_query ($conn, $consulta);
            
        //Vuelta al listado
        echo "<SCRIPT type='text/javascript' language='JavaScript'> window.location = 'Localidades.php'; </SCRIPT>";	
           
    } else {

        $Cod_Postal=$_GET['Cod_Postal'];

        $consulta = "SELECT * FROM localidades WHERE Cod_Postal = '$Cod_Postal' ";

        echo "<SCRIPT type='text/javascript' language='JavaScript'> alert('".$consulta."');</SCRIPT>"; 

        $datos = mysqli_query ($conn, $consulta);
        
        $valores = mysqli_fetch_array($datos);

        //Asigna a campos del formulario los valores del contacto seleccionado
        $Cod_Postal=$valores['Cod_Postal'];
        $Localidad=$valores['Localidad'];

    }

    mysqli_close($conn);

?>
<div class="contenedor">
    <header class="cabecera"></header>
    <div class="caja4">
        <div class="ti1"><h1>Sistema de Gestion de Pedidos</h1></div>
        <div class="border"></div>
        <div class="b1"><h1>Editar Localidad</h1></div>

        <!-- Comienza el Contenedor Principal -->
        <div class="container">
        
        <div class="row">
            <div class="col-12">
            <br>
            </div>
        </div>

        <hr>

        <form action="EditarLocalidad.php" method="POST" name="pedido-modificacion">

            <div class="form-group row">

                <div class="col">
                    <label for="txtCod_Postal">Codigo Postal</label>
                    <input value="<?php echo $Cod_Postal?>" type="text" class="form-control" id="txtCod_Postal" name="txtCod_Postal" placeholder="Codigo Postal" required="true" readOnly>
                </div>

                <div class="col">
                    <label for="txtLocalidad">Localidad</label>
                    <input value="<?php echo $Localidad?>" type="text" class="form-control" id="txtLocalidad" name="txtLocalidad" placeholder="Localidad" required="true">
                </div>
                  
            </div>

            <hr>
                <div class="col">
                    <input name="enviar" type="submit" id="enviar" value="Actualizar" class="btn btn-primary"> 
                    <a href="Localidades.php" class="btn btn-md btn-danger" role="button">Volver</a>
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