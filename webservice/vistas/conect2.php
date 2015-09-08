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
	echo "Error Processing Request";

 }else{
	//Creamos un objeto JSON
	$json_string = json_encode($webservicee);
	echo "La clave para el producto solicitado es: ".$key;
	echo "<br>"; //* Esto es un salto de linea
	echo "El archivo JSON generado es customer2.json";
	

 
	//Creamos un archivo json
	$file = 'customer2.json';
	file_put_contents($file, $json_string);}
	echo "<br>";
	echo "<input type='button' value='Regresar' onclick='history.go(-1)'>";

?>