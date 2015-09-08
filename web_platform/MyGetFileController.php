<?php

class MyGetFileController extends GetfileController
{
    protected $downloaded = false;
    protected $setKey;
    
    public function init()
    {
        $file = _PS_DOWNLOAD_DIR_.strval(preg_replace('/\.{2,}/', '.', $filename));
        $filename = ProductDownload::getFilenameFromFilename(Tools::getValue('file'));
        $user = Context::default();
        $tmp = explode('-', $key);
            if (count($tmp) != 2) {
                $this->displayCustomError('Invalid key.');
            }
    }
    
    protected function updateDatabase($host, $idproduct, $user, $password, $key)
    {
        $result = MySQLOverride::setKeys($idproduct,$user, $password, $key,);
        if (!result) return true;
        
        return result;
    }
        
}