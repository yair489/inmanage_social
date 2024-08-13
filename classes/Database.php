<?php

/**
 * Database
 * 
 * A connection to database
 */

class Database{

    /**
     * connection 
     * 
     * @return  PDO object conncection to server 
     */
    public function gecConn(){
        $db_host = "localhost";
        $db_name = "cms";
        $db_user = "cms_www";
        $db_pass = "is.CnI9]B5rKVIo[";

        $dsn = 'mysql:host=' . $db_host . ';dbname=' . $db_name . ';charset=utf8';

        try {

            $db = new PDO($dsn, $db_user, $db_pass);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $db;

        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }

}