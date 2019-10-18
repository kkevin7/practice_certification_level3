<?php
defined('BASEPATH') or exit('No direct script access allowed');

// importacion de headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
header('Allow: GET, POST, OPTIONS, PUT, DELETE');

// import the libraries
require_once APPPATH. 'libraries/REST_Controller.php';
require_once APPPATH. 'libraries/Format.php';

//class rest
class Empleados extends REST_Controller
{
    
  // method construct
  public function __construct()
  {
    parent::__construct();
    // llamada a los modelos
    $this->load->model(array('Empleados_model'));
  }

  //metodo para obtener registros
  public function index_get($id = "")
  {
    if(empty($id)){
      //obtener todos los registros
      $this->response($this->Empleados_model->findAll(), parent::HTTP_OK);
    }else{
      //buscar por un id
      if($this->Empleados_model->findById($id)){
        $this->response($this->Empleados_model->findById($id), parent::HTTP_OK);
      }else{
        //mensaje de error
        $this->response(array('msg' => "Not found records, is empty"), parent::HTTP_NOT_FOUND);
      }
    }
  }
  

  // metodo para ingresar registros
  public function index_post(){
    //formato del arreglo
    $data = array(
      'dui' => (trim($this->post('dui'))) ? trim($this->post('dui')) : null,
      'nit' => (trim($this->post('nit'))) ? trim($this->post('nit')) : null,
      'nombre' => (trim($this->post('nombre'))) ? trim($this->post('nombre')) : null,
      'salario' => (trim($this->post('salario'))) ? trim($this->post('salario')) : null,
      'profesion' => (trim($this->post('profesion'))) ? trim($this->post('profesion')) : null,
    );

    //validacion que los campos no se encuentren vacios
    if(isset($data['dui']) && isset($data['nit']) && isset($data['nombre']) && isset($data['salario']) && isset($data['profesion']) ){
      if($this->Empleados_model->create($data)){
        $this->response(array('msg' => 'Create successfully',
                              'data' => $data), parent::HTTP_CREATED);
      }else{
        //mensaje de error
        $this->response(array('msg' => "The record wasn´t creted"), parent::HTTP_INTERNAL_SERVER_ERROR);
      }
    }else{
      //mensaje de error
      $this->response(array('msg' => 'Error the fields are empty'), parent::HTTP_BAD_REQUEST);
    }
  }

  //metodo para de eliminar registros
public function index_delete($dui = ""){
  if(isset($dui)){
    if($this->Empleados_model->delete($dui)){
      $this->response(array('msg' => "Deleted successfully"));
    }else{
      //error del servidor
      $this->response(array('msg' => "The record wasn´t deleted"), parent::HTTP_INTERNAL_SERVER_ERROR);
    }
  }else{
    //mensaje de id no puede estar vacio
    $this->response(array('msg' => 'Error the ID is empty'), parent::HTTP_BAD_REQUEST);
  }
}

//metodo para actualizar registros
  public function index_put(){
    if($this->put('dui')){
      if($this->Empleados_model->findById(($this->put('dui')))){

          $id = $this->put('dui');
          $search = (array)$this->Empleados_model->findById($id);
          // darle formato al arreglo
          $data = array(
            'dui' => (trim($this->put('dui'))) ,
            'nit' => (trim($this->put('nit'))) ,
            'nombre' => (trim($this->put('nombre'))) ,
            'salario' => (trim($this->put('salario'))) ,
            'profesion' => (trim($this->put('profesion'))) ,
          );

          // var_dump($data);
          if($this->Empleados_model->update($data)){
            $this->response(array('msg' => 'Update successfully',
                                  'data' => $data), parent::HTTP_CREATED);
          }else{
            //mensaje error que no se pudo actualizar
            $this->response(array('msg' => "The record wasn´t updated"), parent::HTTP_INTERNAL_SERVER_ERROR);
          }
      }else{
        //mensaje de erro que debe existir el id
      $this->response(array('msg' => 'Error the record must be exist'), parent::HTTP_BAD_REQUEST);
      }
    }else{
      //mensaje de bad request
      $this->response(array('msg' => 'Error the ID can´t be empty'), parent::HTTP_BAD_REQUEST);
    }
  }

}
