<?php

class db_loader
{
    protected $db_connection;

    static function connect() {
        // the db info is from the config file
        $db_connection = new PDO('mysql:dbname='. db.';host=' . db_host, db_login, db_pass);
        return $db_connection;
    }
}
