<?php

Class Spots_model extends CI_Model{

    function edit($id){
        $name = $this->input->post('name');
        $data = array( 'name' => $name );
        if($this->db->update('spots', $data, array('id'=>$id))){
            return 'success';
        }
        else{
            return 'error';
        }
    }

    function add(){
        $name = $this->input->post('name');
        $data = array( 'name' => $name);
        if($this->db->insert('spots', $data)){
            return 'success';
        }
        else{
            return 'error';
        }
    }
}