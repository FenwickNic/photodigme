<legend><?php echo __('Addresse');?></legend>
<?php
echo $this->form->hidden('Address.id');
echo $this->form->input('Address.line1', array('placeholder'=>'Ligne 1','label'=>array('text'=>'Ligne 1', 'class'=>'control-label')));
echo $this->form->input('Address.line2', array('placeholder'=>'Ligne 2','label'=>array('text'=>'Ligne 2', 'class'=>'control-label')));
echo $this->form->input('Address.line3', array('placeholder'=>'Ligne 3','label'=>array('text'=>'Ligne 3', 'class'=>'control-label')));
echo $this->form->input('Address.postcode', array('placeholder'=>'Code Postal','label'=>array('text'=>'Code Postal', 'class'=>'control-label')));
echo $this->form->input('Address.city', array('placeholder'=>'Ville','label'=>array('text'=>'Ville', 'class'=>'control-label')));
echo $this->form->input('Address.country', array('label'=>array('text'=>'Pays', 'class'=>'control-label')));
?>