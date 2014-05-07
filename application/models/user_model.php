<?php

class User_model extends CI_Model {

    /**
    * Store the new user's data into the database
    * @return boolean - check the insert
    */
	function add_user()
	{

		$this->db->where('user_name', $this->input->post('username'));
		$query = $this->db->get('users');

        if($query->num_rows > 0){
        	echo '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>';
			  echo "Username already taken";
			echo '</strong></div>';
		} else {

			$new_member_insert_data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'email' => $this->input->post('email_address'),
				'username' => $this->input->post('username'),
				'password' => User::__encrip_password($this->input->post('password'))
			);
			$insert = $this->db->insert('users', $new_member_insert_data);
		    return $insert;
		}

	}//create_member

	/**
	 * Get user by his is
	 * @param string $fieldname
	 * @param int $field_value
	 * @return array
	 */
	public function get_user_by_id($id)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('id', $id);
		$query = $this->db->get();

		return $query->result_array();
	}

	/**
	 * Update product
	 * @param array $data - associative array with data to store
	 * @return boolean
	 */
	function update_user($field_name, $field_value, $data)
	{
		$this->db->where($field_name, $field_value);
		$this->db->update('users', $data);
		$report = array();
		$report['error'] = $this->db->_error_number();
		$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	/**
	 * Fetch products data from the database
	 * possibility to mix search, filter and order
	 * @param string $search_string
	 * @param strong $order
	 * @param string $order_type
	 * @param int $limit_start
	 * @param int $limit_end
	 * @return array
	 */
	public function get_users($search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end)
	{

		$this->db->select('user.id');
		$this->db->select('user.full_name');
		$this->db->select('user.first_name');
		$this->db->select('user.last_name');
		$this->db->select('user.email');
		$this->db->select('user.location');
		$this->db->select('user.status');
		$this->db->from('user');

		if ($search_string){
			$this->db->like('first_name', $search_string);
		}

		if ($order) {
			$this->db->order_by($order, $order_type);
		} else {
			$this->db->order_by('id', $order_type);
		}

		$this->db->limit($limit_start, $limit_end);

		$query = $this->db->get();

		return $query->result_array();
	}

	/**
	 * Count the number of rows
	 * @param int $search_string
	 * @param int $order
	 * @return int
	 */
	function count_users($search_string=null, $order=null)
	{
		$this->db->select('*');
		$this->db->from('user');
		if($search_string){
			$this->db->like('first_name', $search_string);
		}
		if($order){
			$this->db->order_by($order, 'Asc');
		}else{
			$this->db->order_by('id', 'Asc');
		}
		$query = $this->db->get();
		return $query->num_rows();
	}
}

