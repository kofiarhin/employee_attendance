<?php 


class Leave {


	private $db = null,
	$eligible = false,
	$data = array(),
	$error,
	$created = false,
	$session_name;

	public function __construct($id = false) {

		$this->db  = Db::get_instance();

		$this->session_name = Config::get("session/session_name");

		if(!$id) {

			if(Session::exist($this->session_name)) {

				$user_id = Session::get($this->session_name);


				$this->check($user_id);


			}


		} else {


			$this->data = $this->find($id);
		}


	}


	public function update_request($id, $fields) {

		$update = $this->db->update("leave_requests", $fields, array('id', '=', $id));

		if($update) {


			Session::flash("success","Request successfully updated");

			return true;
		}

		return false;

	}



	public function find($id) {





		$sql = "select *,


				leave_requests.created_on as request_date,
				leave_requests.id as request_id,
				leave_status.name as request_status

				from leave_requests

				inner join leave_status

				on leave_requests.leave_status = leave_status.id

				inner join users

				on leave_requests.user_id = users.id

		";

		$fields = array(

			'id' => $id
		);

		$query = $this->db->query($sql, $fields);

		if($query->count()) {

			return ($query->first());

			
		}

		return false;
		/*

		$data = $this->db->get('leave_requests', array('id', '=', $id));


		if($data->count()) {

			return ($data->first());
		}


		return false;


	*/


	}


	public function decline($request_id)  {


			$fields = array(

				'leave_status' => 3
			);

			$update = $this->db->update('leave_requests', $fields, array('id', '=', $request_id));

			if($update) {

				Session::flash("success", "Request successfully declined");
			}

	}


	public function delete($request_id) {


		$delete = $this->db->delete("leave_requests", array('id', '=', $request_id));

		if($delete) {

			echo "deleted";

			Session::flash("success", "Request Successfully deleted");

			return true;
		}


		return false;


	}	

	public function exist() {


		return (!empty($this->data)) ?  true : false;

	}



	public function data() {

		return $this->data;

	}

	public function eligible() {

		return $this->eligible;
	}


	public function check($user_id) {


			//chekc if user has worked for more than 6 months;


		$user = new User($user_id);

		if($user->exist()) {

			$created_on = new Datetime($user->data()->created_on);

			$current_date = new Datetime();


			$diff = $current_date->diff($created_on);


			$months = $diff->m;


				// check if user is eligible
			if($months > 6) {

				$this->eligible = true; 
			} else {

				$this->error = "You need to work for more than 6 months";
			}

			
			if($this->eligible()) {


				//check leave balance;

				//var_dump($user->data());

				$leave_balance = $user->data()->leave_days;



				if($leave_balance == 0) {

					$this->eligible = false;

					$this->error = "you have exhausted all your leave days for the year";
				}




			}
		}





		return $this;

	}


	public function get_all_leave_request() {


			$sql = "select *,

					leave_requests.created_on as request_date,

					leave_status.name as leave_status_name,

					leave_requests.id as request_id

					from leave_requests

					inner join users
					on leave_requests.user_id = users.id

					inner join leave_status

					on leave_requests.leave_status = leave_status.id

					";


			$query = $this->db->query($sql);

			if($query->count()) {

				return ($query->result());
			}


			return false;


	}


	public function get_all_user_leave($user_id) {


		$sql = "select *,

		leave_status.name as leave_status_name,

		leave_requests.id as request_id

		from leave_requests 

		inner join leave_status

		on leave_requests.leave_status = leave_status.id

		where user_id = ?";

		$fields = array(

			'user_id' => $user_id
		);

		$query = $this->db->query($sql,  $fields);


		if($query->count()) {

			return ($query->result());
		}


		return false;


	}


	public function get_request($id) {

		$sql = "select *,
				leave_requests.id as request_id,
				leave_requests.created_on as request_date,


				users.id as user_id 


				from leave_requests
		
				inner join users
				on leave_requests.user_id = users.id 
				where leave_requests.id = ?

		";

		$fields = array(

			'id' => (int) $id
		);


		$query = $this->db->query($sql, $fields);

		if($query->count()) {

			return ($query->first());
		}

		return false;
	}



	public function approve($user_id, $request_id, $num_days) {


			//update request status to approve 
			//grab leave days balance
			//update leave balance

			$fields = array(

				'leave_status' => 2
			);

			$update = $this->db->update('leave_requests', $fields, array('id', '=', $request_id));
			if($update) {

				//grab leave balance

				$user = $this->db->get('users', array('id', '=', $user_id));

				if($user->count()) {


						$leave_balance = $user->first()->leave_days;

						$new_balance = $leave_balance - $num_days;


						if($new_balance < 0) {


							return false;
						}



						//update the users table

						$fields = array(

							'leave_days' => $new_balance
						);
						$update = $this->db->update('users', $fields, array('id', '=', $user_id));

						if($update) {

							Session::flash("success", "Request Successfully update");

							return true;

						}

				}
			}


			return false;


	}

	public function create($user_id, $fields) {

			//get leave balance

		$user = new User($user_id);

		$leave_balance = $user->data()->leave_days;

		$start_date = $fields['start_date'];
		$end_date = $fields['end_date'];

		$days_requested = Helper::date_diff($start_date, $end_date);

		$days_diff = $leave_balance - $days_requested;

		if($days_diff < 0) {



			$this->error = "Number of days requested is more than leave balance!";


		} else {


				//

			$create_fields = array(

				'user_id' => Session::get('user'),
				'start_date' => $fields['start_date'],
				'end_date' => $fields['end_date'],
				'leave_status' => 1,
				'created_on' => date("Y-m-d H:i:s")	
			);


			$create = $this->db->insert("leave_requests", $create_fields);


			if($create) {


					//insert data into database
				$this->created = true;
				Session::flash("success", "Request successfully submitted");

			} else {

				$this->error = "there was a problem creating request";
			}


		}




		return $this;

	}


	public function created() {

		return $this->created;
	}

	public function error() {

		return $this->error;
	}


	public function leave_create($fields) {


		$create = $this->db->insert("leave_requests", $fields );

		if($create) {

			Session::flash("success", "Request successfully made");

			return true; 
		}


		return false;
	}


}