<?php
include("Conexion.php");
    class User{

        private $con;

        function __construct()
        {
            $conexion = new Conexion();
            $this->con = $conexion->getCon();
        }

        function login($user, $pass)
        {
            $result = $this->con->query("select * from usuario where participante_cedula = '$user' and pass = md5('$pass')");

            $id = 0;

            if ($result->num_rows > 0)
            {
                foreach ($result as $key => $value) {
                    $_SESSION["id"] = $value["id"];
                    $id = $value["id"];    
                }

                $consulta = $this->con->query("UPDATE `usuario` SET `login` = '1' WHERE `usuario`.`id` = $id;");
                if ($consulta)
                {
                    header("Location: panel.php");
                }
            }
        }

        function comprobarLogin($id)
        {
            $result = $this->con->query("select * from usuario where id = '$id' and login = 1");

            if ($result->num_rows > 0)
            {
                foreach ($result as $key => $value) {
                    $_SESSION["id"] = $value["id"];
                    $id = $value["id"];    
                }

                $consulta = $this->con->query("UPDATE `usuario` SET `login` = '1' WHERE `usuario`.`id` = $id;");
                if ($consulta)
                {
                    header("Location: panel.php");
                }
            }
        }

    }
?>