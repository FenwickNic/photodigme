<?php
/**
 * Errors Controller
 *
 */
class ErrorsController extends AppController {
	
	public function accessRestricted() {
		$this->Category->moveUp(1,1);
		parent::beforeFilter();
		$this->Auth->allow('view');
		$user_id = $this->Auth->user('id');
		if(!$user_id){
			if(!$this->Acl->check(array('model' => 'Group', 'foreign_key' => 1),array('model'=>'Category','foreign_key'=> intval($this->request['pass'][0])),'read')){
				$this->redirect(array('controller' => 'errors', 'action' => 'accessRestricted'));
			}
		}else{
			if(!$this->Acl->check(array('model' => 'User', 'foreign_key' => $this->user_id),array('model'=>'Category','foreign_key'=> intval($this->request['pass'][0])),'read')){
				$this->redirect(array('controller' => 'errors', 'action' => 'accessRestricted'));
			}
		}		  
	}
	
	public function error404(){

	}
}
?>
