<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {

    /**
    * Validate the login's data with the database
    * @param string $email
    * @param string $password
    * @return void
    */
	function validate($email, $password) {

		$this->db->where('email', $email);
		$this->db->where('password', $password);
		$query = $this->db->get('admin');

		if ($query->num_rows == 1) {
			return $query->result_array();
		} else {
			return false;
		}
	}

    /**
    * Serialize the session data stored in the database,
    * store it in a new array and return it to the controller
    * @return array
    */
	function get_db_session_data() {

		$query = $this->db->select('user_data')->get('ci_sessions');
		$user = array(); /* array to store the user data we fetch */

		foreach ($query->result() as $row) {

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
	public function get_admin_by_id($id) {

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
	function update($field_name, $field_value, $data) {

		$this->db->where($field_name, $field_value);
		$this->db->update('admin', $data);

		$report = array();
		$report['error'] = $this->db->_error_number();
		$report['message'] = $this->db->_error_message();

		if ($report !== 0) {
			return true;
		} else {
			return false;
		}
	}

	function check_password($id, $old_password) {

		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where('id', $id);
		$this->db->where('password', $old_password);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return TRUE;
		} else {

			return FALSE;
		}
	}

	function get_dashboard_data() {

		$data = array();

		// Get the Total Profile
		$sql_result = "SELECT COUNT(id) AS total_profile FROM user";
		$query = $this->db->query($sql_result);
		$total_result = $query->row();

		$data['total_profile'] = $total_result->total_profile;


		// Get the Male Profile
		$sql_male = "SELECT COUNT(id) AS male_profile FROM user WHERE gender = 'M' ";
		$query = $this->db->query($sql_male);
		$total_male = $query->row();

		$data['male_profile'] = $total_male->male_profile;

		// Get the Female Profile
		$sql_female = "SELECT COUNT(id) AS female_profile FROM user WHERE gender = 'F' ";
		$query = $this->db->query($sql_female);
		$total_female = $query->row();

		$data['female_profile'] = $total_female->female_profile;

		// Get the User has dateclip
		$sql_has_dateclip = "SELECT COUNT(user.id) AS has_dateclip FROM user INNER JOIN dateclip ON user.id = dateclip.user_id AND dateclip.deleted IS NULL GROUP BY user.id ";
		$query = $this->db->query($sql_has_dateclip);
		$total_has_dateclip = $query->row();

		$data['has_dateclip'] = $total_has_dateclip->has_dateclip;

		return $data;
	}
}

/* End of file admin_model.php */
/* Location: ./application/models/admin_model.php */