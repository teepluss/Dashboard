<div class="row-fluid">
	<div class="span3">
		<!-- Sidebar -->
		<div class="well sidebar-nav">
			<?php echo CIWidget::navigator('admin'); ?>
		</div><!--/.well -->
	</div><!--/span-->
	<div class="span9">
		
		<div class="page-header clearfix">
			<h1 class="pull-left"><?php _e('Manage Resource'); ?></h1>		
			<div class="pull-right">
		        <a class="btn btn-primary" href="<?php echo CIUri::base('roles/admin/resources_add/'.$role['id']); ?>">
		        	<i class="icon-plus icon-white"></i>
		        	<?php _e('Add new resource'); ?>
		        </a>
			</div>
		</div>
	
		<?php if (isset($success)) : ?>
		<div class="alert alert-success">
		    <a class="close" data-dismiss="alert">×</a>
		    <h4 class="alert-heading">Success</h4>
		    <?php echo $success; ?>
		</div>
		<?php endif; ?>
		
		<div id="resources_manage">
			<?php echo form_open('roles/admin/resources_manage/'.$role['id']); ?>
			<?php foreach ($groups as $group => $resources) : ?>
			<h3><?php echo $group; ?></h3>
			<table class="table table-bordered table-striped">
	   			<thead>
	   				<tr>
	   					<th><?php _e('Allow/Deny'); ?></th>
	   					<th><?php _e('Controller'); ?></th>
	   					<th><?php _e('Action'); ?></th>
	   					<th colspan="2"><?php _e('Description'); ?></th>
	      			</tr>
	   			</thead>
	   			<tbody>
	   				<?php foreach ($resources as $resource) : ?>
	   				<tr>
	   					<td width="80" class="perms">
	   						<?php $checked = is_allowed($resource['controller'], $resource['action'], $role['id']); ?>
	   						<?php echo form_checkbox('perms['.$resource['id'].'][allow]', 1, $checked); ?>
	   						<?php echo form_checkbox('perms['.$resource['id'].'][allow]', 0, !$checked); ?>
	   					</td>
	   					<td width="180"><?php echo $resource['controller']; ?></td>
	   					<td width="100"><?php echo $resource['action']; ?></td>
	   					<td><?php echo $resource['description']; ?></td>
	   					<td width="35" class="actions">
	   						<a class="icon-edit" href="<?php echo CIUri::base(''); ?>"></a>
	   						<a class="icon-remove alert-confirm-remove" href="<?php echo CIUri::base(''); ?>"></a>
	   					</td>
	   				</tr>
	   				<?php endforeach; ?>
	   			</tbody>
	    	</table>	
	    	<?php endforeach; ?>
	    	<div class="form-actions">
	            <button class="btn btn-primary" type="submit"><?php _e('Apply'); ?></button>
	          </div>
	    	<?php echo form_close(); ?>
    	</div> <!-- end #resources_manage -->
   
	
	</div><!--/span-->
</div><!--/row-->