<?php 

		require_once "header.php";

 ?>


 <div class="container">
 	
			<h1 class="title text-center">Create Announcement!</h1>


 </div>

 <div class="container">
 	
		<div class="row justify-content-center" >
			

		<div class="col-md-6">
			
			<form action="" method="post">
				
			<div class="form-group">
				
				<label for="title">Title</label>

				<input type="text" name="title" class="form-control" placeholder="Enter Title">


			</div>

			<div class="form-group">
				
				<label for="description">Description</label>
				<textarea name="description" id="" cols="30" rows="10" class="form-control"></textarea>

			</div>


			<div class="form-group">
					
					<label for="cover_image">Cover Image</label>
					<input type="file" name="file" class="form-control">

			</div>


			<button class="btn btn-primary">Post Announcement</button>

			</form>


		</div>
				


		</div>


 </div>