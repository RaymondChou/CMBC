<?php
/*
 * 刷卡记录查询
 */

Class Logs extends CI_Controller{
    function __construct(){
        parent::__construct();
    }

    function index(){
        redirect('logs/show');
    }

    function show(){
        $this->admin_model->render_header('logs');
        $this->load->library('pagination');//加载分页类
        $config['base_url'] = base_url().'logs/show';//设置基地址
        $config['uri_segment']=3;//设置url上第几段用于传递分页器的偏移量
        $config['num_links'] = 2;
        $config['total_rows'] = $this->db->count_all('logs');//自动从数据库中取得total_row信息
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
       // $this->db->select('spots.name, cards.realname, logs.card_id, logs.created');
        $this->db->join('spots', 'spots.id = logs.spot_id', 'left');
        $this->db->join('cards', 'cards.id = logs.card_id', 'left');
        $this->db->order_by("logs.created", "desc");
        $query=$this->db->get('logs',$config['per_page'],$offset * $config['per_page']);
        $data['query'] = $query->result_array();
        $data['pages'] = $this->pagination->create_links();//显示分页器
        $this->db->select('id as spot_id, name as spot_name');
        $data['spots_list'] = $this->db->get('spots')->result_array();
        $this->load->view('show_logs',$data);
        $this->load->view('footer');
    }

    //搜索刷卡记录
    function search(){
        $this->admin_model->render_header('logs');
        $no = $this->input->get('no');
        $spot_id = $this->input->get('spot_id');
        $realname = $this->input->get('realname');
        $this->db->from('logs');
        $this->db->join('cards', 'cards.id = logs.card_id', 'inner');
        $this->db->join('spots', 'spots.id = logs.spot_id', 'inner');
        if($no){
            $search['no'] = $no;
            $this->db->like('no', $no);
        }
        if($spot_id){
            $search['spot_id'] = $spot_id;
            $this->db->like('spots.id', $spot_id);
        }
        if($realname){
            $search['realname'] = $realname;
            $this->db->like('cards.realname', $realname);
        }
        if(!$search){
            redirect('logs/show');
        }
        $query_string = http_build_query($search);
        $this->load->library('pagination');//加载分页类
        $config['base_url'] = base_url().'logs/search?'.$query_string;//设置基地址
        $config['uri_segment']=3;//设置url上第几段用于传递分页器的偏移量
        $config['num_links'] = 2;
        $config['total_rows'] =  $this->db->get()->num_rows();
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
        $this->db->join('spots', 'spots.id = logs.spot_id', 'inner');
        $this->db->join('cards', 'cards.id = logs.card_id', 'inner');
        if($no){
            $this->db->like('no', $no);
        }
        if($spot_id){
            $this->db->like('spots.id', $spot_id);
        }
        if($realname){
            $this->db->like('cards.realname', $realname);
        }
        $this->db->order_by("logs.created", "desc");
        $query=$this->db->get('logs',$config['per_page'],$offset * $config['per_page']);
        $data['query'] = $query->result_array();
        $data['pages'] = $this->pagination->create_links();//显示分页器
        $data['msg_type'] = '';
        $data['msg'] = '';
        $this->db->select('id as spot_id, name as spot_name');
        $data['spots_list'] = $this->db->get('spots')->result_array();
        $this->load->view('show_logs',$data);
        $this->load->view('footer');
    }
}












?>