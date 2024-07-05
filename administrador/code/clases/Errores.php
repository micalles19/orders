<?php

class Errores Extends Generales
{
    public $paginaPhp,
        $excepcion,
        $sentenciaSql,
        $idUsuario,
        $idCliente;

    public function guardarLog()
    {

        $db = new  connect();
        $conexion = $db->connectDB();
        try {
            $tipoDispositivo = $this->detectarTipoDispositivo();
            $sistemaOperativo = $this->detectarSistemaOperativo();
            $mensajeError = 'Excepción ' . $this->excepcion->getCode() . ': ' . $this->excepcion->getMessage() . ' en la línea '
                . $this->excepcion->getLine() . ' del fichero ' . $this->excepcion->getFile();

            $sql = "insert into trans_erroressistema(paginaPhp, mensajeError, sentenciaSql, ipDispositivo, idUsuario, idCliente,
                                 fechaRegistro, tipoDispositivo,sistemaOperativo)
                    values (:paginaPhp, :mensajeError, :sentenciaSql, :ipDispositivo,:idUsuario, :idCliente, :hoy, :tipoDispositivo,:sistemaOperativo)";

            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':paginaPhp', $this->paginaPhp, PDO::PARAM_STR);
            $stmt->bindParam(':mensajeError', $mensajeError, PDO::PARAM_STR);
            $stmt->bindParam(':sentenciaSql', $this->sentenciaSql, PDO::PARAM_STR);
            $stmt->bindParam(':ipDispositivo', $ipDispositivo, PDO::PARAM_STR);
            $stmt->bindParam(':idUsuario', $this->idUsuario, PDO::PARAM_INT);
            $stmt->bindParam(':idCliente', $this->idCliente, PDO::PARAM_INT);
            $stmt->bindParam(':hoy', $hoy, PDO::PARAM_STR);
            $stmt->bindParam(':tipoDispositivo', $tipoDispositivo, PDO::PARAM_STR);
            $stmt->bindParam(':sistemaOperativo', $sistemaOperativo, PDO::PARAM_STR);

            if ($stmt->execute()) {
                echo "REGISTRO_LOG";
            }

        } catch (Exception $e) {

            $ERROR = 'Excepción ' . $e->getCode() . ': ' . $e->getMessage() . ' en la línea ' . $e->getLine() . ' del fichero ' . $e->getFile();
            $pagina = "guardarError";

            $sql = "insert into trans_erroressistema (paginaPhp, mensajeError, ipDispositivo, fechaRegistro) values (:pagina, :error, :ipDispositivo, :hoy)";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':pagina', $pagina, PDO::PARAM_STR);
            $stmt->bindParam(':error', $ERROR, PDO::PARAM_STR);
            $stmt->bindParam(':ipDispositivo', $ipDispositivo, PDO::PARAM_STR);
            $stmt->bindParam(':hoy', $hoy, PDO::PARAM_STR);
            if ($stmt->execute()) {
                echo "GENERAL_ERROR";
            }
        }
    }

    private function detectarTipoDispositivo()
    {

        $detect = new Mobile_Detect();
        if ($detect->isMobile()) {
            return "Celcular";
        }
        if ($detect->isTablet()) {
            return "Tablet";
        }
        if (!$detect->isTablet() && !$detect->isMobile()) {
            return "Computadora";
        }
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