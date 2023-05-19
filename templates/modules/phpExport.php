<?php

    require __DIR__.'/../../vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Shared\Date;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use PhpOffice\PhpSpreadsheet\NamedRange;

    use PhpOffice\PhpSpreadsheet\Style\Border;

    $conn =  mysqli_connect("127.0.0.1", "root", "", "bee_db");
    if (!$conn) {
      echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
      echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
      echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
      exit;
  }

  // print_r($_GET);
  $inicio = $_GET['start'];
  $fin = $_GET['end'];
  $nombre = $_GET['nombre'];

 /*  $result = $conn->query("SELECT nombre,DATE_FORMAT(fecha,'%d-%m-%Y') AS fecha,AREA,producto,descripcion,puntos,porcentaje FROM reportes ORDER BY nombre ASC");
  $data = $result->fetch_all(MYSQLI_NUM); */

  //numero de dias distintos
  //SELECT COUNT(DISTINCT fecha) AS num_dates FROM reportes WHERE fecha BETWEEN '2023-04-28' AND '2023-05-16' AND nombre = 'jesus emmanuel'

  /* $result = $conn->query("SELECT COUNT(DISTINCT fecha) AS num_dates FROM reportes WHERE fecha BETWEEN '2023-04-28' AND '2023-05-16' AND nombre = 'jesus emmanuel'");
  $data = $result->fetch_all(MYSQLI_NUM); */
  $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
  $reader->setIncludeCharts(true);
  $spreadsheet = $reader->load(__DIR__ .'/template.xlsx');
  $spreadsheet->setActiveSheetIndex(0);
  $DateList=date("Y-m-d");
  $spreadsheet->getActiveSheet()->setCellValue('C2', Date::PHPToExcel($DateList));

  $styleArray = [
    'font' => [
      'size' => 10,
      'name' => 'arial'
  ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => '00000000'],
        ],
    ],
  ];
  
  $styleResultado = [
    'font' => [
      'bold' => true,
      'size' => 11,
      'name' => 'arial'
  ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => '00000000'],
        ],
      ],
      'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'startColor' => [
            'argb' => '9FD5D1',
        ],
        'endColor' => [
            'argb' => '9FD5D1',
        ],
    ],
  ];

//  $data;  
 $all_employed = $conn->query("SELECT nombre,DATE_FORMAT(fecha,'%d-%m-%Y') AS fecha,area,producto,descripcion,puntos,porcentaje FROM reportes GROUP BY nombre");
    // $i=0;
    // $key = "nFechas";
    while($data = $all_employed->fetch_assoc()){
      /* $sql = $conn->query("SELECT COUNT(DISTINCT fecha) AS num_dates FROM reportes WHERE fecha BETWEEN '".$inicio."' AND '".$fin."' AND nombre = '".$fila['nombre']."'");
      $num_date_dist = $sql->fetch_assoc();
      $fila[$key] = $num_date_dist['num_dates'];
      $data[$i] = $fila;
      $i++; */      
      /* echo "<pre>";
  print_r($data);
  echo "</pre>"; */
  
  $dataRows = count($data);
  $spreadsheet->setActiveSheetIndex(0);
  $spreadsheet->getActiveSheet()->fromArray($data, null, 'B4');

  $tco = $dataRows+3;

  $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(140, 'pt');

  $spreadsheet->getActiveSheet()->getStyle('B4:H'.$tco)->applyFromArray($styleArray);

  $spreadsheet->getActiveSheet()->setCellValue("G".($tco+1), '=SUM(G4:G'.$tco.')');
  $spreadsheet->getActiveSheet()->setCellValue("H".($tco+1), '=SUM(H4:H'.$tco.')');
  $spreadsheet->getActiveSheet()->getStyle("G".($tco+1).":H".($tco+1))->applyFromArray($styleResultado);

  $spreadsheet->setActiveSheetIndex(0);

  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header('Content-Disposition: attachment;filename="paises.xlsx"');
  header('Cache-Control: max-age=0');

  header('Cache-Control: max-age=1');

  header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); 
  header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
  header('Cache-Control: cache, must-revalidate');
  header('Pragma: public'); 

  $temp_file = tempnam(sys_get_temp_dir(), 'Excel');

  $writer = new Xlsx($spreadsheet);
  $writer->setPreCalculateFormulas(false);
  $writer->save($temp_file);

  $documento = file_get_contents($temp_file);
  unlink($temp_file);
  echo $documento;

    }
  
  /* echo "<pre>";
  print_r($data);
  echo "</pre>"; */

 /*  $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
  $reader->setIncludeCharts(true);
  $spreadsheet = $reader->load(__DIR__ .'/template.xlsx');
  $spreadsheet->setActiveSheetIndex(0);
  $DateList=date("Y-m-d");
  $spreadsheet->getActiveSheet()->setCellValue('C2', Date::PHPToExcel($DateList));

  
  
  $dataRows = count($data);
  $spreadsheet->setActiveSheetIndex(0);
  $spreadsheet->getActiveSheet()->fromArray($data, null, 'B4');


$styleArray = [
  'font' => [
    'size' => 10,
    'name' => 'arial'
],
  'borders' => [
      'allBorders' => [
          'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          'color' => ['argb' => '00000000'],
      ],
  ],
];

$styleResultado = [
  'font' => [
    'bold' => true,
    'size' => 11,
    'name' => 'arial'
],
  'borders' => [
      'allBorders' => [
          'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          'color' => ['argb' => '00000000'],
      ],
    ],
    'fill' => [
      'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
      'startColor' => [
          'argb' => '9FD5D1',
      ],
      'endColor' => [
          'argb' => '9FD5D1',
      ],
  ],
];


$tco = $dataRows+3;

$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(140, 'pt');

$spreadsheet->getActiveSheet()->getStyle('B4:H'.$tco)->applyFromArray($styleArray);

$spreadsheet->getActiveSheet()->setCellValue("G".($tco+1), '=SUM(G4:G'.$tco.')');
$spreadsheet->getActiveSheet()->setCellValue("H".($tco+1), '=SUM(H4:H'.$tco.')');
$spreadsheet->getActiveSheet()->getStyle("G".($tco+1).":H".($tco+1))->applyFromArray($styleResultado);

$spreadsheet->setActiveSheetIndex(0);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="paises.xlsx"');
header('Cache-Control: max-age=0');

header('Cache-Control: max-age=1');

header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); 
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
header('Cache-Control: cache, must-revalidate');
header('Pragma: public'); 

$temp_file = tempnam(sys_get_temp_dir(), 'Excel');

$writer = new Xlsx($spreadsheet);
$writer->setPreCalculateFormulas(false);
$writer->save($temp_file);

$documento = file_get_contents($temp_file);
unlink($temp_file);
echo $documento; */


    mysqli_close($conn);

?>