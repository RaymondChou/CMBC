<?php
/*
 * API接口
 */
Class Api extends CI_Controller{

    function __contruct(){
        parent::__contruct();
    }

    function index(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $data = array(
                'username' => $username,
                'password' => $password,
                'type' => 4,
                'exist' => 1
            );
            $query = $this->db->get_where('admins', $data);
            if($query->num_rows()>0){
                $row = $query->row_array();
                $admin_id = $row['id'];
                $spot_id = $row['spot_id'];
                $json = $this->input->post('records');//要增加的数据
                $records = json_decode($json, TRUE);
                $success_count = 0;
                foreach($records as $record){
                    $pid = $record['pid'];//身份证号
                    $time = $record['time'];//记录时间
                    $query = $this->db->get_where('cards', array('no'=>$pid));
                    if($query->num_rows() < 1){
                        continue;
                    }
                    $card_id = $query->row()->id;
                    $data = array(
                        'card_id' => $card_id,
                        'admin_id' => $admin_id,
                        'spot_id' => $spot_id,
                        'created' => $time
                    );
                    if($this->db->insert('logs', $data)){
                        $success_count++;
                    }
                }
                if($success_count > 0){
                    $ret = array( 'status'=>'ok', 'success_nums'=>$success_count);
                }
                else{
                    $ret = array('status' => 'error', 'success_nums'=> 0);
                }
                echo json_encode($ret);
                exit;
            }
            else{
                echo json_encode(
                    array(
                        'status' => 'error',
                        'errmsg' => 'validation error'
                    ));
                exit;
            }

        }
    }

    function check(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $data = array(
                'username' => $username,
                'password' => $password,
                'type' => 4,
                'exist' => 1
            );
            $query = $this->db->get_where('admins', $data);
            if($query->num_rows()>0){
                echo json_encode(array('status'=>'OK'));
            }
            else{
                echo json_encode(array('status'=>'ERROR'));
            }
            exit;
        }
    }









}