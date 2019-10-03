<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// Extens de class from the class Model of C
class Producto_model extends CI_Model {

  public function __construct()
  {
    //Inicializate the varibles de class CI Modell
    parent::__construct();
  }

  //Method the the get all the content of table products
  public function findAll()
  {
    //Use the method od query builder of CI and get all records
    return $this->db->get('producto')->result();
  }

  //Method that search one record in the table product
  public function findById($id = ''){
    // Specificate the ID of the table product
    $this->db->where('id_producto', $id);
    // Use the method of query builder of ci to get a specificate record
    return $this->db->get('producto')->row();
  }

  // Method that use to create records en the table product
  public function create($data){
    // Insert one record in the table product
    if($this->db->insert('producto',$data)){
      // Is all is Ok return true
      return true;
    }else{
      // Is something is wrong return false
      return false;
    }
  }

  // Method that use to update the record the table product
  public function update($data){
    // Specificate the ID in the table producto
    $this->db->where('id_producto', $data['id_producto']);
    // The update a record with the class methods of ci
    if($this->db->update('producto',$data)){
      // Is all is Ok return true
      return true;
    }else{
      // Is something is wrong return false
      return false;
    }
  }

  //Method used to delete records in the table product
  public function delete($id = ''){
    // Specificate the ID in the table producto
    $this->db->where('id_producto', $id);
    // Delete a speficate record with the methonds of db clas of ci
    if($this->db->delete('producto')){
      // Is all is Ok return true
      return true;
    }else{
      // Is something is wrong return false
      return false;
    }
  }

}
