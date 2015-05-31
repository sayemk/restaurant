<h2>Create A New User</h2>
		  		
				<?php 
					  	if(validation_errors()) echo custom_message('info',validation_errors());
						echo form_open('admin/restaurant/save', array('class'=>'form-horizontal'));  
					?>
	<div class="row">
	  	<div class="col-md-6">
			<fieldset>
			  <legend>Basic info</legend>
			  <div class="form-group">
			    <div class="col-xs-4"><label for="name">Name</label></div>
			    
			      <div class="col-xs-8"><input name="name" value="<?php echo set_value('name'); ?>" type="text" class="form-control" id="name" placeholder="Full Name"></div>
			   
			  </div>
			  <div class="form-group">
			    <div class="col-xs-4"><label for="description">Description</label></div>
			    
			      <div class="col-xs-8"><textarea name="description" id="description" class="form-control" rows="4"><?php echo set_value('description') ?></textarea></div>
			  </div>

			  <div class="form-group">
			    <div class="col-xs-4"><label for="phone">Phone Number</label></div>
			    
			      <div class="col-xs-8"><input value="<?php echo set_value('phone'); ?>" name="phone" type="text" class="form-control" id="phone" placeholder="Phone number"></div>
			    
			  </div>
			  <div class="form-group">
			    <div class="col-xs-4"><label for="email">Email</label></div>
			    
			      <div class="col-xs-8"><input name="email" value="<?php echo set_value('email'); ?>" type="email" class="form-control" id="email" placeholder="Email address"></div>
			    
			  </div>
			  <div class="form-group">
			    <div class="col-xs-4"><label for="website">website</label></div>
			    
			      <div class="col-xs-8"><input value="<?php echo set_value('website'); ?>" name="website" type="text" class="form-control" id="website" placeholder="Website"></div>
			    
			  </div>
			 </fieldset>
			  <fieldset>
			  <legend>Service Hour</legend>
				  <div class="form-group">
				    <div class="col-xs-4"><label for="start">Start Hour</label></div>
				        <div class="col-xs-8"><input value="<?php echo set_value('start'); ?>" name="start" type="text" class="form-control" id="start" placeholder="Start time 12:30"></div>
				   </div>

				  <div class="form-group">
				    <div class="col-xs-4"><label for="close">Closing Hour</label></div>
				    	
				       <div class="col-xs-8"><input value="<?php echo set_value('close'); ?>" name="close" type="text" class="form-control" id="close" placeholder="Close Time 22:30">    </div>
				  </div>
			  </fieldset>
		</div>
		<div class="col-md-6">
			  <fieldset>
			  <legend>Map Features</legend>
				  <div class="form-group">
				    <div class="col-xs-4"><label for="latitude">Latitude</label></div>
				        <div class="col-xs-8"><input value="<?php echo set_value('latitude'); ?>" name="latitude" type="text" class="form-control" id="latitude" placeholder="Latitude like 12025445"></div>
				   
				  </div>

				  <div class="form-group">
				    <div class="col-xs-4"><label for="longitude">Longitude</label></div>
				    	
				       <div class="col-xs-8"><input value="<?php echo set_value('longitude'); ?>" name="longitude" type="text" class="form-control" id="longitude" placeholder="Longitude like 12256155">    </div>
				  </div>
			  </fieldset>
			  <fieldset>
			  <legend>Address</legend>
				  <div class="form-group">
				    <div class="col-xs-4"><label for="address_line">Address Line</label></div>
				        <div class="col-xs-8"><input value="<?php echo set_value('address_line'); ?>" name="address_line" type="text" class="form-control" id="address_line" placeholder="Address line"></div>
				   
				  </div>

				  <div class="form-group">
				    <div class="col-xs-4"><label for="city">City</label></div>
				    	
				       <div class="col-xs-8"><input value="<?php echo set_value('city'); ?>" name="city" type="text" class="form-control" id="city" placeholder="City">    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-xs-4"><label for="state">State</label></div>
				    	
				       <div class="col-xs-8"><input value="<?php echo set_value('state'); ?>" name="state" type="text" class="form-control" id="state" placeholder="State">    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-xs-4"><label for="zip">Zip Code</label></div>
				    	
				       <div class="col-xs-8"><input value="<?php echo set_value('zip'); ?>" name="zip" type="text" class="form-control" id="zip" placeholder="Zip Code">    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-xs-4"><label for="country">Country</label></div>
				    	<div class="col-xs-8">
				    	<select id="country" name="country" class="form-control">
				    		<option>&nbsp;</option>
				    		<?php 
				    			foreach ($countries as $country) {
				    				?>
				    					<option <?php if(set_value('country')==$country->name) echo 'selected' ?> value="<?php echo $country->name?>"><?php echo $country->name ?></option>
				    				<?php
				    			}
				    		 ?>
				    	</select>
				    	</div>	
				      
				  </div>
			  </fieldset>
		</div>
		<div class="clearfix"></div>
		<div class="col-xs-12">
			<div class="form-group">
				<div class="col-sm-10">
					<br>
				  <button type="submit" class="btn btn-primary">Create</button>
				</div>
			</div>
		</div>
  </div>
	  <?php echo form_close(); ?>
 
</div> <!-- End of row -->
</div>
<script type="text/javascript">
    $(function () {
        $('#start, #close').datetimepicker({
            format: 'hh:mm:ss'
        });
    });
</script>
</body>
</html>