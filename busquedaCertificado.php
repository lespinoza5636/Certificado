<?php
include ("conexion.php");

    class certi {
        private $con;

        function __construct()
        {
        $conexion = new Conexion();
        $this->con = $conexion->getCon();
        }

        function getcertiParticipante($codigo)
        {

         $result = $this->con->query("SELECT certificado.codigo, evento.nombre as nameevento, 
         participante.nombre as nombre,
         participante.apellido as apellido,
         tipos.nombre as tipo,
         modleo.imagen as imagen
         FROM certificado
         INNER JOIN evento ON (certificado.evento_idevento=evento.idevento)
         INNER JOIN participante ON (certificado.participante_cedula=participante.cedula)
         INNER JOIN tipos ON (certificado.tipo_id=tipos.id)
         INNER JOIN modleo ON (certificado.tipo_id=modleo.tipo_id) 
         WHERE participante_cedula = '$codigo' ");
 
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
      }
?>