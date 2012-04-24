<?php if (isset($errors)) : ?>
<div class="alert alert-error">
    <a class="close" data-dismiss="alert">×</a>
    <h4 class="alert-heading">Error</h4>
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

<form method="post" action="<?php echo CIUri::base('users/register/merge/'.$service); ?>" class="well">
	<label>Existing email account</label>
	<input type="text" class="span3" readonly="readonly" name="email" value="<?php echo $email; ?>">
	<label>Current Password</label>
	<input type="password" class="span3" name="password">
	<div><button type="submit" class="btn">Submit</button></div>
</form>