<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH. 'libraries/REST_Controller.php';
require_once APPPATH. 'libraries/Format.php';

class Futbolistas extends REST_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('FutbolistasModel'));
  }

  public function index_get($id = "")
  {
    $id= trim($id);
    if(empty($id)){
      $this->response($this->FutbolistasModel->findAll(), parent::HTTP_OK);
    }else{
      if(!empty($this->FutbolistasModel->findById($id))){
        $this->response($this->FutbolistasModel->findById($id), parent::HTTP_OK);
      }else{
        $this->response(array('msg' => "The record wasn´t found"), 404);
      }
      
    }
  }

  public function index_post(){
    $data = array(
      'nombre' => (!empty(trim($this->post('nombre'))) ? trim($this->post('nombre')) : null),
      'estatura' => (!empty(trim($this->post('estatura'))) ? trim($this->post('estatura')) : null),
      'peso' => (!empty(trim($this->post('peso'))) ? trim($this->post('peso')) : null),
      'procedencia' => (!empty(trim($this->post('procedencia'))) ? trim($this->post('procedencia')) : null),
    );

     if(isset($data['nombre']) && isset($data['estatura']) && isset($data['peso']) && isset($data['procedencia'])){
        if($this->FutbolistasModel->create($data)){
          $this->response(array('msg' => "The record was created", 'data' => $data), parent::HTTP_CREATED);
        }else{
          $this->response(array('msg' => "The record can´t be create" ), parent::HTTP_INTERNAL_SERVER_ERROR);
        }
     }else{
       $this->response(array('msg' => 'Error the fields are empty'), parent::HTTP_NOT_FOUND);
     }
  }

  public function index_put(){
    $data = array(
      'id' => (!empty(trim($this->put('id'))) ? trim($this->put('id')) : null),
      'nombre' => (!empty(trim($this->put('nombre'))) ? trim($this->put('nombre')) : null),
      'estatura' => (!empty(trim($this->put('estatura'))) ? trim($this->put('estatura')) : null),
      'peso' => (!empty(trim($this->put('peso'))) ? trim($this->put('peso')) : null),
      'procedencia' => (!empty(trim($this->put('procedencia'))) ? trim($this->put('procedencia')) : null),
    );

     if(isset($data['nombre']) && isset($data['estatura']) && isset($data['peso']) && isset($data['procedencia'])){
      if($this->FutbolistasModel->update($data)){
        $this->response(array('msg' => "The record was updated", 'data' => $data), parent::HTTP_CREATED);
      }else{
        $this->response(array('msg' => "The record can´t be update" ), parent::HTTP_INTERNAL_SERVER_ERROR);
      }
     }else{
       $this->response(array('msg' => 'Error the fields are empty'), parent::HTTP_NOT_FOUND);
     }
  }

  public function index_delete($id = ""){
    $id = trim($id);
    if(!empty($this->FutbolistasModel->findById($id))){
      if($this->FutbolistasModel->delete($id)){
        $this->response(array('msg' => "The record was deleted", "id" => $id), parent::HTTP_CREATED);
      }else{
        $this->response(array('msg' => "The record can´t be delete" ), parent::HTTP_INTERNAL_SERVER_ERROR);
      }
    }else{
      $this->response(array('msg' => "The record wasn´t found"), 404);
    }
  }

}

