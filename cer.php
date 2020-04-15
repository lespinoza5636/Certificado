<?php
include("Conexion.php");
class Certificados{

    private $con;
    private $nombre_img;

    function __construct()
    {
        $conexion = new Conexion();
        $this->con = $conexion->getCon();
    }

    function setCertificados($cedula, $nombre, $apellido, $correo, $tipo, $id)
    {
        
        $codigo = date("Y"). "-".substr($cedula, 3, 6)."-TE-".rand(10000, 90000);
        $condicion = self::getParticipante($cedula);

        if (!$condicion)
        {
            $sql_participante = "INSERT INTO `participante` (`cedula`, `nombre`, `apellido`, `correo`, `tipo_id`) VALUES ('$cedula', '$nombre', '$apellido', '$correo', $tipo);";
            $result_participante = $this->con->query($sql_participante);
        }
        
        if ($sql_participante or $condicion)
        {
            $sql = "INSERT INTO `certificado` (`codigo`, `evento_idevento`, `participante_cedula`) VALUES ('$codigo', '$id', '$cedula');";
            $result = $this->con->query($sql);
                
            if ($result)
            {
                 echo "<script type='text/javascript'>
                 window.location='pe.php?resp=1&id=$id';
                 </script>";
            }
            else{
                echo "<script type='text/javascript'>
                window.location='panel.php?resp=2';
                </script>";
            }
        }
    }

    

    function getListaParticipante($id)
        {
            $result = $this->con->query("SELECT * FROM `certificado` as cer inner join `participante` as par
            on cer.`participante_cedula` = par.cedula 
            where `evento_idevento` = $id limit 10");

            if ($result->num_rows > 0)
            {
                return $result;
            }
            else
            {
                return false;
            }
        }

        function getParticipante($id)
        {
            $result = $this->con->query("SELECT * FROM `participante` where `cedula` = $id");

            if ($result->num_rows > 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        function getTipo()
        {
            $result = $this->con->query("SELECT * FROM `tipos`");

            if ($result->num_rows > 0)
            {
                return $result;
            }
            else
            {
                return false;
            }
        }
    
    function subirImagen($archivo_img, $codigo)
    {
        $nombre_archivo = $archivo_img['name'];
        $tipo_archivo = $archivo_img['type'];
        $tamano_archivo = $archivo_img['size'];
        $archivo= $archivo_img['tmp_name'];
    
        if ($nombre_archivo!="")
        {
            //Limitar el tipo de archivo y el tamaño    
            if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "png")) && ($tamano_archivo  < 50000000))) 
            {
                return "El tamaño de los archivos no es correcta. <br><br><table><tr><td><li>Se permiten archivos de 5 Mb máximo.</td></tr></table>";
            }
            else
            {
                $file = $archivo_img['name'];
                $res = explode(".", $nombre_archivo);
                $extension = $res[count($res)-1];
                $nombre= $codigo."." . $extension; //renombrarlo como nosotros queremos
                $this->nombre_img = $nombre;
                $dirtemp = "cer/".$nombre."";//Directorio temporaral para subir el fichero
    
                if (is_uploaded_file($archivo_img['tmp_name'])) {
                    $valor = copy($archivo_img['tmp_name'], $dirtemp);
    
                    //unlink($dirtemp); //Borrar el fichero temporal
                    return $valor;
                   }
                else
                {
                    return "Ocurrió algún error al subir el fichero. No pudo guardarse.";
                }
    
            }
        }
    }
}

?>