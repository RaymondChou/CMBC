<?php
/*
 * 主程序入口
 * author: sun
 */
Class Admin extends CI_controller{

    function __construct(){
        parent::__construct();
    }
    //显示首页
    function index(){
        $this->admin_model->render_header('none');
        $this->load->view('home');
        $this->load->view('footer');
    }
    //登陆
    function login(){
        if($this->session->userdata('admin_id')){
            redirect('admin');
        }
        if($this->input->post('user')&&$this->input->post('pwd'))
        {
            $this->load->model('admin_model');
            $this->admin_model->login($this->input->post('user'),$this->input->post('pwd'));
        }
        else{
            $this->load->view('login');
        }
    }

    function logout(){
        $this->session->sess_destroy();
        redirect('admin/login');
    }


    //显示管理员
    function show(){
        $this->admin_model->render_header();
        $this->load->library('pagination');//加载分页类
        $config['base_url'] = base_url().'admin/show';//设置基地址
        $config['uri_segment']=3;//设置url上第几段用于传递分页器的偏移量
        $config['num_links'] = 2;
        $this->db->where('exist', 1);
        $config['total_rows'] = $this->db->count_all_results('admins');//自动从数据库中取得total_row信息
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
        $this->db->where('exist', 1);
        $offset = $this->uri->segment(3)-1;
        if($offset<0){
            $offset = 0;
        }
        $this->db->order_by("updated", "desc");
        $this->db->where('exist', 1);
        $query=$this->db->get('admins',$config['per_page'],$offset * $config['per_page']);
        $data['query'] = $query->result_array();
        $data['pages'] = $this->pagination->create_links();//显示分页器
        $data['msg_type'] = $this->session->flashdata('msg_type');
        $data['msg'] = $this->session->flashdata('msg');
        $this->load->view('show_admin',$data);
        $this->load->view('footer');
    }

    //搜索管理员
    function search(){
        $this->admin_model->render_header();
        $username = $this->input->get('username');
        $realname = $this->input->get('realname');
        $type = $this->input->get('type');
        if($username){
            $search['username'] = $username;
        }
        if($realname){
            $search['realname'] = $realname;
        }
        if($type&&$type!='all'){
            $search['type'] = $type;
        }
        if(!$search){
            redirect('admin/show');
        }
        $query_string = http_build_query($search);
        $this->load->library('pagination');//加载分页类
        $config['base_url'] = base_url().'admin/search?'.$query_string;//设置基地址
        $config['uri_segment']=3;//设置url上第几段用于传递分页器的偏移量
        $config['num_links'] = 2;
        $search['exist'] = 1;
        $this->db->like($search);
        $config['total_rows'] =  $this->db->get_where('admins')->num_rows();
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
        $query=$this->db->get('admins',$config['per_page'],$offset * $config['per_page']);
        $data['query'] = $query->result_array();
        $data['pages'] = $this->pagination->create_links();//显示分页器
        $data['msg_type'] = '';
        $data['msg'] = '';
        $this->load->view('show_admin',$data);
        $this->load->view('footer');
    }

    //增加管理员
    function add(){
        $this->admin_model->render_header();
        $type = $this->input->post('root');
        if($type == 4){
            $this->form_validation->set_rules('spot_id', '所属景区', 'trim|required');
        }
        $this->form_validation->set_rules('username', '帐号', 'trim|required|min_length[4]|max_length[15]|xss_clean|is_unique[admins.username]');
        $this->form_validation->set_rules('password', '密码', 'trim|required|matches[passconf]');
        $this->form_validation->set_rules('passconf', '确认密码', 'trim|required');
        $this->form_validation->set_rules('realname', '姓名', 'max_length[30]');
        $this->form_validation->set_message('required', '%s不能为空');
        $this->form_validation->set_message('matches', '两次输入的密码不一致');
        $this->form_validation->set_message('min_length', '%s最小长度为4');
        $this->form_validation->set_message('max_length', '%s超过最大长度');
        $this->form_validation->set_message('is_unique', '此帐号已经存在！');
        if ($this->form_validation->run() == FALSE){
            $data['msg_type'] = 'error';
            $data['msg'] = validation_errors();
        }
        else{
            $res = $this->admin_model->add_admin();
            if($res == 'success'){
                $data['msg_type'] = 'success';
                $data['msg'] = '增加管理员成功！';
            }
            else{
                $data['msg_type'] = 'error';
                $data['msg'] = '增加管理员失败！';
            }
        }
        $data['spots_list'] = $this->db->get('spots')->result_array();
        $this->load->view('add_admin',$data);
        $this->load->view('footer');
    }
    //删除管理员
    function del(){
        $this->admin_model->render_header();
        $this->admin_model->del_admin();
    }

    //编辑管理员
    function edit(){
        $this->admin_model->render_header();
        $user_id = $this->input->get('user_id');
        if( ! $user_id){
            header("Content-type:text/html;charset=utf-8");
            echo '<script>alert("缺少用户ID!");window.history.back();</script>';
            exit;
        }
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $type = $this->input->post('root');
            if($type == 4){
                $this->form_validation->set_rules('spot_id', '所属景区', 'trim|required');
            }
            $this->form_validation->set_rules('password', '密码', 'trim|required|matches[passconf]');
            $this->form_validation->set_rules('passconf', '确认密码', 'trim|required');
            $this->form_validation->set_rules('realname', '姓名', 'max_length[30]');
            $this->form_validation->set_message('required', '%s不能为空');
            $this->form_validation->set_message('matches', '两次输入的密码不一致');
            $this->form_validation->set_message('max_length', '%s超过最大长度');
            if ($this->form_validation->run() == FALSE){
                $data['msg_type'] = 'error';
                $data['msg'] = validation_errors();
            }
            else{
                $res = $this->admin_model->edit_admin($user_id);
                if($res == 'success'){
                    $this->session->set_flashdata('msg_type', 'success');
                    $this->session->set_flashdata('msg', '更新成功！');
                    redirect('admin/show');
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
        $row = $this->db->get_where('admins', array('id'=>$user_id))->row_array();
        $data['username'] = $row['username'];
        $data['realname'] = $row['realname'];
        $data['type'] = $row['type'];
        $data['spots_list'] = $this->db->get('spots')->result_array();
        $this->load->view('edit_admin', $data);
        $this->load->view('footer');
    }

}



?>