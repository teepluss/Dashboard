<?php if (isset($errors)) : ?>
<div class="alert alert-error">
    <a class="close" data-dismiss="alert">×</a>
    <h4 class="alert-heading">Error!</h4>
    <?php echo $errors; ?>
</div>
<?php endif; ?>
<form class="well form-inline" method="post" action="<?php echo CIUri::top('users/auth/sign_in'); ?>">
	<input type="text" class="input-small" placeholder="Email" name="username">
    <input type="password" class="input-small" placeholder="Password" name="password">
    <label class="checkbox">
    	<input type="checkbox" name="remember"> Remember me
    </label>
    <button type="submit" class="btn">Sign in</button>
</form>