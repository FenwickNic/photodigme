<legend><?php echo __('Informations personelles');?></legend>
<?php
echo $this->form->input('User.title', array('options' => array('M'=>'M', 'Mme'=>'Mme','Mlle'=>'Mlle', 'Dr'=>'Dr', 'Pr'=>'Pr', 'Me'=>'Me'),'empty' => '(Choisissez)','label'=>array('text'=>'Titre', 'class'=>'control-label')));
echo $this->form->input('User.firstname', array('placeholder'=>'Prenom','label'=>array('text'=>'Pr&eacute;nom', 'class'=>'control-label'),'required'));
echo $this->form->input('User.lastname', array('placeholder'=>'Nom','label'=>array('text'=>'Nom', 'class'=>'control-label'),'required'));
echo $this->form->input('User.email', array('placeholder'=>'email','required'));
?>