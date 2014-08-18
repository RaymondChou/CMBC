<?php

Class Cards_model extends CI_Model{

    function edit($id){
        $realname = $this->input->post('realname');
        $expire = $this->input->post('expire');
        $phone = $this->input->post('phone');
        $remark = $this->input->post('remark');
        $data = array(
            'expire' => $expire,
            'phone' => $phone,
            'realname' => $realname,
            'updated' => time(),
            'remark' => $remark
        );
        if($this->db->update('cards', $data, array('id'=>$id))){
            $this->session->set_flashdata('msg_type','success');
            $this->session->set_flashdata('msg','更改成功！');
        }
        else{
            $this->session->set_flashdata('msg_type','error');
            $this->session->set_flashdata('msg','更改失败！');
        }
        redirect('cards/show');
    }

    function add(){
        $no = $this->input->post('no');
        $realname = $this->input->post('realname');
        $id_no = $this->input->post('id_no');
        $expire = $this->input->post('expire');
        $phone = $this->input->post('phone');
        $remark = $this->input->post('remark');
        $data = array(
            'no' => $no,
            'id_no' => $id_no,
            'expire' => $expire,
            'phone' => $phone,
            'realname' => $realname,
            'updated' => time(),
            'created' => time(),
            'remark' => $remark
        );
        if($this->db->insert('cards', $data)){
            return 'success';
        }
        else{
            return 'error';
        }
    }

}