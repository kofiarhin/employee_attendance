<?php 


		require_once "header.php";

		if(!$user->logged_in()) {

			Redirect::to("login.php");
		}

 ?>


 <div class="container">
 	


			<div class="row justify-content-center">
				
					<div class="col-md-8">
						
					<table class="table">
						
							<thead>
								<tr>
									<td>Date</td>
									<td>Description</td>
									<td>Amount</td>
									<td>Status</td>
								</tr>
							</thead>

							<tbody>
								
								
							</tbody>

					</table>


					</div>

			</div>


 </div>