<div class='panel row'>
	<div class='subpanel acl-panel span'>
		<div class='search-panel'>
			<form class="form-search">
				<input type="text" class="input-medium search-query">
			</form>
		</div>
		<div class='grouplist-wrapper pull-left'>
			<div href="#add-group-modal" role="button" data-toggle="modal" class='group-wrapper-add'>
				<div class='group-name'><span class='icon'><i class="icon-plus-sign"></i></span><span>Add a Group</span></div>
			</div>
			<div class="grouplist-scroll">
	<?php
	foreach($groups as $group){
		echo $this->element('group',array('group'=>$group['Group']));
	}
	?>
			</div>
		</div>
		<div class='userlist-wrapper pull-left'>

		</div>
	</div>
	<div class='subpanel user-panel pull-right'>
		
		<?php
		foreach($users as $user){
			echo $this->element('user',array('user'=>$user['User']));
		}
		?>
	
	</div>
</div>




<div id='add-group-modal' class="modal hide fade">
  <input type='hidden' id='new-group-id' value="">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Add a new group</h3>
  </div>
  <div class="modal-body">
		<div class='text-error'></div>
    	<label>Enter a name for your group</label>
		<input class="span2 input-medium" id='new-group-name' type="text">
	</div>
	<div class="modal-footer">
		<button class="btn btn-primary" id='add-group' type="button">Go!</button>
		 <button type="button" class="btn" data-dismiss="modal" aria-hidden="true">Cancel;</button>
  </div>
</div>

</div>
</div>

<script type='text/javascript'>
$(document).ready(function(){
	$('.user-panel .user-wrapper').draggable({ opacity: 0.35 ,revert:true,scope:"user-assignment",helper: "clone"});
	$('.userlist-wrapper').droppable({
		scope:"user-assignment",
		snap:true,
		activeClass: "active",
		hoverClass: "hover",
		accept: ":not(.ui-sortable-helper)",
		drop: function( event, ui ) {
			var request = new Object();
			var user_id = $(ui.draggable[0]).data('id');
			var group_id = $('.group-wrapper.selected').data('id'); 
			
			request.user_id = user_id;
			request.group_id = group_id;
			var jsonRequest = JSON.stringify(request);
			$.ajax({
				url: '<?php echo Router::url(array('admin'=>true,'controller'=>'groups','action'=>'assignuser'),true);?>',
				type: 'post',
				dataType: 'json',
				data: {data: jsonRequest},
				success: function(response) {
					if(response == true){
						$user = $(ui.draggable[0]).clone();
						if(group_id == 1 || group_id == 2 || group_id == 3){
							$user.addClass('uneditable');
						}
						$user.appendTo('.userlist-wrapper');
					}else{
						addError('<?php echo __('This user is already in this group.')?>');
					}
				},
				error:function( req, status, err ) {
					console.log( 'Impossible to get users', status, err );
					addError('<?php echo __('Impossible to add this user to this group.')?>');
				}
			});
		}
	});
	
	$('.group-name').click(function(){
		var $groupwrapper = $(this).parent('.group-wrapper');
		var request = new Object();
		var group_id = $groupwrapper.data('id');
		
		request.group_id = group_id;
		var jsonRequest = JSON.stringify(request);
		$.ajax({
				url: '<?php echo Router::url(array('admin'=>true,'controller'=>'groups','action'=>'getusers'),true);?>',
				type: 'post',
				dataType: 'json',
				data: {data: jsonRequest},
				success: function(response) {
					$('.group-wrapper').removeClass('selected');
					
					$groupwrapper.addClass('selected');
					var userHtml = '';
					if(response == null){response = new Array(); userHtml = '<div class="muted">This group is empty</div>';}
					for(var i=0; i<response.length; i++){
						var user = response[i].User;
						userHtml += '<div class="user-wrapper'; 
						if(group_id ==1 || group_id == 2 || group_id == 3){
								userHtml += ' uneditable';
						}
						userHtml += '" data-id="'+user.id+'">'+
											'<img src="'+user.pictureurl+'" class="pull-left" alt="user"/>'+
											'<span class="user-details">'+
												'<h5 class="userfirstname">'+user.firstname+' '+user.lastname+'</h5>'+
												'<div class="username muted">'+user.username+'</div>'+
											'</span>'+
											'	<span class="pull-right unassign">&times;</span>'+
										'</div>';
					}
					$('.userlist-wrapper').html(userHtml);
				},
				error:function( req, status, err ) {
					console.log( 'Impossible to get users', status, err );
					addError('<?php echo __('We have not been able to find the users for this group.')?>');
				}
			});
	});
	$('#add-group').click(function(){
		$('#add-group-modal .text-error').text('');
		var request = new Object();
		var groupname = $('#new-group-name').val();
		var groupid = $('#new-group-id').val();
		request.group_name = groupname;
		request.group_id = groupid;
		var jsonRequest = JSON.stringify(request);
		$.ajax({
			url: '<?php echo Router::url(array('admin'=>true,'controller'=>'groups','action'=>'update'),true);?>',
			type: 'post',
			dataType: 'json',
			data: {data: jsonRequest},
			success: function(response) {
				if(response!=false){
					$('.group-wrapper:hidden').remove();
					var group_id = response.Group.id;
					var group_name = response.Group.name;
				
					var groupHtml = "<div class='group-wrapper' data-id='"+group_id+"' data-name='"+group_name+"'>"+
								"<div class='group-name'><span class='icon'><i class='icon-group'></i></span>"+group_name+'</div>'+
								"<div class='update-group'><i class='icon-pencil'></i></div>"+
								"<div class='remove-group'><i class='icon-minus'></i></div>"+
								"</div>";
					$('.grouplist-scroll').append(groupHtml);
					$('#add-group-modal').modal('hide');
				}else{
					addError('<?php echo __('We were unable to add your group. Try with another name.')?>');
				}
			},
			error:function( req, status, err ) {
				console.log( 'Impossible to get users', status, err );
				addError('<?php echo __('We were unable to add your group. Try with another name.')?>');
			}
		});
		
	});
	 $('#add-group-modal').on('hidden', function () {
		$('#new-group-id').val('');
		$('.group-wrapper:hidden').show();
	});
});


