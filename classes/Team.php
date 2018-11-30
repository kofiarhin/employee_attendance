<?php 

	

	Class Team  extends  User {


		private $db = null;


		public function __construct() {

			$this->db = Db::get_instance();
		}
		

		public  function get_supervisors() {


				$sql = "select  *, users.id as user_id from users
		
				inner join positions

				on users.position_id = positions.id

				";


				$query = $this->db->query($sql);

				if($query->count()) {


					$supervisos = array();



					foreach($query->result() as $user) {

						

						$permission = json_decode($user->permissions);



						if(isset($permission->supervisor)) {


							$supervisors[] = $user;
						}





					}


					if(!empty($supervisors)) {


						return $supervisors;
					}




				}


				return false;


		}
	}