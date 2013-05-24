<?php
App::uses('CakeEmail', 'Network/Email');
App::uses('CakeTime','Utility');

class UsersController extends AppController {
	
	public $components = array('Session','Aro');
	public $uses = array('Group','User');
	
    function beforeFilter() {
        parent::beforeFilter(); 
        //$this->Auth->allow('login','logout','register');
    }
	
	function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->User->read(null, $this->Auth->User('id'));
				$this->User->set('lastlogin',CakeTime::format('Y-m-d H:i:s',date('Y-m-d H:i:s'),false,new DateTimeZone('Europe/Paris')));
				$this->User->save();
				return $this->redirect($this->Auth->redirect());
			} else {
				$this->set('error_for_layout',array('D&eacute;sol&eacute; votre nom d\'utilisateur ou mot de passe est invalide.'));
				return;
			}
		}
	}
	
	function logout() {
		$this->Session->setFlash('Good-Bye');
        $this->redirect($this->Auth->logout());
	}
	
	public function register(){
		$this->Auth->logout();
		if (!empty($this->data)) {
			if($this->data['User']['password'] == $this->data['User']['password_confirm']){
				$this->request->data['User']['accountcreationdate'] = CakeTime::format('Y-m-d H:i:s',date('Y-m-d H:i:s'),false,new DateTimeZone('Europe/Paris'));
				$this->request->data['User']['lastlogin'] = CakeTime::format('Y-m-d H:i:s',date('Y-m-d H:i:s'),false,new DateTimeZone('Europe/Paris'));
				$this->User->create();
				if ($this->User->saveAll($this->data)) {
					$id = $this->User->id;
					$this->Acl->Aro->create();
					$aro = array('model'=>'User','foreign_key'=>$id,'parent_id'=>1);
					$this->Acl->Aro->save($aro);
					$this->request->data['User'] = array_merge($this->request->data['User'], array('id' => $id));
					$this->Auth->login($this->request->data['User']);
					$this->redirect(array('controller'=>'pages','action'=>'home'));
				}
			}else
			{
			$register_error[] = "";
			}
		}
	}
	
	public function admin_manage(){
		$groups = $this->Group->find('all');
		$this->set('groups', $groups);	

		$users = $this->User->find('all');
		$this->set('users', $users);			
	}
}