<?php
    class Conexion{

        private $con;

        function __construct()
        {
            $this->con = new mysqli("localhost", "root", "", "certificados");
            if ($this->con->connect_errno) {
                echo "Fallo al conectar a MySQL: (" . $this->con->connect_errno . ") " . $this->con->connect_error;
            }
        }

        function getCon()
        {
            return $this->con;
        }
    }
?>