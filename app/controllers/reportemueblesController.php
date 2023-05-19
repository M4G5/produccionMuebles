<?php

   /*  require __DIR__.'/../../vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Shared\Date;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use PhpOffice\PhpSpreadsheet\NamedRange; */

class reportemueblesController extends Controller
{

    public function __construct()
    {

    }

    public function index()
    {
        $data = [
            'id' => 5,
            'title' => 'Reportes',
            'page' => 'reportes_muebles'
        ];
        View::render('reportemuebles',$data);
    }

    public function getReportes()
    {
        $reportes = new reportemueblesModel();
        $request = $reportes->getAllReport();
        if($request > 0){
            for($i=0;$i<count($request);$i++){
                $request[$i]['fecha'] = strftime("%d/%b/%Y", strtotime($request[$i]['fecha']));
                /* $request[$i]['acciones'] = '<div class="text-center">
                <button onclick="update('.$request[$i]['n_reporte'].')" class="btn btn-success btnUpdRep btn-xs" id="btnUpdRep" data-id="'.$request[$i]['n_reporte'].'" title="Editar" type="button" ><i data-id="'.$request[$i]['n_reporte'].'" class="fa fa-edit"></i> </button>
                <button class="btn btn-danger btnDelRep btn-xs" data-id="'.$request[$i]['id_reporte'].'" title="Eliminar" type="button"><i data-id="'.$request[$i]['id_reporte'].'" class="fa fa-trash"></i> </button>
                </div>'; */
            }
        } 
        echo json_encode($request);
    }

  

}
