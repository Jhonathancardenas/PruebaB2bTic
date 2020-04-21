<?php
//Se incluye el modelo donde conectará el controlador.
require_once 'model/archivo.php';

class ArchivoController{

    private $model;

    //Creación del modelo
    public function __CONSTRUCT(){
        $this->model = new archivo();
    }

    //Llamado plantilla principal
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/archivo/index.php';
        require_once 'view/footer.php';
    }

    public function test()
    {
         $this->model->test();
    }
    public function ReporteCantidadxExtension()
    {

        $extensions = $this->model->ListarR2();

        if($extensions)
        {
            $xml = new DomDocument('1.0', 'UTF-8');

            $extension = $xml->createElement('Extension');
            $extension = $xml->appendChild($extension);

            foreach ($extensions as $value)
            {

                $name = $xml->createElement('Nombre',$value->name);
                $name = $extension->appendChild($name);

                $cantidad = $xml->createElement('Cantidad',$value->cantidad);
                $cantidad = $extension->appendChild($cantidad);

                $xml->formatOutput = true;
            }
            $el_xml = $xml->saveXML();
            $xml->save('extension.xml');
            $array = json_decode(json_encode(simplexml_load_string($el_xml)),true);

            $html='';

            $html.='<table class="table table-responsive table-striped table-bordered" id="table3" width="100%">';
            $i = 0;

            $html.='<thead><th>Extesion</th><th>Cantidad</th></thead><tbody>';

            if (! empty($array)) {
                foreach ($array["Nombre"] as $key=>$elem) {
                    $html.='<tr>';
                    $html.='<td>'.$elem.'</td>';
                    $html.='<td>'.$array["Cantidad"][$key].'</td>';
                    $html.='</tr>';
                }
                $html.='</tbody>';
            }



            echo  json_encode(['html'=>$html,'success'=>true]);
        }
        else{

            echo  json_encode(['success'=>false]);

        }

    }
    public function ReporteTodo()
    {

        $archivos = $this->model->Listar();

        if($archivos)
        {
            $xml = new DomDocument('1.0', 'UTF-8');

            $Archivos = $xml->createElement('Archivos');
            $Archivos = $xml->appendChild($Archivos);

            foreach ($archivos as $value)
            {

                $Archivo = $xml->createElement('Archivo');
                $Archivo = $Archivos->appendChild($Archivo);

                // Agregar un atributo al libro
                $Archivo->setAttribute('Nombre', ''.$value->Nombre.'');


                $extension = $xml->createElement('Extension',$value->extension);
                $extension = $Archivo->appendChild($extension);

                $tipo = $xml->createElement('Tipo',$value->tipo);
                $tipo = $Archivo->appendChild($tipo);

                $id = $xml->createElement('Id',$value->Id);
                $id = $Archivo->appendChild($id);

                $xml->formatOutput = true;
            }
            $el_xml = $xml->saveXML();
            $xml->save('archivo.xml');
            $array = json_decode(json_encode(simplexml_load_string($el_xml)),true);
            if ( ! empty($array['Archivo'])) {
                $fields = array_keys($array['Archivo'][0]);
                unset($fields[0]);
                $fields = array_values($fields);
                $html='';

                $html.='<table class="table table-responsive table-striped table-bordered" id="table2" width="100%">';
                $i = 0;

                $html.='<thead><tr><th>Nombre</th><th>Extesion</th><th>Tipo</th><th>Id</th></tr></thead><tbody>';

                if (! empty($array['Archivo'])) {
                    foreach ($array['Archivo'] as $elem) {
                        $html.='<tr>';
                        $html.='<td width="10%">'.$elem['@attributes']["Nombre"].'</td>';
                        unset($elem['@attributes']);

                        foreach ($elem as $k => $v) {
                            $html.='<td>'.$v.'</td>';
                        }
                        $html.='</tr>';
                    }
                    $html.='</tbody>';
                }

            }

            echo  json_encode(['html'=>$html,'success'=>true]);
        }
        else{

            echo  json_encode(['success'=>false]);

        }

    }
    public function obtenerSoapArchivo()
    {
            /*Se hace la peticion */

            $client = new SoapClient('http://test.analitica.com.co/AZDigital_Pruebas/WebServices/ServiciosAZDigital.wsdl', array(

                    'trace' => 1,
                    // 'location' => "http://test.analitica.com.co/AZDigital_Pruebas/WebServices/SOAP/index.php",
                )
            );
            $client->__setLocation('http://test.analitica.com.co/AZDigital_Pruebas/WebServices/SOAP/index.php');

            try {
                // Obtenemos los archivos consumidos
                $obtenerArchivo = $client->BuscarArchivo(
                    [
                        "Condiciones"=> [
                            "Condicion"=> [
                                "Tipo"=>"FechaInicial","Expresion"=>"2019-07-01 00:00:00"
                            ]
                        ]
                    ]
                );

                if(is_object($obtenerArchivo))
                {
                    foreach ($obtenerArchivo as $archivo)
                    {
                        foreach($archivo as $value)
                        {

                            $this->model->insertarArchivo($value->Id, $value->Nombre);
                        }
                    }
                }

            }
            catch (SoapFault $exception)
            {
                echo "error".$exception;
            }
            header('Location: index.php');
    }
}
