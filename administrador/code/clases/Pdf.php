<?php

class Pdf
{
    private $conexion;
    public $idOrden, $hoy;

    function __construct()
    {
        $con = new connect();
        $this->conexion = $con->connectDB();
        date_default_timezone_set('America/El_Salvador');
        $this->hoy = date("Y-m-d H:i:s");
    }

    function crearPDF()
    {
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'letter', true, 'UTF-8', false);
        $idOrden = 1;
        $nombre_archivo = "orden_" . $this->idOrden;

//Información del documento
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('UZIBABY');
        $pdf->SetTitle('Detalle de Orden');
        $pdf->SetSubject('UziBaby');
        $pdf->SetKeywords('TCPDF, PDF, orden');

// Fuente de cabecera y pie de página
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// Espacios por defecto
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//Margenes
        $pdf->SetMargins(15, 8, 15);
        $pdf->SetHeaderMargin(0);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Configurar Auto salto de página
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Factor de escalado de imagen
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Configurando lenguaje
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->setFontSubsetting(true);

        $pdf->SetFont('dejavusans', '', 14, '', true);
        $pdf->AddPage();

        $enter = "<br>";
        $enter_2 = "<br><br>";

        $pdf->SetFont('dejavusans', '', 7);
        $head = '<table cellpadding="5" cellspacing="1" border="1" style="text-align:center; margin-left:5px; margin-top:-30px!important;">
        <tr><td style="width:200px;" rowspan="2"><img src="../images/uzibaby.png" border="0" height="60" width="60" /><br>Orden# ' . str_pad($this->idOrden, 5, "0", STR_PAD_LEFT) . '</td><td style="width:437px;">MAYOREO</td></tr>
        <tr style="text-align:center;"><td>Detalle de la orden realizada</td></tr>
        </table>';

        $sql = "select ordenes.id as idOrden, DATE_FORMAT(ordenes.fechaRecibida, '%d-%m-%Y %H:%i:%s') as fechaRecibida,
        DATE_FORMAT(ordenes.fechaDespacho, '%d-%m-%Y %H:%i:%s') as fechaDespacho, DATE_FORMAT(ordenes.fechaCancela, '%d-%m-%Y %H:%i:%s') as fechaCancela,
         clientes.nombreCliente, clientes.nombreTienda,
        clientes.dui, clientes.nit, clientes.iva, clientes.telefonoPrincipal, clientes.coreoCliente, departamentos.nombre as departamento,
        municipios.nombre as municipio, distritos.nombre as distrito, clientes.direccion, ordenes_tipos_comprobantes.nombre as tipoComprobante, 
        ordenes.idTipoComprobante
    from ordenes
    inner join clientes on ordenes.idCliente = clientes.id
    inner join departamentos  on clientes.idDepartamento = departamentos.id
    inner join municipios  on clientes.idMunicipio = municipios.id
    inner join distritos  on clientes.idDistrito = distritos.id
     inner join ordenes_tipos_comprobantes  on ordenes.idTipoComprobante = ordenes_tipos_comprobantes.id
    where ordenes.id ={$this->idOrden}";
        $query = $this->conexion->query($sql);
        $row = $query->fetchAll(PDO::FETCH_OBJ);

        $pdf->writeHTML($head, true, false, true, false, '');
        $pdf->writeHTML($enter, true, false, true, false, '');
        $tabla = '<table cellpadding="1" cellspacing="1" style="">
        <tr>
            <td style="width:90px; border:2px solid white; text-align:left; line-height:20px;"><strong> Nombre Cliente:</strong></td>
            <td style="border:0px solid white; text-align:left; width:275px; line-height:20px;">' . $row[0]->nombreCliente . ' </td>
            
            <td style="width:90px; border:2px solid white; text-align:left; line-height:20px;"><strong> Telefono:</strong></td>
            <td style="border:0px solid white; text-align:left; width:275px; line-height:20px;">' . $row[0]->telefonoPrincipal . '</td>
        </tr>    
         <tr>
            <td style="width:90px; border:2px solid white; text-align:left; line-height:20px;"><strong> Correo :</strong></td>
            <td style="border:0px solid white; text-align:left; width:275px; line-height:20px;">' .$row[0]->coreoCliente . ' </td>
            
            <td style="width:90px; border:2px solid white; text-align:left; line-height:20px;"><strong> departamento:</strong></td>
            <td style="border:0px solid white; text-align:left; width:275px; line-height:20px;">' . $row[0]->departamento . '</td>
        </tr>
        <tr>
            <td style="width:90px; border:2px solid white; text-align:left; line-height:20px;"><strong> Municipio:</strong></td>
            <td style="border:0px solid white; text-align:left; width:275px; line-height:20px;">' .$row[0]->municipio . ' </td>
            
