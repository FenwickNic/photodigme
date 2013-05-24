<?php
App::uses('CakeEmail', 'Network/Email');
App::uses('CakeTime','Utility');

class GroupsController extends AppController {
	
	public $components = array('Session','Aro');
	public $uses = array('Group','User');
	
    function beforeFilter() {
        parent::beforeFilter(); 
        //$this->Auth->allow('login','logout','register');
    }
	
	public function admin_getusers(){
		if(!empty($this->data)){
			$group_id = $this->data['group_id'];
			$users = $this->Aro->getUsers($group_id);
			$this->set(compact('users'));
		}		
	}
	public function admin_update(){
		if(!empty($this->data)){
			$group_name = $this->data['group_name'];
			$unicitycheck = $this->Group->findByName($group_name);
			if(!empty($unicitycheck)){
				$this->set('group',false);
				return;
			}
			if(!isset($this->data['group_id']) || empty($this->data['group_id'])){
				$group_id = '';
				$this->Group->create();
				$this->Acl->Aro->create();
			}else{
				$group_id = $this->data['group_id'];
				$this->Group->set('id', $group_id);
			}
			$this->Group->set('name', $group_name);
			if($this->Group->save()){
				$group_id = $this->Group->id;
				$group = $this->Group->findById($group_id);
				$aro = array('model'=>'Group','foreign_key'=>$group_id);
				$this->Acl->Aro->save($aro);
				$this->set('group', $group);
			}else{
				$this->set('group',false);
			}		
		}
	}		
	
	public function admin_remove(){
		if(!empty($this->data)){
			$group_id = $this->data['group_id'];
			if(in_array($group_id, array(1,2,3))){
				$this->set('response',false);
				return;
			}
			$this->Group->id = $group_id;
			if($this->Group->delete()){
				$group = $this->Acl->Aro->node(array('model'=>'Group','foreign_key'=>$group_id));
				$this->Acl->Aro->delete($group[0]['Aro']['id']);
				$this->set('response', true);
			}else{
				$this->set('response', false);
			}		
		}
	}
	
	public function admin_assignuser(){
		if(!empty($this->data)){
			$group_id = $this->data['group_id'];
			$user_id = $this->data['user_id'];
			
			$group = $this->Acl->Aro->node(array('model'=>'Group','foreign_key'=>$group_id));
			$parent_id = $group[0]['Aro']['id'];
			$aro = array('model'=>'User','foreign_key'=>$user_id,'parent_id' => $parent_id);
			$unicitytest = $this->Acl->Aro->find('first',array('conditions'=>$aro));
			if(!empty($unicitytest)){
				$response = false;
			}else{
				if($this->Acl->Aro->save($aro)){
					if($group_id == 3){
						$this->User->read(null, $user_id);
						$this->User->set('group_id', 3);
						$this->User->save();
					}
					$response = true;
				}else{
					$response = false;
				}
			}
			$this->set(compact('response'));
		}
	}
	
	public function admin_unassignuser(){
		if(!empty($this->data)){
			$group_id = $this->data['group_id'];
			$user_id = $this->data['user_id'];
			
			if(in_array($group_id, array(1,2,3))){
				$this->set('response',false);
				return;
			}
			
			$group = $this->Acl->Aro->node(array('model'=>'Group','foreign_key'=>$group_id));
			$parent_id = $group[0]['Aro']['id'];
			$aro = array('model'=>'User','foreign_key'=>$user_id,'parent_id' => $parent_id);
			if($this->Acl->Aro->deleteAll($aro)){
				if($group_id == 3){
					$this->User->read(null, $user_id);
					$this->User->set('group_id', 1);
					$this->User->save();
				}
				$response = true;
			}else{
				$response = false;
			}
			$this->set(compact('response'));
		}
	}
}