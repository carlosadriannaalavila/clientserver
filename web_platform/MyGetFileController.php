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
        $useremail = 'carlosnaalavila@gmail.com';
        $idproduct = 'MUHSDBASD';
        $passwordk = 'mypassword';
        
        $filename = ProductDownload::getFilenameFromFilename(Tools::getValue('file'));
        
        
        //Second insert data to ws_webservice
        updateDatabase($idproduct, $usermail, $passwordk, $key);
        
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
    
    
    protected function updateDatabase($idproduct, $user, $password, $key)
    {
        $connection = MySQLCore::connect();
        $result = MySQLOverride::setKeys($idproduct,$user, $password, $key,);
        if (!result) return true;
        
        return result;
    }
    
    protected function getNewKey()
    {
        return "hola";
    }
        
}