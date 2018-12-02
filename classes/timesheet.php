<?php 


	use Carbon\Carbon;

	class Timesheet extends User {


			private $db = null,
					$data = array(),
					$completed = false;


			public function __construct($user_id = false) {


				$this->db = Db::get_instance();

				if(!$user_id) {


						if(Session::exist("user")) {

							$date = date("Y-m-d");
							$user_id = session::get('user');


							$this->check_complete($user_id, $date);


							$this->data = $this->get_user_timesheet($user_id);

							//var_dump($this->data);


						}


					//if user has permission of administrator get all the users timesheet details;




				} else {


							$this->data = $this->get_user_timesheet($user_id);

				}


				


			}


			public function get_all_user_timesheet() {


					$sql = "select * from timesheet

					inner join users on

					timesheet.user_id = users.id


					order by users.first_name desc

					";

					$query = $this->db->query($sql);

					if($query->count()) {

						return($query->result());
					}


					return false;


			}


			public function delete($id) {


				$delete = $this->db->delete("timesheet", array("id", "=", $id));

				if($delete) {

					Session::flash("success", "Timecard Successfully Deleted");

					return true;

				}


				return false;

			}


			public function update_timecard($timesheet_id, $fields) {


					$update = $this->db->update("timesheet", $fields, array('id', '=', $timesheet_id));

					if($update) {

						Session::flash("success", "Timesheet successfully updated");

						return true;
					}

					return false;


			}


			//returns the timesheet;

			public function get_timesheet($id) {

			    
					$query = $this->db->get("timesheet", array('id',  '=', $id));

					if($query->count()) {

						return $query->first();
					}


					return false;
			}



			public function approve($timesheet_id) {


				$fields = array(

					"approved" => 1
				);

				$update = $this->db->update("timesheet", $fields, array("id",  "=", $timesheet_id) );

				if($update) {

					return true;
				}


				return false;


			}


			public function get_user_timesheet($user_id) {


					$query = $this->db->get('timesheet', array("user_id", '=',  $user_id));


					if($query->count()) {

						return  $this->data = $query->result();
					}


					return null;


			}


			public function data() {

				return $this->data;
			}



			public function exist() {

				return (!empty($this->data)) ? true : false;

			 }

			public function get_hours_worked($user_id, $date) {





				$sql = "select * from timesheet where user_id = ? and created_on = ?";

				$fields = array(

					'user_id' => $user_id,
					'created_on' => $date
				);

				$query = $this->db->query($sql, $fields);

				if($query->count()) {


					$time_in = new Carbon($query->first()->time_in);
					$time_out = new Carbon($query->first()->time_out);

					$unit = "";
					$count = "";


					$difference = $time_in->diff($time_out);

					switch (true) {

						case $difference->h > 0:
							
							$count = $difference->h;
							$unit = "hour";
							break;

						case $difference->h == 0:


						$count = $difference->i;

						$unit = "minute";

						break;

						default:

							$count = 0;
							$unit  = "minute";
							break;
					}


					if($count > 1) {

						$unit .="s";
					}

					return  $count." ".$unit;



					//var_dump($query->first());

					/*


					$time_in = new DateTime($query->first()->time_in);

					$time_out =  new DateTime($query->first()->time_out);

					$difference = $time_in->diff($time_out); 

					$hours_worked = $difference->h;

					return $hours_worked;
				*/
				}


				//return false;
			} 


			public function completed () {

				return $this->completed;
			}


			public function check_complete($user_id, $date) {

						

						
						$sql = "select * from timesheet where user_id = ? and created_on = ? and completed = ?";

						$fields = array(

							'user_id' => $user_id,
							'created_on' => $date,
							"completed" => 1

						);

						$query = $this->db->query($sql, $fields);


					

						if($query->count()) {

								$this->completed = true;
							
						}

			}



			public function stamp_in($fields) {


				$stamp = $this->db->insert("timesheet", $fields);

				if($stamp) {


					return true;
				}


				return false;



			}



			public function stamp_out($user_id, $time_out, $date) {



				$fields = array(

					'time_out' => $time_out,
					'completed' => 1,
					'user_id' => (int) $user_id,
					'created_on' => $date
				);


				var_dump($fields);

				$sql = "update timesheet set time_out = ?, completed = ? where user_id = ? and created_on = ?";


				$query = $this->db->query($sql, $fields);

				if($query->count()) {

					Session::flash("success", "You have successfully stamped out");

					return true;
				}



				return false;
			


			}

			public function check($user_id, $date) {

					$sql = "select id as timesheet_id from timesheet where user_id = ? and created_on = ?";

					$fields= array(

						"user_id" => $user_id,
						"created_on"  =>  $date

					);

					$query = $this->db->query($sql, $fields);

					if($query->count()) {

							
							return $query->first()->timesheet_id; 
					}


					return false;


			}


	}