
		<div class="col-md-1">&nbsp;</div>
	  	
	  	<div class="col-md-6">
	  	<h2>Create A New Meal</h2>
	  		
			<?php 
				  	if(validation_errors()) echo custom_message('info',validation_errors());
					echo form_open('admin/meal/save', array('class'=>'form-horizontal'));  
				?>

		  <div class="form-group">
		    <label for="name">Name</label>
		    
		      <input name="name" value="<?php echo set_value('name'); ?>" type="text" class="form-control" id="name" placeholder="Full Name">
		   
		  </div>
		   
		  <div class="form-group">
		    <label for="category">Category</label>
		    	<select name="category" class="form-control">
		    		<option></option>
		    		<?php 
		    			foreach ($categories as $category) {
		    				?>
		    					<option <?php if(set_value('category')==$category->id) echo 'selected' ?> value="<?php echo $category->id?>"><?php echo $category->name ?></option>
		    				<?php
		    			}
		    		 ?>
		    	</select>	
			      
		 </div>
		 <div class="form-group">
		    <label for="price">Price</label>
		    <div class="input-group">
		      <span class="input-group-addon">$</span>
		      <input name="price" value="<?php echo set_value('price'); ?>" type="number" class="form-control" id="price" placeholder="price">
		      <div class="input-group-addon">.00</div>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="description">Description</label>
		    
		      <textarea name="description" id="description" class="form-control" rows="4"><?php echo set_value('description') ?></textarea>
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