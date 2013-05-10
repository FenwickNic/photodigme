<?php
App::uses('CakeEmail', 'Network/Email');
App::uses('CakeTime','Utility');

class GroupsController extends AppController {
	
	public $components = array('Session','Aro');
	public $uses = array('Group','User');
	
    function beforeFilter() {
        parent::beforeFilter(); 
        //$this->Auth->allow('login','logout','register');
		if ($this->request->is('ajax')) {
			$this->layout = 'ajax';
			if(!empty($this->data)){
				$this->data = json_decode($this->data,true);
			}
		}
    }
	
	public function admin_getusers(){
		if(!empty($this->data)){
			$group_id = $this->data['group_id'];
			$users = $this->Aro->getUsers($group_id);
			$this->set(compact('users'));
		}		
	}
	public function admin_add(){
		if(!empty($this->data)){
			$group_name = $this->data['group_name'];
			$unicitycheck = $this->Group->findByName($group_name);
			if(!empty($unicitycheck)){
				$this->set('group',false);
			}else{
				$this->Group->create();
				$this->Group->set('name', $group_name);
				if($this->Group->save()){
					$group_id = $this->Group->id;
					$group = $this->Group->findById($group_id);
					
					$this->Acl->Aro->create();
					$aro = array('model'=>'Group','foreign_key'=>$group_id,'alias'=>$group_name);
					$this->Acl->Aro->save($aro);
					
					$this->set('group', $group);
				}else{
					$this->set('group',false);
				}
			}		
		}
	}
	
	public function admin_remove(){
		if(!empty($this->data)){
			$group_id = $this->data['group_id'];
			$this->Group->id = $group_id;
			if($this->Group->delete()){
				$this->Acl->Aro->deleteAll(array('model'=>'Group','foreign_key'=>$group_id));
				$this->set('response', true);
			}else{
				$this->set('response', false);
			}		
		}
	}
}