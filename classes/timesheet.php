<?php 


	class Timesheet {


			private $db = null,
					$completed = false;


			public function __construct() {


				$this->db = db::get_instance();


				if(session::exist("user")) {

					$date = date("Y-m-d");
					$user_id = session::get('user');


					$this->check_complete($user_id, $date);



				}


			}


			public function get_hours_worked($user_id, $date) {

				$sql = "select * from timesheet where user_id = ? and created_on = ?";

				$fields = array(

					'user_id' => $user_id,
					'created_on' => $date
				);

				$query = $this->db->query($sql, $fields);

				if($query->count()) {


					//var_dump($query->first());


					$time_in = new DateTime($query->first()->time_in);
					$time_out =  new DateTime($query->first()->time_out);

					$difference = $time_in->diff($time_out); 

					$hours_worked = $difference->h;

					return $hours_worked;
				}

				return false;
			} 


			public function completed () {

				return $this->completed;
			}


			public function check_complete($user_id, $date) {


						$sql = "select * from timesheet where user_id = ? and created_on = ?";

						$fields = array(

							'user_id' => $user_id,
							'created_on' => $date


						);

						$query = $this->db->query($sql, $fields);

						if($query->count()) {

							$completed = $query->first()->completed;

							if($completed == 1) {

								$this->completed = true;
							}
						}

			}



			public function stamp_in($fields) {


				$stamp = $this->db->insert("timesheet", $fields);

				if($stamp) {

					return true;
				}


				return false;



			}



			public function stamp_out($id, $time) {

				$fields = array(

					'time_out' => $time,
					'completed' => 1

				);



				$stamp_out = $this->db->update("timesheet", $fields, array('id', '=', $id));

				if($stamp_out) {

					//echo "pass";

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