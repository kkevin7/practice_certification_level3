<?php
defined('BASEPATH') or exit('No direct script access allowed');
//Import the library of REST Controller for CI
require_once APPPATH."libraries/REST_Controller.php";
//Import the library of Format that is add-on for REST_Controller CI
require_once APPPATH."libraries/Format.php";
// header of the reques
header('Access-Control-Allow-Origin: *');
//header type
header('Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method');
//Allow methods
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
//Allows access methods
header('Allow: GET, POST, OPTIONS, PUT, DELETE');

class Producto extends REST_Controller
{
    //Construct method of the CI View for the API REST
  public function __construct()
  {
    //Inicializate the varaibles of the library
    parent::__construct();
    //Specificate the model used in the product
    $this->load->model(array('Producto_model'));
  }

  /** To use the method to get only have to realizate a Get request 
   * 
   * return resposne;
   */

  // GET request of the API REST
  public function index_get($id = "")
  {
    // IS the ID is empty excute the methods of get all records
    if(empty($id)){
      $this->response($this->Producto_model->findAll(), parent::HTTP_OK);
    }else{
      // Verify that ID is not empty
      if($this->Producto_model->findById($id)){
        // Search a speficate record
        $this->response($this->Producto_model->findById($id), parent::HTTP_OK);
      }else{
        // Show message is the ID is empty
        $this->response(array('msg' => "Not found records, is empty"), parent::HTTP_NOT_FOUND);
      }
    }
  }

/**To use the method to create a record in the the database
 * 
 * return response;
*/

  // POST request of the API REST
  public function index_post(){
    // Format the data from the request
    $data = array(
      'nombre' => (trim($this->post('nombre'))) ? trim($this->post('nombre')) : null,
      'cantidad' => (trim($this->post('cantidad'))) ? trim($this->post('cantidad')) : null,
      'precio_unitario' => (trim($this->post('precio_unitario'))) ? trim($this->post('precio_unitario')) : null,
      'estado' => 1
    );

    // Verificaty the fields are not empty
    if(isset($data['nombre']) && isset($data['cantidad']) && isset($data['precio_unitario']) && isset($data['estado']) ){
      // Verificate that the records was created
      if($this->Producto_model->create($data)){
        // Show a message that the request is CREATED 
        $this->response(array('msg' => 'Create successfully',
                              'data' => $data), parent::HTTP_CREATED);
      }else{
        // is something is wrong show a error message
        $this->response(array('msg' => "The record wasn´t creted"), parent::HTTP_INTERNAL_SERVER_ERROR);
      }
    }else{
      // show a message that the fields are empty
      $this->response(array('msg' => 'Error the fields are empty'), parent::HTTP_BAD_REQUEST);
    }
  }

  /**
   * To use the update records in the databsee in the table product
   * 
   * return response;
   */

  // PUT request of the API REST
  public function index_put(){
    //Verificate that the ID is not empty
    if($this->put('id_producto')){
      if($this->Producto_model->findById(($this->put('id_producto')))){
        if(trim($this->put('estado')) == 1 || trim($this->put('estado')) == 0){

          $id = $this->put('id_producto');
          $search = (array)$this->Producto_model->findById($id);
          // Format the data from the request
        $data = array(
          'id_producto' => (trim($this->put('id_producto'))),
          'nombre' => (trim($this->put('nombre'))) ? trim($this->put('nombre')) : $search['nombre'],
          'cantidad' => (trim($this->put('cantidad'))) ? trim($this->put('cantidad')) : $search['cantidad'],
          'precio_unitario' => (trim($this->put('precio_unitario'))) ? trim($this->put('precio_unitario')) :  $search['precio_unitario'],
          'estado' => (trim($this->put('estado'))) ? trim($this->put('estado')) : $search['estado'],
        );
        // Verificaty the fields are not empty
        if(isset($data['id_producto']) && isset($data['nombre']) && isset($data['cantidad']) && isset($data['precio_unitario']) && isset($data['estado']) ){
          // Verificate that the records was created
          if($this->Producto_model->update($data)){
            // Show a message that the request is OK 
            $this->response(array('msg' => 'Modified successfully',
                                  'data' => $this->Producto_model->findById($id)), parent::HTTP_OK);
          }else{
            // is something is wrong show a error message
            $this->response(array('msg' => "The record wasn´t modified"), parent::HTTP_INTERNAL_SERVER_ERROR);
          }
        }else{
          // show a message that the fields are empty
          $this->response(array('msg' => 'Error the fields are empty'), parent::HTTP_BAD_REQUEST);
        }
          //Show message of the state
        }else{
          $this->response(array('msg' => 'Error the fild estado can´t be diferrent of 1 or 0'), parent::HTTP_BAD_REQUEST);
        }
      }else{
        // ask is the record exist
      $this->response(array('msg' => 'Error the record must be exist'), parent::HTTP_BAD_REQUEST);
      }
      
    }else{
      // show a message that ID is not empty
      $this->response(array('msg' => 'Error the ID can´t be empty'), parent::HTTP_BAD_REQUEST);
    }
  }

    /**
   * To use the delete records in the databse in the table product
   * 
   * return response;
   */

  // DELETE request of the API REST
  public function index_delete($id = ""){
    //verificate that the id is not empty
    if(isset($id)){
      // Verificate that delete method is working
      if($this->Producto_model->delete($id)){
        // Is all is OK show a message the is successfully 
        $this->response(array('msg' => "Deleted successfully"));
      }else{
        // is something is wrong show a error message
        $this->response(array('msg' => "The record wasn´t deleted"), parent::HTTP_INTERNAL_SERVER_ERROR);
      }
    }else{
      // show a message that the fields are empty
      $this->response(array('msg' => 'Error the ID is empty'), parent::HTTP_BAD_REQUEST);
    }
  }

}

