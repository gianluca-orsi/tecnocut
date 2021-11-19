<!DOCTYPE html5>
<html lang="es">

<head>
    <title>SGP - Editar Producto</title>
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
        $Cod_Producto=$_POST['txtCod_Producto'];
        $Desc_Prod=$_POST['txtDesc_Prod'];   

        //(SQL) Instruccion SQL modificacion
        $consulta = "UPDATE productos SET Desc_Prod='$Desc_Prod' WHERE Cod_Producto = '$Cod_Producto'";

        //Para que PHP envíe una consulta SQL hacia el gestor de MySQL (PHP)
        $datos= mysqli_query ($conn, $consulta);
            
        //Vuelta al listado
        echo "<SCRIPT type='text/javascript' language='JavaScript'> window.location = 'Productos.php'; </SCRIPT>";
           
    } else {
        
        $Cod_Producto=$_GET['Cod_Producto'];

        $consulta = "SELECT * FROM productos WHERE Cod_Producto = '$Cod_Producto' ";

        echo "<SCRIPT type='text/javascript' language='JavaScript'> alert('".$consulta."');</SCRIPT>"; 

        $datos = mysqli_query ($conn, $consulta);
        
        $valores = mysqli_fetch_array($datos);

        //Asigna a campos del formulario los valores del contacto seleccionado
        $Cod_Producto=$valores['Cod_Producto'];
        $Desc_Prod=$valores['Desc_Prod'];

    }
    mysqli_close($conn);
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
                    Editar Producto
                </p>
            </header>
        </div>

        <!-- Comienza el Contenedor Principal -->
        <div class="container">
        
            <div class="row justify-content-md-center">
                
                <div class="col-6">
    
                    <form action="EditarProducto.php" method="POST" name="agenda-alta" style="background-color: white" class="p-3">
                
                        <div class="form-group row">
            
                            <div class="col">
                                <label for="txtCod_Producto">Codigo Producto</label>
                                <input value="<?php echo $Cod_Producto?>" type="text" class="form-control" id="txtCod_Producto" name="txtCod_Producto" placeholder="Codigo de Producto" maxlength="12" readonly>
                            </div>
                    
                            <div class="col">
                                <label for="txtDesc_Prod">Producto</label>
                                <input value="<?php echo $Desc_Prod?>" type="text" class="form-control" id="txtDesc_Prod" name="txtDesc_Prod" placeholder="Producto" maxlength="30" required="true">
                            </div>´
            
                        </div>
                        
                        <br><hr>
                    
                        <div class="form-group row">
                            <div class="col offset-5">
                                <input name="enviar" type="submit" id="enviar" value="Actualizar" class="btn btn-primary"> 
                                <a href="Productos.php" class="btn btn-md btn-danger" role="button">Volver</a>
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