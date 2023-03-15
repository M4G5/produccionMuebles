<?php

class controlController extends Controller
{

public function __construct()
{

}

public function index()
{
    $data = [
        'id' => 4,
        'title' => 'Control',
        'page' => 'porcentaje'
    ];
    View::render('control',$data);
}


public function getProductos(string $let)
{
    
    $productos = new controlModel();
    $productos->area = $let;
    
        $req = $productos->products();
        if(empty($req)) {
            $request = array("status"=>false, "msg"=>"Sin datos.");
        }else{
            $request = array("status"=>true, "data"=>$req);
        }
    echo json_encode($req);
    die();
}

public function getProducto()
{
    $producto = new controlModel();
    $producto->producto = $_POST['producto'];
    $producto->area = $_POST['area'];
    $req = $producto->oneProduct();
    if(!empty($req)){
        $request = array("status"=>true, "data"=>$req);
    }else{
        $request = array("status"=>false, "msg"=>"Sin datos.");
    }
    echo json_encode($request);
    
}

public function setRep()
{
    
    $date = DateTime::createFromFormat('d/m/Y', $_POST['fecha']);
    
    $reporte = new controlModel();
    $reporte->fecha = $date->format('Y-m-d');
    $reporte->area = $_POST['area'];
    $reporte->producto = $_POST['producto'];
    $reporte->descripcion = $_POST['inputs'];
    $reporte->totalPuntos = $_POST['tpuntos'];
    $reporte->totalPorcentaje = $_POST['tporcentaje'];
    $reporte->empleado = $_POST['empleados'];
    $reporte->area = $_POST['area'];
    
    $request = $reporte->setReporte();
    
    if($request > 0){
        $respuesta = array("status"=>true, "msg"=>"Reporte guardado.");
    }else{
        $respuesta = array("status"=>false, "msg"=>"Ocurrio un erro! Intente de nuevo.");
    }

    echo json_encode($respuesta);

    die();
    
}

public function getReports()
{
    // setlocale(LC_TIME, "spanish");
    $reportes = new controlModel();
    $request = $reportes->allReports();
    if($request > 0){
        for($i=0;$i<count($request);$i++){
            $request[$i]['fecha'] = strftime("%d/%b/%Y", strtotime($request[$i]['fecha']));
        }
    }    
    echo json_encode($request);
    die();
}

public function getCol(string $area)
{
    $columnas = new controlModel();
    $columnas->area = $area;
    $req = $columnas->columnas();
    if(empty($req)) {
        $request = array("status"=>false, "msg"=>"Sin datos.");
    }else{
        $request = array("status"=>true, "data"=>$req);
    }
    echo json_encode($req);
    die();
}


}