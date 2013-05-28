<div class='panel row-fluid'>
	<div class='categories-panel span6'>
		<div class='row-fluid'>
			<div class='search-panel span12'>
				<form class="form-search">
					<input type="text" class="input-medium search-query">
				</form>
			</div>
		</div>
		<div class='row-fluid'>
			<div class='categorielist-wrapper pull-left span4'>
				<div href="#add-category-modal" role="button" data-toggle="modal" class='category-wrapper-add list-topaction'>
					<div class='group-name'><span class='icon'><i class="icon-plus-sign"></i></span><span>Add a Book</span></div>
				</div>
				<div class="categorielist-scroll">
				<?php
					foreach($categories as $category){
						echo $this->element('category',array('category'=>$category['Category']));
					}
				?>
				</div>
			</div>
		
			<div class='categorielist-wrapper chapitres-wrapper pull-left span4'>
				<div href="#add-chapter-modal" role="button" data-toggle="modal" class='category-wrapper-add list-topaction'>
					<div class='group-name'><span class='icon'><i class="icon-plus-sign"></i></span><span>Add a Chapter</span></div>
				</div>
				<div class="categorielist-scroll">

				</div>
			</div>
			<div class='categorielist-wrapper pull-left span4'>
				
			</div>
		</div>
	</div>
	<div class='photo-panel span6'>
		<?php
		foreach($photos as $photo){
			$entityHtml = $this->element('photo',array('photo'=>$photo['Photo']));
			echo '<div class="entity-wrapper" data-id="'.$photo['Entity']['id'].'">'.$entityHtml.'</div>';
		}
		?>	
	</div>
	<div class='text-panel pull-right'>
		<?php
		foreach($texts as $text){
			$entityHtml = $this->element('text',array('text'=>$text['Text']));
			echo '<div class="entity-wrapper" data-id="'.$text['Entity']['id'].'">'.$entityHtml.'</div>';
		}
		?>	
	</div>
	<div class='video-panel pull-right'>
		<?php
		foreach($videos as $video){
			$entityHtml = $this->element('video',array('video'=>$video['Video']));
			echo '<div class="entity-wrapper" data-id="'.$video['Entity']['id'].'">'.$entityHtml.'</div>';
		}
		?>	
	</div>
</div>

<div id='add-category-modal' class="modal hide fade">
  <input type='hidden' id='new-category-id' value="">
  <input type='hidden' id='parent-id' value="">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Add a new category</h3>
  </div>
  <div class="modal-body">
		<div class='text-error'></div>
    	<label>Enter a name for your category</label>
		<input class="span2 input-medium" id='new-category-name' type="text">
	</div>
	<div class="modal-footer">
		<button class="btn btn-primary" id='add-category' type="button">Go!</button>
		 <button type="button" class="btn" data-dismiss="modal" aria-hidden="true">Cancel;</button>
  </div>
</div>

<script type='text/javascript'>
$(document).on('click','.category-wrapper',function(){
	var request = {};
	var category_id = $(this).data('id');
	
	request.category_id = category_id;
	var jsonRequest = JSON.stringify(request);
	$.ajax({
		url: '<?php echo Router::url(array('admin'=>true,'controller'=>'categories','action'=>'getchildren'),true);?>',
		type: 'post',
		dataType: 'json',
		data: {data: jsonRequest},
		success: function(response) {
			console.log(response);
			$('.chapitres-wrapper .categorielist-scroll').empty();
			var chapitre = "";
			if(response!=null){
				for(var i=0;i<response.length;i++){
					chapitre += "<div class='chapitre-wrapper' data-id="+response[i].Category.id+">"+
									"<div class='chapitre-name'>"+response[i].Category.name+"</div>"+
									"</div>";
					
				}
			}
			$('.chapitres-wrapper .categorielist-scroll').append(chapitre);
		},
		error:function( req, status, err ) {
			console.log( 'Impossible to get children', status, err );
			addError('<?php echo __('We have not been able to find the chapters for this book.')?>');
		}
	});
});

$(document).on('click','.category-wrapper-add',function(){
	var parent_id = $(this).parent('.categorielist-wrapper').data('parent');
	$('#parent-id').val(parent_id);
	$('#add-group-modal').modal('show');
});
</script>
