<?php

class Admin_model extends CI_Model {

    /**
    * Validate the login's data with the database
    * @param string $email
    * @param string $password
    * @return void
    */
	function validate($email, $password)
	{
		$this->db->where('email', $email);
		$this->db->where('password', $password);
		$query = $this->db->get('admin');

		if($query->num_rows == 1)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}

    /**
    * Serialize the session data stored in the database,
    * store it in a new array and return it to the controller
    * @return array
    */
	function get_db_session_data()
	{
		$query = $this->db->select('user_data')->get('ci_sessions');
		$user = array(); /* array to store the user data we fetch */
		foreach ($query->result() as $row)
		{
		    $udata = unserialize($row->user_data);
		    /* put data in array using username as key */
		    $user['user_name'] = $udata['user_name'];
		    $user['is_logged_in'] = $udata['is_logged_in'];
		}
		return $user;
	}


	/**
	 * Get admin by his is
	 * @param string $fieldname
	 * @param int $field_value
	 * @return array
	 */
	public function get_admin_by_id($id)
	{
		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where('id', $id);
		$query = $this->db->get();

		return $query->result_array();
	}

	/**
	 * Update admin
	 * @param array $data - associative array with data to store
	 * @return boolean
	 */
	function update($field_name, $field_value, $data)
	{
		$this->db->where($field_name, $field_value);
		$this->db->update('admin', $data);
		$report = array();
		$report['error'] = $this->db->_error_number();
		$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}
}

