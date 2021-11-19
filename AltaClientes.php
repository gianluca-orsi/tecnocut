<!DOCTYPE html5>
<html lang="es">

<head>
    <title>Alta de Clientes</title>
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
        $Nro_CUIT=$_POST['txtNro_CUIT'];
        $Nombre=$_POST['txtNombre'];
        $Apellido=$_POST['txtApellido'];
        $Email=$_POST['txtEmail'];
        $Telefono=$_POST['txtTelefono']; 
        $Direccion=$_POST['txtDireccion'];
        $Cod_Postal=$_POST['txtCod_Postal']; 

        $consulta = "INSERT INTO clientes (Nro_CUIT, Nombre, Apellido, Email, Telefono, Direccion, Cod_Postal) VALUES ('$Nro_CUIT', '$Nombre', '$Apellido', '$Email', '$Telefono', '$Direccion', '$Cod_Postal')";

        $datos = mysqli_query ($conn, $consulta);
            
        //Vuelta al listado
        echo "<SCRIPT type='text/javascript' language='JavaScript'> window.location = 'Clientes.php'; </SCRIPT>";
        
        mysqli_close($conn);
           
    } else {

        $consulta = "SELECT Cod_Postal, Localidad FROM localidades";

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
        <div class="b1"><h1>Alta de Cliente</h1></div>

        <div class="container">
            
            <div class="row justify-content-md-center">
                <div class="col-10">
    
            <hr><br>
    
            <form action="AltaClientes.php" method="POST" name="agenda-alta">
    
                <div class="form-group row">
                    <div class="col">
                        <label for="txtNro_CUIT">Nº CUIT</label>
                        <input type="text" class="form-control" id="txtNro_CUIT" name="txtNro_CUIT" placeholder="Numero de CUIT" title="Ingresa 11 digitos del Numero de CUIT" maxlength="11" required="true">
                    </div>

                    <div class="col">
                        <label for="txtNombre">Nombre</label>
                        <input type="text" class="form-control" id="txtNombre" name="txtNombre" placeholder="Nombre" maxlength="30" required="true">
                    </div>

                    <div class="col">
                        <label for="txtApellido">Apellido</label>
                        <input type="text" class="form-control" id="txtApellido" name="txtApellido" placeholder="Apellido" maxlength="30" required="true">
                    </div>

                    <div class="col-sm-4">
                        <label for="txtEmail">Email</label>
                        <input type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="Email" maxlength="30" required="true">
                    </div>
                </div>

                <br>

                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="txtTelefono">Telefono</label>
                        <input type="text" class="form-control" id="txtTelefono" name="txtTelefono" placeholder="Telefono" maxlength="15" required="true">
                    </div>

                    <div class="col">
                        <label for="txtDireccion">Direccion</label>
                        <input type="text" class="form-control" id="txtDireccion" name="txtDireccion" placeholder="Direccion" maxlength="50" required="true">
                    </div>

                    <div class="col-sm-3">
                    <label>Codigo Postal</label>
                        <select class='form-control input-sm' id="txtCod_Postal" name="txtCod_Postal">
                        <option value="">Seleccione</option>
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
                        <input name="enviar" type="submit" id="enviar" value="Añadir Cliente" class="btn btn-primary"> 
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