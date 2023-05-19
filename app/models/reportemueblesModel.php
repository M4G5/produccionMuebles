<?php

class reportemueblesModel extends Model
{

    public function __construct(){
        
    }

public function getAllReport()
{
    $sql = "SELECT * FROM reportes";
    try {
        $request = parent::query($sql);
        return $request;
    } catch (Exception $e) {
        throw $e;
    }
}

}
