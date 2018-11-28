<?php 


	class User Extends File {


		private $db = null,
				$emp_id,
				$session_name,
				$data = array(),
				$errors = array(),
				$logged_in = false, 
				$passed = false;

		public function __construct($user = false) {

			$this->db = Db::get_instance();

			$this->session_name = Config::get("session/session_name");


			if(!$user) {

				//check if session exist;

				if(Session::exist($this->session_name)) {

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


		public function update($user_id, $fields) {



			$update = $this->db->update('users', $fields, array('id', '=', $user_id));

			if($update) {

				return true;
			}


			return false;


		}


		public function upload_file($user_id,  $file) {

			$filename = $file['name'];
			$tmp_name = $file['tmp_name'];
			$error = $file['error'];
			$size = $file['size'];


			$allowed_files = array("jpg", "jpeg", "png");


			$file_extention = explode('.', $filename);

			$file_extention  = strtolower(end($file_extention));

			if(in_array($file_extention, $allowed_files)) {

				
				if($size < 1000000) {

					
						$file_new_name = md5(uniqid()).".".$file_extention;

						$file_destination = "img/".$file_new_name;



						if(move_uploaded_file($tmp_name, $file_destination)) {

							//update the user table

								$update_fields = array(

									'profile_pic' => $file_new_name

								);


								$update = $this->update($user_id, $update_fields);

								if($update) {

									session::flash("success", "Profile Picture Successfully Changed");

									return true;
								}

						} else {


							session::flash("error", "There was a problem uploading file try again");

							return false;
						}



						

				} else {


					Session::flash("error", "File Size Too Huge");

					return false;
				}



 
			} else {

				Session::flash("error", "File Type not allowed");

				return false;
			}


		

			

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


		public function login($user_input, $password ) {


				//if userput is a number generate the id from the employee id;

				//10186010  first six is the employee id and last is the user id from the database


				$user = $this->find($user_input);

				var_dump($user);

				if($user) {

						$db_password = $this->data()->password;
						$db_salt = $this->data()->salt;


						if($db_password == Hash::make($password, $db_salt)) {


							Session::put($this->session_name, $this->data()->id);

							echo "you are logged in";


							return true;

						}

				}



				return false;



		}


		public function data() {

			return  $this->data;
		}


		public function find($user) {

			$field = is_numeric($user) ? "id" : "email";

			$sql= "select * from users 
	
			

			inner join positions

			on users.position_id = positions.id


			where users.{$field} = ?";


			$query_field = array(

				"{$field}" => $user
			);


			//var_dump($query_field);

			$query = $this->db->query($sql, $query_field);

			if($query->count()) {

				$this->data = $query->first();

				return true;
			}

			

			

			return false;



			//return false;
 
			/*

			$field =  is_numeric($user)  ? 'id' : "email";

			$user = $this->db->get("users", array($field, '=', $user));

			if($user->count()) {

				$this->data = $user->first();

				return true;
			}

			return false;

			*/
		}



		public function has_permission($key) {

			if(!Session::exist($this->session_name)) {

				echo "error";
				return false;
			}

			if(!$this->exist()) {

				return false;
			}


				$position_id = $this->data()->position_id;


				$check = $this->db->get("positions", array('id', '=', $position_id));

				if($check->count()) {

					$permissions = json_decode($check->first()->permissions, true);

				if(isset($permissions[$key])) {

					return true;
				}




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