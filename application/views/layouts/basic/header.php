<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container-fluid">
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <a class="brand" href="<?php echo CIUri::base('#home'); ?>">Project name</a>
      <div class="nav-collapse">
        <ul class="nav">
          <li class="active"><a href="<?php echo CIUri::base('#home'); ?>">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#contact">Contact</a></li>
        </ul>
        <p class="navbar-text pull-right">
        	<?php if (CIUser::isLoggedIn()) : ?>
        	<span>Logged in as</span>
        	<a href="<?php echo CIUri::base('dashboard'); ?>"><?php echo CIUser::authInfo()->get('username'); ?></a>
        	<?php if (is_allowed('dashboard:admin', 'index')) : ?>
        	<a href="<?php echo CIUri::base('dashboard/admin'); ?>"><span class="label label-info">Admin</span></a>
        	<?php endif; ?>
        	<a class="btn btn-danger" href="<?php echo CIUri::base('users/auth/sign_out'); ?>">Sign Out</a>
        	<?php else : ?>
        	<a class="btn" href="<?php echo CIUri::base('users/auth/sign_in'); ?>">Sign In</a>
        	<?php endif; ?>
        </p>
      </div><!--/.nav-collapse -->
    </div>
  </div>
</div>