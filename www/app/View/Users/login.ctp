<div class='row'>
	<div class='span6'></div>
	<div class='span6'>
		<?php echo $this->form->create(false, array(
			'url' => $this->here,
			'id'=>'loginForm',
			'class'=>'form-horizontal narrow',
			'inputDefaults' => array(
				'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
				'div' => array('class' => 'control-group'),
				'label' => array('class' => 'control-label'),
				'between' => '<div class=\'controls\'>',
				'after' => '</div>',
				'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
			)
		)			
	);?>
	<legend>Login</legend>
	<?php 
		echo $this->form->input('User.username', array('placeholder'=>'Email ou Utilisateur', 'label'=>array('text'=>'Utilisateur', 'class'=>'control-label'),'class'=>'input-large'));
		echo $this->form->input('User.password', array('placeholder'=>'Mot de passe', 'label'=>array('text'=>'Mot de passe', 'class'=>'control-label'),'class'=>'input-large'));?>
	<div class='control-group'>
		<?php echo $this->form->submit('Login', array('name'=>'login','class'=>'btn btn-primary btn-block'));?>
	</div>
	<?php
	echo '<hr>';
		echo $this->Html->link('Cr&eacute;ez votre profil.', array('controller'=>'Users','action'=>'register'), array('escape' => false));
		echo '<hr>';
		echo $this->html->link('Vous avez oubli&eacute; vos identifiants?', array('controller'=>'Users','action'=>'forgotten_credentials'),array('escape' => false));
		echo '<br>';
		echo $this->html->link('Vous avez oubli&eacute; votre mot de passe?', array('controller'=>'Users','action'=>'forgotten_password'), array('escape' => false));
		echo $this->form->end();
	?>
<script type="text/javascript">
$(document).ready(function()
{
// Validation
$("#loginForm").validate({
rules:{
"data[User][username]":"required",
"data[User][password]":"required"
},

messages:{
"data[User][username]":"Le nom d'utilisateur est obligatoire",
"data[User][password]":"Le mot de passe est obligatoire",
},

errorClass: "help-inline",
errorElement: "span",
highlight:function(element, errorClass, validClass)
{
$(element).parents('.control-group').addClass('error');
},
unhighlight: function(element, errorClass, validClass)
{
$(element).parents('.control-group').removeClass('error');
}
});
});
</script>
	</div>
</div>