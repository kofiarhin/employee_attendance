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


	public function get_user_reimbursement($user_id) {

		$sql = "select * from reimbursement 

		inner join rem_status

		on reimbursement.status_id = rem_status.id

		where reimbursement.user_id = ?";

		$fields = array(

			'user_id' => $user_id

		);

		$query = $this->db->query($sql,  $fields);


		if($query->count()) {

			return($query->result());
		}

		return false;
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

			$sql = "select *, reimbursement.id as rem_id,

			rem_status.id as status_id

			from reimbursement

			inner join users

			on reimbursement.user_id = users.id


			inner join rem_status

			on reimbursement.status_id = rem_status.id

			order by reimbursement.created_on

			";

			$query = $this->db->query($sql);

			if($query->count()) {


  				return ($query->result()) ;
			}




		} else {



			$fields = array(

				'id' => (int) $id

			);

			//var_dump($fields);

			//echo $id;

			$sql = "
			select 
			*, 
			rem_status.id as rem_status_id,
			reimbursement.created_on as rem_created_on

			from reimbursement 
			

			inner join users

			on reimbursement.user_id = users.id


			inner join rem_status

			on reimbursement.status_id = rem_status.id

			where reimbursement.id = ?";

			$fields = array(

				'id' => $id

			);

			$query = $this->db->query($sql, $fields);

			if($query->count()) {

				return ($query->first());


			}


			

		}

		return  false;
	}


	public function delete($id) {

		$delete = $this->db->delete("reimbursement", array('id', '=', $id));

		if($delete) {

			Session::flash("success", "Reimbursement Deleted");

			return true;
		}

		return false;
	}



	public function approve($id) {

		$fields = array(

			'status_id' => 2

		);

		$approve = $this->db->update("reimbursement", $fields, array('id', '=', $id));

		if($approve) {

			Session::flash("success", "Reimbursement approved");

			return true;
		}


		return false;
	}



	public function decline($id) {


			$fields = array(

				'status_id' => 3

			);


			$update = $this->db->update("reimbursement", $fields, array('id','=', $id));

			if($update) {

				Session::flash("success", "Request Declined");

				return true;
			}

			return false;
	}


}