<?php 


	class User {


		private $db = null,
				$emp_id,
				$session_name,
				$data = array(),
				$errors = array(),
				$logged_in = false, 
				$passed = false;

		public function __construct($user = false) {

			$this->db = db::get_instance();

			$this->session_name = config::get("session/session_name");


			if(!$user) {

				//check if session exist;

				if(session::exist($this->session_name)) {

					$user = session::get($this->session_name);

					if($this->find($user)) {

						$this->logged_in = true;
					}


				}
			} else {


				$this->find($user);
			}


		}


		public function exist() {

			return (!empty($this->data)) ? true : false;
		}


		public function logged_in() {

			return $this->logged_in;
		}

		public function create($fields) {


				$account = $this->db->insert('users',  $fields);

				if($account) {

					$id = $this->db->last_insert();

					$general_num = 101860;


					$staff_id = $general_num.$id;

					session::flash("success", "Your account with staff_id: ".$staff_id." was successfully created");
					return true;
				}

				session::flash("error",  "There was a problem creating account. Try Again!");
				return false;

		}


		function get_staff_id() {



		}


		public function check_id($id) {

			//echo $id, '<br>';
			$emp_id = substr($id, 6);

			//echo $emp_id."<br>";

			$first_six = substr($id, 0, 6);

			//echo $first_six, "<br>";

			$prefix = array(101860, 101823);

			if(!in_array($first_six, $prefix)) {

				$this->add_error("Invalid ID please check with HR");

			}


			if(empty($this->errors)) {

				$this->passed = true;

				//$this->emp_id = $emp_id;
			}


			return $this; 


		}


		public function get_all_users() {


				$users = $this->db->get("users");

				if($users->count()) {

					return $users->result();
				}

				return false;
		}

		public function get_positions() {

			$positions = $this->db->get("positions");

			if($positions->count()) {

				return $positions->result();
			}
		}


		public function login($id, $password) {

				$emp_id  = substr($id, 6);

				$user = $this->find($emp_id);


				if($user) {

						if($this->data()->password == hash::make($password, $this->data()->salt)) {

							session::put($this->session_name, $this->data()->id);

							return true;
						}
				}

				return false;
		}


		public function data() {

			return  $this->data;
		}


		public function find($user) {

			$field =  is_numeric($user)  ? 'id' : "email";

			$user = $this->db->get("users", array($field, '=', $user));

			if($user->count()) {

				$this->data = $user->first();

				return true;
			}

			return false;
		}


		public function add_error($error) {

			$this->errors[] = $error;
		}


		public function passed() {


			return  $this->passed;
		}


		public function errors() {

				return $this->errors;
		}
	}