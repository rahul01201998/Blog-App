<?php
/**
 * 
 */
class My_model extends CI_Model
{
	public function check_valid_user($username,$password)
	{
		$this->db->where('username', $username);  
        $this->db->where('password', $password);  
        $query = $this->db->get('tbl_admin'); 
        if ($query->num_rows() == 1)  
        {
            return true;  
        } else {
            return false;  
        }
	}
	public function insertBlog($insert_array)
	{
         $this->db->insert('tbl_blog',$insert_array);
          return $this->db->insert_id();
	}
	public function get_products($limit, $offset, $search, $count)
	{
		$this->db->select('*');
		$this->db->from('tbl_blog');
		if($search){
			$keyword = $search['keyword'];
			if($keyword){
				$this->db->where("categories LIKE '%$keyword%'");
			}
		}
		if($count){
			return $this->db->count_all_results();
		}
		else {
			$this->db->limit($limit, $offset);
			$this->db->order_by("id", "desc");
			$query = $this->db->get();
			
			if($query->num_rows() > 0) {
				return $query->result();
			}
		}
		
		return array();
	}
	public function editEmployee(){
		$id = $this->input->get('id');
		$this->db->where('id', $id);
		$query = $this->db->get('tbl_blog');
		if($query->num_rows() > 0){
			return $query->row();
		}else{
			return false;
		}
	}
	public function deleteEmployee(){
		$id = $this->input->get('id');
		$this->db->where('id', $id);
		$this->db->delete('tbl_blog');
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	public function updateblog()
	{
		// echo "<pre>";
		// print_r($this->input->post());
		// die;
		$id = $this->input->post('txtId');
		$field = array(
		'author'=>$this->input->post('author'),
		'description'=>$this->input->post('description'),
		'categories'=>$this->input->post('categories'),
		'updated_at'=>date('Y-m-d H:i:s')
		);
		$this->db->where('id', $id);
		$this->db->update('tbl_blog', $field);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
























	public function insert_lead($insert_lead)
	{
		  $this->db->insert('tbl_webleads',$insert_lead);
          return $this->db->insert_id();
	}


	public function leadList() {
		if (!empty($this->session->userdata('start_date')) && !empty($this->session->userdata('end_date'))  ) {
			    $query =$this->db->select(['fullname', 'emailaddress', 'phone'])
                 ->from('tbl_webleads')
                 ->where('datedon >=',$this->session->userdata('start_date'))	
                 ->where('datedon <=',$this->session->userdata('end_date'))
                 ->where('isdeleted',0)
                 ->get();
		}else{
			$query =$this->db->select(['fullname', 'emailaddress', 'phone'])
                 ->from('tbl_webleads')
                 ->where('isdeleted',0)
                 ->get();
		}
        return $query->result();
    }

    public function get_country()
	{
		   $query = $this->db->query("SELECT COUNT(`region_name`) AS Scount, region_name FROM tbl_webleads WHERE api_respone = 1 GROUP By region_name");
			return $query->result();				
	}

	public function get_year()
	{
		   $query = $this->db->query("SELECT COUNT(`year`) AS ycount, year FROM tbl_webleads GROUP By year");
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}	
	}

	public function get_month_leads()
	{
		   $query = $this->db->query("SELECT COUNT(`month`) AS mcount, month FROM tbl_webleads WHERE year = YEAR(CURDATE()) GROUP By month Order By id DESC");
			return $query->result();
	}

	public function get_today_lead_count()
	{
		   $query = $this->db->query("SELECT id FROM tbl_webleads WHERE DATE(datedon) = CURDATE()");
			return $query->result();	
	}

	public function get_weekly_lead_count()
	{
		   $query = $this->db->query("SELECT COUNT(`week`) AS Wcount, week FROM tbl_webleads WHERE year = YEAR(CURDATE()) GROUP By week ORDER By week DESC LIMIT 4 ");
			return $query->result();
	}
	
	public function deletelead($id)
    {
    	$data = array(
    		'isdeleted' => 1
    	);
    	$this->db->where('id',$id);
        $run = $this->db->update('tbl_webleads', $data);
        return $run;
    }    
    
}
?>
