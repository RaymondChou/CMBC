<?php
/*
 * 登陆验证模型
 * author:sun
 */

Class Admin_model extends CI_Model{

    function login($user, $pwd){
        $this->db->select('id, realname, type');
        $this->db->from('admins');
        $this->db->where('type !=', 4);
        $this->db->where(array('username'=>$user, 'password'=>md5($pwd), 'exist'=>1));
        $query = $this->db->get();
        if($query->num_rows()>0){
            $row = $query->row();
            $this->session->set_userdata('admin_id',$row->id);
            $this->session->set_userdata('admin_auth',$row->type);
            $this->session->set_userdata('admin_realname',$row->realname);
            redirect('admin');
        }
        else{
            header("Content-type:text/html;charset=utf-8");
            echo '<script>alert("用户名或密码不正确!");window.history.back();</script>';
            exit;
        }
    }

    function add_admin(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $realname = $this->input->post('realname');
        $type = $this->input->post('root');
        if($type == 4){
            $spot_id = $this->input->post('spot_id');
        }
        else{
            $spot_id = NULL;
        }
        $data = array(
            'username' => $username,
            'password' => md5($password),
            'realname' => $realname,
            'spot_id' => $spot_id,
            'created' => time(),
            'updated' => time(),
            'type' => $type
        );
        if($this->db->insert('admins', $data)){
            return 'success';
        }
        else{
            return 'error';
        }

    }

    function del_admin(){
        $user_id = $this->input->get('user_id');
        if(!$user_id){
            header("Content-type:text/html;charset=utf-8");
            echo '<script>alert("缺少用户ID!");window.history.back();</script>';
            exit;
        }
        if($user_id == $this->session->userdata('admin_id')){
            $this->session->set_flashdata('msg_type','error');
            $this->session->set_flashdata('msg','你不能删除你自己！');
        }
        else{
            $data = array('exist'=>0);
            $res = $this->db->update('admins', $data, array('id'=>$user_id));
            if($res){
                $this->session->set_flashdata('msg_type','success');
                $this->session->set_flashdata('msg','删除用户成功！');
            }
            else{
                $this->session->set_flashdata('msg_type','error');
                $this->session->set_flashdata('msg','删除用户失败！');
            }
        }
        redirect('admin/show');
    }

    function edit_admin($user_id){
        $password = $this->input->post('password');
        $realname = $this->input->post('realname');
        $type = $this->input->post('root');
        if($type == 4){
            $spot_id = $this->input->post('spot_id');
        }
        else{
            $spot_id = NULL;
        }
        $data = array(
            'password' => md5($password),
            'realname' => $realname,
            'spot_id' => $spot_id,
            'updated' => time(),
            'type' => $type
        );
        if($this->db->update('admins', $data, array('id'=>$user_id))){
            return 'success';
        }
        else{
            return 'error';
        }
    }

    public function render_header($need_auth = 'root'){
        if($this->session->userdata('admin_id') == NULL){
            redirect('admin/login');
        }
        if(!$this->auth_check($need_auth)){
            header("Content-type:text/html;charset=utf-8");
            echo '<script>alert("抱歉，您的权限不够，无法查看此页!");window.history.back();</script>';
            exit;
        }
        $data['admin_name'] = $this->session->userdata('admin_realname');
        $data['type'] = $this->session->userdata('admin_auth');
        $this->load->view('header',$data);
    }

    public function auth_check($need_auth){
        $user_auth = $this->session->userdata('admin_auth');
        if($user_auth == '4'){//收费员
            return FALSE;
        }
        if($user_auth == '1'){//超级管理员
            return TRUE;
        }
        if($need_auth == 'none'){
            return TRUE;
        }
        if($need_auth == 'logs' && $user_auth == '2'){//旅游局管理员
            return TRUE;
        }
        else if($need_auth == 'cards' && $user_auth == '3'){//柜员
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
}









?>