<div class="user-wrapper" data-id="<?php echo $user['id']?>">
	<img src="<?php echo $user['pictureurl']?>" class="pull-left" alt="user">
	<span class="user-details">
		<h5 class="userfirstname"><?php echo $user['firstname'].' '.$user['lastname'];?></h5>
		<div class="username muted"><?php echo $user['username']?></div>
	</span>
	<span class="pull-right unassign">&times;</span>
</div>