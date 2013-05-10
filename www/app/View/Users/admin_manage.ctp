<div class='panel'>
	<div class='acl-panel'>
		<div class='search-panel'>
			<form class="form-search">
				<input type="text" class="input-medium search-query">
			</form>
		</div>
		<div class='grouplist-wrapper pull-left'>
			<div href="#add-group-modal" role="button" data-toggle="modal" class='group-wrapper-add'>
				<div class='group-name'><span class='icon'><i class="icon-plus-sign"></i></span><span>Add a Group</span></div>
			</div>
	<?php
	foreach($groups as $group){
		echo $this->element('group',array('group'=>$group['Group']));
	}
	?>
		</div>
		<div class='userlist-wrapper pull-left'>

		</div>
	</div>
</div>

<div id='add-group-modal' class="modal hide fade">
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
					
					for(var i=0; i<response.length; i++){
						var user = response[i].User;
						userHtml += '<div class="user-wrapper" data-id="'+user.id+'">'+
											'<img src="'+user.pictureurl+'" class="pull-left" alt="user"/>'+
											'<span class="user-details">'+
												'<h5 class="userfirstname">'+user.firstname+' '+user.lastname+'</h5>'+
												'<div class="username muted">'+user.username+'</div>'+
											'</span>'+
										'</div>';
					}
					$('.userlist-wrapper').html(userHtml);
				},
				error:function( req, status, err ) {
					console.log( 'Impossible to get users', status, err );
				}
			});
	});
	$('#add-group').click(function(){
		$('#add-group-modal .text-error').text('');
		var request = new Object();
		var groupname = $('#new-group-name').val();
		request.group_name = groupname;
		var jsonRequest = JSON.stringify(request);
		$.ajax({
				url: '<?php echo Router::url(array('admin'=>true,'controller'=>'groups','action'=>'add'),true);?>',
				type: 'post',
				dataType: 'json',
				data: {data: jsonRequest},
				success: function(response) {
					if(response!=false){
						var group_id = response.Group.id;
						var group_name = response.Group.name;
					
						var groupHtml = "<div class='group-wrapper' data-id='"+group_id+"'>"+
									"<div class='group-name'><span class='icon'><i class='icon-group'></i></span>"+group_name+'</div>'+
									"<div class='remove-group'><i class='icon-minus'></i></div>"+
									"</div>";
						$('.grouplist-wrapper').append(groupHtml);
						$('#add-group-modal').modal('hide');
					}else{
						$('#add-group-modal .text-error').text('<?php echo __('We were unable to add your group. Try with another name.')?>');
					}
				},
				error:function( req, status, err ) {
					console.log( 'Impossible to get users', status, err );
				}
			});
		
	});
});

$('.remove-group').on('click',function(){
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
						$('#error-panel .text-error').text('<?php echo __('We were unable to add your group. Try with another name.')?>');
					}
				},
				error:function( req, status, err ) {
					console.log( 'Impossible to get users', status, err );
				}
			});
		
	});

function hideUserlistWrapper(){
	
}
function showUserListWrapper(){

}
</script>
