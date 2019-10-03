<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH. 'libraries/REST_Controller.php';
require_once APPPATH. 'libraries/Format.php';

class Empleado extends REST_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('Empleado_model'));
  }

  public function index_get($id = "")
  {
    if(empty($id)){
      $this->response($this->Empleado_model->findAll(), parent::HTTP_OK);
    }else{
      if($this->Empleado_model->findById($id)){
        $this->response($this->Empleado_model->findById($id), parent::HTTP_OK);
      }else{
        $this->response(array('msg' => "Not found records"), parent::HTTP_NOT_FOUND);
      }
    }
  }

  public function index_post(){
    $data = array(
      'nombre' => $this->post('nombre'),
      'apellido' => $this->post('apellido'),
      'salario' => $this->post('salario'),
      'categoria' => $this->post('categoria'),
      'id_usuario' => $this->post('id_usuario')
    );

    if(isset($data['nombre']) && isset($data['apellido']) && isset($data['salario']) && isset($data['categoria']) && isset($data['id_usuario'])){
      if($this->Empleado_model->create($data) == true){
        $this->response(array('msg' => "created successfully",
                              'data' => $this->Empleado_model->findLastRecord()  
      ), parent::HTTP_CREATED);
      }else{
        $this->response(array('msg' => "Something went wrong in the request"), parent::HTTP_INTERNAL_SERVER_ERROR);
      }
    }else{
      $this->response(array('msg' => "Some field is empty"), parent::HTTP_BAD_REQUEST);
    }
  }

  public function index_put(){
    $data = array(
      'id_empleado' => $this->put('id_empleado'),
      'nombre' => $this->put('nombre'),
      'apellido' => $this->put('apellido'),
      'salario' => $this->put('salario'),
      'categoria' => $this->put('categoria'),
      'id_usuario' => $this->put('id_usuario')
    );

    if(isset($data['id_empleado']) && isset($data['nombre']) && isset($data['apellido']) && isset($data['salario']) && isset($data['categoria']) && isset($data['id_usuario'])){
      if($this->Empleado_model->update($data) == true){
        $this->response(array('msg' => "modified successfully",
                              'data' => $this->Empleado_model->findById($data['id_empleado']) 
      ), parent::HTTP_OK);
      }else{
        $this->response(array('msg' => "Something went wrong in the request"), parent::HTTP_INTERNAL_SERVER_ERROR);
      }
    }else{
      $this->response(array('msg' => "Some field is empty"), parent::HTTP_BAD_REQUEST);
    }
  }

  public function index_delete($id = ""){
    if(empty($id)){
      $this->response(array('msg' => 'ID is empty'), parent::HTTP_BAD_REQUEST);
    }else{
      if($this->Empleado_model->delete($id) == true){
        $this->response(array('msg' => "Deleted successfully"), parent::HTTP_OK);
      }else{
        $this->response(array('msg' => "Something went wrong in the request"), parent::HTTP_INTERNAL_SERVER_ERROR);
      }
    }
  }

  public function findAllJoin_get(){
    $this->response($this->Empleado_model->findAllJoin(), parent::HTTP_OK);
  }

  public function findAllDependences_get(){
    $this->response($this->Empleado_model->findAllDependences(), parent::HTTP_OK);
  }



}
