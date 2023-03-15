<?php

class panelController extends Controller
{
    public function __construct(){
        
    }

    function index(){
        $data = [
            'id' => 2,
            'title' => 'Dashboard',
            'page' => 'dashboard'
        ];

        View::render('panel',$data);
    }

    
    

}