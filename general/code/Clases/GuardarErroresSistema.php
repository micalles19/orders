<?php
class GuardarErroresSistema
{
    private $conexion;
    public
        $archivo,
        $consultasql,
        $idFactura,
        $mensaje,
        $excepcion,
        $funcionActual,
         $usuario;

    function __construct()
    {
        $con = new connect();
        $this->conexion = $con->connectDB();

    }


    public function guardarLogError()
    {
        $respuesta = new stdClass();
        date_default_timezone_set('America/El_Salvador');
        $hoy = date("Y-m-d H:i:s");
        try {
            $sistemaOperativo = $this->detectarSistemaOperativo();

            $sql = "insert into logs_sistema(archivo, consultasql, idfactura, idUsuario, mensaje, excepcion, sistemaOperativo, funcionactual, fechaRegistro)
                    values (:archivo, :consultasql, :idfactura, :idUsuario, :mensaje,  :excepcion, :sistemaOperativo,:funcionactual, :hoy)";

            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':archivo', $this->archivo, PDO::PARAM_STR);
            $stmt->bindParam(':consultasql', $this->consultasql, PDO::PARAM_STR);
            $stmt->bindParam(':idfactura', $this->idFactura, PDO::PARAM_STR);
            $stmt->bindParam(':idUsuario', $this->usuario, PDO::PARAM_STR);
            $stmt->bindParam(':mensaje', $this->mensaje, PDO::PARAM_STR);
            $stmt->bindParam(':excepcion', $this->excepcion, PDO::PARAM_STR);
            $stmt->bindParam(':sistemaOperativo', $sistemaOperativo, PDO::PARAM_STR);
            $stmt->bindParam(':funcionactual', $this->funcionActual, PDO::PARAM_STR);
            $stmt->bindParam(':hoy', $hoy, PDO::PARAM_STR);
            if ($stmt->execute()) {
                $respuesta->mensaje = "REGISTRO_LOG";
                $respuesta->idLog = $this->conexion->lastInsertId();
                $respuesta->excepcion ="Ocurrió un error inesperado, por favor revisa la bitácora de log Referencia: ".$this->conexion->lastInsertId();
            }else{
                $respuesta->mensaje = "NO_REGISTRO_LOG";
                $respuesta->excepcion ="Ups, Ocurrió un error al registrar el log, contacte con TI";
            }

        } catch (Exception $e) {

            $excepcion = 'Excepción ' . $e->getCode() . ': ' . $e->getMessage() . ' en la línea ' . $e->getLine() . ' del fichero ' . $e->getFile();
            $pagina = "GuardarErroresSistema.php";
            $idUsuario = isset($_SESSION['general']['usuario'][0]->id) ?$_SESSION['general']['usuario'][0]->id :0;

            $sql2 = "insert into logs_sistema (archivo, excepcion, fechaRegistro, idUsuario) values ('{$pagina}', '{$excepcion}', '{$hoy}',{$idUsuario})";
            if ($this->conexion->query($sql2)) {
                $respuesta->mensaje = "REGISTRO_LOG";
                $respuesta->idLog = $this->conexion->lastInsertId();
                $respuesta->excepcion ="Ocurrió un error inesperado, por favor revisa la bitácora de log Referencia: ".$this->conexion->lastInsertId();
            }else{
                $respuesta->mensaje = "NO_REGISTRO_LOG";
                $respuesta->excepcion ="Ups, Ocurrió un error al registrar el error del log, contacte con TI";
            }
        }
        return json_encode($respuesta);
    }

    private function detectarSistemaOperativo()
    {
        $os = array("WIN", "MAC", "LINUX");
        $sistema = "OTHER";
        foreach ($os as $val) {
            if (strpos(strtoupper($_SERVER['HTTP_USER_AGENT']), $val) !== false)
                $sistema = $val;
        }
        return $sistema;
    }
}