            <td style="width:90px; border:2px solid white; text-align:left; line-height:20px;"><strong>Distrito :</strong></td>
            <td style="border:0px solid white; text-align:left; width:270px; line-height:20px;">' . $row[0]->distrito . ' </td>
        </tr>  
        <tr>
            <td style="width:90px; border:2px solid white; text-align:left; line-height:20px;"><strong> Fecha orden recibida:</strong></td>
            <td style="border:0px solid white; text-align:left; width:275px; line-height:20px;">' .$row[0]->fechaRecibida . ' </td>
            
            <td style="width:90px; border:2px solid white; text-align:left; line-height:20px;"><strong>Fecha orden despachada :</strong></td>
            <td style="border:0px solid white; text-align:left; width:270px; line-height:20px;">' . $row[0]->fechaDespacho . ' </td>
        </tr>   
        <tr>
            <td style="width:90px; border:2px solid white; text-align:left; line-height:20px;"><strong> Direccion:</strong></td>
            <td style="border:0px solid white; text-align:left; width:275px; line-height:20px;">' .$row[0]->direccion . ' </td>
            
            <td style="width:90px; border:2px solid white; text-align:left; line-height:20px;"><strong>Tipo Comprobante :</strong></td>
            <td style="border:0px solid white; text-align:left; width:270px; line-height:20px;">' .$row[0]->tipoComprobante. ' </td>
        </tr>      
         

</table>
        ';
        $pdf->writeHTML($tabla, true, false, true, false, '');
        $pdf->writeHTML($enter_2, true, false, true, false, '');
        $detalle = '
<table cellspacing="0" cellpadding="1" border="1">
    <tr>
        <td width="30" align="center">Item</td>
        <td width="87" align="center">Código</td>
        <td width="100" align="center">Imagen</td>
        <td width="55" align="center">Cantidad</td>
        <td width="253" align="center">Descripción</td>
        <td width="55" align="center">Precio por Bulto</td>
        <td width="60" align="center">Total Bulto</td>
    </tr>';

        $sql = "select idProducto, ordenes_detalle.unidadesBulto, ordenes_detalle.precioUnidad, ordenes_detalle.precioTotal, 
       productos.nombre as nombreProducto, productos.codigoProducto, productos.imagen
                from ordenes_detalle 
                inner join productos  on ordenes_detalle.idProducto = productos.id 
                where idOrden = {$this->idOrden} and ordenes_detalle.eliminado ='N'";
        $query = $this->conexion->query($sql);
        $rowDet = $query->fetchAll(PDO::FETCH_OBJ);
        $stotal = 0.00;
        $total = 0.00;
        $iva = 0.00;
        for ($i = 0; $i <= count($rowDet) - 1; $i++) {
            $detalle .= '
        <tr>
        <td width="30" align="center">' . ($i + 1) . '</td>
        <td width="87" align="center">' . $rowDet[$i]->codigoProducto . '</td>
        <td width="100" align="center"> <img src="./../../images/thumbnails/' . $rowDet[$i]->imagen . '" height="65px;" width="65px;"/></td>
        <td width="55" align="center">' . $rowDet[$i]->unidadesBulto . '</td>
        <td width="253" align="center">' . $rowDet[$i]->nombreProducto . '</td>
        <td width="55" align="rigth">$' . sprintf('%0.2f', $rowDet[$i]->precioUnidad) . '</td>
        <td width="60" align="rigth">$' . sprintf('%0.2f', $rowDet[$i]->precioTotal) . '</td>
    </tr>
    ';
            $stotal += $rowDet[$i]->precioTotal;
        }

        $detalle .= "</table>";
        $pdf->writeHTML($detalle, true, false, true, false, '');

        if ($row[0]->idTipoComprobante == 1 || $row[0]->idTipoComprobante ==2){
            $iva = $stotal * 0.13;
            $total = $stotal + $iva;
        }else{
            $total = $stotal;
        }
        $totales = '
        <table cellspacing="0" cellpadding="1" border="1">
            <tr>
                <td rowspan="8" width="380" ></td>
                <td width="200">Suma total de las operaciones</td>
                <td width="60" align="rigth">$' . sprintf('%0.2f',$stotal) . '</td>
            </tr>
             <tr>
               <td>IVA</td>
               <td align="rigth">$' . sprintf('%0.2f', $iva) . '</td>
            </tr>
            <tr>
               <td>Total a pagar</td>
               <td align="rigth">$' . sprintf('%0.2f', $total) . '</td>
            </tr>
        
        </table>';
        $pdf->writeHTML($totales, true, false, true, false, '');

        $mypdf = __DIR__ . '\./../../../pdf/' . $nombre_archivo . '.pdf';
        $pdf->Output($mypdf, 'F');

        return $nombre_archivo;
    }

}