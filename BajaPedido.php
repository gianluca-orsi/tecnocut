<!DOCTYPE html5>
<html lang="es">

<head>
    <title>SGP - Baja de Pedido</title>
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
        $Nro_CUIT=$_POST['txtNro_CUIT'];

        $consulta = "DELETE FROM clientes WHERE Nro_CUIT = '$Nro_CUIT' ";

        $datos = mysqli_query ($conn, $consulta);  
            
        //Vuelta al listado
        echo "<SCRIPT type='text/javascript' language='JavaScript'> window.location = 'Clientes.php'; </SCRIPT>";
           
    } else {
        
        $Nro_CUIT=$_GET['Nro_CUIT'];

        $consulta = "SELECT * FROM clientes WHERE Nro_CUIT = '$Nro_CUIT' ";

        echo "<SCRIPT type='text/javascript' language='JavaScript'> alert('".$consulta."');</SCRIPT>"; 

        $datos = mysqli_query ($conn, $consulta);
        
        $valores = mysqli_fetch_array($datos);

        //Asigna a campos del formulario los valores del contacto seleccionado
        $Nro_CUIT=$valores['Nro_CUIT'];
        $Nombre=$valores['Nombre'];
        $Apellido=$valores['Apellido'];
        $Email=$valores['Email'];
        $Telefono=$valores['Telefono'];
        $Direccion=$valores['Direccion'];
        $Cod_Postal=$valores['Cod_Postal'];

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
                    Baja de Pedido
                </p>
            </header>
        </div>

        <div class="container">
            
            <div class="row justify-content-md-center">
                <div class="col-10">
    
            <form action="BajaPedido.php" method="POST" name="agenda-alta" style="background-color: white" class="p-3">
    
                <div class="form-group row">
                    <div class="col">
                        <label for="txtNro_CUIT">Nº CUIT</label>
                        <input value="<?php echo $Nro_CUIT?>" type="text" class="form-control" id="txtNro_CUIT" name="txtNro_CUIT" placeholder="Numero de CUIT" title="Ingresa 11 digitos del Numero de CUIT" maxlength="11" readonly>
                    </div>

                    <div class="col">
                        <label for="txtNombre">Nombre</label>
                        <input value="<?php echo $Nombre?>" type="text" class="form-control" id="txtNombre" name="txtNombre" placeholder="Nombre" maxlength="30" readonly>
                    </div>

                    <div class="col">
                        <label for="txtApellido">Apellido</label>
                        <input value="<?php echo $Apellido?>" type="text" class="form-control" id="txtApellido" name="txtApellido" placeholder="Apellido" maxlength="30" readonly>
                    </div>

                    <div class="col-sm-4">
                        <label for="txtEmail">Email</label>
                        <input value="<?php echo $Email?>" type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="Email" maxlength="30" readonly>
                    </div>
                </div>

                <br>

                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="txtTelefono">Telefono</label>
                        <input value="<?php echo $Telefono?>" type="text" class="form-control" id="txtTelefono" name="txtTelefono" placeholder="Telefono" maxlength="15" readonly>
                    </div>

                    <div class="col">
                        <label for="txtDireccion">Direccion</label>
                        <input value="<?php echo $Direccion?>" type="text" class="form-control" id="txtDireccion" name="txtDireccion" placeholder="Direccion" maxlength="50" readonly>
                    </div>

                    <div class="col-sm-2">
                        <label for="txtCod_Postal">Codigo Postal</label>
                        <input value="<?php echo $Cod_Postal?>" type="text" class="form-control" id="txtCod_Postal" name="txtCod_Postal" placeholder="Codigo Postal" maxlength="4" readonly>
                    </div>

                </div>
                
                <br><hr>
    
                <div class="form-group row">
                    <div class="col offset-5">
                        <input name="enviar" type="submit" id="enviar" value="Borrar Cliente" class="btn btn-primary"> 
                        <a href="Clientes.php" class="btn btn-md btn-danger" role="button">Volver</a>
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