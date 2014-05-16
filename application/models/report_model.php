<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_model extends CI_Model {


	/**
	 * Get admin by his is
	 * @param array $search
	 * @return array
	 */
	public function get_dateclip_report($search = array(), $limit = NULL, $offset = NULL, $return = 'row') {

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


}

/* End of file report_model.php */
/* Location: ./application/models/report_model.php */