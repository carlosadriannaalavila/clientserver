<?php


/**
 * Class MyGetFileController
 */
class MyGetFileController extends GetFileControllerCore
{
    /**
    * Resource to overrid method init()
    */
    public function init()
    {
        //Firs generate the Key and get all user data
        $key = getNewKey();
        
        //$hash = getHash(Tools:getValue('secure_key'));
        $secureKey = Tools::getValue('secure_key');
        $info = getOrderData($secureKey);
        
        if(isset($idUsuario = $info['id_customer'])
        {
            
        }
        
        //Obtain order_reference from ps_order_payment
        
        $orderReference = 'MUHSDBASD';
        
        
        $filename = ProductDownload::getFilenameFromFilename(Tools::getValue('file'));
        
        
        //Second insert data to ws_webservice
        updateDatabase($orderReference, $usermail, $key);
        
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
    * @param $user = considera la llave del usuario
    * @param $password = es la contraseña del usuario
    * @param $key = llave generada para poder desbloquear los usuarios.
    * @return connection
    */
    protected static function getOrderReference($hash){
        if ($hash == '') {
            return false;
        }
        $sql = 'SELECT *
		FROM `'._DB_PREFIX_.'order_detail` od
		LEFT JOIN `'._DB_PREFIX_.'product_download` pd ON (od.`product_id`=pd.`id_product`)
		WHERE od.`download_hash` = \''.pSQL(strval($hash)).'\'
		AND pd.`active` = 1';
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($sql);
    }
    
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
    
    protected static function getOrderData($secure_key)
    {
        if ($hash == '') {
            return false;
        }
        
        $sql = 'SELECT * FROM `'.DB_PREFXI_.'orders WHERE secure_key = '.pSQL(strval($secure_key));
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($sql);
    }
        
}