<?php 


class Reimbursement {


	private $db = null;



	public function __construct() {


		$this->db = Db::get_instance();

	}



	public function create($fields) {

		$create = $this->db->insert('Reimbursement', $fields);

		if($create) {

			Session::flash("success", "Request successfully sent!");

			return true;
		}

		return false;
	}



	public function get_all($id = false) {


		if(!$id) {

				//get all reimbursements

			$sql = "select * from reimbursement

			inner join users

			on reimbursement.user_id = users.id

			order by reimbursement.created_on

			";

			$query = $this->db->query($sql);

			if($query->count()) {


				return $query->result();
			}




		} else {

			

		}

	}


}