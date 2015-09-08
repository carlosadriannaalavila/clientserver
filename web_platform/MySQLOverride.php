<?php

public class MySQLOverride extends MySQLCore
{
    
    /**
     * Tries to connect and update a 'prestashop.web_service' table
     *
     * @param string $host
     * @param string $idproduct
     * @param string $user
     * @param string $password
     * @param string $key
     * @param bool $dropit If true, rollback the changes
     * @return bool|resource
     */
    public function setKeys($host, $idproduct, $user, $password, $key, $dropit = false){
        
        $link = mysql_connect($host, $user, $password);
        $result = mysql_query('INSERT INTO `'.str_replace('`', '\\`', 'prestashop.key_webserice').'` SET '
                              .str_replace('`', '\\`', $idproduct).', '
                              .str_replace('`', '\\`', $user).', '
                              .str_replace('`', '\\`', 'null').', '
                              .str_replace('`', '\\`', $key).', ', $link);
        
        if ($dropit && (mysql_query('ROLLBACK', $link) !== false)) {
            return true;
        }
        
        return $success;
    }
}