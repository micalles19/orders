<?php
class connect
{
    private $dbHost ='localhost';
    private $dbUser = 'root';
    private $dbPass = '123456';
    private $dbName = 'orders';
    private $dbCharset =  'utf8';
    public function connectDB(){
        $mysqlConnect = "mysql:host=$this->dbHost;dbname=$this->dbName;charset=$this->dbCharset";
        $dbConnecion = new PDO($mysqlConnect, $this->dbUser, $this->dbPass);
        $dbConnecion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbConnecion;
    }
}

?>

