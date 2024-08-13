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
    public function getConn(){
        $db_host = "localhost";
        $db_name = "inmanage";
        $db_user = "cms_inmanage";
        $db_pass = "A1Q/LBpgHoq_VQbk";

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