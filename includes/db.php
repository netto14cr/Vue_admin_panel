<?php

class Database {
    private $con;

    public function __construct() {
        // Detectar el entorno (local o remoto)
        if ($_SERVER['SERVER_NAME'] === 'localhost') {
            // Configuración para entorno local
            $host = "localhost";
            $username = "root";
            $password = "";
            $database = "ecom_store";
        } else {
            // Configuración para servidor remoto
            $host = "mysql-tienda.alwaysdata.net";
            $username = "tienda";
            $password = "Carroverde123@";
            $database = "tienda_ecom_store";
        }

        $this->con = mysqli_connect($host, $username, $password, $database);

        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
    }

    public function getConnection() {
        return $this->con;
    }

    public function closeConnection() {
        mysqli_close($this->con);
    }
}


// Usar la conexión dentro de la clase Database
$con = (new Database)->getConnection();