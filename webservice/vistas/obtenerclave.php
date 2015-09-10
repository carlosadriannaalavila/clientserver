<?php
	$server= "localhost";
	$user= "root";
	$pwd="";
	$bd="prestashop";

    $email= $_POST['email'];
    $cod_prod=$_POST['cod_prod'];
    $webservicee = array(); //creamos un array para sacar las variables
	
	//Creamos la conexión
	try
	{
		$conexion = new mysqli($server, $user, $pwd,$bd);
		//or die("ERROR DE CONEXION EN LA BD");
		if($conexion->connect_errno){
			throw new Exception("Error Processing Request", 1);
		}
	

	}catch (Exception $e){
    	echo "Error al conectar con la base de datos";
    }
	$conexion->set_charset("utf8");

	//generamos la consulta
	$sql = "SELECT * FROM ps_webservice WHERE user = '".$email."' AND IdProduct = '".$cod_prod."'";
	
    try
    {
       $result=$conexion->query($sql);
       
       if (!$result){
       	throw new Exception("Error Processing Request", 1);
       	
       }

      while($row = mysqli_fetch_array($result)) 
	{ 
    	$IdProduct=$row['IdProduct'];
    	$user=$row['user'];
    	$download_date=$row['download_date'];
    	$key=$row['key'];
 
    	$webservicee[] = array('IdProduct'=> $IdProduct, 'user'=> $user, 'download_date'=> $download_date, 'key'=> $key);
	}

     

    } catch (Exception $e){
    	echo "Error en la consulta".$e;
    }



	//desconectamos la base de datos
	$close = mysqli_close($conexion) 
	or die("Ha sucedido un error inexperado en la desconexion de la base de datos");
  
 if ($webservicee==null){
	$mensaje="¡Por favor verifique que los datos ingresados esten correctos!";

 }else{
	//Creamos un objeto JSON
	/*$json_string = json_encode($webservicee);
	echo "La clave para el producto solicitado es: ".$key;
	echo "<br>"; //* Esto es un salto de linea
	echo "El archivo JSON generado es customer2.json";
	*/
	$mensaje="La clave para desbloquear su producto es: ".$key;

 
	//Creamos un archivo json
	/*$file = '../customer2.json';
	file_put_contents($file, $json_string);}
	echo "<br>";
	echo "<input type='button' value='Regresar' onclick='history.go(-1)'>";
	*/
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CIMAT Dev Store</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    
    
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">

        <div align="center" class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <h4><br>CIMAT Dev Store</h4>
        </div>

    </div>
</nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Gracias por comprar con nosotros</div>
                    <div class="panel-body">                                                    
                            <div class="panel-group">
                                <label class="col-md-8 control-label"><?php echo $mensaje; ?></label>
                                
                            </div>
                            <br>
                            <br>
                            <div class="panel-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="button" onclick="history.go(-1)" class="btn btn-primary" style="margin-right: 15px;">
                                        Regresar
                                    </button>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>