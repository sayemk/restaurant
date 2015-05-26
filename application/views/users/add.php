
		<div class="col-md-1">&nbsp;</div>
	  	
	  	<div class="col-md-6">
	  	<h2>Create A New User</h2>
	  		
			<?php 
				if(validation_errors())
				{
					?>
					<div class="alert alert-warning alert-dismissible fade in" role="alert">
				      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				      <strong>Holy guacamole!</strong> <?php echo validation_errors(); ?>
				    </div>
			<?php
				}
				echo form_open('admin/users/create', array('class'=>'form-horizontal')); 
			?>
		  <div class="form-group">
		   <label for="group">Select User Group </label>
		    <select name="group" class="form-control">
			  <option value="Admin">Admin</option>
			  <option value="Customer">Customer</option>
			  
			</select>
		    
		  </div>
			
		  <div class="form-group">
		    <label for="name">Full Name</label>
		    
		      <input name="name" value="<?php echo set_value('name'); ?>" type="text" class="form-control" id="name" placeholder="Full Name">
		   
		  </div>

		  <div class="form-group">
		    <label for="phone">Phone Number</label>
		    
		      <input required value="<?php echo set_value('phone'); ?>" name="phone" type="text" class="form-control" id="phone" placeholder="Phone number">
		    
		  </div>
		  <div class="form-group">
		    <label for="email">Email</label>
		    
		      <input name="email" value="<?php echo set_value('email'); ?>"type="email" class="form-control" id="email" placeholder="Email address">
		    
		  </div>
		  <div class="form-group">
		    <label for="username">Username</label>
		    
		      <input required value="<?php echo set_value('username'); ?>" name="username" type="text" class="form-control" id="username" placeholder="Username">
		    
		  </div>

		  <div class="form-group">
		    <label for="password">Password</label>
		    
		      <input required value="<?php echo set_value('password'); ?>" name="password" type="password" class="form-control" id="password" placeholder="Password">
		    
		  </div>

		  <div class="form-group">
		    <label for="conf_password">Confirm Password</label>
		    
		      <input required value="<?php echo set_value('conf_password'); ?>" name="conf_password" type="password" class="form-control" id="conf_password" placeholder="Confirm Password">
		    
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

</body>
</html>