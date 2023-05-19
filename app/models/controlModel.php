<?php

class controlModel extends Model
{
public $id;
public $lastId;
public $first_let;
public $producto;
public $cantidad;
public $puntos;
public $porcentaje;
public $totalPuntos;
public $totalPorcentaje;
public $empleado;
public $fecha;
public $area;
public $descripcion;
public $columna;
public $idReport;
public $capacidad;
public $nreporte;
public $id_nombre;

public function products()
{
    
        $sql = "SELECT * FROM {$this->area}";
        try{
            $request = parent::query($sql);
            return $request;
        }catch(Exception $e) { throw $e; }
    
}

public function oneProduct()
{
    $sql = "SELECT * FROM {$this->area} WHERE producto=:product";
    try{
        $request = parent::query($sql, ['product'=>$this->producto]);
        return $request;
    }catch(Exception $e){ throw $e; }
    
}

public function lastID()
{
    $lastId = "SELECT n_reporte FROM reportes ORDER BY id_reporte DESC LIMIT 1";
    $last=parent::query($lastId);
    return $last;
}

public function setReporte()
{
        
        $sql = "INSERT INTO reportes (n_reporte,nombre,fecha,area,capacidad,producto,descripcion,puntos,porcentaje)
                VALUES (:n_reporte,:nombre, :fecha, :area, :capacidad, :producto, :descripcion, :puntos, :porcentaje)";
        try{
            $empleados = explode(',', $this->empleado);
            $nEmpleados = count($empleados);
            if($nEmpleados > 1 )
            {
                for($i=0;$i<$nEmpleados;$i++) {
                    $datos = [
                        "n_reporte" => $this->lastId,
                        "nombre" => $empleados[$i],
                        "fecha" => $this->fecha,
                        "area" => $this->area,
                        "capacidad" => $this->capacidad,
                        "producto" => $this->producto,
                        "descripcion" => $this->descripcion,
                        "puntos" => $this->totalPuntos,
                        "porcentaje" => $this->totalPorcentaje
                    ];
                    $request = parent::query($sql, $datos);
                }
                
            }else {
                $datos = [
                    "n_reporte" => $this->lastId,
                    "nombre" => $this->empleado,
                    "fecha" => $this->fecha,
                    "area" => $this->area,
                    "capacidad" => $this->capacidad,
                    "producto" => $this->producto,
                    "descripcion" => $this->descripcion,
                    "puntos" => $this->totalPuntos,
                    "porcentaje" => $this->totalPorcentaje
                ];
                $request = parent::query($sql, $datos);
            }

            return $request;

        }catch(Exception $e) {
            throw $e;
        }
    

}

public function updateReporte()
{

    $nombreID = explode(',',$this->id_nombre);
    $arrayID = array();
    for($i=0;$i<count($nombreID);$i++){
        $arrayID[$i] = explode('-',$nombreID[$i]);
        
    }

    $empleados = explode(',', $this->empleado);
    $sql = "UPDATE reportes 
    SET nombre=:nombre,fecha=:fecha,area=:area,capacidad=:capacidad,producto=:producto,descripcion=:descripcion,puntos=:puntos,porcentaje=:porcentaje
    WHERE n_reporte=:n_rep AND id_reporte=:id_rep";
    for($j=0;$j<count($empleados);$j++){
        $datos = [
            "n_rep" => $arrayID[$j][2],
            "id_rep" => $arrayID[$j][0],
            "nombre" => $empleados[$j],
            "fecha" => $this->fecha,
            "area" => $this->area,
            "capacidad" => $this->capacidad,
            "producto" => $this->producto,
            "descripcion" => $this->descripcion,
            "puntos" => $this->totalPuntos,
            "porcentaje" => $this->totalPorcentaje
        ];
        $request = parent::query($sql, $datos);
        
    }

    return $request;
             
}

public function allReports()
{
    $sql = "SELECT * FROM reportes ORDER BY id_reporte DESC";
    try{
        $request = parent::query($sql);
        return $request;
    }catch(Exception $e){
        throw $e;
    }
}

public function columnas()
{
    $sql = "SHOW COLUMNS FROM {$this->area}";
    try{
        $request = parent::query($sql);
        return $request;
    }catch(Exception $e){
        throw $e;
    }
}

public function productData()
{
    // $columnas = explode(',', $this->columna);
    // $colum = 
    // for($i=0;$i<count($columnas);$i++){
        $sql = "SELECT {$this->columna} FROM {$this->area} WHERE producto LIKE '{$this->producto}'";
        return $request = parent::query($sql); //, ['prod'=>$this->producto]
    // }
    
    // $sql = "SELECT {$this->columna} FROM {$this->area} WHERE producto=:prod";
    /* try{
        $request = parent::query($sql, ['prod'=>$this->producto]);
        return $request;
    }catch(Exception $e){
        throw $e;
    } */
}

public function allAreas()
{
    $sql = "SELECT * FROM area";
    try{
        $request = parent::query($sql);
        return $request;
    }catch(Exception $e){
        throw $e;
    }
}

public function allEmployees()
{
    $sql = "SELECT * FROM empleado";
    try{
        $request = parent::query($sql);
        return $request;
    }catch(Exception $e){
        throw $e;
    }
}

public function report()
{
    $sql = "SELECT * FROM reportes WHERE n_reporte=:id";
    // return "SELECT * FROM reportes WHERE n_reporte={$this->nreporte}";
    try{
        $request = parent::query($sql, ['id' => $this->nreporte]);
        return $request;
    }catch(Exception $e){ throw $e; };
}

}