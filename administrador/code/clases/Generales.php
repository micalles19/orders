<?php
require '../assets/Mobile-Detect-5.x/Mobile_Detect.php';
date_default_timezone_set('America/El_Salvador');
class Generales
{
    public $hoy,
        $ipDispositivo;


    public function setHoy(): void
    {
        $this->hoy = date("Y-m-d H:i:s");
    }

    /**
     * @return mixed
     */
    public function getHoy()
    {
        return $this->hoy;
    }

    public function setIpDispositivo(): void
    {
        $this->ipDispositivo = $_SERVER['REMOTE_ADDR'];
    }

    /**
     * @return mixed
     */
    public function getIpDispositivo()
    {
        return $this->ipDispositivo;
    }

}