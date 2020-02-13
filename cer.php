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

    function setCertificados($archivo, $cedula, $nombre, $apellido, $correo, $id)
    {
        $codigo = date("Y"). "-".substr($cedula, 3, 6)."-TE-".rand(10000, 90000);
        $result = self::subirImagen($archivo, $codigo);
        if (gettype($result) == "string")
        {
            return $result;
            exit();
        }
        else
        if (gettype($result) == "boolean" and $result == true)
        {
            $codigo = date("Y"). "-".substr($cedula, 3, 6)."-TE-".rand(10000, 90000);
            echo $codigo;

            $sql_participante = "INSERT INTO `participante` (`cedula`, `nombre`, `apellido`, `correo`) VALUES ('$cedula', '$nombre', '$apellido', '$correo');";
            $result_participante = $this->con->query($sql_participante);
            
            if ($sql_participante)
            {
                $sql = "INSERT INTO `certificado` (`codigo`, `img`, `evento_idevento`, `participante_cedula`) VALUES ('$codigo', '$this->nombre_img', '$id', '$cedula');";
                $result = $this->con->query($sql);
                
                if ($result)
                {
                    echo "Exito";
                    exit();
                }
            }
            exit();
        }
        else
        {

        }
        exit();
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
}

?>