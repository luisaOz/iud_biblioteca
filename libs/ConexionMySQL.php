<?php

class ConexionMySQL {

    // Para manejar la conexion a la base de datos
    private $conn;
    private static $instance;

    // constructor de una clase php
    private function __construct() {
        $this->conn = new mysqli('localhost', 'root', '', 'biblioteca-iud');

        if ($this->conn->connect_errno) {
            //die('Error al conectar MySQL (' . $this->conn->connect_errno . ')' . $this->connect_error);
        }
    }

    public static function getInstance() {
        // si no esta definida la instancia, la creo
        if (!self::$instance) {
            self::$instance = new ConexionMysql();
        }
        return self::$instance;
    }

    public function cerrarConexion() {
        $this->conn->close();
    }

    public function ejecutarSQL($sql) {
        $result = $this->conn->query($sql);
        return $result;
    }

    public function obtenerFilasAfectadas() {
        return $this->conn->affected_rows;
    }

    public function getFilas($result) {
        return $result->fetch_assoc();
    }

}

?>