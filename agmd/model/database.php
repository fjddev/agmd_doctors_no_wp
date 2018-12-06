<?php

class Database {

    /*

     * PDO Object

     *          Parameters:

     *                      DSN: Data Source Name

     *                      Username

     *                      Password

     * 

     */

	/* 

    private static $dsn = 'mysql:host=localhost;dbname=AGMD';

    private static $username = 'root';  

    private static $password = 'pa55word';   

    */
// www.agmdhope.org
// agmdho5_admin
    private static $dsn = 'mysql:host=www.agmdhope.org;dbname=agmdho5_admin';

    private static $username = 'agmdho5_dev';  

    private static $password = 'd5v%0gMd';

    private static $db;



    private function __construct() {}



    public static function getDB () {

        if (!isset(self::$db)) {

            try {

                self::$db = new PDO(self::$dsn,

                                     self::$username,

                                     self::$password);

                

                

            } catch (PDOException $e) {

                $error_message = $e->getMessage();

                // include('../errors/database_error.php');
                die("Problem with database! " . $error_message);

                exit();

            }

        }

        return self::$db;

    }

}

?>