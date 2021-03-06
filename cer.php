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
            $sql_participante = "INSERT INTO `participante` (`cedula`, `nombre`, `apellido`, `correo`) VALUES ('$cedula', '$nombre', '$apellido', '$correo');";
            $result_participante = $this->con->query($sql_participante);
        }
        else{
            $result_participante = true;
        }
        
        

        if ($result_participante or $condicion)
        {
            $condicion2 = self::getVerificaParticipante($cedula, $id);
            if (!$condicion2)
            {
                $sql = "INSERT INTO `certificado` (`codigo`, `evento_idevento`, `participante_cedula`, `tipo_id`) VALUES ('$codigo', '$id', '$cedula',  $tipo);";
                $result = $this->con->query($sql);
                
                if ($result)
                {
                     echo "<script type='text/javascript'>
                     window.location='pe.php?resp=1&id=$id';
                     </script>";
                }
                else{
                    echo "<script type='text/javascript'>
                    window.location='pe.php?resp=2&id=$id';
                    </script>";
                }
            }
            else{
                echo "<script type='text/javascript'>
                window.location='pe.php?resp=3&id=$id';
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

        function getListaParticipanteFiltro()
        {
            $id = $_COOKIE["id"];

            $cadena = "SELECT * FROM `certificado` as cer inner join `participante` as par
            on cer.`participante_cedula` = par.cedula 
            where `evento_idevento` = $id";

            if (isset($_COOKIE["cedula"]))
            {
                $cadena .= " and cedula = '" . $_COOKIE["cedula"]."'";
            }
            
            if (isset($_COOKIE["nombre"]))
            {
                $cadena .= " and nombre = '" . $_COOKIE["nombre"]."'";
            }

            if (isset($_COOKIE["apellido"]))
            {
                $cadena .= " and apellido = '" . $_COOKIE["apellido"]."'";
            }

            $result = $this->con->query($cadena);

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

            $result = $this->con->query("SELECT * FROM `participante` where `cedula` = '$id'");

            if ($result)
            {
                if ($result->num_rows > 0)
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
        }

        function getVerificaParticipante($cedula, $id)
        {
            //echo "SELECT * FROM `certificado` where `participante_cedula	` = '$cedula'
            //and evento_idevento = $id";
            //exit();
            $result = $this->con->query("SELECT * FROM `certificado` where `participante_cedula` = '$cedula'
            and evento_idevento = $id");

            if ($result)
            {
                if ($result->num_rows > 0)
                {
                    return true;
                }
                else
                {
                    return false;
                }
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

        function getCertificadoParticipante($id, $cedula)
        {
            $result = $this->con->query("SELECT certificado.codigo, evento.nombre as congreso, tipos.nombre as tipo FROM `certificado` INNER JOIN `evento` INNER JOIN `tipos` ON
            tipos.id = certificado.tipo_id and certificado.evento_idevento = evento.idevento WHERE certificado.participante_cedula = '$cedula' and certificado.evento_idevento = $id");

            if ($result->num_rows > 0)
            {
                return $result;
            }
            else
            {
                return false;
            }
        }

        function delCer($id)
        {
            $result = $this->con->query("DELETE FROM `certificado` WHERE `certificado`.`codigo` = '$id'");

            if ($result)
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        function delParticipante($cedula)
        {
            //  echo "DELETE FROM `participante` WHERE `participante`.`cedula` = '$cedula'";
            //  exit();
             $result_cer = $this->con->query("DELETE FROM `certificado` WHERE `certificado`.`participante_cedula` = '$cedula'");

            if ($result_cer)
            {
                // echo "DELETE FROM `participante` WHERE `participante`.`cedula` = '$cedula'";
                // exit();
                $result = $this->con->query("DELETE FROM `participante` WHERE `participante`.`cedula` = '$cedula'");

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
            //Limitar el tipo de archivo y el tama??o    
            if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "png")) && ($tamano_archivo  < 10000000))) 
            {
                return "El tama??o de los archivos no es correcta. <br><br><table><tr><td><li>Se permiten archivos de 1 Mb m??ximo.</td></tr></table>";
            }
            else
            {
                $file = $archivo_img['name'];
                $res = explode(".", $nombre_archivo);
                $extension = $res[count($res)-1];
                $nombre= $codigo."." . "jpg"; //renombrarlo como nosotros queremos
                $this->nombre_img = $nombre;
                $dirtemp = "cer/".$nombre."";//Directorio temporaral para subir el fichero
    
                if (is_uploaded_file($archivo_img['tmp_name'])) {
                    $valor = copy($archivo_img['tmp_name'], $dirtemp);
    
                    //unlink($dirtemp); //Borrar el fichero temporal
                    return $valor;
                   }
                else
                {
                    return "Ocurri?? alg??n error al subir el fichero. No pudo guardarse.";
                }
    
            }
        }
    }

    function setModelo($archivo, $tipo, $id)
    {
        
        $codigo = date("Y")."-TE-".rand(10000, 90000).$id;
        
        $result = self::subirImagen($archivo, $codigo);
        
        if (gettype($result) == "string")
        {
            return $result;
        }
        else
        if (gettype($result) == "boolean" and $result == true)
        {
            $result = $this->con->query("SELECT * FROM `modleo` where `tipo_id` = $tipo and evento_id = $id");

            if ($result->num_rows > 0)
            {
                echo "<script type='text/javascript'>
                 window.location='modelo.php?resp=4&id=$id';
                 </script>";
            }
            else
            {
                $sql_modelo = "INSERT INTO `modleo` (`imagen`, `tipo_id`, `evento_id`) VALUES ('$codigo', '$tipo', '$id');";
                $result_modelo = $this->con->query($sql_modelo);

                if ($result_modelo)
                {
                    echo "<script type='text/javascript'>
                 window.location='modelo.php?resp=1&id=$id';
                 </script>";
                }
                else{
                    echo "<script type='text/javascript'>
                 window.location='modelo.php?resp=2&id=$id';
                 </script>";
                }
            }
        }
        else
        {
            echo "<script type='text/javascript'>
                 window.location='modelo.php?resp=3&id=$id';
                 </script>";
        }
    }

    
  function getListaModelosDiplomas()
  {
    $result = $this->con->query("SELECT modleo.imagen, modleo.idm, tipos.nombre as tipos 

    FROM modleo
    
    INNER JOIN tipos ON (modleo.tipo_id=tipos.id)");
 
    if ($result)
  {
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

  function funcionEliminar($id, $img)
    {
        $dir = "cer/"; /*Ruta local donde se almacenan tu imagen*/
        echo $dir.$img."jpg";
        if (unlink($dir.$img.".jpg"))
        {
            $deletediploma = $this->con->query("DELETE FROM `modleo` WHERE `modleo`.`idm` = '$id'");
            return $deletediploma;

        }
        else
        {
            echo "ERROR";
            exit();
        }  /* Eliminas tu Imagen*/

        

        //unlink("/cer".$foto); 
            
    }


}

?>
