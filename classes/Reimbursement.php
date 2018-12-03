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


	}