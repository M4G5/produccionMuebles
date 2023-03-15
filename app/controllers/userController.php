<?php
 class userController extends Controller
 {
    
    public function __construct(){
        
    }

    public function index()
    {
        $data = [
            'id'     => 3,
            'title'  => 'Usuarios',
            'page' => 'users'
        ];
        
        View::render('user',$data);
    }

    public function getUsers()
    {
        // Agregrar try {} catch(){} 
        $d = new usuarioModel();
        $data = $d->allUser();
        for($i=0;$i<count($data);$i++){
            $data[$i]['acciones'] = '<div class="text-center">
            <button class="btn btn-success editUsr btn-xs" data-id="'.$data[$i]['id_user'].'" title="Editar" type="button" ><i data-id="'.$data[$i]['id_user'].'" class="fa fa-edit"></i> Editar</button>
            <button class="btn btn-danger delUsr btn-xs" data-id="'.$data[$i]['id_user'].'" title="Eliminar" type="button"><i data-id="'.$data[$i]['id_user'].'" class="fa fa-trash"></i> Borrar</button>
            </div>';
        }
        echo json_encode($data);
        die();
    }

    public function getUser(int $id)
    {
        // Agregrar try {} catch(){} 
        $getUser = new usuarioModel();
        $getUser->id = $id;
        $dataUser = $getUser->oneUser();
        if(empty($dataUser)){
            $request = array("status"=>false,"msg"=>"Dato no encontrado.");
        }else{
            $request = array("status"=>true,"data"=>$dataUser);
        }
        echo json_encode($request, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function setUser()
    {
        try {
            $user = new usuarioModel();
            $user->name = $_POST['nombre'];
            $user->username = $_POST['usuario'];
            $user->pass = $_POST['clave'];
            $opcion = 0;
            $user->id = intval($_POST['idUsr']);
            if(empty($_POST['idUsr'])){
                $user->created_at = now();
                $id = $user->addUser();
                $opcion = 1;
            }else{
                $id = $user->updUser();
                $opcion = 2;
            }
            
            if($id > 0){
                if($opcion == 1){
                    $arrResponse = array("status"=>true, "msg"=>"Datos guardados correctamente.");
                }else{
                    $arrResponse = array("status"=>true, "msg"=>"Datos actualizados correctamente.");
                }
            }else if($data == 'exist'){
                $arrResponse = array("status"=>false, "msg"=>".");
            }else{
                $arrResponse = array("status"=>false, "msg"=>"Ocurrio un error." .$e->getMessage());
            }
            
            // echo json_encode($arrResponse);
            
        }
        catch(Exception $e){
            $arrResponse = array("status"=>false, "msg"=>"Comunicarse con admin." .$e->getMessage());
            // echo json_encode($arrResponse);
        }
        
        echo json_encode($arrResponse);
        die();
    }

    public function delUser()
    {
        // print_r($_POST['idUsr']);
        try{
            $user = new usuarioModel();
            $user->id = intval($_POST['idUsr']);
            if($user->deleteUser()){
                $arrResponse = array("status"=>true, "msg"=>"Datos guardados correctamente.");
            }
            
        }catch(Exception $e){
            $arrResponse = array("status"=>false, "msg"=>"Ocurrio un error. " .$e->getMessage());
        }

        echo json_encode($arrResponse);
        die();
    }

 }