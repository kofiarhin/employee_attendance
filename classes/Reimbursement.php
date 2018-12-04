<?php 


class Reimbursement {


	private $db = null,
	$data = array();



	public function __construct($id = false) {


		$this->db = Db::get_instance();


		if($id) {

			$this->data = $this->get_all($id);
		}

	}


	public function data() {

		return $this->data;
	}


	public function exist() {

		return (!empty($this->data)) ? true : false;
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

			$sql = "select *, reimbursement.id as rem_id from reimbursement

			inner join users

			on reimbursement.user_id = users.id

			order by reimbursement.created_on

			";

			$query = $this->db->query($sql);

			if($query->count()) {


				return $query->result();
			}




		} else {


			$fields = array(

				'id' => (int) $id

			);

			//var_dump($fields);

			$sql ="select *, reimbursement.id as rem_id, reimbursement.created_on as rem_created_on from reimbursement 

			inner join users

			on reimbursement.user_id = users.id
			where reimbursement.id = ?";

			$query = $this->db->query($sql, $fields);

			if($query->count()) {

				return($query->first());


			}


			

		}

		return  false;
	}


	public function approve($id) {

		$fields = array(

			'approved' => 1

		);

		$approve = $this->db->update("reimbursement", $fields, array('id', '=', $id));

		if($approve) {

			Session::flash("success", "Reimbursement approved");

			return true;
		}


		return false;
	}


}