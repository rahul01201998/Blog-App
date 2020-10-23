<?php

class Site extends CI_Controller
{
  
  function __construct()
  {
      parent::__construct();
      error_reporting(1);
    ini_set('display_errors', 'On');
      $this->load->model('my_model','m');
      date_default_timezone_set('Asia/Kolkata');
  }
  public function index()
  {
      if($this->session->userdata('is_login') == 'yes'){       //check session
          $this->load->view('dashboard');
      }else{
        $this->load->view('index');
      }
  }
  public function dashboard()
  {
      if($this->session->userdata('is_login') == 'yes'){   //check session
           $this->load->view('dashboard');
      }else{
         $this->load->view('index');
      }
  }
  public function login_check()
  {
      $post_data = $this->input->post(NULL, TRUE); // received post data
      $username = isset($post_data['username']) ? $post_data['username'] : '';
      $password = isset($post_data['password']) ? $post_data['password'] : '';

      $result = $this->m->check_valid_user($username,$password); 
      if ($result){
            $this->session->set_userdata('is_login', 'yes');
            $this->session->set_userdata('username', $username);
            echo json_encode(array('status' => 'success'));
            exit;
      }else{
            echo json_encode(array('status' => 'error'));
            exit;
        }
  }
  public function logout()
  {
     $this->session->sess_destroy();
     redirect('Site');
  }
  public function createBlog()
  {
      $post_data = $this->input->post(NULL, TRUE); // received post data
      $author = isset($post_data['author']) ? $post_data['author'] : '';
      $description = isset($post_data['description']) ? $post_data['description'] : '';
      $categories = isset($post_data['categories']) ? $post_data['categories'] : '';
      $flag = true;
        // Server side validation
      if ($author == ''){
          $error['author'] = "Please Enter Author";
          $flag = false;
      }
      if ($description == ''){
          $error['description'] = "Please Enter Description";
          $flag = false;
      }
      if ($categories == ''){
          $error['categories'] = "Please Select Categories";
          $flag = false;
      }
      if ($flag == false){
          echo json_encode(array('status' => 'error', 'errors' => $error));
          exit;
      }
      $insert_array = array(
        "author" => $author,
        "description" => $description,
        "categories" => $categories,
        "created_at" => date("Y-m-d H:i:s"),
        "ip_address" => $_SERVER['REMOTE_ADDR']
      );
      $insert = $this->m->insertBlog($insert_array);    //insert blog
      if ($insert > 0 ) {
        echo json_encode(array('status' => 'success', 'type' => 'add'));
        exit;
      }else{
      }
  }
  public function index_ajax($offset=null)
  {
      $search = array(
        'keyword' => trim($this->input->post('search_key')),
      );
      
      $this->load->library('pagination');

      $limit = 2;
      $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
      
      $config['base_url'] = site_url('Site/index_ajax'); 
      $config['total_rows'] = $this->m->get_products($limit, $offset, $search, $count=true);
      $config['per_page'] = $limit;
      $config['uri_segment'] = 3;
      $config['num_links'] = 3;
      $config['num_tag_open'] = '<li>';
      $config['num_tag_close'] = '</li>';
      $config['cur_tag_open'] = '<li><a href="" class="current_page">';
      $config['cur_tag_close'] = '</a></li>';
      $config['next_link'] = 'Next';
      $config['next_tag_open'] = '<li>';
      $config['next_tag_close'] = '</li>';
      $config['prev_link'] = 'Previous';
      $config['prev_tag_open'] = '<li>';
      $config['prev_tag_close'] = '</li>';
      $config['first_link'] = 'First';
      $config['first_tag_open'] = '<li>';
      $config['first_tag_close'] = '</li>';
      $config['last_link'] = 'Last';
      $config['last_tag_open'] = '<li>';
      $config['last_tag_close'] = '</li>';
      
      $this->pagination->initialize($config);

      $data['products'] = $this->m->get_products($limit, $offset, $search, $count=false);

      $data['page'] = $this->pagination->create_links();
      // echo "<pre>";
      // print_r($data);
      // die;
      
      $this->load->view('index_ajax', $data);
  }
  public function editBlog(){
     $result = $this->m->editEmployee();
     echo json_encode($result);
  }
  public function updateBlog()
  {
      $result = $this->m->updateblog();
      if ($result ) {
        echo json_encode(array('status' => 'success', 'type' => 'update'));
        exit;
      }else{
      }
  }
  public function deleteBlog()
  {
      $result = $this->m->deleteEmployee();
      $msg['success'] = false;
      if($result){
        echo json_encode(array('status' => 'success'));
        exit;
      }else{
        echo json_encode(array('status' => 'error'));
        exit;
      }
  }

}
?>