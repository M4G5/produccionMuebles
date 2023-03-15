<?php

class controlModel extends Model
{

public $id;
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

public function setReporte()
{

    $sql = "INSERT INTO reportes (nombre,fecha,area,producto,descripcion,puntos,porcentaje)
            VALUES (:nombre, :fecha, :area, :producto, :descripcion, :puntos, :porcentaje)";
    try{

        $empleados = explode(',', $this->empleado);
        $nEmpleados = count($empleados);
        if($nEmpleados > 1 )
        {
            for($i=0;$i<$nEmpleados;$i++) {
                $datos = [
                    "nombre" => $empleados[$i],
                    "fecha" => $this->fecha,
                    "area" => $this->area,
                    "producto" => $this->producto,
                    "descripcion" => $this->descripcion,
                    "puntos" => $this->totalPuntos,
                    "porcentaje" => $this->totalPorcentaje
                ];
                $request = parent::query($sql, $datos);
            }
            
        }else {
            $datos = [
                "nombre" => $this->empleado,
                "fecha" => $this->fecha,
                "area" => $this->area,
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

public function allReports()
{
    $sql = "SELECT * FROM reportes";
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


}