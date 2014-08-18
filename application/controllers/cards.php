<?php
/*
 * 刷卡记录查询
 */

Class Cards extends CI_Controller{
    function __construct(){
        parent::__construct();
    }

    function index(){
        redirect('cards/show');
    }

    function show(){
        $this->admin_model->render_header('cards');
        $this->load->library('pagination');//加载分页类
        $config['base_url'] = base_url().'cards/show';//设置基地址
        $config['uri_segment']=3;//设置url上第几段用于传递分页器的偏移量
        $config['num_links'] = 2;
        $this->db->where('exist', 1);
        $config['total_rows'] = $this->db->count_all_results('cards');//自动从数据库中取得total_row信息
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
        $this->db->where('exist', 1);
        $query=$this->db->get('cards',$config['per_page'],$offset * $config['per_page']);
        $data['query'] = $query->result_array();
        $data['pages'] = $this->pagination->create_links();//显示分页器
        $data['msg_type'] = $this->session->flashdata('msg_type');
        $data['msg'] = $this->session->flashdata('msg');
        $this->load->view('show_cards',$data);
        $this->load->view('footer');
    }

    function search(){
        $this->admin_model->render_header();
        $no = $this->input->get('no');
        $realname = $this->input->get('realname');
        $id_no = $this->input->get('id_no');
        if($no){
            $search['no'] = $no;
        }
        if($realname){
            $search['realname'] = $realname;
        }
        if($id_no){
            $search['id_no'] = $id_no;
        }
        if(!$search){
            redirect('admin/show');
        }
        $query_string = http_build_query($search);
        $this->load->library('pagination');//加载分页类
        $config['base_url'] = base_url().'cards/search?'.$query_string;//设置基地址
        $config['uri_segment']=3;//设置url上第几段用于传递分页器的偏移量
        $config['num_links'] = 2;
        $search['exist'] = 1;
        $this->db->like($search);
        $config['total_rows'] =  $this->db->get_where('cards')->num_rows();
        $config['per_page'] = 9; //每页显示的数据数量
        $config['anchor_class'] = "class=\"item\" ";
        $config['first_link'] = '首页';
        $config['last_link'] = '尾页';
        $config['use_page_numbers'] = TRUE;
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'page';
        $config['next_link'] = '<i class="icon right arrow"></i>';
        $config['prev_link'] = '<i class="icon left arrow"></i>';
        $config['cur_tag_open'] = '<a class="active item">';
        $config['cur_tag_close'] = '</a>';
        $this->pagination->initialize($config); //设置完成分页器
        $offset = $this->uri->segment(3)-1;
        if($offset<0){
            $offset = 0;
        }
        $this->db->like($search);
        $this->db->order_by("updated", "desc");
        $query=$this->db->get('cards',$config['per_page'],$offset * $config['per_page']);
        $data['query'] = $query->result_array();
        $data['pages'] = $this->pagination->create_links();//显示分页器
        $data['msg_type'] = '';
        $data['msg'] = '';
        $this->load->view('show_cards',$data);
        $this->load->view('footer');
    }

    function edit(){
        $this->admin_model->render_header('cards');
        $id = $this->input->get('id');
        if( ! $id){
            header("Content-type:text/html;charset=utf-8");
            echo '<script>alert("缺少用户ID!");window.history.back();</script>';
            exit;
        }
        $row = $this->db->get_where('cards', array('id'=>$id))->row_array();
        $data = $row;
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $this->form_validation->set_rules('expire', '到期时间', 'trim|required');
            $this->form_validation->set_rules('realname', '姓名', 'trim|required|max_length[30]');
            $this->form_validation->set_message('required', '%s不能为空');
            $this->form_validation->set_message('matches', '两次输入的密码不一致');
            $this->form_validation->set_message('exact_length', '%s长度为16');
            $this->form_validation->set_message('max_length', '%s超过最大长度');
            $this->form_validation->set_message('numeric', '%s只能为数字');
            $this->form_validation->set_message('is_unique', '此%s已经存在！');
            if ($this->form_validation->run() == FALSE){
                $data['msg_type'] = 'error';
                $data['msg'] = validation_errors();
            }
            else{
                $this->load->model('cards_model');
                $this->cards_model->edit($id);
            }
        }
        else{
            $data['msg_type'] = '';
            $data['msg'] = '';
        }
        $this->load->view('edit_card', $data);
        $this->load->view('footer');
    }

    //增加年卡
    function add(){
        $this->admin_model->render_header('cards');
        $this->form_validation->set_rules('no', '卡号', 'trim|required|numeric|exact_length[16]|xss_clean|is_unique[cards.no]');
        $this->form_validation->set_rules('id_no', '身份证', 'trim|numeric|required|is_unique[cards.id_no]');
        $this->form_validation->set_rules('expire', '到期时间', 'trim|required');
        $this->form_validation->set_rules('realname', '姓名', 'trim|required|max_length[30]');
        $this->form_validation->set_message('required', '%s不能为空');
        $this->form_validation->set_message('matches', '两次输入的密码不一致');
        $this->form_validation->set_message('exact_length', '%s长度为16');
        $this->form_validation->set_message('max_length', '%s超过最大长度');
        $this->form_validation->set_message('numeric', '%s只能为数字');
        $this->form_validation->set_message('is_unique', '此帐号已经存在！');
        if ($this->form_validation->run() == FALSE){
            $data['msg_type'] = 'error';
            $data['msg'] = validation_errors();
        }
        else{
            $this->load->model('cards_model');
            $res = $this->cards_model->add();
            if($res == 'success'){
                $data['msg_type'] = 'success';
                $data['msg'] = '年卡充值成功！';
            }
            else{
                $data['msg_type'] = 'error';
                $data['msg'] = '年卡充值失败！';
            }
        }
        $this->load->view('add_card',$data);
        $this->load->view('footer');
    }

}












?>