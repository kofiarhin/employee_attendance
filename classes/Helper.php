<?php 

	Use Carbon\Carbon;

	class Helper	{


		public static function date_stuff($date) {

				echo $date;
		}

		public static function total_hours($time_in, $time_out) {


				$time_in = new DateTime($time_in);
				$time_out= new DateTime($time_out);


				$difference = $time_in->diff($time_out);

				$hours = $difference->h;

				return $hours;

		}


	}

