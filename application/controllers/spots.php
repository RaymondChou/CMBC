<?php
/*
 * 刷卡记录查询
 */

Class Spots extends CI_Controller{
    function __construct(){
        parent::__construct();
    }

    function index(){
        redirect('spots/show');
    }

    function show(){
        $this->admin_model->render_header();
        $this->load->library('pagination');//加载分页类
        $config['base_url'] = base_url().'spots/show';//设置基地址
        $config['uri_segment']=3;//设置url上第几段用于传递分页器的偏移量
        $config['num_links'] = 2;
        $config['total_rows'] = $this->db->count_all('spots');//自动从数据库中取得total_row信息
        $config['per_page'] = 8; //每页显示的数据数量
        $config['anchor_class'] = "class=\"item\" ";
        $config['first_link'] = '首页';
        $config['last_link'] = '尾页';
        $config['use_page_numbers'] = TRUE;
        $config['next_link'] = '<i class="icon right arrow"></i>';
        $config['prev_link'] = '<i class="icon left arrow"></i>';
        $config['cur_tag_open'] = '<a class="active item">';
        $config['cur_tag_close'] = '</a>';
        $this->pagination->initialize($config); //设置完成分页器
        $offset = $this->uri->segment(3)-1;
        if($offset<0){
            $offset = 0;
        }
        $this->db->order_by('id','desc');
        $query=$this->db->get('spots',$config['per_page'],$offset * $config['per_page']);
        $data['query'] = $query->result_array();
        $data['pages'] = $this->pagination->create_links();//显示分页器
        $data['msg_type'] = $this->session->flashdata('msg_type');
        $data['msg'] = $this->session->flashdata('msg');
        $this->load->view('show_spots',$data);
        $this->load->view('footer');
    }

    function add(){
        $this->admin_model->render_header();
        $this->form_validation->set_rules('name', '景区名', 'trim|required|min_length[3]|max_length[30]|xss_clean|is_unique[spots.name]');
        $this->form_validation->set_message('is_unique', '%s已经存在！');
        $this->form_validation->set_message('required', '%s不能为空');
        $this->form_validation->set_message('min_length', '%s最小长度为3');
        $this->form_validation->set_message('max_length', '%s最大长度为30');
        if ($this->form_validation->run() == FALSE){
            $data['msg_type'] = 'error';
            $data['msg'] = validation_errors();
        }
        else{
            $this->load->model('spots_model');
            $res = $this->spots_model->add();
            if($res == 'success'){
                $data['msg_type'] = 'success';
                $data['msg'] = '增加景区成功！';
            }
            else{
                $data['msg_type'] = 'error';
                $data['msg'] = '增加景区失败！';
            }
        }
        $this->load->view('add_spot',$data);
        $this->load->view('footer');
    }

    function edit(){
        $this->admin_model->render_header();
        $id = $this->input->get('id');
        if( ! $id){
            header("Content-type:text/html;charset=utf-8");
            echo '<script>alert("缺少用户ID!");window.history.back();</script>';
            exit;
        }
        $row = $this->db->get_where('spots', array('id'=>$id))->row_array();
        $data['id'] = $row['id'];
        $data['name'] = $row['name'];
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $this->form_validation->set_rules('name', '景区名', 'trim|required|min_length[3]|max_length[30]|xss_clean|is_unique[spots.name]');
            $this->form_validation->set_message('is_unique', '%s已经存在！');
            $this->form_validation->set_message('required', '%s不能为空');
            $this->form_validation->set_message('min_length', '%s最小长度为2');
            $this->form_validation->set_message('max_length', '%s最大长度为12');
            if ($this->form_validation->run() == FALSE){
                $data['msg_type'] = 'error';
                $data['msg'] = validation_errors();
            }
            else{
                $this->load->model('spots_model');
                $res = $this->spots_model->edit($id);
                if($res == 'success'){
                    $this->session->set_flashdata('msg_type', 'success');
                    $this->session->set_flashdata('msg', '更新成功！');
                    redirect('spots/show');
                }
                else{
                    $data['msg_type'] = 'error';
                    $data['msg'] = '更新失败！';
                }
            }
        }
        else{
            $data['msg_type'] = '';
            $data['msg'] = '';
        }
        $this->load->view('edit_spot', $data);
        $this->load->view('footer');
    }
}












?>