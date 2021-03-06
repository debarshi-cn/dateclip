<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Generic Database Table Model for CodeIgniter 2.x
 *
 * @author     Debarshi Das
 */
class my_model_v2 extends CI_Model {

	var $table_name = '';  //required
	var $field_prefix = '';
	var $primary_key = ''; //required
	var $select_fields = '*';
	var $num_rows = 0;
	var $insert_id = 0;
	var $affected_rows = 0;
	var $last_query = '';
	var $error_msg = array();

	public function initialize($params = array()) {

		if (count($params) > 0) {
			foreach ($params as $key => $val) {
				if (isset($this->$key)) {
					$this->$key = $val;
				}
			}
		}

		if ($this->table_name == '') {
			$this->_set_error('table_name_required');
		}

		if ($this->primary_key == '') {
			$this->_set_error('primary_key_required');
		}

		if (count($this->error_msg) > 0) {
			return FALSE;
		}
	}

	public function get($limit = NULL, $offset = NULL, $sort = NULL, $search = NULL) {

		if ($limit !== NULL) $limit = (int) $limit;
		if ($offset !== NULL) $offset = (int) $offset;

		if (is_array($sort)) {
			foreach ($sort as $field => $order) {
				$this->db->order_by($this->field_prefix . $field, $order);
			}
		}

		if (is_array($search)) {
			foreach ($search as $field => $match) {
				$this->db->like($this->field_prefix . $field, $match);
			}
		}

		$this->db->select($this->select_fields);
		$query = $this->db->get($this->table_name, $limit, $offset);
		$this->last_query = $this->db->last_query();
		$this->num_rows = $this->_num_rows($search);
		return ($limit == 1) ? $query->row() : $query->result();
	}

	public function insert($data = array()) {


		if (is_array($data)) {
			$this->db->insert($this->table_name, $data);
			$this->insert_id = $this->db->insert_id();
			//echo $this->db->last_query();exit();
			$this->_optimize();

			$report = array();
			$report['error'] = $this->db->_error_number();
			$report['message'] = $this->db->_error_message();

			if ($report !== 0) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function update($id = 0, $data = array()) {

		$id = (int) $id;

		if ($id && is_array($data)) {
			$this->db->where($this->primary_key, $id);
			$this->db->update($this->table_name, $data);
			$this->_optimize();

			$report = array();
			$report['error'] = $this->db->_error_number();
			$report['message'] = $this->db->_error_message();

			if ($report !== 0) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function update_by_field($field = NULL, $field_value = NULL, $data = array()) {

		if ($field && $field_value && is_array($data)) {
			$this->db->where($field, $field_value);
			$this->db->update($this->table_name, $data);
			$this->_optimize();

			$report = array();
			$report['error'] = $this->db->_error_number();
			$report['message'] = $this->db->_error_message();

			if ($report !== 0) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function delete($id = 0) {

		$id = (int) $id;

		if ($id) {
			$this->db->where($this->primary_key, $id);
			$this->db->delete($this->table_name);
			$this->_optimize();

			$report = array();
			$report['error'] = $this->db->_error_number();
			$report['message'] = $this->db->_error_message();

			if ($report !== 0) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	private function _num_rows($search = NULL) {

		if ($search !== NULL) {
			foreach ($search as $field => $match) {
				$this->db->like($this->field_prefix . $field, $match);
			}
			return $this->db->count_all_results($this->table_name);
		}
		return $this->db->count_all($this->table_name);
	}

	public function is_valid_data($table_name, $search = NULL) {

		if ($search !== NULL) {
			foreach ($search as $field => $match) {
				$this->db->like($this->field_prefix . $field, $match);
			}
		}
		$this->num_rows = $this->db->count_all_results($table_name);

		if ($this->num_rows > 0)
			return true;
		else
			return false;
	}

	public function query($where = "") {

		$sql = "SELECT * FROM ".$this->table_name." ".$where;
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0) {
			return $query->result();
		}

		return false;
	}

	private function _optimize() {

		$this->last_query = $this->db->last_query();
		$this->affected_rows = $this->db->affected_rows();
		$this->load->dbutil();
		$this->dbutil->optimize_table($this->table_name);
	}

	private function _set_error($msg) {

		if (is_array($msg)) {
			foreach ($msg as $val) {
				$this->error_msg[] = $val;
				log_message('error', $val);
			}
		} else {
			$this->error_msg[] = $msg;
			log_message('error', $msg);
		}
	}

	public function display_errors($open = '<p>', $close = '</p>')    {

		$str = '';

		foreach ($this->error_msg as $val) {
			$str .= $open . $val . $close;
		}
		return $str;
	}
}


/* End of file my_model_v2.php */
/* Location: ./application/models/my_model_v2.php */