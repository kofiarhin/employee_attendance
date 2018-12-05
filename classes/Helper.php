<?php 

	Use Carbon\Carbon;

	class Helper	{


		public static function date_format($date) {

				$date = new DateTime($date);

				return $date->format("jS M Y");
		}

		public static function total_hours($time_in, $time_out) {


				$time_in = new DateTime($time_in);
				$time_out= new DateTime($time_out);


				$difference = $time_in->diff($time_out);

				$hours = $difference->h;

				return $hours;

		}

	

		public static function upload_file($file, $allowed, $d_folder) {





				$file_name = $file['name'];
				$file_tmp_name = $file['tmp_name'];
				$file_size = $file['size'];


				$extention = explode(".", $file_name);

				$extention = strtolower(end($extention));


				if(!in_array($extention, $allowed)) {


					return false;
				}


				$file_new_name = md5(microtime()).".".$extention;


				$file_destination = $d_folder."/".$file_new_name;


				if(move_uploaded_file($file_tmp_name, $file_destination)) {


					echo "file uploaded";


					return $file_new_name;
				}




				return false;

					



		}


	}

