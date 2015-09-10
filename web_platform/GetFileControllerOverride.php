<?php


/**
 * Class GetFileControllerOverride
 */
class GetFileControllerOverride extends GetFileControllerCore
{
    /**
    * Resource to override method init()
    */
    public function init()
    {
        //Firs generate the Key and get all user data
        $key = getNewKey();
        $hash = getHash(Tools::getValue('secure_key'));
        //Se encuentra toda la información
        $info1 = getOrderData($hash);
        $idCostumer = $info1['id_customer']
        $orderReference = $info1['reference'];
        //Second insert data to ps_webservice
        persistData($idCostumer, $orderReference, $key);
        
        //calling the init from GetFileControllerCore
        parent::init();
    }
    
    /**
    * Generates a Key for products.
    */
    protected function getNewKey()
    {
        return "hola";
    }
    
    /**
    * @param $hash = llave para obtener la información de la compra
    * @return SQL
    */
    protected function getOrderData($hash)
    {
        if ($hash == '') {
            return false;
        }
        $sql = 'SELECT *
		FROM `'._DB_PREFIX_.'orders` os
		LEFT JOIN `'._DB_PREFIX_.'order_detail` od ON (os.`id_order`=od.`id_order`)
		WHERE od.`download_hash` = \''.pSQL(strval($hash)).'\'
		AND od.download_nb < 1';
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($sql);
    }
    
    /**
    * Obtiene el hash de un input key
    * @param $key = Cadena unica asignada al usuario para su descarga.
    * @return $hash = cadena de descarga unica por usuario para enlazarlo con su archivo.
    */
    protected function getHash($key)
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
    protected function persistData($id, $or, $k)
    {
        return DB::getInstance()->insert('webservice', array(
            'reference' => pSQL($or),
            'id_customer' => (int)$id,
            'key' => pSQL($k),
            'download_date' => null,
        ));
    }
}