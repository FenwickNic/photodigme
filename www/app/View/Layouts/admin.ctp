<!DOCTYPE html>

<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo "YGD in Asia" ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		//echo $this->Html->meta('icon');
		
		echo $this->Html->css('font-awesome');
		echo $this->Html->css('main');
		echo $this->Html->css('admin');
		echo $this->Html->css('bootstrap');
		echo $this->Html->css('bootstrap-responsive');

		echo $this->Html->script('jquery-1.7.1.min');
		echo $this->Html->script('jquery-ui-1.8.18.custom.min');
		echo $this->Html->script('jquery.validate.min');
		echo $this->Html->script('bootstrap');
		echo $this->Html->script('photodigme.core');
		

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id='header'>
    <nav class="navbar">
		<div class="navbar-inner">
		<a class="brand" href="#">Photodigme</a>
			
		<?php //echo $this->Menu->setup($menu_data,array('modelName' => 'Category','selectedClass'=>'active','menuClass'=>'nav','selected'=>($this->here))); ?>
		<div class='nav'>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo __("Manage");?><b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><?php echo $this->Html->link(__('Users'),array('admin'=>true,'controller'=>'users','action'=>'manage'));?></li>
					<li><?php echo $this->Html->link(__('Albums'),array('admin'=>true,'controller'=>'categories','action'=>'manage'));?></li>
					<li><?php echo $this->Html->link(__('Permissions'),array('admin'=>true,'controller'=>'groups','action'=>'access'));?></li>
				</ul>
			</li>
		</div>
		<div class='nav pull-right'>
			<?php echo $this->Auth->displayAuthWidget(); ?>
		</div>
		</div>
    </div>
	
	</div>
		<div id='error-panel' style='width:100%;height:40px;text-align:center;'>
		</div>
		<?php echo $this->Session->flash(); ?>
		<?php echo $this->fetch('content'); ?>

</body>
</html>
