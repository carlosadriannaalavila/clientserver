<?php


/**
 * Class MyGetFileController
 */
class MyGetFileController extends GetFileControllerCore
{
    /**
    * Resource to override method init()
    */
    public function init()
    {
        //Firs generate the Key and get all user data
        $key = getNewKey();
        $hash = getHash(Tools:getValue('secure_key'));
        //Se encuentra toda la información
        $info = getOrderData($hash);
        $orderReference = 'MUHSDBASD';
        $idCostumer = '';
        
        if(!isset($idCostumer = $info['id_customer'])
        {
            $this->parent::displayCustomError('you have already downloaded the unlocker_key');
        } else {
            $orderReference = $info['reference'];
        }
        
        //Second insert data to ws_webservice
        updateDatabase($orderReference, $idCostumer, $key);
        
        //Calling the GetFileController init() function
        parent::init();
    }
    
    /**
    * @param $idproduct = guarda la llave del producto
    * @param $user = considera la llave del usuario
    * @param $password = es la contraseña del usuario
    * @param $key = llave generada para poder desbloquear los usuarios.
    * @return connection
    */
    protected function updateDatabase($orderReference, $user, $key)
    {
        $connection = MySQLCore::connect();
        $result = MySQLOverride::setKeys($idproduct, $user, $key,);
        if (!result) return true;
        
        return result;
    }
    
    /**
    * Generates a Key for products.
    */
        
    protected function getNewKey()
    {
        return "hola";
    }
    
    /**
    * @param $hash = Es 
    * @return SQL
    */
    protected static function getOrderData($hash){
        if ($hash == '') {
            return false;
        }
        $sql = 'SELECT *
		FROM `'._DB_PREFIX_.'orders` os
		LEFT JOIN `'._DB_PREFIX_.'order_detail` od ON (os.`id_order`=od.`id_order`)
		WHERE od.`download_hash` = \''.pSQL(strval($hash)).'\'
		AND pd.`active` = 1 AND  and download_nb < 1';
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($sql);
    }
    
    /**
    * Obtiene el hash de un input key
    * @param $key = Cadena unica asignada al usuario para su descarga.
    * @return $hash = cadena de descarga unica por usuario para enlazarlo con su archivo.
    */
    protected static function getHash($key)
    {
        $tmp = explode('-',$key);
        if (count($tmp) != 2) {
                $this->displayCustomError('Invalid key.');
            }
        $filename = $tmp[0];
        $hash = $tmp[1];
        return $hash;
    }
    
    /**
    * Saves data on DB
    * @param $idCostumer = Id del cliente que compro la descarga directa.
    * @param $orderReference = referencia que se asigna a la descarga de un producto virtual.
    * @param $key= llave generada para el uso del usuario y para descargar productos virtuales.
    * @return $result = resultado de la ejecución SQL.
    */
    protected static function persisteData($idCostumer, $orderReference, $key)
    {
        $sql = 'INSERT INTO `'._DB_PREFIX_'ps_webservice` VALUES ('.strval($orderReference).','.(int)$idCostumer.','.strval($key).',null);';
        return DB::getInstance(_PS_USE_SQL_SLAVE_)->execute($sql);
    }
}