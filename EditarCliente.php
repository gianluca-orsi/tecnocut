<!DOCTYPE html5>
<html lang="es">

<head>
    <title>Editar Cliente</title>
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
        $Nro_CUIT=$_POST['txtNro_CUIT'];
        $Nombre=$_POST['txtNombre'];
        $Apellido=$_POST['txtApellido'];
        $Email=$_POST['txtEmail'];
        $Telefono=$_POST['txtTelefono']; 
        $Direccion=$_POST['txtDireccion'];
        $Cod_Postal=$_POST['txtCod_Postal'];    

        //(SQL) Instruccion SQL modificacion
        $consulta = "UPDATE clientes SET Nombre='$Nombre', Apellido='$Apellido', Email='$Email', Telefono='$Telefono', Direccion='$Direccion', Cod_Postal='$Cod_Postal' WHERE Nro_CUIT = '$Nro_CUIT'";

        //Para que PHP envíe una consulta SQL hacia el gestor de MySQL (PHP)
        $datos= mysqli_query ($conn, $consulta);
            
        //Vuelta al listado
        echo "<SCRIPT type='text/javascript' language='JavaScript'> window.location = 'Clientes.php'; </SCRIPT>";
           
    } else {

        $Nro_CUIT=$_GET['Nro_CUIT'];

        $consulta = "SELECT C.Nro_Cuit, C.Nombre, C.Apellido, C.Email, C.Telefono, C.Direccion, C.Cod_Postal, L.Cod_Postal, L.Localidad FROM clientes C INNER JOIN localidades L WHERE C.Nro_CUIT = '$Nro_CUIT' AND C.Cod_Postal = L.Cod_Postal ";

        echo "<SCRIPT type='text/javascript' language='JavaScript'> alert('".$consulta."');</SCRIPT>"; 

        $datos = mysqli_query ($conn, $consulta);
        
        $valores = mysqli_fetch_array($datos);

        //Asigna a campos del formulario los valores del contacto seleccionado
        
        $Nombre=$valores['Nombre'];
        $Apellido=$valores['Apellido'];
        $Email=$valores['Email'];
        $Telefono=$valores['Telefono'];
        $Direccion=$valores['Direccion'];
        $Cod_Postal=$valores['Cod_Postal'];
        $Localidad=$valores['Localidad'];

        $consulta1 = "SELECT Cod_Postal, Localidad FROM localidades";

        $result = $conn->query($consulta1);

        if ($result->num_rows > 0) {

    }

?>
<div class="contenedor">
    <header class="cabecera"></header>
    <div class="caja4">
        <div class="ti1"><h1>Sistema de Gestion de Pedidos</h1></div>
        <div class="border"></div>
        <div class="b1"><h1>Editar Cliente</h1></div>

        <!-- Comienza el Contenedor Principal -->
        <div class="container">
        
        <div class="row">
            <div class="col-12">
            <br>
            </div>
        </div>

        <hr>

        <form action="EditarCliente.php" method="POST" name="agenda-alta">
    
            <div class="form-group row">
                <div class="col">
                    <label for="txtNro_CUIT">Nº CUIT</label>
                    <input value="<?php echo $Nro_CUIT?>" type="text" class="form-control" id="txtNro_CUIT" name="txtNro_CUIT" placeholder="Numero de CUIT" title="Ingresa 11 digitos del Numero de CUIT" maxlength="11" required="true" readonly>
                </div>
        
                <div class="col">
                    <label for="txtNombre">Nombre</label>
                    <input value="<?php echo $Nombre?>" type="text" class="form-control" id="txtNombre" name="txtNombre" placeholder="Nombre" maxlength="30" required="true">
                </div>
        
                <div class="col">
                    <label for="txtApellido">Apellido</label>
                    <input value="<?php echo $Apellido?>" type="text" class="form-control" id="txtApellido" name="txtApellido" placeholder="Apellido" maxlength="30" required="true">
                </div>
        
                <div class="col-sm-4">
                    <label for="txtEmail">Email</label>
                    <input value="<?php echo $Email?>" type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="Email" maxlength="30" required="true">
                </div>
            </div>
        
            <br>
        
            <div class="form-group row">
                <div class="col-sm-3">
                    <label for="txtTelefono">Telefono</label>
                    <input value="<?php echo $Telefono?>" type="text" class="form-control" id="txtTelefono" name="txtTelefono" placeholder="Telefono" maxlength="15" required="true">
                </div>
        
                <div class="col">
                    <label for="txtDireccion">Direccion</label>
                    <input value="<?php echo $Direccion?>" type="text" class="form-control" id="txtDireccion" name="txtDireccion" placeholder="Direccion" maxlength="50" required="true">
                </div>
        
                <div class="col-sm-3">
                <label>Codigo Postal</label>
                    <select class='form-control input-sm' id="txtCod_Postal" name="txtCod_Postal">
                        <option value=""><?php echo $Cod_Postal,' - ',$Localidad?></option>
                        <?php 
                            while ($row = $result->fetch_assoc()){
                                $output = "<option value='".$row['Cod_Postal']."'";
                                if($_POST['txtCod_Postal'] == $row['Cod_Postal']){
                                    $output .= " selected='selected'";
                                }
                                $output .= ">".$row['Cod_Postal']." - ".$row["Localidad"]."</option>";
                                echo $output;
                            }
                        }
                        mysqli_close($conn);
                        ?>    
                    </select>
                </div>

        
            </div>
            
            <br><hr>
        
            <div class="form-group row">
                <div class="col offset-5">
                    <input name="enviar" type="submit" id="enviar" value="Actualizar" class="btn btn-primary"> 
                    <a href="Clientes.php" class="btn btn-md btn-danger" role="button">Volver</a>
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