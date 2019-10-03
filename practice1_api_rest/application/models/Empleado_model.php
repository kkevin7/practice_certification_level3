<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empleado_model extends CI_Model {

  public function __construct()
  {
    parent::__construct();
  }

  public function findAll()
  {
    return $this->db->get('empleado')->result();
  }

  public function findById($id = "")
  {
    $this->db->where('id_empleado',$id);
    return $this->db->get('empleado')->row();
  }

  public function findAllJoin(){
    $this->db->select('e.id_empleado, e.nombre, e.apellido, e.salario, e.categoria, tu.nombre as tipo_usuario');
    $this->db->from('empleado e');
    $this->db->join('tipo_usuario tu', 'e.id_usuario = tu.id_usuario');
    return $this->db->get()->result();
  }

  public function findAllDependences(){
    $data = $this->db->get('empleado')->result();
    $result = array();
    if(isset($data)){
      foreach($data as $empleado){
        $this->db->where('id_usuario', $empleado->id_usuario);
        $empleado = (array) $empleado;
        unset($empleado['id_usuario']);
        $empleado = array_merge_recursive($empleado, array('id_usuario' => (array)$this->db->get('tipo_usuario')->row()));
        array_push($result, $empleado);
      }
    }
    return $result;
  }

  public function create($data){
    if($this->db->insert('empleado',$data)){
      return true;
    }else{
      return false;
    }
  }

  public function findLastRecord(){
    $this->db->select_max('id_empleado');
    $this->db->select('nombre,apellido,salario,categoria');
    $this->db->from('empleado');
    return $this->db->get()->row();
  }

  public function update($data){
    $this->db->where('id_empleado', $data['id_empleado']);
    if($this->db->update('empleado',$data)){
      return true;
    }else{
      return false;
    }
  }

  public function delete($id){
    $this->db->where('id_empleado', $id);
    if($this->db->delete('empleado')){
      return true;
    }else{
      return false;
    }
  }


}

