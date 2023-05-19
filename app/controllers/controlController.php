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
    $lastId = $reporte->lastID();

    if(empty($_POST['nreporte'])) {
        $reporte->lastId = empty($lastId) ? 1 : intval($lastId[0]['n_reporte'] + 1) ;
        $reporte->fecha = $date->format('Y-m-d');
        $reporte->area = $_POST['area'];
        $reporte->capacidad = $_POST['capacidad'];
        $reporte->producto = $_POST['producto'];
        $reporte->descripcion = $_POST['inputs'];
        $reporte->totalPuntos = $_POST['tpuntos'];
        $reporte->totalPorcentaje = $_POST['tporcentaje'];
        $reporte->empleado = $_POST['empleados'];
        $reporte->area = $_POST['area'];
        $request = $reporte->setReporte();
        $opcion = 1;
    }else {
        $reporte->id_nombre = $_POST['nreporte'];
        // $reporte->id = $_POST['id'];
        $reporte->fecha = $date->format('Y-m-d');
        $reporte->area = $_POST['area'];
        $reporte->capacidad = $_POST['capacidad'];
        $reporte->producto = $_POST['producto'];
        $reporte->descripcion = $_POST['inputs'];
        $reporte->totalPuntos = $_POST['tpuntos'];
        $reporte->totalPorcentaje = $_POST['tporcentaje'];
        $reporte->empleado = $_POST['empleados'];
        $reporte->area = $_POST['area'];
        $request = $reporte->updateReporte();
        $opcion = 2;
    }
    /* print_r($_POST);
    print_r($request);
    die(); */
    if($request > 0){
        if($opcion==1){
            $respuesta = array("status"=>true, "msg"=>"Reporte guardado.");
        }else{
            $respuesta = array("status"=>true, "msg"=>"Reporte actualizado.");
        }
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
            $request[$i]['acciones'] = '<div class="text-center">
            <button onclick="update('.$request[$i]['n_reporte'].')" class="btn btn-success btnUpdRep btn-xs" id="btnUpdRep" data-id="'.$request[$i]['n_reporte'].'" title="Editar" type="button" ><i data-id="'.$request[$i]['n_reporte'].'" class="fa fa-edit"></i> </button>
            <button class="btn btn-danger btnDelRep btn-xs" data-id="'.$request[$i]['id_reporte'].'" title="Eliminar" type="button"><i data-id="'.$request[$i]['id_reporte'].'" class="fa fa-trash"></i> </button>
            </div>';
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

public function getProductData(){
    $producto = new controlModel();
    $producto->producto = $_POST['prod'];
    $producto->area     = $_POST['area'];
    $producto->columna  = $_POST['columns'];
    $req = $producto->productData();
    if(empty($req)) {
        $request = array("status"=>false, "msg"=>"Sin datos.");
    }else{
        $request = array("status"=>true, "data"=>$req);
    }
    echo json_encode($request);
    
}

public function getAreas()
{
    $areas = new controlModel();
    $request = $areas->allAreas();
    if(empty($request)){
        $requestAreas = array("status"=>false, "msg"=>"Sin Datos.");
    }else{
        $requestAreas = array("status"=>true,"data"=>$request);
    }
    echo json_encode($requestAreas);
}

public function getEmployyes()
{
    $employee = new controlModel();
    $req = $employee->allEmployees();
    if(empty($req)){
        $request = array("status"=>false,"msg"=>"Sin Datos.");
    }else{
        $request = array("status"=>true,"data"=>$req);
    }
    echo json_encode($request);
}

public function getReport(int $id) //,int $id_rep
{
    $report = new controlModel();
    $report->nreporte = intval($id);
    $requ = $report->report();
    if(empty($requ)){
        $request = array("status"=>false, "msg"=>"Sin datos.");
    }else{
        $request = array("status"=>true, "data"=>$requ);
    }
    echo json_encode($request);
}

}