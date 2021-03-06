<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_model extends CI_Model {


	/**
	 * Get Flagged DateClips
	 * @param array $search
	 * @param int $limit
	 * @param int $offset
	 * @param string $return
	 * @return array
	 */
	public function get_dateclip_flag_report($search = array(), $limit = NULL, $offset = NULL, $return = 'row') {

		$where = "WHERE 1=1 AND dateclip.deleted is NULL ";

		if ($search['name'] <> "") {
			$where .= " AND owner.full_name like '%".$search['name']."%' ";
		}

		if ($search['reported'] <> "") {
			$where .= " AND reporter.full_name like '%".$search['reported']."%' ";
		}

		if ($search['date_from'] <> "") {
			$where .= " AND user_flag_dateclip.create_date >= '".$search['date_from']."' ";
		}

		if ($search['date_to'] <> "") {
			$where .= " AND user_flag_dateclip.create_date <= '".$search['date_to']."' ";
		}

		//print "<pre>"; print_r($search); print "</pre>";
		$sql = "SELECT
					user_flag_dateclip.id AS id,
					owner.id AS user_id,
					owner.full_name AS user_name,
					reporter.id AS reporter_id,
					reporter.full_name AS reporter_name,
					user_flag_dateclip.create_date,
					flag.flag,
					user_flag_dateclip.other,
					user_flag_dateclip.status,
					dateclip.dateclip,
					dateclip.id AS dateclip_id
				FROM user_flag_dateclip
				INNER JOIN flag
					ON user_flag_dateclip.flag_id = flag.id
				INNER JOIN user AS reporter
					ON user_flag_dateclip.user_id = reporter.id
				INNER JOIN dateclip
					ON user_flag_dateclip.dateclip_id = dateclip.id
				INNER JOIN user AS owner
					ON dateclip.user_id = owner.id
				".$where."";

		if ($limit) {
			$sql .= " LIMIT ".$limit;
			if ($offset) {
				$sql .= ", ".$offset;
			}
		}

		$query = $this->db->query($sql);

		if ($return == "row") {
			return $query->result();
		} else {
			return $query->num_rows();
		}
	}

	/**
	 * Get Flagged DateClips
	 * @param array $search
	 * @param int $limit
	 * @param int $offset
	 * @param string $return
	 * @return array
	 */
	public function get_message_flag_report($search = array(), $limit = NULL, $offset = NULL, $return = 'row') {

		$where = "WHERE 1=1 AND message.deleted is NULL ";

		if ($search['name'] <> "") {
			$where .= " AND owner.full_name like '%".$search['name']."%' ";
		}

		if ($search['reported'] <> "") {
			$where .= " AND reporter.full_name like '%".$search['reported']."%' ";
		}

		if ($search['date_from'] <> "") {
			$where .= " AND user_flag_message.create_date >= '".$search['date_from']."' ";
		}

		if ($search['date_to'] <> "") {
			$where .= " AND user_flag_message.create_date <= '".$search['date_to']."' ";
		}

		//print "<pre>"; print_r($search); print "</pre>";
		$sql = "SELECT
		user_flag_message.id AS id,
		owner.id AS user_id,
		owner.full_name AS user_name,
		reporter.id AS reporter_id,
		reporter.full_name AS reporter_name,
		user_flag_message.create_date,
		user_flag_message.status,
		message.message,
		message.id AS message_id
		FROM user_flag_message
		INNER JOIN user AS reporter
			ON user_flag_message.user_id = reporter.id
		INNER JOIN message
			ON user_flag_message.message_id = message.id
		INNER JOIN user AS owner
			ON message.owner = owner.id
		".$where."";

		if ($limit) {
			$sql .= " LIMIT ".$limit;
			if ($offset) {
				$sql .= ", ".$offset;
			}
		}

		$query = $this->db->query($sql);

		if ($return == "row") {
			return $query->result();
		} else {
			return $query->num_rows();
		}

	}
	

	/**
	 * Get Flagged DateClips
	 * @param array $search
	 * @param int $limit
	 * @param int $offset
	 * @param string $return
	 * @return array
	 */
	public function get_finance_report($search = array()) {

		$where = "WHERE 1=1 ";

		if (isset($search['user_id']) && $search['user_id'] <> "") {
			$where .= " AND user.id = '".$search['user_id']."' ";
		}

		if (isset($search['name']) && $search['name'] <> "") {
			$where .= " AND user.full_name like '%".$search['name']."%' ";
		}

		if (isset($search['transaction']) && $search['transaction'] <> "") {
			$where .= " AND user_package_log.transaction_id like '%".$search['transaction']."%' ";
		}

		if (isset($search['date_from']) && $search['date_from'] <> "") {
			$where .= " AND user_package_log.purchase_date >= '".$search['date_from']."' ";
		}

		if (isset($search['date_to']) && $search['date_to'] <> "") {
			$where .= " AND user_package_log.purchase_date <= '".$search['date_to']."' ";
		}

		if (isset($search['price_from']) && $search['price_from'] <> "") {
			$where .= " AND package.price >= '".$search['price_from']."' ";
		}

		if (isset($search['price_to']) && $search['price_to'] <> "") {
			$where .= " AND package.price <= '".$search['price_to']."' ";
		}

		//print "<pre>"; print_r($search); print "</pre>";
		$sql = "SELECT
					user.id AS user_id,
					user.full_name,
					user_package_log.transaction_id,
					user_package_log.purchase_date,
					user_package_log.status,
					package.name AS package_name,
					package.type AS package_type,
					package.price AS package_price,
					package.credit AS package_credit,
					package.id AS package_id
				FROM user_package_log
				INNER JOIN user
					ON user_package_log.user_id = user.id
				INNER JOIN package
					ON user_package_log.package_id = package.id
				".$where."";

		$query = $this->db->query($sql);
		return $query->result();
	}


	/**
	 * Get Flagged DateClips
	 * @param array $search
	 * @param int $limit
	 * @param int $offset
	 * @param string $return
	 * @return array
	 */
	public function get_credit_report($search = array()) {

		$where = "WHERE 1=1 ";

		if (isset($search['user_id']) && $search['user_id'] <> "") {
			$where .= " AND user.id = '".$search['user_id']."' ";
		}

		if (isset($search['name']) && $search['name'] <> "") {
			$where .= " AND user.full_name like '%".$search['name']."%' ";
		}

		if (isset($search['transaction']) && $search['transaction'] <> "") {
			$where .= " AND user_package_log.transaction_id like '%".$search['transaction']."%' ";
		}

		if (isset($search['date_from']) && $search['date_from'] <> "") {
			$where .= " AND user_package_log.purchase_date >= '".$search['date_from']."' ";
		}

		if (isset($search['date_to']) && $search['date_to'] <> "") {
			$where .= " AND user_package_log.purchase_date <= '".$search['date_to']."' ";
		}

		if (isset($search['credit_from']) && $search['credit_from'] <> "") {
			$where .= " AND user.credit >= '".$search['credit_from']."' ";
		}

		if (isset($search['credit_to']) && $search['credit_to'] <> "") {
			$where .= " AND user.credit <= '".$search['credit_to']."' ";
		}


		$sql = "SELECT
		user.id AS user_id,
		user.full_name,
		user.email,
		user.credit,
		user_package_log.transaction_id,
		user_package_log.purchase_date,
		user_package_log.status
		FROM user_package_log
		INNER JOIN user
		ON user_package_log.user_id = user.id
		".$where."
		GROUP BY user_id";

		$query = $this->db->query($sql);
		return $query->result();
	}
}

/* End of file report_model.php */
/* Location: ./application/models/report_model.php */