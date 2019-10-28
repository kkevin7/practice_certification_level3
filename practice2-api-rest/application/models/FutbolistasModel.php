<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FutbolistasModel extends CI_Model {


  public function __construct()
  {
    parent::__construct();
  }

  public function findAll()
  {
    return $this->db->get('futbolistas')->result();
  }

  public function findById($id){
    $this->db->where('id', $id);
    return $this->db->get('futbolistas')->row();
  }

  public function create($datos){
    if($this->db->insert('futbolistas', $datos)){
      return true;
    }else{
      return false;
    }
  }

  public function update($datos){
    $this->db->where('id', $datos['id']);
    if($this->db->update('futbolistas', $datos)){
      return true;
    }else{
      return false;
    }
  }

  public function delete($id){
    $this->db->where('id', $id);
    if($this->db->delete('futbolistas')){
      return true;
    }else{
      return false;
    }
  }

}
