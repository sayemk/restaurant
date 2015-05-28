
		<div class="col-md-1">&nbsp;</div>
	  	
	  	<div class="col-md-6">
	  	<h2>Create A New User</h2>
	  		
			<?php 
				  	if(validation_errors()) echo custom_message('info',validation_errors());
					echo form_open('admin/restaurant/save', array('class'=>'form-horizontal'));  
				?>

		  <div class="form-group">
		    <label for="name">Name</label>
		    
		      <input name="name" value="<?php echo set_value('name'); ?>" type="text" class="form-control" id="name" placeholder="Full Name">
		   
		  </div>
		  <div class="form-group">
		    <label for="description">Description</label>
		    
		      <textarea name="description" id="description" class="form-control" rows="4"><?php echo set_value('description') ?></textarea>
		  </div>

		  <div class="form-group">
		    <label for="phone">Phone Number</label>
		    
		      <input value="<?php echo set_value('phone'); ?>" name="phone" type="text" class="form-control" id="phone" placeholder="Phone number">
		    
		  </div>
		  <div class="form-group">
		    <label for="email">Email</label>
		    
		      <input name="email" value="<?php echo set_value('email'); ?>"type="email" class="form-control" id="email" placeholder="Email address">
		    
		  </div>
		  <div class="form-group">
		    <label for="username">website</label>
		    
		      <input value="<?php echo set_value('website'); ?>" name="website" type="text" class="form-control" id="website" placeholder="Website">
		    
		  </div>
		  <fieldset>
		  <legend>Service Hour</legend>
			  <div class="form-group">
			    <label for="start">Start Hour</label>
			        <input value="<?php echo set_value('start'); ?>" name="start" type="text" class="form-control" id="start" placeholder="Start time 12:30">
			   </div>

			  <div class="form-group">
			    <label for="close">Closing Hour</label>
			    	
			       <input value="<?php echo set_value('close'); ?>" name="close" type="text" class="form-control" id="close" placeholder="Close Time 22:30">    
			  </div>
		  </fieldset>

		  <fieldset>
		  <legend>Map Features</legend>
			  <div class="form-group">
			    <label for="latitude">Latitude</label>
			        <input value="<?php echo set_value('latitude'); ?>" name="latitude" type="text" class="form-control" id="latitude" placeholder="Latitude like 12025445">
			   
			  </div>

			  <div class="form-group">
			    <label for="longitude">Longitude</label>
			    	
			       <input value="<?php echo set_value('longitude'); ?>" name="longitude" type="text" class="form-control" id="longitude" placeholder="Longitude like 12256155">    
			  </div>
		  </fieldset>
		  <fieldset>
		  <legend>Address</legend>
			  <div class="form-group">
			    <label for="adress_line">Address Line</label>
			        <input value="<?php echo set_value('address_line'); ?>" name="address_line" type="text" class="form-control" id="address_line" placeholder="Address line">
			   
			  </div>

			  <div class="form-group">
			    <label for="city">City</label>
			    	
			       <input value="<?php echo set_value('city'); ?>" name="city" type="text" class="form-control" id="city" placeholder="City">    
			  </div>
			  <div class="form-group">
			    <label for="state">State</label>
			    	
			       <input value="<?php echo set_value('state'); ?>" name="state" type="text" class="form-control" id="state" placeholder="State">    
			  </div>
			  <div class="form-group">
			    <label for="zip">Zip Code</label>
			    	
			       <input value="<?php echo set_value('zip'); ?>" name="zip" type="text" class="form-control" id="zip" placeholder="Zip Code">    
			  </div>
			  <div class="form-group">
			    <label for="country">Country</label>
			    	<select name="country" class="form-control">
			    		<option></option>
			    		<?php 
			    			foreach ($countries as $country) {
			    				?>
			    					<option <?php if(set_value('country')==$country->name) echo 'selected' ?> value="<?php echo $country->name?>"><?php echo $country->name ?></option>
			    				<?php
			    			}
			    		 ?>
			    	</select>	
			      
			  </div>
		  </fieldset>
			  
		  
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