<?php

class errorController extends Controller{

    function __construct(){
        
    }
    function index(){
        // require_once VIEWS.'testView.php';
        View::render('404');
    }

}