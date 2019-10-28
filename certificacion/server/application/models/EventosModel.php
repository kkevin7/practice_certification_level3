<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//Name of the class
class EventosModel extends CI_Model {

  public function __construct()
  {
    //inializar las varibales
    parent::__construct();
  }

  // get all the recors of events table
  public function findAll(){
    //use the query builder of ci
  return $this->db->get('eventos')->result();
  }

  // get one record of the table in a particualar way
  public function findById($id = ""){
    //speficate the id
  $this->db->where('id', $id);
    // get one record
  return $this->db->get('eventos')->row();
  }

  // method to create records in the table
  public function create($data){
  try {
    // speficate the table with the data
  if($this->db->insert('eventos', $data)){
    // all it's ok return true
  return true;
  }else{
    // if fail return false
  return false;
  }
  } catch (Exception $e) {
    // if fail return false
  return false;
  }
  }

  public function update($data){
  try {
    //speficate the id
  $this->db->where('id', $data['id']);
   // speficate the table with the data
  if($this->db->update('eventos', $data)){
    // all it's ok return true
  return true;
  }else{
    // if fail return false
  return false;
  }
  } catch (Exception $e) {
    // if fail return false
  return false;
  }
  }

  public function delete($id = ''){
  try {
  $this->db->where('id', $id);
  if($this->db->delete('eventos')){
    // all it's ok return true
  return true;
  }else{
    // if fail return false
  return false;
  }
  } catch (Exception $e) {
    // if fail return false
  return false;
  }  
  }

}
