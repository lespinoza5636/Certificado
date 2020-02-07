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
            else
            {
                return false;
            }
        }

        function deleteEvento($id)
        {
            $deleteParticipantes = $this->con->query(
                "DELETE FROM `certificado` WHERE `certificado`.`evento_idevento` = '$id'");
            
            if ($deleteParticipantes)
            {
                $deleteEventos = $this->con->query(
                    "DELETE FROM `evento` WHERE `evento`.`idevento` = $id");
                
                return $deleteEventos;
            }
        }

    }
?>