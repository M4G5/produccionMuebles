<?php

class homeController extends Controller{

    function __construct(){
        
    }
    
    function index(){
        
        $data = [
            'id' => 1,
            'title' => 'Inicio',
            'page' => 'inicio'
        ];

        View::render('bee',$data);
    }

    
    function test(){
        // Redirect::to('home');
        // Flasher::new('Hola soy una notificacion-1','success');
        // Flasher::new('Hola soy una notificacion-2','danger');
        // Flasher::new('Hola soy una notificacion-2','primary');
        // $db = new Db();
        // $db->connect();

        /*echo 'Probando base de datos <br><br><br>';
        echo '<pre>';
        
        try{
            $sql = "SELECT * FROM test";
            $res = Db::query($sql);
            print_r($res);

            $sql = "INSERT INTO test(name,email,created_at) VALUES(:name, :email, :created_at)";
            $registro = [
                'name'       => 'Angel',
                'email'      => 'nuevo@gmail',
                'created_at' => now()
            ];
            // $id = Db::query($sql, $registro);
            // print_r($id);

            $sql = "UPDATE test SET name=:name WHERE id=:id";
            $registro_actu = [
                'name' => 'Juan',
                'id' => '2'
            ];
            // print_r(Db::query($sql, $registro_actu));

            $sql = "DELETE FROM test WHERE id=:id";
            // print_r(Db::query($sql, ['id' => 3]));

            //ALTER TABLE
            $sql = 'ALTER TABLE test ADD COLUMN username VARCHAR(255) NULL AFTER name';
            // print_r(Db::query($sql));

        }catch(Exception $e){
            echo 'Hubo un error: '.$e->getMessage();
        }
        echo '</pre>';
        die; */
        View::render('test');
    }

    function flash(){
        // Flasher::new('Te has registrado','success');
        View::render('flash');
    }

}