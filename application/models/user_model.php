<?php

class User_model extends CI_Model {

    /**
    * Store the new user's data into the database
    * @return boolean - check the insert
    */
	function add($data)
	{
		$this->db->where('email', $data['email']);
		$query = $this->db->get('user');

        if($query->num_rows > 0){
        	return false;
		} else {
			return $this->db->insert('user', $data);
		}
	}//create_member

	/**
	 * Get user by his is
	 * @param numeric $id
	 * @return array
	 */
	public function get_user_by_id($id)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('id', $id);
		$query = $this->db->get();

		return $query->result_array();
	}

	/**
	 * Update product
	 * @param array $data - associative array with data to store
	 * @return boolean
	 */
	function update($field_name, $field_value, $data)
	{
		$this->db->where($field_name, $field_value);
		$this->db->update('user', $data);

		$report = array();
		$report['error'] = $this->db->_error_number();
		$report['message'] = $this->db->_error_message();

		if($report !== 0){
			return true;
		} else {
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
	public function get_users($search=array(), $limit_start, $limit_end)
	{
		$this->db->select('user.id');
		$this->db->select('user.full_name');
		$this->db->select('user.first_name');
		$this->db->select('user.last_name');
		$this->db->select('user.email');
		$this->db->select('user.location');
		$this->db->select('user.status');
		$this->db->from('user');

		if (isset($search['name_selected']) && $search['name_selected'] <> "") {
			$this->db->like('full_name', $search['name_selected']);
		}

		if (isset($search['email_selected']) && $search['email_selected'] <> "") {
			$this->db->like('email', $search['email_selected']);
		}

		if (isset($search['location_selected']) && $search['location_selected'] <> "") {
			$this->db->like('location', $search['location_selected']);
		}

		if (isset($search['status_selected']) && $search['status_selected'] <> "") {
			$this->db->like('status', $search['status_selected']);
		}

		$this->db->order_by($search['sort_selected'], $search['sort_dir_selected']);
		/*if ($order) {
			$this->db->order_by($order, $order_type);
		} else {
			$this->db->order_by('id', $order_type);
		}*/

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
	function count_users($search=array())
	{
		$this->db->select('*');
		$this->db->from('user');

		if (isset($search['name_selected']) && $search['name_selected'] <> "") {
			$this->db->like('full_name', $search['name_selected']);
		}

		if (isset($search['email_selected']) && $search['email_selected'] <> "") {
			$this->db->like('email', $search['email_selected']);
		}

		if (isset($search['location_selected']) && $search['location_selected'] <> "") {
			$this->db->like('location', $search['location_selected']);
		}

		if (isset($search['status_selected']) && $search['status_selected'] <> "") {
			$this->db->like('status', $search['status_selected']);
		}

		$query = $this->db->get();
		return $query->num_rows();
	}
}