$(document).on('click', '.remove-group',function(){
	$groupwrapper = $(this).parents('.group-wrapper');
	var request = new Object();
	var groupid = $groupwrapper.data('id');
	request.group_id = groupid;
	var jsonRequest = JSON.stringify(request);
	$.ajax({
		url: '<?php echo Router::url(array('admin'=>true,'controller'=>'groups','action'=>'remove'),true);?>',
			type: 'post',
			dataType: 'json',
			data: {data: jsonRequest},
			success: function(response) {
				if(response!=false){
					$groupwrapper.remove();
				}else{
					addError('<?php echo __('We were unable to remove this group.')?>');
				}
			},
			error:function( req, status, err ) {
				console.log( 'Impossible to get users', status, err );
				addError('<?php echo __('We were unable to remove this group.')?>');
			}
		});
	
});
	
	
$(document).on('click', '.update-group',function(){
	$groupwrapper = $(this).parents('.group-wrapper');
	$groupwrapper.hide();
	var groupid = $groupwrapper.data('id');
	$('#new-group-name').val($groupwrapper.data('name'));
	$('#add-group-modal').modal('show');
	$('#new-group-id').val(groupid);

});

$(document).on('click', '.unassign',function(){
	$groupwrapper = $(this).parents('.user-wrapper');
	var request = new Object();
	
	var user_id = $groupwrapper.data('id');
	var group_id = $('.group-wrapper.selected').data('id'); 
			
	request.user_id = user_id;
	request.group_id = group_id;
	var jsonRequest = JSON.stringify(request);
	$.ajax({
		url: '<?php echo Router::url(array('admin'=>true,'controller'=>'groups','action'=>'unassignuser'),true);?>',
		type: 'post',
		dataType: 'json',
		data: {data: jsonRequest},
		success: function(response) {
			if(response!= false){
				$groupwrapper.remove();
			}else{
				addError('<?php echo __('Impossible to remove this user...')?>');
			}
			
		},
		error:function( req, status, err ) {
			console.log( 'Impossible to get users', status, err );
			addError('<?php echo __('Impossible to remove this user...')?>');
		}
	});
});


function addError(text){
	$('#error-panel').html(
		'<div class="alert alert-error">'+
			'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			'<h4>Error!</h4>'+text+
		 '</div>'
	);
}
</script>
