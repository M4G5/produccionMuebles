<?php

class usuarioModel extends Model
{

    public $id;
    public $name;
    public $username;
    public $pass;
    public $created_at;

    /**
     * Metodo para agregar nuevo usuario
     *
     * @return void
     */
    public function add()
    {

        $sql = 'INSERT INTO test (name,username,email,created_at) VALUES(:name,:username,:email,:created)';
        $usr = [
            'name'     => $this->name,
            'username' => $this->username,
            'email'    => $this->email,
            'created'  => $this->created_at
        ];

        try{
            return ($this->id = parent::query($sql, $usr)) ? $this->id : false;
        }catch(Exception $e) {
            throw $e;
        }

    }    

    /**
     * Metodo para actualizar usuario
     *
     * @return void
     */
    public function update()
    {
        $sql = 'UPDATE test SET name=:name,username=:username,email=:email WHERE id=:id';
        $usr = [
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'id' => $this->id
        ];
        try{
            return (parent::query($sql, $usr)) ? true : false;
        }catch(Exceptio $e){
            throw $e;
        }
    }

    public function allUser(){
        $sql = 'SELECT * FROM user';
        try{
            $request = parent::query($sql);
            return $request;
        }catch(Exception $e){
            throw $e;
        }
    }

    public function oneUser()
    {
        $sql = 'SELECT id_user,nombre,usuario FROM user WHERE id_user=:id';
        $usr = [
            "id" => $this->id
        ];
        try{
            $request = parent::query($sql, $usr);
            // print_r($request);
            return $request;
        }catch(Exception $e){ throw $e; }
    }

    public function addUser()
    {
        $sql = 'INSERT INTO user (nombre,usuario,clave,created_at) VALUES(:nombre,:usuario,:clave,:created)';
        $usr = [
            'nombre'  => $this->name,
            'usuario' => $this->username,
            'clave'   => $this->pass,
            'created' => $this->created_at
        ];

        try{
            return ($this->id = parent::query($sql, $usr)) ? $this->id : false;
        }catch(Exception $e) {
            throw $e;
        }    
    }

    public function updUser()
    {
        $sql = 'UPDATE user SET nombre=:nombre,usuario=:usuario,clave=:clave WHERE id_user=:id';
        $usr =[
            'nombre' =>$this->name,
            'usuario'=>$this->username,
            'clave'  =>$this->pass,
            'id'     =>$this->id
        ];
        
        try{
            $request = (parent::query($sql, $usr)) ? true : false;
            return $request;
        }catch(Exception $e){
            throw $e;
        }

    }

    public function deleteUser()
    {
        $sql = 'DELETE FROM user WHERE id_user=:id';
        try{
            $request = (parent::query($sql, ['id' => $this->id])) ? true : false;
            return $request;
        }catch(Exception $e){
            throw $e;
        }
    }

}