<?php $uneditable_arry = array(1,2,3);?>

<div class='group-wrapper<?php echo (in_array($group['id'],$uneditable_arry) ? ' uneditable':'');?>' data-id="<?php echo $group['id'];?>" data-name="<?php echo $group['name'];?>">
	<div class='group-name'><span class='icon'><i class="icon-group"></i></span><?php echo $group['name'];?></div><div class='update-group'><i class='icon-pencil'></i></div><div class='remove-group'><i class='icon-minus'></i></div>
</div>