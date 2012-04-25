<div class="row-fluid">
	<div class="span3">
		<!-- Sidebar -->
		<div class="well sidebar-nav">
			<?php echo CIWidget::navigator('admin'); ?>
		</div><!--/.well -->
	</div><!--/span-->
	<div class="span9">
		
		<div class="page-header clearfix">
			<h1 class="pull-left"><?php _e('Add a resource'); ?></h1>		
		</div>
		
		<?php if (isset($errors)) : ?>
		<div class="alert alert-error">
		    <a class="close" data-dismiss="alert">×</a>
		    <h4 class="alert-heading"><?php _e('Error!'); ?></h4>
		    <?php echo $errors; ?>
		</div>
		<?php endif; ?>
	
		<?php if (isset($success)) : ?>
		<div class="alert alert-success">
		    <a class="close" data-dismiss="alert">×</a>
		    <h4 class="alert-heading">Success</h4>
		    <?php echo $success; ?>
		</div>
		<?php endif; ?>
		
		<div id="resources_add" class="clearfix">
		
			<?php echo form_open('roles/admin/resources_add/'.$role['id'], 'class="form-horizontal"'); ?>
				<fieldset>
					<div class="control-group">
						<label class="control-label"><?php _e('Controller'); ?></label>
						<div class="controls">
							<?php echo form_input(array(
								'name'        => 'controller', 
								'class'       => 'input-xlarge', 
								'placeholder' => 'Folder:Class',
								'value'       => set_value('controller')
							)); ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label"><?php _e('Action'); ?></label>
						<div class="controls">
							<?php echo form_input(array(
								'name'        => 'action', 
								'class'       => 'input-xlarge', 
								'placeholder' => 'Class Method',
								'value'       => set_value('action')
							)); ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label"><?php _e('Group'); ?></label>
						<div class="controls">
							<?php echo form_input(array(
								'name'        => 'group', 
								'class'       => 'input-xlarge', 
								'value'       => set_value('group')
							)); ?>
						</div>
					</div>					
					<div class="control-group">
			            <label for="description" class="control-label"><?php _e('Description'); ?></label>
			            <div class="controls">
			            	<?php echo form_textarea(array(
			            		'name'  => 'description',
			            		'rows'  => 3,
			            		'id'    => 'description',
			            		'class' => 'input-xlarge',
			            		'value' => set_value('description')
			            	)); ?>
			            </div>
			        </div>
					<div class="control-group">
			            <label for="optionsCheckbox" class="control-label"><?php _e('Apply to Role'); ?></label>
			            <div class="controls">
							<label class="checkbox">
								<input type="checkbox" name="apply" value="1" <?php echo set_checkbox('apply', '1', true); ?> />
								Auto add this resource to the role name <strong><?php echo $role['id']; ?></strong>
							</label>
			            </div>
			        </div>
					<div class="form-actions">
			            <button class="btn btn-primary" type="submit"><?php _e('Save changes'); ?></button>
					</div>
				</fieldset>
			<?php echo form_close(); ?>	
				
    	</div> <!-- end #resources_add -->
   
	
	</div><!--/span-->
</div><!--/row-->