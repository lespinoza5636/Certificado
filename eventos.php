<?php
include("Conexion.php");
    class Eventos{

        private $con;

        function __construct()
        {
            $conexion = new Conexion();
            $this->con = $conexion->getCon();
        }

        function setEvento($nombre, $fi, $ff)
        {
            $valida = $this->con->query("INSERT INTO `evento` (`idevento`, `nombre`, `fi`, `ff`) VALUES (NULL, '$nombre', '$fi', '$ff');");

            return $valida;
        }

        function getEvento()
        {
            $result = $this->con->query("select * from evento");

            if ($result->num_rows > 0)
            {
                return $result;
            }
        }

    }
?>