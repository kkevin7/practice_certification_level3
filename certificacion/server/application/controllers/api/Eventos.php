<?php
defined('BASEPATH') or exit('No direct script access allowed');

// import the libraries use reset controller methods
require_once APPPATH . 'libraries/REST_Controller.php';
require_once APPPATH . 'libraries/Format.php';

// name of he class
class Eventos extends REST_Controller
{

  public function __construct()
  {
    // inicializate the variables parent class
    parent::__construct();
    //speficate the model that will use
    $this->load->model(array('EventosModel'));
  }

  // method the use to do a get request
  public function index_get($id = "")
  {
    //check the id is not empty
    if (empty($id)) {
      // return the all records of the table
      $this->response($this->EventosModel->findAll(), parent::HTTP_OK);
    } else {
      // verificate the id is not empty
      if ($this->EventosModel->findById($id)) {
        // find a specificate record
        $this->response($this->EventosModel->findById($id), parent::HTTP_OK);
      } else {
        // message of bad request
        $this->response(array('msg' => 'Not found records, is empty'), parent::HTTP_NOT_FOUND);
      }
    }
  }

  //method used to create record in the table with post request
  public function index_post()
  {
    // get data with a speficate format
    $data = array(
      'titulo' => (trim($this->post('titulo'))) ? trim($this->post('titulo')) : null,
      'fecha_hora' => (trim($this->post('fecha_hora'))) ? trim($this->post('fecha_hora')) : null,
      'descripcion' => (trim($this->post('descripcion'))) ? trim($this->post('descripcion')) : null,
      'categoria' => (trim($this->post('categoria'))) ? trim($this->post('categoria')) : null,
    );

    // method to update record in the table
    if (isset($data['titulo']) && isset($data['fecha_hora']) && isset($data['descripcion']) && isset($data['categoria'])) {
      if ($this->EventosModel->create($data)) {
        // show a message that all is OK
        $this->response(array(
          'msg' => 'Created successfully',
          'data' => $data
        ), parent::HTTP_CREATED);
      } else {
        // Error from the server 
        $this->response(array('msg' => 'The record wasn´t creted'), parent::HTTP_INTERNAL_SERVER_ERROR);
      }
    } else {
      // message of bad request
      $this->response(array('msg' => 'Error the fields are empty'), parent::HTTP_BAD_REQUEST);
    }
  }

  //method used to update record in the table with put request
  public function index_put()
  {
    // verificate that id is not empty
    if ($this->put('id')) {
      // check that id exist
      if ($this->EventosModel->findById(($this->put('id')))) {
        $id = $this->put('id');
        // search = (array)$this->EventosModel->findById($id);
        // get data with a speficate format
        $data = array(
          'id' => (trim($this->put('id'))),
          'titulo' => (trim($this->put('titulo'))),
          'fecha_hora' => (trim($this->put('fecha_hora'))),
          'descripcion' => (trim($this->put('descripcion'))),
          'categoria' => (trim($this->put('categoria'))),
        );
        // method to update record in the table
        if ($this->EventosModel->update($data)) {
          // show a message that all is OK
          $this->response(array(
            'msg' => 'Update successfully',
            'data' => $data
          ), parent::HTTP_OK);
        } else {
          // Error from the server 
          $this->response(array('msg' => 'The record wasn´t updated'), parent::HTTP_INTERNAL_SERVER_ERROR);
        }
      } else {
        // Show error because the filds are empty
        $this->response(array('msg' => 'Error the record must be exist'), parent::HTTP_BAD_REQUEST);
      }
    } else {
      //mensaje de bad request
      $this->response(array('msg' => 'Error the ID can´t be empty'), parent::HTTP_BAD_REQUEST);
    }
  }

  //method used to delete record in the table
  public function index_delete($id = "")
  {
    $id = trim($id);
    //check that id is not empty
    if (!empty($id)) {
      // verificate that record exist
      if ($this->EventosModel->findById($id)) {
        // delete the record
        if($this->EventosModel->delete($id)){
          $this->response(array("msg" => "Deleted successfully"), parent::HTTP_OK);
        }else{
          // Error from the server 
          $this->response(array('msg' => 'The record wasn´t deleted'), parent::HTTP_INTERNAL_SERVER_ERROR);
        }
      } else {
        // Show error because the filds are empty
        $this->response(array('msg' => 'Not found records, is empty'), parent::HTTP_NOT_FOUND);
      }
    } else {
      //mensaje de bad request
      $this->response(array('msg' => 'Error the ID can´t be empty'), parent::HTTP_BAD_REQUEST);
    }
  }

}
