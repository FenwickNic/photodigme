<?php
App::uses('AppHelper', 'View/Helper');
 
class PhotoHelper extends AppHelper {
	
	public $helpers = array('Html');
	
	public function thumbnail($key, $options = array()){
		return $this->Html->image('assets/120/'.$key.'.jpg',array('fullBase' => true));
	}
}
?>