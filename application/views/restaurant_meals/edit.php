
		<div class="col-md-1">&nbsp;</div>
	  	
	  	<div class="col-md-6">
	  	<h2>Create A New User</h2>
	  		
			<?php 
				  	if(validation_errors()) echo custom_message('info',validation_errors());
				  	if(@$errors) echo $errors['error'];

				  	if($this->session->flashdata('userFlashData'))
				  		echo $this->session->flashdata('userFlashData');
					echo form_open_multipart('admin/restaurant_meal/update', array('class'=>'form-horizontal'));  
				?>

		    <div class="form-group">
			    <label for="restaurant">Restaurant</label>
			    	<select name="restaurant" class="form-control">
			    		<option></option>
			    		<?php 
			    			foreach ($restaurants as $restaurant) {
			    				?>
			    					<option <?php if($restaurant_meal[0]->restaurant_id==$restaurant->id) echo 'selected' ?> value="<?php echo $restaurant->id?>"><?php echo $restaurant->id.' &nbsp;&nbsp;'.$restaurant->name ?></option>
			    				<?php
			    			}
			    		 ?>
			    	</select>	
			      
			</div>
			<div class="form-group">
			    <label for="meal">Meals</label>
			    	<select name="meal" class="form-control">
			    		<option></option>
			    		<?php 
			    			foreach ($meals as $meal) {
			    				?>
			    					<option <?php if($restaurant_meal[0]->meal_id==$meal->id) echo 'selected' ?> value="<?php echo $meal->id?>"><?php echo $meal->id.' &nbsp;&nbsp;'.$meal->name ?></option>
			    				<?php
			    			}
			    		 ?>
			    	</select>	
			      
			</div>
			<div class="form-group">
			    <label for="price">Price</label>
			    <div class="input-group">
			      <span class="input-group-addon">$</span>
			      <input name="price" value="<?php echo $restaurant_meal[0]->price ?>" type="number" class="form-control" id="price" placeholder="price">
			    </div>
			</div>
			<div class="form-group">
			    <img class="form-iamge"src="<?php echo base_url().'/uploads/images/'.$restaurant_meal[0]->image_name ?>">
			 </div>

			 <div class="form-group">
			    <label for="userfile">Change Image</label>
			    <input type="file" name="userfile"id="userfile">
			    <p class="help-block">Select jpg,jpeg,png image file</p>
			  </div>
		   <div class="form-group">
		    <div class="col-sm-10">
		      <button type="submit" class="btn btn-primary">Create</button>
		    </div>
		  </div>
		  <?php echo form_close(); ?>
		</div>

  </div> <!--End of col-md-10-->
 
</div> <!-- End of row -->
</div>
<!--script type="text/javascript">
            $('#start').timepicker();
            $('#close').timepicker();
        </script-->
</body>
</html>