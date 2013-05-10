<?php
echo $this->form->create('User', array(
		'action' => 'register',
		'class'=>'form narrow',
		'id'=>'registrationForm',
		'inputDefaults' => array(
			'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
			'div' => array('class' => 'control-group'),
			'label' => array('class' => 'control-label'),
			'between' => '<div class="controls">',
			'after' => '</div>',
			'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
		)
	)			
);?>
<div class='row'>
	<div class='span4'>
	<legend>Identifiants</legend>
	<?php
		echo $this->form->input('id', array('type'=>'hidden'));
		echo $this->form->input('username', array('placeholder'=>'Nom d\'utilisateur','required','label'=>array('text'=>'Utilisateur', 'class'=>'control-label')));
		echo $this->form->input('password', array('placeholder'=>'Mot de Passe','label'=>array('text'=>'Mot de passe', 'class'=>'control-label'), 'required'));
		echo $this->form->input('password_confirm', array('type' => 'password','placeholder'=>'Mot de passe','label'=>array('text'=>'Mot de passe', 'class'=>'control-label'), 'required'));
	?>
	</div>
	<div class='span4'>
	<?php
		echo $this->element('personaldetails');
	?>
	</div>
	<div class='span4'>
	<?php
	echo $this->element('address',array('addressType'=>'Address'));
	?>
	</div>
</div>
<div class='row text-center'>
	<div class='span12'>
<div class='control-group'>
	<div class="controls">
	<?php echo $this->form->submit(__('Enregistrez-vous'),array('class'=>'btn btn-primary btn-large btn-block'));?>
	</div>
</div>
<?php
echo '<hr>';
echo $this->Html->link('Vous poss&eacute;dez d&eacute;j&agrave; un compte?', array('action'=>'login'), array('escape' => false));
echo '<hr>';
echo $this->html->link('Vous avez oubli&eacute; vos identifiants?', array('action'=>'forgotten_credentials'),array('escape' => false));
echo '<br>';
echo $this->html->link('Vous avez oubli&eacute; votre mot de passe?', array('action'=>'forgotten_password'), array('escape' => false));
?>
</div>
</div>
<?php echo $this->form->end();?>
<script type="text/javascript">
$(document).ready(function()
{
// Validation
$("#registrationForm").validate({
ignore: '.ignore_validation',
rules:{
"data[User][username]":"required",
"data[User][password]":"required",
"data[User][password_confirm]":
	{
		required:true,
		equalTo:"#UserPassword"
	},
"data[User][firstname]":"required",
"data[User][lastname]":"required",
"data[User][email]":
	{
		required:true,
		email:true
	},
//"data[Phonenumber][phonenumber]":"required",
//"data[Address][line1]":"required",
//"data[Address][postcode]":"required",
//"data[Address][city]":"required",
//"data[Address][country]":"required",
},

messages:{
"data[User][username]":"Entrez un nom d\'utilisateur.",
"data[User][password]":"Entrez un mot de passe.",
"data[User][password_confirm]":
	{
		required:"Veuillez renseigner ce champ.",
		equalTo:"Ce champ doit etre identique au mot de passe."
	},
"data[User][firstname]":"Entrez un pr&eacute;nom.",
"data[User][lastname]":"Entrez un nom.",
"data[User][email]":
	{required:"Entrez une adresse Email.",
	 email:"Votre email est invalide."},
//"data[Phonenumber][phonenumber]":"Entrez un num&eacute;ro de t&eacute;l&eacute;phone.",
//"data[Address][line1]":"Ce champ est obligatoire.",
//"data[Address][postcode]":"Entrez votre code postal.",
//"data[Address][city]":"Entrez le nom de la ville.",
//"data[Address][country]":"Entrez un nom de pays.",
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