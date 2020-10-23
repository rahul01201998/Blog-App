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
    
}
?>
