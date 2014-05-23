<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Front_model extends CI_Model {

	/**
	 *
	 * @param unknown_type $fb_user_id
	 * @param unknown_type $email
	 */
    public function check_fb_user($fb_user_id = NULL, $email = NULL) {

		$this->db->where('fb_user_id', $fb_user_id);
		$this->db->where('email', $email);
		$query = $this->db->get('user');

		if ($query->num_rows == 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}


	public function get_user($field, $id = NULL) {

		$this->db->where($field, $id);
		$query = $this->db->get('user');

		return $query->row_array();
	}

	public function get_dateclip() {

		$this->db->select('*');
		$this->db->where('user_id !=', $this->session->userdata('session_user_id'));
		$query = $this->db->get('dateclip');

		return $query->result();
	}


	public function get_site_config() {

		$query = $this->db->get('site_settings');
		$result = $query->result();

		$settings = array();
		foreach ($result AS $obj) {
			$settings[$obj->token] = $obj->value;
		}
		return $settings;
	}


	public function check_user($id = NULL){

		$this->db->where('user_id', $id);
		$query = $this->db->get('user_search_settings');

		if ($query->num_rows == 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}



	public function update_user_search_settings($id = 0, $data = array()) {

		$id = (int) $id;

		if ($id && is_array($data)) {

			$this->db->where('user_id', $id);
			$this->db->update('user_search_settings', $data);
			//echo $this->db->last_query();exit();

			return true;

		} else {
			return false;
		}
	}



	public function get_user_dateclip($user_id = NULL) {

		$this->db->select('*');
		$this->db->where('user_id', $user_id);
		$this->db->where('deleted', NULL);
		$query = $this->db->get('dateclip');

		if ($query->num_rows > 0) {
			return $query->row();
		}
	}

	public function update_dateclip($id = NULL, $data = array()) {

		$this->db->where('user_id', $id);
		$this->db->update('dateclip', $data);
		return TRUE;
	}

	public function insert_activity($activity, $associated_id, $user_id, $credit = 0) {

		if ($activity == 'dateclip_flagged') {

			// Activity for user ..
			$data_to_store_activity = array(
				'activity' => $activity,
				'associated_id' => $associated_id,
				'user_id' => $user_id,
				'credit' => $credit
			);

			$this->db->insert('user_activity_log', $data_to_store_activity);

			// Activity for owner ..
			$owner = $this->get_dateclip_owner($associated_id);

			if($owner) {
				$data_to_store_owner = array(
					'activity' => 'dateclip_flagged_by_user',
					'associated_id' => $associated_id,
					'user_id' => $owner,
					'credit' => $credit
				);
				$this->db->insert('user_activity_log', $data_to_store_owner);
			}

		} else if ($activity == 'dateclip_coached') {

			// Activity for user ..
			$data_to_store_activity = array(
				'activity' => $activity,
				'associated_id' => $associated_id,
				'user_id' => $user_id,
				'credit' => $credit
			);

			$this->db->insert('user_activity_log', $data_to_store_activity);

			// Activity for owner ..
			$owner = $this->get_dateclip_owner($associated_id);

			if($owner) {
				$data_to_store_owner = array(
					'activity' => 'dateclip_coached_by_user',
					'associated_id' => $associated_id,
					'user_id' => $owner,
					'credit' => $credit
				);
				$this->db->insert('user_activity_log', $data_to_store_owner);
			}

		} else if ($activity == 'dateclip_liked') {

			// Activity for user ..
			$data_to_store_activity = array(
				'activity' => $activity,
				'associated_id' => $associated_id,
				'user_id' => $user_id,
				'credit' => $credit
			);

			$this->db->insert('user_activity_log', $data_to_store_activity);

			// Activity for owner ..
			$owner = $this->get_dateclip_owner($associated_id);

			if($owner) {
				$data_to_store_owner = array(
					'activity' => 'dateclip_liked_by_user',
					'associated_id' => $associated_id,
					'user_id' => $owner,
					'credit' => $credit
				);
				$this->db->insert('user_activity_log', $data_to_store_owner);
			}

		} else if ($activity == 'dateclip_disliked') {

			// Activity for user ..
			$data_to_store_activity = array(
				'activity' => $activity,
				'associated_id' => $associated_id,
				'user_id' => $user_id,
				'credit' => $credit
			);

			$this->db->insert('user_activity_log', $data_to_store_activity);

			// Activity for owner ..
			$owner = $this->get_dateclip_owner($associated_id);

			if($owner) {
				$data_to_store_owner = array(
					'activity' => 'dateclip_disliked_by_user',
					'associated_id' => $associated_id,
					'user_id' => $owner,
					'credit' => $credit
				);
				$this->db->insert('user_activity_log', $data_to_store_owner);
			}
		}

	}

	public function get_dateclip_owner($dateclip_id = NULL) {

		$this->db->select("user_id");
		$this->db->where("id", $dateclip_id);
		$query = $this->db->get("dateclip");

		$row = $query->row();
		return $row->user_id;

	}

	/*public function get_dateclip_viewer() {

		$this->db->select("*");
		$this->db->where("user_id", $this->session->userdata('user_id'));
		$this->db->where("activity", 'dateclip_viewed_by_user');
		$query = $this->db->get("user_activity_log");

		//echo $this->db->last_query();exit();
		return $query->num_rows();
	}

	public function get_likes() {

		$session_user = 2;

		// $this->db->select("*");
		// $this->db->where("user_id", $session_user);
		// $this->db->where("activity", 'dateclip_viewed_by_user');
		// $query = $this->db->get("user_activity_log");

		// //echo $this->db->last_query();exit();
		// return $query->num_rows();



		// $sql = "SELECT
		// 			user_like_dateclip.id AS id,
		// 			user_like_dateclip.user_id AS user_id,
		// 			user_like_dateclip.dateclip_id AS dateclip_id
		// 		FROM user_like_dateclip
		// 		INNER JOIN dateclip
		// 			ON user_like_dateclip.dateclip_id = dateclip.id
		// 		WHERE user_like_dateclip.user_id = ".$session_user."";

		// if ($limit) {
		// 	$sql .= " LIMIT ".$limit;
		// 	if ($offset) {
		// 		$sql .= ", ".$offset;
		// 	}
		// }

		$sql = "SELECT id, user_id, dateclip_id FROM user_like_dateclip UNION SELECT id, user_id, dateclip FROM dateclip";

		$query = $this->db->query($sql);

		echo $this->db->last_query();exit();

		if ($return == "row") {
			return $query->result();
		} else {
			return $query->num_rows();
		}
	}*/


}

/* End of file admin_model.php */
/* Location: ./application/models/admin_model.php */