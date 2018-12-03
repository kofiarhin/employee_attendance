<?php 


	class Announcement {


		private $db = null,
				$data = array();




		public  function __construct($id = false) {


			$this->db = Db::get_instance();


			if($id) {


				$this->data = 	$this->get_announcement($id);

			}

		}


		public function data() {

			return $this->data;
		}


		public function get_announcement($id) {


				$data = $this->db->get("announcements", array("id", "=", $id));

				if($data->count()) {

					return($data->first());
				} 


				return false;


		}


		public function exist() {


			return (!empty($this->data)) ? true : false;

		}


		public function create($fields) {


				$create = $this->db->insert("announcements", $fields);


				if($create) {


					Session::flash("success", "Annocement successfully created");

					return true;
				}

				return false;

		}


		public function get_all() {


				$query = $this->db->get("announcements");

				if($query->count()) {

					return $query->result();
				}


				return false;



		}




	}